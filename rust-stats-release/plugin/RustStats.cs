using System;
using System.Collections.Generic;
using Newtonsoft.Json;
using Oxide.Core;
using UnityEngine;

namespace Oxide.Plugins
{
    [Info("RustStats", "YashKT", "1.4.0")]
    [Description("Comprehensive stat tracking for web leaderboard")]
    public class RustStats : RustPlugin
    {
        #region Config
        private Configuration config;
        protected override void LoadConfig() { base.LoadConfig(); config = Config.ReadObject<Configuration>(); SaveConfig(); }
        protected override void LoadDefaultConfig() => config = new Configuration();
        protected override void SaveConfig() => Config.WriteObject(config);
        class Configuration
        {
            [JsonProperty("Save interval (seconds)")]  public float SaveInterval  = 300f;
            [JsonProperty("Clear stats on wipe")]      public bool  WipeOnNewSave = true;
            [JsonProperty("Track suicides as deaths")] public bool  TrackSuicides = true;
        }
        #endregion

        #region Data
        private Dictionary<ulong, PlayerStats> data = new Dictionary<ulong, PlayerStats>();

        class PlayerStats
        {
            public string Name               = "Unknown";
            // PVP
            public int    Kills              = 0;
            public int    Deaths             = 0;
            public int    Suicides           = 0;
            public int    Headshots          = 0;
            public int    Wounds             = 0;
            public int    BulletsFired       = 0;
            public int    BulletHits         = 0;
            public float  LongestKill        = 0f;
            public int    SelfWounds         = 0;
            // PVP+
            public int    OilrigKills        = 0;
            public int    OilrigDeaths       = 0;
            public int    HeliKills          = 0;
            // PVE
            public int    AnimalKills        = 0;
            public int    NpcKills           = 0;
            public int    BradleyKills       = 0;
            // Resources
            public long   Wood               = 0;
            public long   Stone              = 0;
            public long   Metal              = 0;
            public long   Sulfur             = 0;
            public long   HQM               = 0;
            public long   Leather            = 0;
            public long   AnimalFat          = 0;
            public long   Bone               = 0;
            // Building
            public int    BlocksPlaced       = 0;
            public int    BlocksUpgraded     = 0;
            public int    DeployablesPlaced  = 0;
            public int    DoorsPlaced        = 0;
            // Raiding
            public int    C4Used             = 0;
            public int    SatchelsUsed       = 0;
            public int    HVRocketsUsed      = 0;
            public int    RocketsUsed        = 0;
            public int    OnlineRocketHits   = 0;
            public int    OfflineRocketHits  = 0;
            // Loot
            public int    CratesLooted       = 0;
            public int    BarrelsBroken      = 0;
            public int    FishGutted         = 0;
            // Farming
            public long   Cloth              = 0;
            public long   YellowBerries      = 0;
            public long   RedBerries         = 0;
            public long   BlueBerries        = 0;
            public long   GreenBerries       = 0;
            public long   WhiteBerries       = 0;
            public long   Mushrooms          = 0;
            public long   Pumpkins           = 0;
            public long   Corn               = 0;
            public long   Potatoes           = 0;
            public long   Wheat              = 0;
            public long   Flowers            = 0;
            public long   Eggs               = 0;
            // Vending
            public int    Purchases          = 0;
            public int    Sales              = 0;
            public int    ItemsBought        = 0;
            public int    ItemsSold          = 0;
            public int    DronePurchases     = 0;
            // Scrap
            public long   ScrapWagered       = 0;
            public long   ScrapWon           = 0;
            public long   RecyclerScrap      = 0;
            // Misc
            public int    Playtime           = 0;
            public int    ItemsDropped       = 0;
            public int    MissionsStarted    = 0;
            public int    MissionsDone       = 0;
            public float  TimeSwimming       = 0f;
            public float  DistanceWalked     = 0f;
            // Activity
            public int    ItemsCrafted       = 0;
            public int    ItemsRepaired      = 0;
            public int    ItemsResearched    = 0;
            public int    CardSwipes         = 0;
            public int    ButtonsPressed     = 0;
            public int    HorsesClaimed      = 0;
            public int    BoomboxToggles     = 0;
            public int    MiniHeliPurchases  = 0;
            public int    ScrapHeliPurchases = 0;
            public int    TurretKills        = 0;
            public int    TurretDeaths       = 0;
            public int    SamKills           = 0;
            public int    SamDeaths          = 0;
            // Teleports
            public int    TeleportHome       = 0;
            public int    TeleportTPR        = 0;
            public int    TeleportOutpost    = 0;
            public int    TeleportTotal      = 0;
        }

