# RustStats — Comprehensive Player Stat Tracker & Leaderboard System

A complete, lightweight, and fully automated statistics ecosystem for Rust servers. This project includes a high-performance server plugin, an automated backend syncing network, an optimized MySQL schema, and a modern, feature-packed PHP web leaderboard.

Compatible with both **Oxide** and **Carbon** framework environments.

**🔴 Live Demo**
Check out this exact system running live on my server: 
[Rust Samrajya Leaderboard (Powered by Shadowtrace Hosting)](https://leaderboard.shadowtracehosting.com/)

---

## 🚀 Key Features

### 🔌 Server Plugin (RustStats.cs)
*   **Automatic Tracking:** Monitors over 80 structural player actions across 13 unique categories (PVP, PVP+, PVE, Resources, Building, Raiding, Loot, Farming, Vending, Scrap, Activities, Teleports, and Misc).
*   **Wipe Automation:** Generates an instantaneous `new_wipe.flag` upon a server map wipe (`OnNewSave`) to keep external databases in perfect sync.
*   **Background Performance:** Saves locally to a clean JSON payload every 5 minutes in a separate thread, ensuring zero impact on your server's frame rate.

### 🗄️ Database & Automated Sync Pipeline
*   **Dual-Layer Analytics:** Syncs stats seamlessly to an absolute cumulative `players` table (All-Time) alongside chronological tracking via a `player_wipe_stats` table.
*   **Live RCON Tracking:** Connects directly via WebSockets to instantly evaluate active player counts, show active status indicators, and automatically refresh Steam nicknames.
*   **Map Retention:** Implements automated timeline management to preserve previous wipe history data seamlessly.

### 🌐 Web Dashboard (index.php)
*   **Dynamic Selection:** Includes a custom drop-up historical selector displaying All-Time datasets alongside context-specific individual past wipes.
*   **Real-Time Countdown:** Renders a high-accuracy, visual-tier countdown timer tracking targeted wipe schedules, utilizing reactive warnings (Orange under 24 hours, pulsing Red under 1 hour).
*   **Gamified Elements:** Embeds custom high-fidelity item graphics with responsive glowing accents, custom particle connection layer systems, staggered entry layout visuals, and bespoke Gold/Silver/Bronze crown treatments for your server's top 3 players.

---

## 📦 Setup & Installation Guide

### Step 1: Plugin Deployment
1. Move `RustStats.cs` directly into your server environment's `oxide/plugins/` or `carbon/plugins/` directory.
2. The compilation routine initializes instantly. Customize tracking variables inside the generated configuration payload (`oxide/config/RustStats.json`) if necessary.

### Step 2: Database Initialization
1. Access your target management client (e.g., phpMyAdmin).
2. Execute the included structured compilation code located inside `database/schema.sql` to initialize the tables (`players`, `clans`, `online_players`, `wipes`, `player_wipe_stats`).

### Step 3: Backend Sync Engine Configuration
1. Deploy `sync_stats.py` and `rcon_sync.py` to your remote processing instance or VPS.
2. Fill in the localized variables inside the scripts with your structural MySQL authentication information and secure server RCON passwords.
3. Establish your execution schedules using standard automated systems (`cron`):

```bash
# Sync player performance statistics every 5 minutes
*/5 * * * * /usr/bin/python3 /opt/rust-sync/sync_stats.py

# Sync real-time RCON tracking information every minute
* * * * * /usr/bin/python3 /opt/rust-sync/rcon_sync.py
```

---

## Command,Permissions,Description
1. ruststats.save,Server Admin / Console,Dispatches an immediate flush save request of all in-memory stats to the JSON cache file.
2. ruststats.wipe,Server Admin / Console,Erases local active tracking statistics instantly.
