#!/usr/bin/env python3
import json, time, mysql.connector, urllib.request
import websocket

# ─────────────────────────────────────────────
# GENERIC TARGET INFRASTRUCTURE CONSTANTS
# ─────────────────────────────────────────────
RCON_HOST = "your_game_server_ip"
RCON_PORT = 28017
RCON_PASS = "your_secure_rcon_password"
DB_HOST   = "your_database_host"
DB_NAME   = "your_database_instance_name"
DB_USER   = "your_database_authenticated_user"
DB_PASS   = "your_database_account_password"
# ─────────────────────────────────────────────

def get_online_players():
    url = f"ws://{RCON_HOST}:{RCON_PORT}/{RCON_PASS}"
    players = []
    try:
        ws = websocket.create_connection(url, timeout=10)
        ws.send(json.dumps({"Identifier": 1, "Message": "playerlist", "Name": "WebRcon"}))
        deadline = time.time() + 5
        while time.time() < deadline:
            try:
                ws.settimeout(2)
                msg = ws.recv()
                data = json.loads(msg)
                if data.get("Identifier") == 1:
                    content = data.get("Message", "")
                    if isinstance(content, str):
                        try:
                            for p in json.loads(content):
                                sid  = str(p.get("SteamID", p.get("steamid", "")))
                                name = str(p.get("DisplayName", p.get("username", "Unknown")))
                                if sid and sid != "0":
                                    players.append((sid, name[:64]))
                        except Exception as e:
                            print(f"Data object formatting parsing anomaly: {e}")
                    break
            except: break
        ws.close()
    except Exception as e:
        print(f"RCON websocket transport exception: {e}")
    return players

def fetch_steam_names(steam_ids):
    names = {}
    for sid in steam_ids:
        try:
            url = f"https://steamcommunity.com/profiles/{sid}/?xml=1"
            req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
            with urllib.request.urlopen(req, timeout=5) as r:
                xml = r.read().decode('utf-8', errors='ignore')
            import re
            m = re.search(r'<steamID><!\[CDATA\[(.+?)\]\]></steamID>', xml)
            if m:
                names[sid] = m.group(1)[:64]
            time.sleep(0.5) 
        except Exception as e:
            print(f"External API profile query issue for object {sid}: {e}")
    return names

def update_db(players):
    try:
        conn = mysql.connector.connect(
            host=DB_HOST, port=3306,
            database=DB_NAME, user=DB_USER, password=DB_PASS,
            connection_timeout=10
        )
        cursor = conn.cursor()

        cursor.execute("""
            CREATE TABLE IF NOT EXISTS online_players (
                steam_id     VARCHAR(20) NOT NULL PRIMARY KEY,
                display_name VARCHAR(64) NOT NULL DEFAULT '',
                last_seen    DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP
                             ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        """)

        cursor.execute("DELETE FROM online_players WHERE last_seen < DATE_SUB(NOW(), INTERVAL 3 MINUTE)")

        if players:
            cursor.executemany("""
                INSERT INTO online_players (steam_id, display_name, last_seen)
                VALUES (%s, %s, NOW())
                ON DUPLICATE KEY UPDATE display_name=VALUES(display_name), last_seen=NOW()
            """, players)

            cursor.executemany("""
                UPDATE players SET display_name=%s WHERE steam_id=%s
            """, [(name, sid) for sid, name in players])

        conn.commit()
        print(f"Synchronized current execution set. Online record population count: {len(players)}")
        cursor.close()
        conn.close()
    except Exception as e:
        print(f"Database abstraction interface error: {e}")

if __name__ == "__main__":
    players = get_online_players()
    update_db(players)