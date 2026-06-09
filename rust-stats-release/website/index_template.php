<?php
ini_set('display_errors', 0);
// ─────────────────────────────────────────────
// CONFIG
// ─────────────────────────────────────────────
define('DB_HOST',      'localhost');           // Your MySQL host
define('DB_NAME',      'your_database_name');  // Your database name
define('DB_USER',      'your_db_username');    // Your database username
define('DB_PASS',      'your_db_password');    // Your database password
define('SERVER_NAME',  'Your Server Name');    // Your server name
define('LOGO_URL',     '/logo.png');
define('DISCORD_URL',  'https://discord.gg/yourlink'); // Your Discord invite
define('SERVER_IP', '140.238.249.147:28015');
define('QUERY_PORT',   '28016');
define('ROWS_PER_PAGE', 25);
define('CACHE_SECONDS', 120);
// Icons folder — upload your icons here on Hostinger
define('ICON_URL',     '/icons/');
// ─────────────────────────────────────────────

// Item icon filenames (upload these to /icons/ folder on Hostinger)
$icons = array(
    'kills'             => 'skull.human.png',
    'deaths'            => 'coffin.storage.png',
    'kdr'               => 'target.reactive.png',
    'suicides'          => 'grenade.f1.png',
    'headshots'         => 'bow.hunting.png',
    'wounds'            => 'syringe.medical.png',
    'bullets_fired'     => 'ammo.rifle.png',
    'bullet_hits'       => 'ammo.rifle.explosive.png',
    'longest_kill'      => 'rifle.bolt.png',
    'competitive_kills' => 'pistol.python.png',
    'self_wounds'       => 'bandage.png',
    'oilrig_kills'      => 'explosive.satchel.png',
    'oilrig_deaths'     => 'coffin.storage.png',
    'heli_kills'        => 'rocket.launcher.png',
    'diving_kills'      => 'diving.mask.png',
    'sub_kills'         => 'submarine.torpedo.straight.png',
    'animal_kills'      => 'crossbow.png',
    'bradley_kills'     => 'rocket.launcher.png',
    'npc_kills'         => 'pistol.revolver.png',
    'boats_destroyed'   => 'paddle.png',
    'subs_destroyed'    => 'submarine.torpedo.straight.png',
    'sulfur'            => 'sulfur.ore.png',
    'metal'             => 'metal.ore.png',
    'hqm'               => 'hq.metal.ore.png',
    'stone'             => 'stones.png',
    'wood'              => 'wood.png',
    'leather'           => 'leather.png',
    'animal_fat'        => 'fat.animal.png',
    'bone'              => 'bone.fragments.png',
    'blocks_placed'     => 'hammer.png',
    'blocks_upgraded'   => 'hammer.salvaged.png',
    'deployables'       => 'door.hinged.wood.png',
    'doors_placed'      => 'door.hinged.metal.png',
    'wiring_meters'     => 'wiretool.png',
    'piping_meters'     => 'fluid.combiner.png',
    'hose_meters'       => 'bucket.water.png',
    'c4_used'           => 'explosive.timed.png',
    'satchels_used'     => 'explosive.satchel.png',
    'hv_rockets'        => 'ammo.rocket.hv.png',
    'rockets_used'      => 'ammo.rocket.basic.png',
    'online_hits'       => 'ammo.rocket.fire.png',
    'offline_hits'      => 'ammo.rocket.smoke.png',
    'crates_looted'     => 'crate.elite.png',
    'barrels_broken'    => 'explosive.satchel.png',
    'crates_freed'      => 'crate.elite.png',
    'fish_gutted'       => 'fish.raw.png',
    'cloth'             => 'cloth.png',
    'yellow_berries'    => 'yellow.berry.png',
    'red_berries'       => 'red.berry.png',
    'blue_berries'      => 'blue.berry.png',
    'green_berries'     => 'green.berry.png',
    'white_berries'     => 'white.berry.png',
    'mushrooms'         => 'mushroom.png',
    'pumpkins'          => 'pumpkin.png',
    'corn'              => 'corn.png',
    'potatoes'          => 'potato.png',
    'wheat'             => 'seed.wheat.png',
    'flowers'           => 'sunflower.png',
    'eggs'              => 'egg.png',
    'purchases'         => 'vending.machine.png',
    'sales'             => 'vending.machine.png',
    'items_bought'      => 'box.wooden.png',
    'items_sold'        => 'box.wooden.large.png',
    'drone_purchases'   => 'drone.png',
    'scrap_wagered'     => 'scrap.png',
    'scrap_won'         => 'scrap.png',
    'barrel_scrap'      => 'scrap.png',
    'crate_scrap'       => 'scrap.png',
    'recycler_scrap'    => 'scrap.png',
    'playtime'          => 'clock.alarm.png',
    'items_dropped'     => 'dropbox.png',
    'missions_started'  => 'map.png',
    'missions_done'     => 'map.png',
    'subs_destroyed'    => 'submarine.torpedo.straight.png',
    'boats_destroyed'   => 'paddle.png',
    'time_swimming'     => 'diving.fins.png',
    'teleport_total'    => 'sleepingbag.png',
    'teleport_home'     => 'sleepingbag.png',
    'teleport_tpr'      => 'sleepingbag.png',
    'teleport_outpost'  => 'hat.miner.png',
    'teleport_bandit'   => 'mask.bandana.png',
    'total_kills'       => 'skull.human.png',
    'clan_kdr'          => 'target.reactive.png',
    'total_deaths'      => 'coffin.storage.png',
    'member_count'      => 'hat.wolf.png',
    'total_c4'          => 'explosive.timed.png',
    'total_rockets'     => 'rocket.launcher.png',
    'total_wood'        => 'wood.png',
    'total_stone'       => 'stones.png',
    'total_sulfur'      => 'sulfur.ore.png',
    'player_col'        => 'hazmatsuit.png',
);

// Tab icons shown before tab label
$tab_icons = array(
    'pvp'       => 'skull.human.png',
    'pvpplus'   => 'pistol.python.png',
    'pve'       => 'crossbow.png',
    'resources' => 'sulfur.ore.png',
    'building'  => 'hammer.png',
    'raiding'   => 'explosive.timed.png',
    'loot'      => 'crate.normal.png',
    'farming'   => 'corn.png',
    'vending'   => 'vending.machine.png',
    'scrap'     => 'scrap.png',
    'misc'      => 'map.png',
    'teleport'  => 'sleepingbag.png',
    'clans'     => 'hat.wolf.png',
);