        PlayerStats GetStats(ulong id)
        {
            if (!data.ContainsKey(id)) data[id] = new PlayerStats();
            return data[id];
        }
        void SaveData() => Interface.Oxide.DataFileSystem.WriteObject($"{Name}/PlayerData", data);
        void LoadData()
        {
            data = Interface.Oxide.DataFileSystem.ExistsDatafile($"{Name}/PlayerData")
                ? Interface.Oxide.DataFileSystem.ReadObject<Dictionary<ulong, PlayerStats>>($"{Name}/PlayerData")
                : new Dictionary<ulong, PlayerStats>();
        }
        #endregion

        #region Tracking
        private Dictionary<ulong, DateTime> loginTimes    = new Dictionary<ulong, DateTime>();
        private Dictionary<ulong, Vector3>  lastPositions = new Dictionary<ulong, Vector3>();
        #endregion

        #region Lifecycle
        void OnServerInitialized()
        {
            LoadData();
            foreach (var p in BasePlayer.activePlayerList)
            {
                GetStats(p.userID).Name = p.displayName;
                loginTimes[p.userID]    = DateTime.UtcNow;
                lastPositions[p.userID] = p.transform.position;
            }
            timer.Every(config.SaveInterval, SaveData);
            timer.Every(60f, TickPlaytime);
            timer.Every(3f,  TickMovement);

            // Detect wipe by comparing save file name with stored one
            string saveFile = ConVar.Server.level + "_" + ConVar.Server.seed + "_" + ConVar.Server.worldsize;
            string flagPath = System.IO.Path.Combine(Interface.Oxide.DataDirectory, "RustStats", "savefile.txt");
            if (System.IO.File.Exists(flagPath))
            {
                string lastSave = System.IO.File.ReadAllText(flagPath).Trim();
                if (lastSave != saveFile && lastSave != "")
                {
                    Puts($"RustStats: Wipe detected! {lastSave} -> {saveFile}");
                    if (config.WipeOnNewSave) { data.Clear(); SaveData(); }
                    WriteWipeFlag();
                }
            }
            System.IO.File.WriteAllText(flagPath, saveFile);
        }
        void OnServerSave() => SaveData();
        // Save file name that was active last session
        string _lastSaveFile = "";



        void WriteWipeFlag()
        {
            System.IO.File.WriteAllText(
                System.IO.Path.Combine(Interface.Oxide.DataDirectory, "RustStats", "new_wipe.flag"),
                DateTime.UtcNow.ToString("o")
            );
            Puts("RustStats: wipe flag written.");
        }

        void OnNewSave()
        {
            // Backup: also fire on live OnNewSave (works when map changes without full restart)
            if (!config.WipeOnNewSave) return;
            data.Clear();
            SaveData();
            WriteWipeFlag();
            Puts("RustStats: wiped for new map via OnNewSave.");
        }
        void Unload() { foreach (var p in BasePlayer.activePlayerList) FlushPlaytime(p); SaveData(); }
        #endregion

