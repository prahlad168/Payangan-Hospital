#!/usr/bin/env python3
"""
Payangan Hospital - Persistent Agent Script
==========================================
Agent ini akan jalan terus dan bisa di-resume jika terputus.

Usage:
    python persistent_agent.py                    # Start fresh
    python persistent_agent.py --resume          # Resume dari checkpoint
    python persistent_agent.py --task "task"    # Eksekusi task spesifik
    python persistent_agent.py --watch          # Watch mode - auto-detect changes
"""

import os
import sys
import json
import subprocess
import argparse
from datetime import datetime
from pathlib import Path

# Config
REPO_PATH = Path(__file__).parent.parent
CHECKPOINT_FILE = REPO_PATH / ".agent_checkpoint.json"
LOG_FILE = REPO_PATH / ".agent_log.txt"
TASK_QUEUE_FILE = REPO_PATH / ".task_queue.json"

# Timezone Bali (WITA/UTC+8)
TIMEZONE = "Asia/Makassar"
DEFAULT_DATE = "July 1, 2026"


class PersistentAgent:
    """Persistent Agent yang bisa jalan terus dan resume dari checkpoint"""
    
    def __init__(self):
        self.checkpoint = self.load_checkpoint()
        self.task_queue = self.load_task_queue()
        
    def load_checkpoint(self):
        """Load checkpoint terakhir"""
        if CHECKPOINT_FILE.exists():
            try:
                with open(CHECKPOINT_FILE, 'r') as f:
                    data = json.load(f)
                    print(f"📂 Loaded checkpoint from: {data.get('timestamp', 'unknown')}")
                    return data
            except:
                pass
        return {
            "status": "idle",
            "current_task": None,
            "completed_tasks": [],
            "pending_tasks": [],
            "timestamp": DEFAULT_DATE,
            "session_id": self.generate_session_id(),
            "progress": {}
        }
    
    def load_task_queue(self):
        """Load task queue"""
        if TASK_QUEUE_FILE.exists():
            try:
                with open(TASK_QUEUE_FILE, 'r') as f:
                    return json.load(f)
            except:
                pass
        return {"tasks": [], "completed": []}
    
    def save_checkpoint(self, force=False):
        """Save checkpoint ke file"""
        self.checkpoint["timestamp"] = datetime.now().strftime("%Y-%m-%d %H:%M:%S") + " WITA"
        
        # Auto-save setiap 5 task atau jika forced
        if force or len(self.checkpoint["completed_tasks"]) % 5 == 0:
            with open(CHECKPOINT_FILE, 'w') as f:
                json.dump(self.checkpoint, f, indent=2)
            print(f"💾 Checkpoint saved: {len(self.checkpoint['completed_tasks'])} tasks completed")
            
    def generate_session_id(self):
        """Generate unique session ID"""
        import uuid
        return str(uuid.uuid4())[:8]
    
    def add_task(self, task_name, description="", priority="normal"):
        """Tambah task ke queue"""
        task = {
            "name": task_name,
            "description": description,
            "priority": priority,  # high, normal, low
            "added_at": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
            "status": "pending"
        }
        
        if task not in self.task_queue["tasks"]:
            self.task_queue["tasks"].append(task)
            self.save_task_queue()
            print(f"✅ Task added: {task_name}")
        else:
            print(f"⚠️ Task already exists: {task_name}")
    
    def save_task_queue(self):
        """Save task queue"""
        with open(TASK_QUEUE_FILE, 'w') as f:
            json.dump(self.task_queue, f, indent=2)
    
    def get_next_task(self):
        """Get task berikutnya berdasarkan priority"""
        tasks = self.task_queue["tasks"]
        if not tasks:
            return None
        
        # Sort by priority
        priority_order = {"high": 0, "normal": 1, "low": 2}
        tasks.sort(key=lambda x: priority_order.get(x["priority"], 1))
        
        for task in tasks:
            if task["status"] == "pending":
                return task
        return None
    
    def complete_task(self, task_name):
        """Mark task sebagai completed"""
        for task in self.task_queue["tasks"]:
            if task["name"] == task_name:
                task["status"] = "completed"
                task["completed_at"] = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                
                # Add to checkpoint
                if task_name not in self.checkpoint["completed_tasks"]:
                    self.checkpoint["completed_tasks"].append(task_name)
                
                self.save_task_queue()
                self.save_checkpoint()
                print(f"🎉 Task completed: {task_name}")
                return True
        return False
    
    def log(self, message, level="info"):
        """Logging dengan timestamp"""
        timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        log_entry = f"[{timestamp}] [{level.upper()}] {message}\n"
        
        print(log_entry.strip())
        
        with open(LOG_FILE, 'a') as f:
            f.write(log_entry)
    
    def git_commit(self, message):
        """Auto git commit dengan checkpoint"""
        try:
            # Add all changes
            subprocess.run(["git", "-C", str(REPO_PATH), "add", "-A"], check=True)
            
            # Check if there are changes
            result = subprocess.run(
                ["git", "-C", str(REPO_PATH), "status", "--porcelain"],
                capture_output=True,
                text=True
            )
            
            if result.stdout.strip():
                # Commit
                subprocess.run(
                    ["git", "-C", str(REPO_PATH), "commit", "-m", message],
                    check=True
                )
                
                # Push
                subprocess.run(
                    ["git", "-C", str(REPO_PATH), "push", "origin", "main"],
                    check=True
                )
                
                self.log(f"✅ Git commit & push: {message}", "success")
                return True
            else:
                self.log("No changes to commit", "info")
                return False
                
        except subprocess.CalledProcessError as e:
            self.log(f"❌ Git error: {e}", "error")
            return False
    
    def generate_progress_report(self):
        """Generate progress report untuk progress/index.html"""
        completed = len(self.checkpoint["completed_tasks"])
        pending = len([t for t in self.task_queue["tasks"] if t["status"] == "pending"])
        
        report = f"""
## 📊 Auto Progress Report - {datetime.now().strftime('%B %d, %Y')} WITA

### Session: {self.checkpoint['session_id']}

### Completed Tasks ({completed})
"""
        for task in self.checkpoint["completed_tasks"]:
            report += f"- ✅ {task}\n"
        
        report += f"""
### Pending Tasks ({pending})
"""
        for task in self.task_queue["tasks"]:
            if task["status"] == "pending":
                report += f"- ⏳ {task['name']} ({task['priority']})\n"
        
        report += f"""
### Progress: {completed}/{completed + pending} ({int(completed/(completed+pending)*100) if completed + pending > 0 else 0}%)
"""
        return report
    
    def run_interactive(self):
        """Mode interactive - agent menunggu input"""
        print("""
╔══════════════════════════════════════════════════════════════╗
║     🤖 Payangan Hospital - Persistent Agent                  ║
║     Mode: Interactive | Session: {}                        ║
╚══════════════════════════════════════════════════════════════╝
        
Commands:
  add <task_name> [description]  - Tambah task baru
  list                           - List semua task
  next                           - Lihat task berikutnya
  do <task_name>                 - Kerjakan task
  complete <task_name>           - Mark task selesai
  progress                       - Lihat progress
  checkpoint                     - Save checkpoint sekarang
  commit <message>               - Git commit & push
  report                         - Generate progress report
  help                           - Tampilkan help
  exit                           - Exit agent

Current Date: {} WITA
""".format(self.checkpoint['session_id'], DEFAULT_DATE))
        
        while True:
            try:
                user_input = input("\n🤖 > ").strip()
                
                if not user_input:
                    continue
                    
                parts = user_input.split(maxsplit=1)
                cmd = parts[0].lower()
                args = parts[1] if len(parts) > 1 else ""
                
                if cmd == "exit":
                    self.save_checkpoint(force=True)
                    print("👋 Goodbye! Checkpoint saved.")
                    break
                    
                elif cmd == "help":
                    print("""
Commands:
  add <task> [desc]     - Add new task
  list                  - List all tasks
  next                  - Show next task
  do <task>            - Work on task
  complete <task>       - Mark task done
  progress              - Show progress
  checkpoint           - Save checkpoint
  commit <msg>          - Git commit & push
  report                - Generate report
  exit                  - Exit
""")
                    
                elif cmd == "add":
                    if args:
                        task_name = args.split()[0]
                        desc = args[len(task_name):].strip()
                        self.add_task(task_name, desc)
                    else:
                        print("Usage: add <task_name> [description]")
                        
                elif cmd == "list":
                    print("\n📋 Task Queue:")
                    for task in self.task_queue["tasks"]:
                        status_icon = "✅" if task["status"] == "completed" else "⏳"
                        priority_icon = "🔴" if task["priority"] == "high" else "🟡" if task["priority"] == "normal" else "🟢"
                        print(f"  {status_icon} {priority_icon} {task['name']} - {task.get('description', 'No description')}")
                        
                elif cmd == "next":
                    task = self.get_next_task()
                    if task:
                        print(f"\n📌 Next task: {task['name']}")
                        print(f"   Description: {task.get('description', 'No description')}")
                        print(f"   Priority: {task['priority']}")
                    else:
                        print("No pending tasks!")
                        
                elif cmd == "do":
                    if args:
                        self.log(f"Starting task: {args}", "info")
                        # Di sini bisa integrate dengan OpenHands SDK
                        print(f"\n🔄 Working on: {args}")
                        print("   (Integrate with OpenHands SDK for actual execution)")
                    else:
                        print("Usage: do <task_name>")
                        
                elif cmd == "complete":
                    if args:
                        self.complete_task(args)
                    else:
                        print("Usage: complete <task_name>")
                        
                elif cmd == "progress":
                    completed = len([t for t in self.task_queue["tasks"] if t["status"] == "completed"])
                    total = len(self.task_queue["tasks"])
                    pct = int(completed/total*100) if total > 0 else 0
                    print(f"\n📊 Progress: {pct}% ({completed}/{total} tasks)")
                    print(f"   Session: {self.checkpoint['session_id']}")
                    
                elif cmd == "checkpoint":
                    self.save_checkpoint(force=True)
                    
                elif cmd == "commit":
                    if args:
                        self.git_commit(args)
                    else:
                        print("Usage: commit <message>")
                        
                elif cmd == "report":
                    print(self.generate_progress_report())
                    
                else:
                    print(f"Unknown command: {cmd}")
                    
            except KeyboardInterrupt:
                self.save_checkpoint(force=True)
                print("\n\n👋 Interrupted. Checkpoint saved.")
                break
            except Exception as e:
                self.log(f"Error: {e}", "error")
    
    def run_auto(self, tasks=None):
        """Mode auto - jalankan task dari queue"""
        if tasks:
            for task in tasks:
                self.add_task(task)
        
        print("""
╔══════════════════════════════════════════════════════════════╗
║     🤖 Payangan Hospital - Persistent Agent                 ║
║     Mode: Auto | Session: {}                              ║
╚══════════════════════════════════════════════════════════════╝
""".format(self.checkpoint['session_id']))
        
        while True:
            task = self.get_next_task()
            if not task:
                print("✅ All tasks completed!")
                self.save_checkpoint(force=True)
                break
            
            print(f"\n🔄 Working on: {task['name']}")
            print(f"   Description: {task.get('description', 'No description')}")
            
            # Placeholder - integrate dengan actual agent execution
            # Di sini bisa panggil OpenHands SDK atau execute command
            
            # Simulasi selesai
            user_input = input("\n   Tekan Enter jika selesai, atau ketik 'skip' untuk skip: ").strip()
            
            if user_input.lower() != 'skip':
                self.complete_task(task['name'])
                self.git_commit(f"✅ Complete: {task['name']}")
            else:
                print("   Skipped.")
            
            # Auto checkpoint setiap 3 task
            if len(self.checkpoint["completed_tasks"]) % 3 == 0:
                self.save_checkpoint()
                
    def run_watch(self):
        """Mode watch - monitor perubahan file dan auto generate report"""
        print("""
╔══════════════════════════════════════════════════════════════╗
║     🤖 Payangan Hospital - Persistent Agent                  ║
║     Mode: Watch | Session: {}                               ║
╚══════════════════════════════════════════════════════════════╝

Monitoring changes in repository...
Press Ctrl+C to stop.
""".format(self.checkpoint['session_id']))
        
        import time
        
        last_commit = subprocess.run(
            ["git", "-C", str(REPO_PATH), "rev-parse", "HEAD"],
            capture_output=True,
            text=True
        ).stdout.strip()
        
        while True:
            try:
                time.sleep(30)  # Check setiap 30 detik
                
                # Check for new commits
                current_commit = subprocess.run(
                    ["git", "-C", str(REPO_PATH), "rev-parse", "HEAD"],
                    capture_output=True,
                    text=True
                ).stdout.strip()
                
                if current_commit != last_commit:
                    print(f"\n📝 New changes detected: {current_commit[:8]}")
                    last_commit = current_commit
                    
                    # Generate auto progress update
                    self.git_commit("[Auto] Update progress - " + datetime.now().strftime("%Y-%m-%d %H:%M"))
                    
            except KeyboardInterrupt:
                print("\n\n👋 Watch stopped.")
                break


