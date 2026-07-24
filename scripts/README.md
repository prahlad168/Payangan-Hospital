# 🤖 Persistent Agent Scripts

Scripts untuk menjalankan agent yang persistent dan bisa di-resume.

## 📁 Files

| File | Description |
|------|-------------|
| `persistent_agent.py` | Main script untuk persistent agent |
| `checkpoint.json` | Auto-generated checkpoint file |
| `task_queue.json` | Auto-generated task queue |

## 🚀 Quick Start

### 1. Interactive Mode (Default)
```bash
cd scripts
python persistent_agent.py
```

### 2. Auto Mode - Jalankan Semua Task
```bash
python persistent_agent.py --auto
```

### 3. Watch Mode - Monitor Perubahan
```bash
python persistent_agent.py --watch
```

### 4. Resume dari Checkpoint
```bash
python persistent_agent.py --resume
```

### 5. Quick Commands
```bash
# Tambah task
python persistent_agent.py --add "Fix bug in homepage"

# Lihat progress
python persistent_agent.py --progress

# Generate report
python persistent_agent.py --report
```

## 📋 Interactive Commands

| Command | Description |
|---------|-------------|
| `add <task> [desc]` | Tambah task baru |
| `list` | List semua task |
| `next` | Lihat task berikutnya |
| `do <task>` | Kerjakan task |
| `complete <task>` | Mark task selesai |
| `progress` | Lihat progress |
| `checkpoint` | Save checkpoint |
| `commit <msg>` | Git commit & push |
| `report` | Generate progress report |
| `exit` | Exit (auto-save checkpoint) |

## 💾 Checkpoint System

Agent secara otomatis save checkpoint setiap:
- 5 task selesai
- Manual command `checkpoint`
- Exit dari interactive mode

### Checkpoint File (.agent_checkpoint.json)
```json
{
  "status": "idle",
  "current_task": "Feature X",
  "completed_tasks": ["Task A", "Task B"],
  "pending_tasks": ["Task C"],
  "timestamp": "2026-07-01 08:00 WITA",
  "session_id": "abc12345",
  "progress": {}
}
```

## 🔄 Resume Workflow

```bash
# 1. Start agent
python persistent_agent.py

# 2. Kerjakan beberapa task
> add Build homepage
> do Build homepage
> complete Build homepage

# 3. Terputus? Resume dengan:
python persistent_agent.py --resume

# 4. Lihat progress terakhir
python persistent_agent.py --progress
```

## 🎯 Example Session

```
🤖 Payangan Hospital - Persistent Agent

> add "Fix partner logo visibility"
✅ Task added: Fix partner logo visibility

> list
📋 Task Queue:
  ⏳ 🟡 Fix partner logo visibility - No description

> next
📌 Next task: Fix partner logo visibility
   Description: No description
   Priority: normal

> do Fix partner logo visibility
🔄 Working on: Fix partner logo visibility

> complete Fix partner logo visibility
🎉 Task completed: Fix partner logo visibility
💾 Checkpoint saved: 1 tasks completed

> commit "Fix partner logo visibility"
✅ Git commit & push: Fix partner logo visibility
```

## 🔧 Integration dengan OpenHands SDK

Untuk full integration dengan OpenHands:

```python
from openhands.sdk import Agent, Conversation
from persistent_agent import PersistentAgent

agent = PersistentAgent()

# Load checkpoint
agent.load_checkpoint()

# Create OpenHands agent
openhands = Agent(llm=llm, tools=[...])
conversation = Conversation(agent=openhands)

# Get next task from queue
task = agent.get_next_task()
if task:
    # Execute dengan OpenHands
    conversation.send_message(f"Lakukan task: {task['name']}")
    conversation.run()
    
    # Mark complete
    agent.complete_task(task['name'])
```

## 📊 Auto Update Progress

Agent secara otomatis update progress page setiap push:

1. Task selesai
2. Git commit & push
3. GitHub Actions trigger
4. Progress page auto-update

---

**Agent:** SuperAgent  
**Date:** July 1, 2026  
**Timezone:** WITA (UTC+8) - Bali