        #region Connect/Disconnect
        void OnPlayerConnected(BasePlayer p)
        {
            if (p == null) return;
            GetStats(p.userID).Name = p.displayName;
            loginTimes[p.userID]    = DateTime.UtcNow;
            lastPositions[p.userID] = p.transform.position;
        }
        void OnPlayerDisconnected(BasePlayer p, string reason)
        {
            if (p == null) return;
            FlushPlaytime(p);
            loginTimes.Remove(p.userID);
            lastPositions.Remove(p.userID);
        }
        void FlushPlaytime(BasePlayer p)
        {
            if (!loginTimes.ContainsKey(p.userID)) return;
            GetStats(p.userID).Playtime += (int)(DateTime.UtcNow - loginTimes[p.userID]).TotalSeconds;
            loginTimes[p.userID] = DateTime.UtcNow;
        }
        void TickPlaytime()
        {
            foreach (var p in BasePlayer.activePlayerList)
                if (loginTimes.ContainsKey(p.userID))
                    GetStats(p.userID).Playtime += 60;
        }
        void TickMovement()
        {
            foreach (var p in BasePlayer.activePlayerList)
            {
                if (p == null || !lastPositions.ContainsKey(p.userID)) continue;
                var s = GetStats(p.userID);
                float d = Vector3.Distance(p.transform.position, lastPositions[p.userID]);
                if (d > 0.05f && d < 25f) s.DistanceWalked += d;
                lastPositions[p.userID] = p.transform.position;
                if (p.IsSwimming()) s.TimeSwimming += 3f;
            }
        }
        #endregion

        #region PVP
        void OnEntityDeath(BaseCombatEntity entity, HitInfo info)
        {
            if (entity == null || info == null) return;
            var victim = entity as BasePlayer;
            if (victim == null || victim.IsNpc) return;
            var vs  = GetStats(victim.userID);
            vs.Name = victim.displayName;
            var att = info.InitiatorPlayer;
            bool suicide = att == null || att == victim;
            if (suicide) { vs.Suicides++; if (config.TrackSuicides) vs.Deaths++; return; }
            vs.Deaths++;
            if (IsOnOilrig(victim.transform.position)) vs.OilrigDeaths++;
            if (att == null || att.IsNpc) return;
            var at = GetStats(att.userID);
            at.Name = att.displayName;
            at.Kills++;
            float dist = Vector3.Distance(att.transform.position, victim.transform.position);
            if (dist > at.LongestKill) at.LongestKill = dist;
            if (info.isHeadshot) at.Headshots++;
            // Competitive kills removed - unreliable
            if (IsOnOilrig(victim.transform.position)) at.OilrigKills++;
            // Diving kills removed
        }

        // Official hook for patrol heli kill
        void OnPatrolHelicopterKill(PatrolHelicopter heli, HitInfo info)
        {
            var att = info?.InitiatorPlayer;
            if (att != null && !att.IsNpc) GetStats(att.userID).HeliKills++;
        }

        // Bradley kill via entity death
        void OnEntityDeath(BradleyAPC bradley, HitInfo info)
        {
            var att = info?.InitiatorPlayer;
            if (att != null && !att.IsNpc) GetStats(att.userID).BradleyKills++;
        }

        // Animal kill
        void OnEntityDeath(BaseAnimalNPC animal, HitInfo info)
        {
            var att = info?.InitiatorPlayer;
            if (att != null && !att.IsNpc) GetStats(att.userID).AnimalKills++;
        }

        // NPC/Scientist kill - NPCPlayer covers scientists, tunnel dwellers etc
        void OnEntityDeath(NPCPlayer npc, HitInfo info)
        {
            var att = info?.InitiatorPlayer;
            if (att != null && !att.IsNpc) GetStats(att.userID).NpcKills++;
        }

        // Scarecrow NPC kill
        void OnEntityDeath(ScarecrowNPC npc, HitInfo info)
        {
            var att = info?.InitiatorPlayer;
            if (att != null && !att.IsNpc) GetStats(att.userID).NpcKills++;
        }