$tabs = array(
  'pvp'       => array('label'=>'PVP',       'icon'=>'pvp',       'cols'=>array('kills'=>'Kills','deaths'=>'Deaths','kdr'=>'KDR','suicides'=>'Suicides','headshots'=>'Headshot','wounds'=>'Wounds','bullets_fired'=>'Bullets Fired','bullet_hits'=>'Bullet Hits','longest_kill'=>'Longest Kill')),
  'pvpplus'   => array('label'=>'PVP+',      'icon'=>'pvpplus',   'cols'=>array('competitive_kills'=>'Competitive Kills','longest_kill'=>'Longest Kill','self_wounds'=>'Self-Wounds','oilrig_kills'=>'Oilrig Kills','oilrig_deaths'=>'Oilrig Deaths','heli_kills'=>'Heli Kills','diving_kills'=>'Diving Kills','sub_kills'=>'Sub Kills')),
  'pve'       => array('label'=>'PVE',       'icon'=>'pve',       'cols'=>array('animal_kills'=>'Animal Kills','bradley_kills'=>'Bradley Kills','npc_kills'=>'NPC Kills','boats_destroyed'=>'Boats Destroyed','subs_destroyed'=>'Subs Destroyed')),
  'resources' => array('label'=>'Resources', 'icon'=>'resources', 'cols'=>array('sulfur'=>'Sulfur','metal'=>'Metal Ore','hqm'=>'HQM Ore','stone'=>'Stone','wood'=>'Wood','leather'=>'Leather','animal_fat'=>'Animal Fat','bone'=>'Bone Fragments')),
  'building'  => array('label'=>'Building',  'icon'=>'building',  'cols'=>array('blocks_placed'=>'Blocks Placed','blocks_upgraded'=>'Blocks Upgraded','deployables'=>'Deployables','doors_placed'=>'Doors Placed','wiring_meters'=>'Wiring Meters','piping_meters'=>'Piping Meters','hose_meters'=>'Hose Meters')),
  'raiding'   => array('label'=>'Raiding',   'icon'=>'raiding',   'cols'=>array('c4_used'=>'C4','satchels_used'=>'Satchels','hv_rockets'=>'HV Rockets','rockets_used'=>'Rockets','online_hits'=>'Online Rocket Hits','offline_hits'=>'Offline Rocket Hits')),
  'loot'      => array('label'=>'Loot',      'icon'=>'loot',      'cols'=>array('crates_looted'=>'Loot Crates Looted','barrels_broken'=>'Loot Barrels Broken','crates_freed'=>'Loot Crates Freed','fish_gutted'=>'Fish Gutted')),
  'farming'   => array('label'=>'Farming',   'icon'=>'farming',   'cols'=>array('cloth'=>'Cloth','yellow_berries'=>'Yellow Berries','red_berries'=>'Red Berries','blue_berries'=>'Blue Berries','green_berries'=>'Green Berries','white_berries'=>'White Berries','mushrooms'=>'Mushrooms','pumpkins'=>'Pumpkins','corn'=>'Corn','potatoes'=>'Potatoes','wheat'=>'Wheat','flowers'=>'Hemp','eggs'=>'Eggs')),
  'vending'   => array('label'=>'Vending',   'icon'=>'vending',   'cols'=>array('purchases'=>'Purchases','sales'=>'Sales','items_bought'=>'Items Bought','items_sold'=>'Items Sold','drone_purchases'=>'Drone Purchases')),
  'scrap'     => array('label'=>'Scrap',     'icon'=>'scrap',     'cols'=>array('scrap_wagered'=>'Scrap Wagered (Wheel)','scrap_won'=>'Scrap Won (Wheel)','barrel_scrap'=>'Barrel Scrap','crate_scrap'=>'Crate Scrap','recycler_scrap'=>'Recycler Scrap')),
  'misc'      => array('label'=>'Misc',      'icon'=>'misc',      'cols'=>array('playtime'=>'Time Played','items_dropped'=>'Items Dropped','missions_started'=>'Missions Started','missions_done'=>'Missions Completed','subs_destroyed'=>'Subs Destroyed','boats_destroyed'=>'Boats Destroyed','time_swimming'=>'Time Swimming')),
  'teleport'  => array('label'=>'Teleports', 'icon'=>'teleport',  'cols'=>array('teleport_total'=>'Total Teleports','teleport_home'=>'Home TP','teleport_tpr'=>'Player TP (TPR)','teleport_outpost'=>'Outpost TP')),
  'clans'     => array('label'=>'Clans',     'icon'=>'clans',     'cols'=>array('total_kills'=>'Clan Kills','clan_kdr'=>'Clan KDR','total_deaths'=>'Clan Deaths','member_count'=>'Members','total_c4'=>'C4 Used','total_rockets'=>'Rockets','total_wood'=>'Wood','total_stone'=>'Stone','total_sulfur'=>'Sulfur')),
);

$active_tab  = (isset($_GET['tab']) && isset($tabs[$_GET['tab']])) ? $_GET['tab'] : 'pvp';
$tab_cols    = $tabs[$active_tab]['cols'];
$first_col   = array_key_first($tab_cols);
$sort        = (isset($_GET['sort']) && array_key_exists($_GET['sort'], $tab_cols)) ? $_GET['sort'] : $first_col;
$page        = max(1, intval(isset($_GET['page']) ? $_GET['page'] : 1));
$search      = trim(isset($_GET['q']) ? $_GET['q'] : '');
$offset      = ($page - 1) * ROWS_PER_PAGE;
$is_clan     = ($active_tab === 'clans');

function get_steam_avatar($steamid) {
    if (empty($steamid)) return '';
    $cache_file = sys_get_temp_dir() . '/steam_av_' . $steamid . '.txt';
    // Cache avatar URL for 24 hours
    if (file_exists($cache_file) && (time() - filemtime($cache_file)) < 21600) {
        return trim(file_get_contents($cache_file));
    }
    try {
        $xml_url = 'https://steamcommunity.com/profiles/' . $steamid . '/?xml=1';
        $ctx = stream_context_create(array('http' => array('timeout' => 3, 'user_agent' => 'Mozilla/5.0')));
        $xml = @file_get_contents($xml_url, false, $ctx);
        if ($xml && preg_match('/<avatarFull><!\[CDATA\[(.+?)\]\]><\/avatarFull>/', $xml, $m)) {
            file_put_contents($cache_file, $m[1]);
            return $m[1];
        }
    } catch(Exception $e) {}
    return '';
}