def main():
    parser = argparse.ArgumentParser(description="Payangan Hospital Persistent Agent")
    parser.add_argument("--resume", action="store_true", help="Resume dari checkpoint terakhir")
    parser.add_argument("--task", type=str, help="Eksekusi task spesifik")
    parser.add_argument("--add", type=str, help="Tambah task baru")
    parser.add_argument("--auto", action="store_true", help="Mode auto - jalankan semua task")
    parser.add_argument("--watch", action="store_true", help="Watch mode - monitor perubahan")
    parser.add_argument("--progress", action="store_true", help="Tampilkan progress")
    parser.add_argument("--report", action="store_true", help="Generate progress report")
    
    args = parser.parse_args()
    
    agent = PersistentAgent()
    
    if args.progress:
        agent.log(f"Progress: {len(agent.checkpoint['completed_tasks'])} tasks completed")
        agent.log(f"Session: {agent.checkpoint['session_id']}")
        
    elif args.report:
        print(agent.generate_progress_report())
        
    elif args.add:
        agent.add_task(args.add)
        
    elif args.task:
        agent.log(f"Executing task: {args.task}")
        agent.complete_task(args.task)
        agent.save_checkpoint()
        
    elif args.watch:
        agent.run_watch()
        
    elif args.auto:
        agent.run_auto()
        
    else:
        agent.run_interactive()


if __name__ == "__main__":
    main()