        void OnPlayerWound(BasePlayer p, HitInfo info)
        {
            if (p == null) return;
            GetStats(p.userID).Wounds++;
            if (info?.InitiatorPlayer == p) GetStats(p.userID).SelfWounds++;
        }

        void OnWeaponFired(BaseProjectile projectile, BasePlayer p, ItemModProjectile mod, ProtoBuf.ProjectileShoot projectiles)
        {
            if (p == null || p.IsNpc) return;
            GetStats(p.userID).BulletsFired++;
        }

        void OnPlayerAttack(BasePlayer att, HitInfo info)
        {
            if (att == null || att.IsNpc || info == null) return;
            if (info.HitEntity is BasePlayer t && !t.IsNpc)
                GetStats(att.userID).BulletHits++;
        }

        void OnEntityTakeDamage(BaseCombatEntity entity, HitInfo info)
        {
            if (entity == null || info == null || !(entity is BuildingBlock)) return;
            var att = info.InitiatorPlayer;
            if (att == null || att.IsNpc) return;
            if (!info.damageTypes.Has(Rust.DamageType.Explosion)) return;
            // Check if any enemy player is nearby (within 100m)
            var nearby = new List<BasePlayer>();
            Vis.Entities(entity.transform.position, 100f, nearby);
            bool online = false;
            foreach (var p in nearby)
            {
                if (p == null || p.IsNpc || p == att) continue;
                if (p.IsConnected) { online = true; break; }
            }
            if (online) GetStats(att.userID).OnlineRocketHits++;
            else        GetStats(att.userID).OfflineRocketHits++;
        }
        #endregion

        #region Explosives
        // OnExplosiveThrown - fires for satchels (thrown)
        void OnExplosiveThrown(BasePlayer p, BaseEntity entity, ThrownWeapon item)
        {
            if (p == null || entity == null) return;
            string n = entity.ShortPrefabName ?? "";
            if (n.Contains("satchel"))
                GetStats(p.userID).SatchelsUsed++;
        }

        // OnEntitySpawned - fires when C4 is placed on a surface
        // creatorEntity gives us the player who placed it
        void OnEntitySpawned(BaseNetworkable entity)
        {
            if (entity == null) return;
            string n = entity.ShortPrefabName ?? "";
            // Only track C4 (explosive.timed.prefab)
            if (!n.Equals("explosive.timed.prefab") && !n.Contains("explosive.timed")) return;
            var explosive = entity as TimedExplosive;
            if (explosive == null) return;
            var player = explosive.creatorEntity as BasePlayer;
            if (player == null || player.IsNpc) return;
            GetStats(player.userID).C4Used++;
        }

        void OnRocketLaunched(BasePlayer p, BaseEntity entity)
        {
            if (p == null || entity == null) return;
            string n = entity.ShortPrefabName ?? "";
            if (n.Contains("hv")) GetStats(p.userID).HVRocketsUsed++;
            else                  GetStats(p.userID).RocketsUsed++;
        }
        #endregion

        #region Resources
        void OnDispenserGather(ResourceDispenser d, BasePlayer p, Item item)
        {
            if (p == null || item == null) return;
            if (item.info.shortname.Contains("orchid") || item.info.shortname.Contains("rose") || item.info.shortname.Contains("flower"))
                AddResource(p.userID, item.info.shortname, item.amount);
        }

        void OnDispenserBonus(ResourceDispenser d, BasePlayer p, Item item)
        { if (p != null && item != null) AddResource(p.userID, item.info.shortname, item.amount); }

        void OnCollectiblePickup(CollectibleEntity col, BasePlayer p)
        {
            if (p == null || col?.itemList == null) return;
            foreach (var i in col.itemList)
            {
                if (i?.itemDef == null) continue;
                AddResource(p.userID, i.itemDef.shortname, (int)i.amount);
            }
        }

