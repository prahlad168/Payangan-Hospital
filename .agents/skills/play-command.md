# Play Command Skill

## Overview
This skill provides the `/play` command for Payangan Hospital website - running **13 quality assurance agents** for website optimization with a single command.

## Trigger
When user says:
- "play"
- "jalankan semua agent"
- "run all agents"
- "check semua"
- "/play"
- "optimasi website"
- "website optimization"

## Actions

### 1. Run Local Play Script
```bash
cd /workspace/project/Payangan-Hospital
python3 scripts/play.py
```

### 2. 13 Agents Checklist

| # | Agent | Checks |
|---|-------|--------|
| 1 | 🔍 Link Checker | Logo, dokter, kontak links, broken links |
| 2 | ✅ QA Checker | DOCTYPE, viewport, lang, alt text |
| 3 | 📋 Content Validator | 22 doctors, images, required pages |
| 4 | 🔍 SEO Optimizer | Meta description, title tags |
| 5 | ⚡ Performance | Inline styles, lazy loading |
| 6 | ♿ Accessibility | Alt text, heading hierarchy |
| 7 | 🎨 UI/UX Enhancer | Semantic HTML, navigation |
| 8 | 🖼️ Image Optimizer | Image sizes, optimization |
| 9 | 📝 Code Quality | Code cleanliness, best practices |
| 10 | 📱 Mobile Responsive | Viewport, responsive CSS |
| 11 | 🔒 Security Checker | HTTPS, inline JS |
| 12 | 🕐 Content Freshness | Recent content updates |
| 13 | 🚀 Deployment Ready | Required files, final check |

### 3. Output
- Console output with colored status
- HTML report saved to `progress/index.html`
- Report URL: https://payanganhospital.gianyarkab.go.id/progress/

### 4. Expected Output
```
============================================================
  📋 PAYANGAN HOSPITAL - /play (13 AGENTS)
============================================================

  Agent  1: ✅ Link Checker
  Agent  2: ✅ QA Checker
  Agent  3: ✅ Content Validator
  Agent  4: ✅ SEO Optimizer
  Agent  5: ✅ Performance
  Agent  6: ✅ Accessibility
  Agent  7: ✅ UI/UX Enhancer
  Agent  8: ✅ Image Optimizer
  Agent  9: ✅ Code Quality
  Agent 10: ✅ Mobile Responsive
  Agent 11: ✅ Security Checker
  Agent 12: ✅ Content Freshness
  Agent 13: ✅ Deployment Ready

Total: Passed 13/13, Failed 0/13

🎉🎉🎉 ALL 13 AGENTS PASSED!
```

## Files Involved
- `scripts/play.py` - Main play script (13 agents)
- `progress/index.html` - HTML report
- `.github/workflows/00-all-agents.yml` - GitHub Actions version
- `OPENHANDS-AUTOMATION.md` - OpenHands Cloud guide

## Report Location
The HTML report is automatically saved to:
```
progress/index.html
```
After deployment, it will be available at:
```
https://payanganhospital.gianyarkab.go.id/progress/
```

## Cron Schedule Options
For automated scheduling:
- `0 0 * * *` - Daily at midnight
- `0 7 * * *` - Daily at 7 AM (WIB)
- `0 */6 * * *` - Every 6 hours
- `0 9 * * 1-5` - Weekdays at 9 AM
