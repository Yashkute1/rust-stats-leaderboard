#!/usr/bin/env python3
"""
sync_stats.py — Runs on Remote VPS via cron every 5 minutes
Reads PlayerData.json from local file mirror and pushes to Database

SETUP:
  pip3 install mysql-connector-python
"""

import json
import os
import sys
import logging
from datetime import datetime

try:
    import mysql.connector
except ImportError:
    print("Missing Requirement: pip3 install mysql-connector-python")
    sys.exit(1)

# ─────────────────────────────────────────────
# CONFIGURATION
# ─────────────────────────────────────────────
PLAYERDATA_JSON = "/opt/rust-sync/data/PlayerData.json"

DB_HOST     = "your_database_host"   
DB_PORT     = 3306
DB_NAME     = "your_database_name"                
DB_USER     = "your_database_user"                
DB_PASS     = "your_database_password"

# ─────────────────────────────────────────────
logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(message)s",
    datefmt="%Y-%m-%d %H:%M:%S"
)
log = logging.getLogger(__name__)

def load_playerdata(path: str) -> dict:
    if not os.path.exists(path):
        log.error(f"PlayerData.json not found at: {path}")
        sys.exit(1)
    with open(path, "r", encoding="utf-8") as f:
        data = json.load(f)
    log.info(f"Loaded {len(data)} player records.")
    return data

def parse_player(steam_id: str, entry: dict) -> dict:
    stats = entry if isinstance(entry, dict) else {}
    kills   = int(stats.get("Kills", 0))
    deaths  = int(stats.get("Deaths", 0))
    kdr     = round(kills / deaths, 2) if deaths > 0 else float(kills)
    playtime = int(stats.get("Playtime", 0))
    
    wood    = int(stats.get("Wood", 0))
    stone   = int(stats.get("Stone", 0))
    metal   = int(stats.get("Metal", 0))
    sulfur  = int(stats.get("Sulfur", 0))
    heli    = int(stats.get("HeliKills", 0))
    bradley = int(stats.get("BradleyKills", 0))
    name = str(stats.get("Name", "Unknown"))[:64]

    return {
        "steam_id":      steam_id,
        "display_name":  name,
        "kills":         kills,
        "deaths":        deaths,
        "kdr":           kdr,
        "playtime":      playtime,
        "wood":          wood,
        "stone":         stone,
        "metal":         metal,
        "sulfur":        sulfur,
        "heli_kills":    heli,
        "bradley_kills": bradley,
    }

def sync_to_mysql(players: list):
    try:
        conn = mysql.connector.connect(
            host=DB_HOST, port=DB_PORT,
            database=DB_NAME, user=DB_USER, password=DB_PASS,
            connection_timeout=10
        )
        cursor = conn.cursor()

        upsert_sql = """
            INSERT INTO players
              (steam_id, display_name, kills, deaths, kdr, playtime,
               wood, stone, metal, sulfur, heli_kills, bradley_kills)
            VALUES
              (%(steam_id)s, %(display_name)s, %(kills)s, %(deaths)s, %(kdr)s, %(playtime)s,
               %(wood)s, %(stone)s, %(metal)s, %(sulfur)s, %(heli_kills)s, %(bradley_kills)s)
            ON DUPLICATE KEY UPDATE
              display_name  = VALUES(display_name),
              kills         = VALUES(kills),
              deaths        = VALUES(deaths),
              kdr           = VALUES(kdr),
              playtime      = VALUES(playtime),
              wood          = VALUES(wood),
              stone         = VALUES(stone),
              metal         = VALUES(metal),
              sulfur        = VALUES(sulfur),
              heli_kills    = VALUES(heli_kills),
              bradley_kills = VALUES(bradley_kills),
              last_updated  = NOW()
        """
        cursor.executemany(upsert_sql, players)
        conn.commit()
        log.info(f"Synced {cursor.rowcount} records to database database.")
        cursor.close()
        conn.close()
    except mysql.connector.Error as e:
        log.error(f"MySQL connection issue: {e}")
        sys.exit(1)

def main():
    log.info("=== Leaderboard Analytics Processing Block ===")
    raw_data = load_playerdata(PLAYERDATA_JSON)
    players = []
    for steam_id, entry in raw_data.items():
        if not steam_id.isdigit() or len(steam_id) < 15:
            continue
        try:
            players.append(parse_player(steam_id, entry))
        except Exception as e:
            log.warning(f"Skipping record ID {steam_id}: {e}")
    if not players:
        log.warning("No operational objects extracted.")
        return
    sync_to_mysql(players)

if __name__ == "__main__":
    main()