        // Growable plants (farm plots)
        void OnGrowableGather(GrowableEntity plant, Item item, BasePlayer p)
        {
            if (p == null || item == null) return;
            // Debug: log shortname so we can verify orchid
            Puts($"[RustStats] Gathered: shortname={item.info.shortname} amount={item.amount}");
            AddResource(p.userID, item.info.shortname, item.amount);
        }

        void AddResource(ulong id, string sh, int amt)
        {
            var s = GetStats(id);
            switch (sh)
            {
                case "wood":           s.Wood          += amt; break;
                case "stones":         s.Stone         += amt; break;
                case "metal.ore":      s.Metal         += amt; break;
                case "sulfur.ore":     s.Sulfur        += amt; break;
                case "hq.metal.ore":   s.HQM           += amt; break;
                case "leather":        s.Leather       += amt; break;
                case "fat.animal":     s.AnimalFat     += amt; break;
                case "bone.fragments": s.Bone          += amt; break;
                case "cloth":          s.Cloth         += amt; break;
                case "corn":           s.Corn          += amt; break;
                case "pumpkin":        s.Pumpkins      += amt; break;
                case "potato":         s.Potatoes      += amt; break;
                case "wheat":          s.Wheat         += amt; break;
                case "mushroom":       s.Mushrooms     += amt; break;
                case "egg.chicken":    s.Eggs          += amt; break;
                case "yellow.berry":   s.YellowBerries += amt; break;
                case "red.berry":      s.RedBerries    += amt; break;
                case "blue.berry":     s.BlueBerries   += amt; break;
                case "green.berry":    s.GreenBerries  += amt; break;
                case "white.berry":    s.WhiteBerries  += amt; break;
                case "black.berry":
                case "sunflower":      s.Flowers       += amt; break;
                // scrap from crates not tracked separately
            }
        }
        #endregion

        #region Building
        void OnEntityBuilt(Planner plan, GameObject go)
        {
            var p = plan?.GetOwnerPlayer();
            if (p == null || go == null) return;
            var s = GetStats(p.userID);
            var e = go.GetComponent<BaseEntity>();
            if (e == null) return;
            if (e is BuildingBlock) s.BlocksPlaced++;
            else if (e is Door)     s.DoorsPlaced++;
            else                    s.DeployablesPlaced++;
        }

        void OnStructureUpgrade(BuildingBlock block, BasePlayer p, BuildingGrade.Enum grade)
        { if (p != null) GetStats(p.userID).BlocksUpgraded++; }

        // Card Swipes at monuments - CONFIRMED in official docs Electronic(18)
        void OnCardSwipe(CardReader reader, Keycard card, BasePlayer p)
        {
            if (p == null || p.IsNpc) return;
            GetStats(p.userID).CardSwipes++;
        }

        // Items Crafted - correct signature post Aug 2023 Rust update
        // itemCrafter.owner is the player, task.owner was removed
        void OnItemCraftFinished(ItemCraftTask task, Item item, ItemCrafter itemCrafter)
        {
            var p = itemCrafter?.owner;
            if (p == null || p.IsNpc) return;
            GetStats(p.userID).ItemsCrafted++;
        }

        // Items Repaired - CONFIRMED in Item(64) official docs
        void OnItemRepair(BasePlayer p, Item item)
        {
            if (p == null || p.IsNpc) return;
            GetStats(p.userID).ItemsRepaired++;
        }

        // Items Researched - CONFIRMED in Item(64) official docs
        void OnItemResearched(ResearchTable table, Item item, BasePlayer p)
        {
            if (p == null || p.IsNpc) return;
            GetStats(p.userID).ItemsResearched++;
        }

        // OnPipeConnect not in official Oxide docs - tracking via OnWireConnect only
        #endregion

        #region Loot
        void OnLootEntity(BasePlayer p, BaseEntity entity)
        {
            if (p == null || entity == null) return;
            string n = entity.ShortPrefabName ?? "";
            if (n.Contains("supply_drop") || n.Contains("heli_crate") || n.Contains("bradley_crate"))
                GetStats(p.userID).CratesLooted++;
        }

