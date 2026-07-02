# Play Command Skill

## Overview
This skill provides the `/play` command functionality for Payangan Hospital website - running all quality assurance agents with a single command.

## Trigger
When user says:
- "play"
- "jalankan semua agent"
- "run all agents"
- "check semua"
- "/play"

## Actions

### 1. Run Local Play Script
```bash
cd /workspace/project/Payangan-Hospital
python3 scripts/play.py
```

### 2. What It Checks

| Agent | Checks |
|-------|--------|
| 🔍 Link Checker | Logo links, dokter links, kontak links, broken internal links |
| ✅ QA Checker | DOCTYPE, viewport meta, lang attribute, alt text, meta description |
| 📋 Content Validator | 22 doctors list, dokter images, required pages |

### 3. Expected Output
```
============================================================
  📋 PAYANGAN HOSPITAL - /play COMMAND
============================================================

  🔍 Agent 1: Link Checker      ✅ Pass
  ✅ Agent 2: QA Checker        ✅ Pass
  📋 Agent 3: Content Validator ✅ Pass

Total:
  Errors: 0
  Warnings: 18

🎉🎉🎉 ALL AGENTS PASSED!
```

### 4. If Errors Found
- Report which agent failed
- List specific issues found
- Suggest fixes if known

## Files Involved
- `scripts/play.py` - Main play script
- `.github/workflows/00-all-agents.yml` - GitHub Actions version
- `OPENHANDS-AUTOMATION.md` - OpenHands Cloud guide
- `PLAY-COMMAND.md` - Full documentation

## Related Skills
- link-checker: Individual link checking
- qa-checker: Individual QA checking
- content-validator: Individual content validation

## Cron Schedule Options
For automated scheduling:
- `0 0 * * *` - Daily at midnight
- `0 7 * * *` - Daily at 7 AM (WIB)
- `0 */6 * * *` - Every 6 hours
- `0 9 * * 1-5` - Weekdays at 9 AM
