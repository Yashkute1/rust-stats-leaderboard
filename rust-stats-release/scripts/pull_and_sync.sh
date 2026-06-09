#!/bin/bash
# ─────────────────────────────────────────────
# pull_and_sync.sh — runs on Remote VPS every 5 min via cron
# Pulls tracking data from Game Server and executes ingestion script
# ─────────────────────────────────────────────

# CONFIGURE THESE PLACEHOLDERS:
SERVER_USER="vps_user"                                     # SSH username on your Game Server host
SERVER_IP="your_game_server_ip"                           # Public/Private IP mapping to game server
REMOTE_JSON_PATH="/path/to/oxide/data/RustStats/PlayerData.json" # Source file location
LOCAL_JSON="/opt/rust-sync/data/PlayerData.json"          # Local structural processing mirror path
SYNC_SCRIPT="/opt/rust-sync/sync_stats.py"
SSH_KEY="/root/.ssh/id_rsa"                               # Private key path mapping for remote access

# ─────────────────────────────────────────────
mkdir -p /opt/rust-sync/data

echo "[$(date)] Syncing data block from Game Server..."
rsync -az \
    -e "ssh -i $SSH_KEY -o StrictHostKeyChecking=no -o ConnectTimeout=10" \
    "$SERVER_USER@$SERVER_IP:$REMOTE_JSON_PATH" \
    "$LOCAL_JSON"

if [ $? -ne 0 ]; then
    echo "[$(date)] CRITICAL: File array transfer routine faulted. Execution terminated."
    exit 1
fi

echo "[$(date)] Executing relational database injection stack..."
/usr/bin/python3 "$SYNC_SCRIPT"
echo "[$(date)] Task completed successfully."