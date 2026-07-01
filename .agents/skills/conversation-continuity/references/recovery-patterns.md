# Recovery Patterns

## Common Context Loss Scenarios

### Scenario 1: User starts new conversation referring to previous work

**User says:** "Melanjutkan dari percakapan sebelumnya..."

**Response pattern:**
1. Thank user for the summary
2. Extract key context from their message
3. Create action plan based on restored context
4. Ask clarifying questions if needed

### Scenario 2: User complains conversation was closed

**User says:** "Percakapan saya ditutup, tidak bisa lanjut"

**Response pattern:**
1. Apologize for the inconvenience
2. Explain OpenHands limitation (session-based context)
3. Guide user to copy-paste previous conversation
4. Offer to help restore from what they remember

### Scenario 3: User wants to resume interrupted task

**User says:** "Saya tadi sedang mengedit file X, tapi session terputus"

**Response pattern:**
1. Ask user to share the file or describe changes
2. Check if file exists in repository
3. Review current state of the work
4. Complete or continue the task

## Context Restoration Techniques

### Method 1: Conversation Copy-Paste
User pastes relevant parts of previous conversation.

```
User: [Paste from previous session]
Saya tadi sampai di这一步 - install dependencies dan buat fitur login
```

### Method 2: Summary-Based
User provides brief summary of context.

```
User: Saya sedang membuat API untuk user authentication
Tidak sampai selesai, session terputus
```

### Method 3: File Reference
User points to files being worked on.

```
User: File routes/auth.py yang tadi saya edit
```

### Method 4: Command/Output Reference
User shares terminal output or command history.

```
User: Error tadi:
AttributeError: 'User' object has no attribute 'validate'
```

## Recovery Checklist

When restoring context:
- [ ] Identify what was being worked on
- [ ] Determine how far the work progressed
- [ ] Check current state of relevant files
- [ ] Create plan to complete or continue
- [ ] Confirm restoration with user

## Proactive Save Guidelines

Before session ends, if task is incomplete:
1. Summarize completed work
2. List remaining tasks
3. Save state to AGENTS.md
4. Inform user what was saved