        void OnLootEntityEnd(BasePlayer p, BaseCombatEntity entity)
        {
            if (p == null || entity == null) return;
            if ((entity.ShortPrefabName ?? "").Contains("barrel"))
            {
                GetStats(p.userID).BarrelsBroken++;
            }
        }

        // CrateHackEnd kept but tracks SurveyCharges now via OnSurveyGather above

        void OnFishCaught(Item fish, BaseFishingRod rod, BasePlayer p)
        { if (p != null) GetStats(p.userID).FishGutted++; }
        #endregion

        #region Vending — confirmed hook from VendingMachineLogs plugin
        void OnVendingTransaction(VendingMachine machine, BasePlayer buyer, int sellOrderId, int numberOfTransactions)
        {
            // Track helicopter purchases from Airwolf vendor at Bandit Camp
            if (buyer != null && !buyer.IsNpc && machine != null)
            {
                try {
                    var order = machine.sellOrders.sellOrders[sellOrderId];
                    int cost = order.currencyAmountPerItem * numberOfTransactions;
                    // Minicopter = 750 scrap, Scrap Heli = 1250 scrap
                    if (order.currencyID == -932201673) // scrap item ID
                    {
                        if (cost == 750)  GetStats(buyer.userID).MiniHeliPurchases++;
                        else if (cost == 1250) GetStats(buyer.userID).ScrapHeliPurchases++;
                    }
                } catch {}
            }
            // Detect helicopter purchases from Airwolf vendor at Bandit Camp
            // Minicopter = 750 scrap, Scrap Heli = 1250 scrap
            if (machine != null && buyer != null)
            {
                try {
                    var order = machine.sellOrders.sellOrders[sellOrderId];
                    // Check item being sold - minicopter or scrap heli
                    string itemName = order.itemToSellID.ToString();
                    // Minicopter item ID: 1567775535, Scrap Heli: -1252059217
                    if (order.itemToSellID == 1567775535)
                        GetStats(buyer.userID).MiniHeliPurchases++;
                    else if (order.itemToSellID == -1252059217)
                        GetStats(buyer.userID).ScrapHeliPurchases++;
                    // Also detect by cost: 750 = minicopter, 1250 = scrap heli
                    else if (order.currencyAmountPerItem == 750)
                        GetStats(buyer.userID).MiniHeliPurchases++;
                    else if (order.currencyAmountPerItem == 1250)
                        GetStats(buyer.userID).ScrapHeliPurchases++;
                } catch {}
            }
            if (buyer == null || machine == null) return;
            var s = GetStats(buyer.userID);
            s.Purchases++;

            try {
                var order = machine.sellOrders?.sellOrders?[sellOrderId];
                if (order != null) {
                    s.ItemsBought += order.itemToSellAmount * numberOfTransactions;
                    s.ItemsSold   += order.currencyAmountPerItem * numberOfTransactions;
                }
            } catch { }

            // Track owner's sales
            if (machine.OwnerID != 0)
            {
                var owner = GetStats(machine.OwnerID);
                owner.Sales++;
            }
        }
        #endregion

        #region Scrap Wheel — official hooks: OnBigWheelWin / OnBigWheelLoss
        void OnBigWheelWin(BigWheelGame wheel, float angle, BasePlayer player)
        { if (player != null) GetStats(player.userID).ScrapWon++; }

        void OnBigWheelLoss(BigWheelGame wheel, float angle, BasePlayer player)
        { if (player != null) GetStats(player.userID).ScrapWagered++; }

        // Recycler scrap output
        void OnItemAddedToContainer(ItemContainer container, Item item)
        {
            if (item == null || container == null) return;
            var p = container.playerOwner;
            if (p == null || p.IsNpc) return;
            string n = item.info?.shortname ?? "";
            if (n == "scrap" && container.entityOwner is Recycler)
                GetStats(p.userID).RecyclerScrap += item.amount;
        }
        #endregion

