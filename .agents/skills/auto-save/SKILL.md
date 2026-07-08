---
name: auto-save
description: This skill auto-saves any skill created or modified to GitHub. Use when user says "save", "simpan", "save skill", "auto save", "jadikan skill", "menjadi skill", "menjadikan skill", "menyimpan skill", atau setiap kali membuat atau mengubah skill files di .agents/skills/.
---

# Auto-Save Skill

## Overview

Auto-save any skill file to GitHub repository immediately after creation or modification.

## Trigger

User says any of:
- "save", "simpan"
- "save skill", "auto save"
- "jadikan skill", "menjadi skill"
- "menjadikan skill", "menyimpan skill"

## Workflow

### 1. Create/Edit Skill File
```bash
# Create in .agents/skills/[skill-name]/SKILL.md
# or edit existing skill file
```

### 2. Auto-Commit & Push
```bash
cd /workspace/project/Payangan-Hospital

# Add the skill file
git add .agents/skills/[skill-name]/

# Commit with descriptive message
git commit -m "feat: add [skill-name] skill

- SKILL.md with complete documentation
- Usage instructions
- Examples"

# Push to GitHub
GIT_TERMINAL_PROMPT=0 git push origin main
```

### 3. Verify
```bash
# Verify push successful
git log -1 --oneline
```

## Quick Commands

### Save New Skill
```bash
cd /workspace/project/Payangan-Hospital && \
git add .agents/skills/[SKILL_NAME]/ && \
git commit -m "feat: add [SKILL_NAME] skill" && \
GIT_TERMINAL_PROMPT=0 git push origin main
```

### Save All Skill Changes
```bash
cd /workspace/project/Payangan-Hospital && \
git add .agents/skills/ && \
git commit -m "chore: update skills" && \
GIT_TERMINAL_PROMPT=0 git push origin main
```

## Skill Structure Template

```markdown
---
name: [skill-name]
description: This skill should be used when user says "[trigger phrases]"...
---

# [Skill Name]

## Overview
[Description]

## Usage
[How to use]

## Examples
[Examples]

## Notes
[Any additional info]
```

## Common Patterns

### Pattern 1: New Skill
```bash
mkdir -p .agents/skills/[name]
# Create SKILL.md
git add .agents/skills/[name]/
git commit -m "feat: add [name] skill"
git push
```

### Pattern 2: Update Existing Skill
```bash
# Edit .agents/skills/[name]/SKILL.md
git add .agents/skills/[name]/
git commit -m "fix: update [name] skill - [change description]"
git push
```

### Pattern 3: Multiple Skills at Once
```bash
git add .agents/skills/
git commit -m "feat: add multiple skills

- hosting-deploy
- github-actions-deploy
- auto-save"
git push
```

## Git Configuration

```bash
git config user.name "openhands"
git config user.email "openhands@all-hands.dev"
```

## Error Handling

| Error | Solution |
|-------|----------|
| Nothing to commit | File not in staging - check path |
| Push rejected | Pull first, then push |
| Permission denied | Check GITHUB_TOKEN |

## Verification

After save:
```
git log -1 --oneline
# Should show: feat: add [skill-name] skill
```

Or check GitHub:
```
https://github.com/prahlad168/Payangan-Hospital/tree/main/.agents/skills
```
