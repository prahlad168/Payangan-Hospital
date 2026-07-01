---
name: conversation-continuity
description: This skill should be used when the conversation is interrupted, closed, or when the user asks to "continue previous conversation", "lanjutkan percakapan sebelumnya", "restore session", "session lost", or when the user wants to resume work from where it left off. Also use when the user mentions that previous context was lost.
---

# Conversation Continuity Skill

## Purpose

Handle session interruptions and restore context when conversations are closed or need to continue from a previous state. This skill ensures smooth transitions between sessions without losing important context or work progress.

## When to Use

Activate this skill when:
- User mentions "lanjutkan", "continue", "previous", "session", "context"
- Conversation appears to be starting fresh but user refers to previous work
- User reports that context was lost or conversation was closed
- Session bridge/interrupt is detected

## Core Workflow

### 1. Detect Context Loss

When a user indicates context was lost:
1. Acknowledge the interruption empathetically
2. Ask the user to provide the previous context or summary
3. Request key details: what was being worked on, last actions taken

### 2. Restore Context

To restore context, ask for or accept:
- Copy-paste of previous conversation
- Summary of what was being done
- Specific files or code that were being worked on
- Any output or error messages from before

### 3. AGENTS.md Memory

For persistent repository knowledge:
1. Check `/AGENTS.md` for saved context
2. Update AGENTS.md with important information from current session before closing
3. Read AGENTS.md at start of new session to restore project context

### 4. Reference Scripts

Use `scripts/restore_context.py` to:
- Parse conversation history
- Extract key action items
- Generate summary of work in progress

## Key Principles

1. **Never assume context is complete** - Always verify with user
2. **Preserve work** - Before session ends, save important state to AGENTS.md
3. **Be proactive** - Offer to save context before closing
4. **Language-aware** - Respond in user's language (Indonesian: "lanjutkan", "percakapan sebelumnya")

## Reference Files

For detailed recovery patterns, consult:
- **`references/recovery-patterns.md`** - Common context recovery scenarios
- **`references/session-management.md`** - Best practices for session handling

## Indonesian Language Support

Indonesian users may say:
- "lanjutkan percakapan sebelumnya"
- "kenapa tidak bisa lanjut?"
- "session saya hilang"
- "konteks sebelumnya hilang"
- "continue from where we left off"

Respond empathetically in Indonesian and guide them through context restoration.