function get_db() {
    static $pdo = null;
    if ($pdo) return $pdo;
    $pdo = new PDO(
        'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',
        DB_USER, DB_PASS,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    return $pdo;
}

// Wipe selector
$selected_wipe = isset($_GET['wipe']) ? intval($_GET['wipe']) : 0;
$wipes_list = array();

try {
    $db = get_db();
    $player_total = (int)$db->query("SELECT COUNT(*) FROM players")->fetchColumn();
    // Load wipes for dropdown
    try {
        $wipes_list = $db->query("SELECT wipe_id, label, is_current, start_date FROM wipes ORDER BY start_date DESC")->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $ew) { $wipes_list = array(); }
    $online_ids = array();
    try {
        $online_count = (int)$db->query("SELECT COUNT(*) FROM online_players WHERE last_seen >= DATE_SUB(UTC_TIMESTAMP(), INTERVAL 3 MINUTE)")->fetchColumn();
        $online_ids_raw = $db->query("SELECT steam_id FROM online_players WHERE last_seen >= DATE_SUB(UTC_TIMESTAMP(), INTERVAL 3 MINUTE)")->fetchAll(PDO::FETCH_COLUMN);
        $online_ids = array_flip($online_ids_raw);
    } catch(Exception $e2) {
        $online_count = 0;
        $online_ids = array();
    }

    $tbl    = $is_clan ? 'clans' : 'players';
    $where  = '';
    $params = array();
    if ($search !== '') {
        $name_col = $is_clan ? 'name' : 'display_name';
        $where = "WHERE $name_col LIKE :q";
        $params[':q'] = '%' . $search . '%';
    }

    $st = $db->prepare("SELECT COUNT(*) FROM $tbl $where");
    $st->execute($params);
    $total = (int)$st->fetchColumn();

    if ($is_clan) {
        $col_select = 'tag, name, member_count, ' . implode(', ', array_keys($tab_cols));
    } else {
        $col_select = 'steam_id, display_name, last_updated, ' . implode(', ', array_keys($tab_cols));
    }

    $st = $db->prepare("SELECT $col_select FROM $tbl $where ORDER BY `$sort` DESC LIMIT :lim OFFSET :off");
    foreach ($params as $k => $v) $st->bindValue($k, $v);
    $st->bindValue(':lim', ROWS_PER_PAGE, PDO::PARAM_INT);
    $st->bindValue(':off', $offset,       PDO::PARAM_INT);
    $st->execute();
    $players = $st->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $players = array(); $total = 0; $player_total = 0; $online_count = 0;
}

$total_pages = max(1, (int)ceil($total / ROWS_PER_PAGE));

function fmt($col, $val) {
    if (in_array($col, array('playtime','time_swimming'))) {
        $s = (int)$val;
        return intdiv($s, 3600).'h '.intdiv($s % 3600, 60).'m';
    }
    if (in_array($col, array('longest_kill','wiring_meters','piping_meters','hose_meters','distance_walked')))
        return number_format((float)$val, 1).'m';
    if ($col === 'kdr' || $col === 'clan_kdr')
        return number_format((float)$val, 2);
    $n = (int)$val;
    if ($n >= 1000000) return number_format($n/1000000, 1).'M';
    if ($n >= 1000)    return number_format($n/1000, 1).'k';
    return (string)$n;
}

function icon_img($col, $icons) {
    if (!isset($icons[$col]) || !$icons[$col]) return '';
    return '<img src="'.ICON_URL.$icons[$col].'" style="width:20px;height:20px;vertical-align:middle;margin-right:5px;image-rendering:pixelated;" onerror="this.style.display=\'none\'">';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars(SERVER_NAME); ?> &mdash; Player Leaderboard</title>
<meta name="description" content="Live player leaderboard for <?php echo htmlspecialchars(SERVER_NAME); ?> Rust server. Track kills, raids, resources, and more. Updated every 5 minutes.">
<meta name="keywords" content="Rust server, leaderboard, Rust Samrajya, player stats, PVP, raiding">
<meta property="og:title" content="<?php echo htmlspecialchars(SERVER_NAME); ?> Leaderboard">
<meta property="og:description" content="Live player stats for <?php echo htmlspecialchars(SERVER_NAME); ?> Rust server">
<meta property="og:image" content="/logo.png">
<meta property="og:url" content="https://your-leaderboard-url.com">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://your-leaderboard-url.com">
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Share+Tech+Mono&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--bg:#0a0c0f;--surf:#111418;--border:#1e2530;--acc:#e85d04;--acc2:#f48c06;--text:#d6dce8;--muted:#5a6478;--gold:#f4c430;--silver:#9fb4cc;--bronze:#cd7f32;--green:#4ade80;--red:#f87171}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{font-size:17px}
body{background:var(--bg);color:var(--text);font-family:'Inter',sans-serif;min-height:100vh;background-image:radial-gradient(ellipse 80% 50% at 50% -20%,rgba(232,93,4,.13),transparent)}
header{border-bottom:2px solid var(--border);padding:16px 32px;width:100%;box-shadow:0 0 30px rgba(232,93,4,.1);display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;background:linear-gradient(180deg,rgba(232,93,4,.07) 0%,transparent 100%)}
.hl{display:flex;align-items:center;gap:14px}
.logo{height:50px;object-fit:contain}
.lt{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;letter-spacing:3px;color:#fff;line-height:1;text-shadow:0 0 28px rgba(232,93,4,.35)}
.ls{font-family:'Share Tech Mono',monospace;font-size:.72rem;color:var(--acc);letter-spacing:4px;text-transform:uppercase;margin-top:2px}
.hbtns{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.hbtn{display:flex;align-items:center;gap:7px;font-family:'Share Tech Mono',monospace;font-size:.75rem;letter-spacing:1px;text-transform:uppercase;padding:9px 16px;border-radius:8px;text-decoration:none;transition:background .2s;white-space:nowrap;color:#fff}
.hbtn-discord{background:#5865F2}.hbtn-discord:hover{background:#4752c4}
.hbtn-play{background:var(--acc)}.hbtn-play:hover{background:#c44d03}
.hbtn-insta{background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);padding:9px 11px}
.hbtn-copyip{background:var(--surf);border:1px solid var(--border);color:var(--text);cursor:pointer;position:relative;overflow:hidden}
.hbtn-copyip::after{content:'';position:absolute;inset:0;background:var(--green);transform:scaleX(0);transform-origin:left;transition:transform .4s ease;z-index:0}
.hbtn-copyip.copied::after{transform:scaleX(1)}
.hbtn-copyip svg,.hbtn-copyip span{position:relative;z-index:1;transition:color .2s}
.hbtn-copyip.copied svg,.hbtn-copyip.copied span{color:#000}
.hbtn-copyip:hover{border-color:var(--green);color:var(--green)}
.hbtn-insta:hover{opacity:.85;transform:scale(1.05)}

/* ── PARTICLES ── */
#particle-canvas{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:0}
.wrap,.tabs,.bar,.sb,.tw,.pg,header,footer{position:relative;z-index:1}

/* ── RANK NUMBERS ── */
.r1{color:var(--gold);animation:goldpulse 3s ease-in-out infinite}
.r2{color:var(--silver);animation:silverpulse 3.5s ease-in-out infinite}
.r3{color:var(--bronze);animation:bronzepulse 4s ease-in-out infinite}
@keyframes goldpulse{0%,100%{text-shadow:0 0 8px rgba(244,196,48,.4)}50%{text-shadow:0 0 20px rgba(244,196,48,.9),0 0 40px rgba(244,196,48,.3)}}
@keyframes silverpulse{0%,100%{text-shadow:0 0 4px rgba(159,180,204,.3)}50%{text-shadow:0 0 14px rgba(159,180,204,.8)}}
@keyframes bronzepulse{0%,100%{text-shadow:0 0 4px rgba(205,127,50,.3)}50%{text-shadow:0 0 14px rgba(205,127,50,.8)}}

/* ── TOP 3 ROWS ── */
tr.t1{animation:goldrow 2.5s ease-in-out infinite}
tr.t2{animation:silverrow 3s ease-in-out infinite}
tr.t3{animation:bronzerow 3.5s ease-in-out infinite}
tr.t1,tr.t2,tr.t3{opacity:1!important} tr.t1 td,tr.t2 td,tr.t3 td{background:transparent!important}
@keyframes goldrow{0%,100%{background:rgba(244,196,48,.03)!important;box-shadow:inset 3px 0 0 rgba(244,196,48,.5)}50%{background:rgba(244,196,48,.07)!important;box-shadow:inset 3px 0 0 rgba(244,196,48,1)}}
@keyframes silverrow{0%,100%{background:rgba(159,180,204,.02)!important;box-shadow:inset 3px 0 0 rgba(159,180,204,.4)}50%{background:rgba(159,180,204,.06)!important;box-shadow:inset 3px 0 0 rgba(159,180,204,.9)}}
@keyframes bronzerow{0%,100%{background:rgba(205,127,50,.02)!important;box-shadow:inset 3px 0 0 rgba(205,127,50,.4)}50%{background:rgba(205,127,50,.06)!important;box-shadow:inset 3px 0 0 rgba(205,127,50,.9)}}

/* ── ROW ENTRANCE ── */
tbody tr{animation:rowin .5s cubic-bezier(.22,1,.36,1) both}
tbody tr:nth-child(1){animation-delay:.04s}
tbody tr:nth-child(2){animation-delay:.1s}
tbody tr:nth-child(3){animation-delay:.16s}
tbody tr:nth-child(4){animation-delay:.22s}
tbody tr:nth-child(5){animation-delay:.28s}
tbody tr:nth-child(6){animation-delay:.34s}
tbody tr:nth-child(n+7){animation-delay:.4s}
@keyframes rowin{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

/* ── ROW HOVER ── */
tbody tr{transition:background .2s,transform .15s,box-shadow .2s}
tbody tr:hover{background:rgba(232,93,4,.05)!important;transform:translateX(4px);box-shadow:-3px 0 0 var(--acc)}

/* ── LIVE DOT ── */
.dot{animation:livepulse 2s ease-in-out infinite}
@keyframes livepulse{0%,100%{box-shadow:0 0 0 0 rgba(74,222,128,.6)}50%{box-shadow:0 0 0 5px rgba(74,222,128,0)}}

/* ── ACTIVE SORT GLOW ── */
.sbt.on{box-shadow:0 0 0 1px var(--acc),0 0 16px rgba(232,93,4,.3);animation:sortpulse 2s ease-in-out infinite}
@keyframes sortpulse{0%,100%{box-shadow:0 0 0 1px var(--acc),0 0 10px rgba(232,93,4,.2)}50%{box-shadow:0 0 0 1px var(--acc),0 0 22px rgba(232,93,4,.5)}}

/* ── TAB UNDERLINE ── */
.tb.on{position:relative}
.tb.on::after{content:'';position:absolute;bottom:-2px;left:50%;transform:translateX(-50%);width:0;height:2px;background:var(--acc);animation:tabunder .35s cubic-bezier(.22,1,.36,1) forwards}
@keyframes tabunder{to{width:100%;left:0;transform:none}}

/* ── HEADER ACCENT LINE ── */
header{border-top:2px solid transparent;animation:headertop 4s ease-in-out infinite}
@keyframes headertop{0%,100%{border-top-color:rgba(232,93,4,.4)}50%{border-top-color:rgba(232,93,4,.9)}}

/* ── ICON HOVER ── */
.sbt:hover img,.tb:hover img{transform:scale(1.15) rotate(-5deg);transition:transform .2s cubic-bezier(.34,1.56,.64,1)}

/* ── LOGO TITLE ── */
.lt{letter-spacing:3px;animation:logobreathe 4s ease-in-out infinite}
@keyframes logobreathe{0%,100%{letter-spacing:3px}50%{letter-spacing:4px}}

/* ── SEARCH FOCUS ── */
.si:focus{border-color:var(--acc);box-shadow:0 0 0 3px rgba(232,93,4,.12),0 0 20px rgba(232,93,4,.06)}

/* ── BADGE NUMBERS ── */
.badge span{font-weight:700;color:#fff;transition:all .3s}

/* ── STAT HOVER ── */
tbody tr:hover td:not(:first-child):not(:nth-child(2)){color:#fff;transition:color .15s}
.badge{display:flex;align-items:center;gap:8px;font-family:'Share Tech Mono',monospace;font-size:.76rem;color:#b0bec5;background:var(--surf);border:1px solid var(--border);padding:8px 14px;border-radius:8px;letter-spacing:1px}
.wipe-dd{position:relative;z-index:999}
.wipe-dd-btn{display:flex;align-items:center;gap:8px;background:var(--surf);border:1px solid var(--border);color:var(--text);font-family:'Share Tech Mono',monospace;font-size:.75rem;padding:9px 16px;border-radius:8px;cursor:pointer;letter-spacing:1px;transition:all .2s;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,0,.3)}
.wipe-dd-btn:hover{border-color:var(--acc);color:var(--acc)}
.wipe-dd-btn.open{border-color:var(--acc);color:var(--acc)}
.wipe-dd-btn.open .wipe-dd-arrow{transform:rotate(180deg)}
.wipe-dd-menu{position:absolute;bottom:calc(100% + 6px);right:0;min-width:240px;background:#0d1117;border:1px solid rgba(232,93,4,.3);border-radius:10px;overflow:hidden;opacity:0;transform:translateY(8px) scale(.95);pointer-events:none;transition:opacity .2s ease,transform .25s cubic-bezier(.22,1,.36,1);box-shadow:0 -8px 40px rgba(0,0,0,.8),0 0 0 1px rgba(232,93,4,.1);z-index:9999}
.wipe-dd-menu.open{opacity:1;transform:translateY(0) scale(1);pointer-events:all}
.wipe-dd-item{display:flex;align-items:center;gap:10px;padding:10px 14px;color:var(--muted);font-family:'Share Tech Mono',monospace;font-size:.72rem;letter-spacing:1px;text-decoration:none;transition:all .15s;border-bottom:1px solid rgba(30,37,48,.5)}
.wipe-dd-item:last-child{border-bottom:none}
.wipe-dd-item:hover{background:rgba(232,93,4,.08);color:var(--text);padding-left:18px}
.wipe-dd-item.active{background:rgba(232,93,4,.12);color:var(--acc);border-left:2px solid var(--acc)}
.wipe-dd-icon{font-size:.9rem;flex-shrink:0;width:16px;text-align:center}
.wipe-dd-tag{margin-left:auto;font-size:.6rem;padding:2px 6px;border-radius:3px;background:rgba(232,93,4,.15);color:var(--acc);letter-spacing:1px;flex-shrink:0}
.wipe-dd-live{background:rgba(74,222,128,.15);color:var(--green);animation:livetag 2s ease-in-out infinite}
@keyframes livetag{0%,100%{opacity:1}50%{opacity:.5}}
.wipe-timer{background:var(--surf);border:1px solid var(--border);padding:8px 16px;border-radius:8px;text-align:center;position:relative;overflow:hidden;min-width:140px}
.wipe-timer::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:2px;background:linear-gradient(90deg,transparent,var(--acc),transparent);animation:wipescan 2s linear infinite}
@keyframes wipescan{0%{left:-100%}100%{left:100%}}
.wipe-urgent{border-color:var(--acc)!important;animation:urgentpulse 1s ease-in-out infinite}
@keyframes urgentpulse{0%,100%{box-shadow:0 0 0 0 rgba(232,93,4,.3)}50%{box-shadow:0 0 0 6px rgba(232,93,4,0)}}
.dot{width:7px;height:7px;border-radius:50%;background:var(--green);animation:pulse 2s infinite;box-shadow:0 0 6px var(--green)}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
.wrap{max-width:100%;margin:0 auto;padding:20px 32px 60px}
.tabs{display:flex;gap:3px;flex-wrap:wrap;margin-bottom:18px;border-bottom:2px solid var(--border)}
.tb{font-family:'Share Tech Mono',monospace;font-size:.8rem;letter-spacing:1px;text-transform:uppercase;padding:10px 16px;border-radius:6px 6px 0 0;border:1px solid transparent;border-bottom:none;background:transparent;color:var(--muted);text-decoration:none;transition:all .15s;white-space:nowrap;margin-bottom:-2px}
.tb:hover{color:var(--text);background:var(--surf)}
.tb.on{background:var(--surf);border-color:var(--border);border-bottom-color:var(--surf);color:var(--acc)}
.bar{display:flex;align-items:center;gap:12px;margin-bottom:14px;flex-wrap:wrap;position:relative;z-index:999}
.sw{position:relative;flex:1;min-width:180px;max-width:340px}
.sw svg{position:absolute;left:11px;top:50%;transform:translateY(-50%);color:var(--muted);width:15px;height:15px;pointer-events:none}
.si{width:100%;background:var(--surf);border:1px solid var(--border);color:var(--text);font-family:'Inter',sans-serif;font-size:.9rem;padding:9px 11px 9px 35px;border-radius:7px;outline:none;transition:border-color .2s,box-shadow .2s}
.si:focus{border-color:var(--acc);box-shadow:0 0 0 3px rgba(232,93,4,.12)}
.si::placeholder{color:var(--muted)}
.tl{font-family:'Share Tech Mono',monospace;font-size:.75rem;color:var(--muted);margin-left:auto;background:var(--surf);border:1px solid var(--border);padding:8px 13px;border-radius:7px}
.tl span{color:var(--acc);font-weight:700}
.sb{display:flex;gap:5px;flex-wrap:wrap;margin-bottom:13px;align-items:center}
.sl{font-size:.7rem;color:var(--muted);text-transform:uppercase;letter-spacing:2px;font-family:'Share Tech Mono',monospace;margin-right:4px}
.sbt{font-family:'Share Tech Mono',monospace;font-size:.76rem;letter-spacing:1px;text-transform:uppercase;padding:7px 13px;border-radius:5px;border:1px solid var(--border);background:var(--surf);color:var(--muted);text-decoration:none;transition:all .15s;white-space:nowrap}
.sbt:hover{border-color:var(--acc);color:var(--acc)}
.sbt.on{background:var(--acc);border-color:var(--acc);color:#fff;box-shadow:0 0 12px rgba(232,93,4,.28)}
.tw{border:1px solid var(--border);border-radius:10px;overflow:hidden;box-shadow:0 6px 22px rgba(0,0,0,.35)}
table{width:100%;border-collapse:collapse}
thead tr{background:linear-gradient(180deg,#0f1318,#0a0d10);border-bottom:2px solid var(--acc);box-shadow:0 2px 20px rgba(232,93,4,.2)}
thead th{font-family:'Share Tech Mono',monospace;font-size:.72rem;letter-spacing:1px;text-transform:uppercase;color:var(--muted);padding:13px 12px;text-align:left;white-space:nowrap;overflow:hidden}
thead th:not(:first-child):not(:nth-child(2)){text-align:center;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
tbody tr{border-bottom:1px solid var(--border);transition:background .1s} 
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:rgba(232,93,4,.04)}
td{padding:12px 12px;white-space:nowrap;font-size:1rem;border:none}
td:not(:first-child):not(:nth-child(2)){text-align:center;font-family:'Share Tech Mono',monospace;font-size:.95rem}
.rk{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--muted);width:50px;min-width:50px;text-align:center!important}
.r1{color:var(--gold);text-shadow:0 0 10px rgba(244,196,48,.45)}.r2{color:var(--silver)}.r3{color:var(--bronze)} tbody td{border-left:none!important;border-right:none!important}
.pn{font-weight:600;color:#fff;font-size:1.05rem;min-width:140px;max-width:220px;overflow:hidden;text-overflow:ellipsis;display:flex;align-items:center}

.hi{color:var(--acc2);font-weight:600}.good{color:var(--green);font-weight:600}.bad{color:var(--red)}.online-hit{color:var(--green);font-weight:600;text-shadow:0 0 8px rgba(74,222,128,0.6)}.offline-hit{color:var(--red);font-weight:600;text-shadow:0 0 8px rgba(248,113,113,0.6)}
td.ca{color:var(--acc2)}
.rk{border-right:none!important} tr.t1{background:rgba(244,196,48,.04)!important;animation:goldrow 2.5s ease-in-out infinite}
tr.t2{background:rgba(159,180,204,.03)!important;animation:silverrow 3s ease-in-out infinite}
tr.t3{background:rgba(205,127,50,.03)!important;animation:bronzerow 3.5s ease-in-out infinite}
tr.t1,tr.t2,tr.t3{opacity:1!important} tr.t1 td,tr.t2 td,tr.t3 td{background:transparent!important}
@keyframes goldrow{
  0%,100%{background:rgba(244,196,48,.03)!important;box-shadow:inset 4px 0 0 rgba(244,196,48,.5)}
  50%{background:rgba(244,196,48,.08)!important;box-shadow:inset 4px 0 0 rgba(244,196,48,1),0 0 20px rgba(244,196,48,.08)}}
@keyframes silverrow{
  0%,100%{background:rgba(159,180,204,.02)!important;box-shadow:inset 4px 0 0 rgba(159,180,204,.4)}
  50%{background:rgba(159,180,204,.07)!important;box-shadow:inset 4px 0 0 rgba(159,180,204,.9),0 0 16px rgba(159,180,204,.06)}}
@keyframes bronzerow{
  0%,100%{background:rgba(205,127,50,.02)!important;box-shadow:inset 4px 0 0 rgba(205,127,50,.4)}
  50%{background:rgba(205,127,50,.07)!important;box-shadow:inset 4px 0 0 rgba(205,127,50,.9),0 0 16px rgba(205,127,50,.06)}}
.empty{text-align:center;padding:70px 20px;color:var(--muted);font-family:'Share Tech Mono',monospace;letter-spacing:3px;text-transform:uppercase;font-size:.85rem}
.pg{display:flex;justify-content:center;align-items:center;gap:6px;margin-top:22px;flex-wrap:wrap}
.pb{font-family:'Share Tech Mono',monospace;font-size:.78rem;padding:8px 15px;border:1px solid var(--border);border-radius:5px;background:var(--surf);color:var(--muted);text-decoration:none;transition:all .15s}
.pb:hover{border-color:var(--acc);color:var(--acc)}.pb.cur{background:var(--acc);border-color:var(--acc);color:#fff;cursor:default}.pb.dis{opacity:.3;pointer-events:none}
footer{text-align:center;font-family:'Share Tech Mono',monospace;font-size:.7rem;color:var(--muted);letter-spacing:2px;padding:18px;border-top:1px solid var(--border);margin-top:36px;text-transform:uppercase}
footer a{color:var(--acc);text-decoration:none}
#particle-canvas{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:0;opacity:.6}
.wrap,.tabs,.bar,.sb,.tw,.pg,header,footer{position:relative;z-index:1}
.tw{position:relative;border:1px solid var(--border)}
header::after{content:'';position:absolute;bottom:-2px;left:0;width:100%;height:2px;background:linear-gradient(90deg,transparent,var(--acc),#f48c06,var(--acc),transparent);animation:hline 3s ease-in-out infinite;z-index:2}
@keyframes hline{0%,100%{opacity:.4}50%{opacity:1}}


/* ── MOBILE ── */
@media(max-width:768px){
    header{padding:12px 16px;gap:10px}
    .lt{font-size:1.4rem;letter-spacing:2px}
    .ls{font-size:.6rem;letter-spacing:2px}
    .logo{height:36px}
    .hbtns{gap:6px;width:100%}
    .hbtn{font-size:.65rem;padding:7px 10px;gap:5px}
    .badge{font-size:.65rem;padding:6px 10px;gap:5px}
    .dot{width:6px;height:6px}
    .wrap{padding:12px 10px 40px}
    .tabs{gap:2px;margin-bottom:12px}
    .tb{font-size:.62rem;padding:7px 8px;letter-spacing:0}
    .bar{gap:8px;margin-bottom:10px}
    .sw{max-width:100%;min-width:0;flex:1}
    .si{font-size:.82rem;padding:8px 10px 8px 32px}
    .tl{font-size:.68rem;padding:7px 10px}
    .sb{gap:4px;margin-bottom:10px}
    .sbt{font-size:.62rem;padding:5px 8px;letter-spacing:0}
    .sbt img{width:18px;height:18px;margin-right:4px}
    thead th{font-size:.58rem;padding:9px 8px;letter-spacing:0}
    thead th img{width:20px;height:20px;margin-right:3px}
    td{padding:9px 8px;font-size:.82rem}
    td:not(:first-child):not(:nth-child(2)){font-size:.78rem}
    .rk{font-size:1rem;width:36px}
    .pn{font-size:.85rem;max-width:120px}
    .pn img{width:22px;height:22px;margin-right:5px}
    .tw{border-radius:7px;overflow-x:auto}
    table{min-width:500px}
    .pg{gap:4px;margin-top:16px}
    .pb{font-size:.7rem;padding:6px 10px}
}

@media(max-width:480px){
    .lt{font-size:1.2rem}
    .hbtn span{display:none}
    .hbtn{padding:8px}
    .tabs{overflow-x:auto;flex-wrap:nowrap;padding-bottom:2px}
    .tb{white-space:nowrap;flex-shrink:0}
    .sb{overflow-x:auto;flex-wrap:nowrap;padding-bottom:4px}
    .sbt{flex-shrink:0}
    .pn{max-width:90px}
    thead th{padding:8px 6px}
    td{padding:8px 6px}
}
</style>
</head>
<body>
<canvas id="particle-canvas"></canvas>
<header>
  <div class="hl">
    <img src="<?php echo LOGO_URL; ?>" class="logo" alt="Logo">
    <div>
      <div class="lt" data-text="<?php echo htmlspecialchars(SERVER_NAME); ?>"><?php echo htmlspecialchars(SERVER_NAME); ?></div>
      <div class="ls">Player Leaderboard</div>
    </div>
  </div>
  <div class="hbtns">
    <a href="<?php echo DISCORD_URL; ?>" target="_blank" class="hbtn hbtn-discord">
      <svg width="18" height="18" viewBox="0 0 127.14 96.36" fill="#fff"><path d="M107.7,8.07A105.15,105.15,0,0,0,81.47,0a72.06,72.06,0,0,0-3.36,6.83A97.68,97.68,0,0,0,49,6.83,72.37,72.37,0,0,0,45.64,0,105.89,105.89,0,0,0,19.39,8.09C2.79,32.65-1.71,56.6.54,80.21h0A105.73,105.73,0,0,0,32.71,96.36,77.7,77.7,0,0,0,39.6,85.25a68.42,68.42,0,0,1-10.85-5.18c.91-.66,1.8-1.34,2.66-2a75.57,75.57,0,0,0,64.32,0c.87.71,1.76,1.39,2.66,2a68.68,68.68,0,0,1-10.87,5.19,77,77,0,0,0,6.89,11.1A105.25,105.25,0,0,0,126.6,80.22h0C129.24,52.84,122.09,29.11,107.7,8.07ZM42.45,65.69C36.18,65.69,31,60,31,53s5-12.74,11.43-12.74S54,46,53.89,53,48.84,65.69,42.45,65.69Zm42.24,0C78.41,65.69,73.25,60,73.25,53s5-12.74,11.44-12.74S96.23,46,96.12,53,91.08,65.69,84.69,65.69Z"/></svg>
      Join Discord
    </a>
    <a href="steam://run/252490//+connect <?php echo SERVER_IP; ?>" class="hbtn hbtn-play">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
      Play Now
    </a>
    <button class="hbtn hbtn-copyip" id="copyIpBtn" onclick="copyServerIP()">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
      <span id="copyIpText">Copy IP</span>
    </button>
    <a href="https://www.instagram.com/yourpage/" target="_blank" class="hbtn hbtn-insta" title="Follow us on Instagram">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
    </a>
    <div class="badge">
      <div class="dot"></div>
      <?php echo $online_count; ?> online &nbsp;&middot;&nbsp; <?php echo $player_total; ?> sleepers
    </div>
    <div class="wipe-timer" id="wipeTimer">
      <span style="color:var(--muted);font-size:.65rem;letter-spacing:2px;text-transform:uppercase;display:block;margin-bottom:2px">Next Wipe</span>
      <span id="wipeCountdown" style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:2px;color:#fff"></span>
    </div>
  </div>
</header>

<div class="wrap">

<div class="tabs">
<?php foreach ($tabs as $tid => $td): ?>
<a class="tb <?php echo ($tid === $active_tab ? 'on' : ''); ?>" href="?tab=<?php echo $tid; ?><?php echo ($search ? '&q='.urlencode($search) : ''); ?>"><?php if(isset($tab_icons[$tid])): ?><img src="<?php echo ICON_URL.$tab_icons[$tid]; ?>" style="width:16px;height:16px;vertical-align:middle;margin-right:5px;image-rendering:pixelated;" onerror="this.src='/icons/hazmatsuit.png'"><?php endif; ?><?php echo $td['label']; ?></a>
<?php endforeach; ?>
</div>

<div class="bar">
  <form class="sw" method="get" action="">
    <input type="hidden" name="tab" value="<?php echo htmlspecialchars($active_tab); ?>">
    <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>">
    <input type="hidden" name="wipe" value="<?php echo $selected_wipe; ?>">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 111 11a6 6 0 0116 0z"/></svg>
    <input class="si" type="text" name="q" placeholder="Search player..." value="<?php echo htmlspecialchars($search); ?>" autocomplete="off">
  </form>
  <div class="tl">Showing <span><?php echo count($players); ?></span> of <span><?php echo $total; ?></span></div>
  <?php if (!empty($wipes_list)): ?>
  <div class="wipe-dd" id="wipeDd">
    <button class="wipe-dd-btn" onclick="toggleWipeDd()" type="button">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      <span id="wipeDdLabel"><?php echo $selected_wipe===0 ? '&#9733; All Time' : ($wipes_list[0]['is_current'] ? '&#128994; '.$wipes_list[0]['label'] : $wipes_list[0]['label']); ?></span>
      <svg class="wipe-dd-arrow" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;transition:transform .25s"><polyline points="6 9 12 15 18 9"/></svg>
    </button>
    <div class="wipe-dd-menu" id="wipeDdMenu">
      <div style="padding:8px 14px 6px;border-bottom:1px solid rgba(232,93,4,.15);font-family:'Share Tech Mono',monospace;font-size:.6rem;color:var(--muted);letter-spacing:3px;text-transform:uppercase">Select Wipe</div>
      <a class="wipe-dd-item <?php echo $selected_wipe===0?'active':''; ?>" href="?tab=<?php echo $active_tab; ?>&sort=<?php echo $sort; ?>&wipe=0">
        <span class="wipe-dd-icon">&#9733;</span>
        <span>All Time</span>
        <span class="wipe-dd-tag">TOTAL</span>
      </a>
      <?php $seen=array(); foreach ($wipes_list as $w): if(in_array($w['wipe_id'],$seen))continue; $seen[]=$w['wipe_id']; ?>
      <a class="wipe-dd-item <?php echo $selected_wipe===$w['wipe_id']?'active':''; ?>"
         href="?tab=<?php echo $active_tab; ?>&sort=<?php echo $sort; ?>&wipe=<?php echo $w['wipe_id']; ?>">
        <span class="wipe-dd-icon"><?php echo $w['is_current']?'&#128994;':'&#128309;'; ?></span>
        <span><?php echo htmlspecialchars($w['label']); ?></span>
        <?php if($w['is_current']): ?><span class="wipe-dd-tag wipe-dd-live">LIVE</span><?php endif; ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>
</div>

<div class="sb">
  <span class="sl">Sort:</span>
  <?php foreach ($tab_cols as $col => $label):
    $active_cls = ($col === $sort) ? ' on' : '';
  ?>
  <a class="sbt<?php echo $active_cls; ?>" href="?tab=<?php echo $active_tab; ?>&sort=<?php echo $col; ?><?php echo ($search ? '&q='.urlencode($search) : ''); ?>">
    <?php echo icon_img($col, $icons); ?><?php echo $label; ?>
  </a>
  <?php endforeach; ?>
</div>

<div class="tw"><table style="width:100%">
<thead><tr>
  <th>#</th><th><img src="<?php echo ICON_URL; ?>hazmatsuit.png" style="width:32px;height:32px;vertical-align:middle;margin-right:7px;image-rendering:pixelated;filter:drop-shadow(0 0 4px rgba(232,93,4,0.5));" onerror="this.src='/icons/hazmatsuit.png'">Player</th>
  <?php foreach ($tab_cols as $col => $label): ?>
  <th><?php echo icon_img($col, $icons); ?><?php echo $label; ?></th>
  <?php endforeach; ?>
</tr></thead>
<tbody>
<?php if (empty($players)): ?>
<tr><td colspan="<?php echo count($tab_cols)+2; ?>" class="empty">No players yet</td></tr>
<?php else: ?>
<?php foreach ($players as $i => $p):
  $rank = $offset + $i + 1;
  $rc   = ($rank <= 3) ? ' t'.$rank : '';
  $rtd  = ($rank <= 3) ? ' r'.$rank : '';
?>
<tr class="<?php echo $rc; ?>">
  <td class="rk<?php echo $rtd; ?>"><?php echo $rank; ?></td>
  <?php if ($is_clan): ?>
  <td class="pn">
    <span style="color:var(--acc);margin-right:5px">[<?php echo htmlspecialchars($p['tag'] ?? ''); ?>]</span><?php echo htmlspecialchars($p['name'] ?? ''); ?>
  </td>
  <?php else: ?>
  <td class="pn">
    <div style="position:relative;display:inline-block;margin-right:8px;vertical-align:middle;">
      <img src="<?php echo htmlspecialchars(get_steam_avatar($p['steam_id'] ?? '')); ?>" onerror="this.src='https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg'" alt="" style="width:28px;height:28px;border-radius:50%;display:block;border:1px solid var(--border);">
      <?php $sid_key = isset($p['steam_id']) ? $p['steam_id'] : ''; $is_online = !empty($sid_key) && isset($online_ids[$sid_key]); ?>
      <?php if($is_online): ?>
      <div style="position:absolute;bottom:0;right:0;width:9px;height:9px;background:var(--green);border-radius:50%;border:1px solid var(--bg);box-shadow:0 0 5px var(--green);"></div>
      <?php endif; ?>
    </div>
    <?php echo htmlspecialchars($p['display_name'] ?? ''); ?>
  </td>
  <?php endif; ?>
  <?php foreach ($tab_cols as $col => $label):
    $val = isset($p[$col]) ? $p[$col] : 0;
    $ca  = ($col === $sort) ? ' ca' : '';
    $f   = fmt($col, $val);
    $sc  = '';
    $extra_style = '';
    if ($col === 'kdr' || $col === 'clan_kdr') {
        $sc = ((float)$val >= 2) ? 'good' : (((float)$val < 1) ? 'bad' : '');
    } elseif (in_array($col, array('kills','heli_kills','bradley_kills','competitive_kills','longest_kill','headshots'))) {
        $sc = 'hi';
    } elseif ($col === 'online_hits') {
        $sc = 'online-hit';
    } elseif ($col === 'offline_hits') {
        $sc = 'offline-hit';
    }
  ?>
  <td class="<?php echo $ca; ?>"><?php echo ($sc ? '<span class="'.$sc.'">'.$f.'</span>' : $f); ?></td>
  <?php endforeach; ?>
</tr>
<?php endforeach; ?>
<?php endif; ?>
</tbody></table></div>

<?php if ($total_pages > 1): ?>
<div class="pg">
<a class="pb <?php echo ($page<=1?'dis':''); ?>" href="?tab=<?php echo $active_tab; ?>&sort=<?php echo $sort; ?>&q=<?php echo urlencode($search); ?>&page=<?php echo $page-1; ?>">&#8592; Prev</a>
<?php
$s = max(1,$page-2); $e = min($total_pages,$page+2);
if($s>1) echo "<a class='pb' href='?tab=$active_tab&sort=$sort&q=".urlencode($search)."&page=1'>1</a>";
if($s>2) echo "<span class='pb dis'>...</span>";
for($p2=$s;$p2<=$e;$p2++){$cur=($p2===$page)?' cur':'';echo "<a class='pb$cur' href='?tab=$active_tab&sort=$sort&q=".urlencode($search)."&page=$p2'>$p2</a>";}
if($e<$total_pages-1) echo "<span class='pb dis'>...</span>";
if($e<$total_pages) echo "<a class='pb' href='?tab=$active_tab&sort=$sort&q=".urlencode($search)."&page=$total_pages'>$total_pages</a>";
?>
<a class="pb <?php echo ($page>=$total_pages?'dis':''); ?>" href="?tab=<?php echo $active_tab; ?>&sort=<?php echo $sort; ?>&q=<?php echo urlencode($search); ?>&page=<?php echo $page+1; ?>">Next &#8594;</a>
</div>
<?php endif; ?>

</div>
<footer>
  <?php echo htmlspecialchars(SERVER_NAME); ?> &nbsp;&middot;&nbsp; Powered by <a href="#">Your Name</a>
</footer>
<script>
var canvas=document.getElementById('particle-canvas');
var ctx=canvas.getContext('2d');
var W,H,pts=[],tick_n=0;
function resize(){W=canvas.width=window.innerWidth;H=canvas.height=window.innerHeight;}
resize();
window.addEventListener('resize',resize);

// Create nodes
for(var i=0;i<45;i++){
  pts.push({
    x:Math.random()*W, y:Math.random()*H,
    vx:(Math.random()-.5)*.25, vy:(Math.random()-.5)*.25,
    r:Math.random()*1.2+.3,
    phase:Math.random()*Math.PI*2
  });
}

function draw(){
  ctx.clearRect(0,0,W,H);
  tick_n+=.012;

  // Draw connections first
  for(var i=0;i<pts.length;i++){
    for(var j=i+1;j<pts.length;j++){
      var dx=pts[i].x-pts[j].x, dy=pts[i].y-pts[j].y;
      var d=Math.sqrt(dx*dx+dy*dy);
      if(d<130){
        // Pulsing line opacity
        var pulse=(Math.sin(tick_n*2+pts[i].phase)*.5+.5);
        var alpha=(1-d/130)*0.07*(.4+pulse*.6);
        ctx.save();
        ctx.globalAlpha=alpha;
        ctx.strokeStyle='#e85d04';
        ctx.lineWidth=.4;
        ctx.beginPath();
        ctx.moveTo(pts[i].x,pts[i].y);
        ctx.lineTo(pts[j].x,pts[j].y);
        ctx.stroke();
        ctx.restore();
      }
    }
  }

  // Draw nodes
  pts.forEach(function(p){
    p.x+=p.vx; p.y+=p.vy;
    if(p.x<0)p.x=W; if(p.x>W)p.x=0;
    if(p.y<0)p.y=H; if(p.y>H)p.y=0;

    var pulse=(Math.sin(tick_n*1.5+p.phase)*.5+.5);
    var alpha=.05+pulse*.12;
    ctx.save();
    ctx.globalAlpha=alpha;
    ctx.fillStyle='#e85d04';
    ctx.beginPath();
    ctx.arc(p.x,p.y,p.r*(1+pulse*.4),0,Math.PI*2);
    ctx.fill();
    ctx.restore();
  });

  requestAnimationFrame(draw);
}
draw();

// ── Copy IP ──────────────────────────────
function copyServerIP() {
    var btn = document.getElementById('copyIpBtn');
    var txt = document.getElementById('copyIpText');
    navigator.clipboard.writeText('client.connect your-server-ip:28015').then(function() {
        btn.classList.add('copied');
        txt.textContent = 'Copied!';
        setTimeout(function() {
            btn.classList.remove('copied');
            txt.textContent = 'Copy IP';
        }, 2000);
    });
}

// ── Wipe Dropdown ──────────────────────────────
function toggleWipeDd() {
    var btn = document.querySelector('.wipe-dd-btn');
    var menu = document.getElementById('wipeDdMenu');
    btn.classList.toggle('open');
    menu.classList.toggle('open');
}
document.addEventListener('click', function(e) {
    var dd = document.getElementById('wipeDd');
    if (dd && !dd.contains(e.target)) {
        document.querySelector('.wipe-dd-btn').classList.remove('open');
        document.getElementById('wipeDdMenu').classList.remove('open');
    }
});

// ── Wipe Countdown ──────────────────────────────
function getNextWipe() {
    var now = new Date();
    // Convert to IST (UTC+5:30)
    var ist = new Date(now.getTime() + (5.5 * 60 * 60 * 1000));
    
    // Find next wipe: Friday 4pm IST (or Thursday 4pm IST if first Thursday of month)
    var candidate = new Date(ist);
    candidate.setHours(16, 0, 0, 0); // 4pm IST
    
    // Check next 14 days for a wipe day
    for (var i = 0; i <= 14; i++) {
        var d = new Date(ist);
        d.setDate(ist.getDate() + i);
        d.setHours(16, 0, 0, 0);
        
        var dow = d.getDay(); // 0=Sun,1=Mon,...,4=Thu,5=Fri
        var isWipeDay = false;
        
        // Check if this is first Thursday of month
        if (dow === 4) { // Thursday
            var firstThu = new Date(d.getFullYear(), d.getMonth(), 1);
            while (firstThu.getDay() !== 4) firstThu.setDate(firstThu.getDate() + 1);
            if (firstThu.getDate() === d.getDate()) isWipeDay = true;
        }
        
        // Friday is always wipe day (unless first thursday replaced it)
        if (dow === 5) {
            // Check if this week's Thursday was first Thursday
            var thu = new Date(d); thu.setDate(d.getDate() - 1);
            var firstThu2 = new Date(thu.getFullYear(), thu.getMonth(), 1);
            while (firstThu2.getDay() !== 4) firstThu2.setDate(firstThu2.getDate() + 1);
            if (firstThu2.getDate() !== thu.getDate()) isWipeDay = true;
            else isWipeDay = false; // Thursday replaced this Friday
        }
        
        if (isWipeDay && d > ist) {
            // Return as UTC
            return new Date(d.getTime() - (5.5 * 60 * 60 * 1000));
        }
    }
    return null;
}

function updateWipeTimer() {
    var el = document.getElementById('wipeCountdown');
    var container = document.getElementById('wipeTimer');
    if (!el) return;
    
    var nextWipe = getNextWipe();
    if (!nextWipe) { el.textContent = 'SOON'; return; }
    
    var now = new Date();
    var diff = nextWipe - now;
    if (diff <= 0) { el.textContent = 'WIPING NOW'; container.classList.add('wipe-urgent'); return; }
    
    var days    = Math.floor(diff / 86400000);
    var hours   = Math.floor((diff % 86400000) / 3600000);
    var minutes = Math.floor((diff % 3600000) / 60000);
    var seconds = Math.floor((diff % 60000) / 1000);
    
    var pad = function(n) { return n < 10 ? '0' + n : n; };
    
    if (days > 0) {
        el.textContent = days + 'd ' + pad(hours) + 'h ' + pad(minutes) + 'm ' + pad(seconds) + 's';
    } else {
        el.textContent = pad(hours) + ':' + pad(minutes) + ':' + pad(seconds);
    }
    
    // Turn urgent (red) when < 1 hour
    if (diff < 3600000) {
        container.classList.add('wipe-urgent');
        el.style.color = 'var(--red)';
        el.style.animation = 'urgentpulse 0.5s ease-in-out infinite';
    } else if (diff < 86400000) {
        el.style.color = 'var(--acc2)'; // orange when < 1 day
    } else {
        el.style.color = '#fff';
    }
}
updateWipeTimer();
setInterval(updateWipeTimer, 1000);
</script>
</body>
</html>