        #region Misc
        void OnItemDropped(Item item, BaseEntity entity)
        {
            var p = item?.GetOwnerPlayer();
            if (p != null) GetStats(p.userID).ItemsDropped++;
        }

        // Buttons Pressed - CONFIRMED in official docs Electronic(18)
        void OnButtonPress(BasePlayer p, PressButton button)
        {
            if (p == null || p.IsNpc) return;
            GetStats(p.userID).ButtonsPressed++;
        }

        // Boombox Toggle - OnSwitchToggle CONFIRMED in official docs Entity
        // Check parent is DeployableBoomBox
        void OnSwitchToggle(ElectricSwitch sw, BasePlayer p)
        {
            if (p == null || p.IsNpc || sw == null) return;
            if (sw.GetParentEntity() is DeployableBoomBox)
                GetStats(p.userID).BoomboxToggles++;
        }

        // Boombox Toggle - OnSwitchToggle confirmed in official docs Entity(103)
        // DeployableBoomBox is a switch entity
        void OnSwitchToggle(IOEntity entity, BasePlayer p)
        {
            if (p == null || p.IsNpc) return;
            if (entity is DeployableBoomBox || (entity?.ShortPrefabName ?? "").Contains("boombox"))
                GetStats(p.userID).BoomboxToggles++;
        }

        // Horses Claimed - CONFIRMED in official docs Animal(7)
        void OnRidableAnimalClaim(BasePet pet, BasePlayer p)
        {
            if (p == null || p.IsNpc) return;
            GetStats(p.userID).HorsesClaimed++;
        }

        void OnMissionStarted(BasePlayer p, BaseMission mission)
        { if (p != null) GetStats(p.userID).MissionsStarted++; }

        void OnMissionSucceeded(BasePlayer p, BaseMission.MissionInstance instance)
        { if (p != null) GetStats(p.userID).MissionsDone++; }
        #endregion

        #region Teleport tracking via chat commands (works with any teleport plugin)
        // OnPlayerCommand fires for every chat command - confirmed in official docs
        void OnPlayerCommand(BasePlayer player, string command, string[] args)
        {
            if (player == null || player.IsNpc) return;
            string cmd = command.ToLower().TrimStart('/');
            var s = GetStats(player.userID);

            // Home teleport: /home <name>
            if (cmd == "home" && args != null && args.Length > 0)
            {
                s.TeleportHome++;
                s.TeleportTotal++;
                return;
            }

            // TPR: /tpr <player>
            if (cmd == "tpr" && args != null && args.Length > 0)
            {
                s.TeleportTPR++;
                s.TeleportTotal++;
                return;
            }

            // TPA: player accepts TPR
            if (cmd == "tpa")
            {
                s.TeleportTPR++;
                s.TeleportTotal++;
                return;
            }

            // Outpost
            if (cmd == "outpost")
            {
                s.TeleportOutpost++;
                s.TeleportTotal++;
                return;
            }
        }
        #endregion

        #region Helpers
        // Check if position is on an oilrig by looking for oilrig entities nearby
        bool IsOnOilrig(Vector3 pos)
        {
            var entities = new List<BaseEntity>();
            Vis.Entities(pos, 50f, entities);
            foreach (var e in entities)
            {
                string n = e?.ShortPrefabName ?? "";
                if (n.Contains("oilrig") || n.Contains("oil_rig")) return true;
            }
            return false;
        }

        [ConsoleCommand("ruststats.save")]
        void CmdSave(ConsoleSystem.Arg arg) { SaveData(); Puts("RustStats: saved."); }

        [ConsoleCommand("ruststats.wipe")]
        void CmdWipe(ConsoleSystem.Arg arg)
        {
            var p = arg?.Player();
            if (p != null && !p.IsAdmin) return;
            data.Clear(); SaveData(); Puts("RustStats: wiped.");
        }
        #endregion
    }
}
