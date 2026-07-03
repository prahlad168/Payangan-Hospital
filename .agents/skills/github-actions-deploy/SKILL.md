---
name: github-actions-deploy
description: This skill should be used when the user asks to "deploy", "trigger deploy", "run workflow", "github actions", "ci/cd", "auto deploy", "build", "workflow error", atau setiap kali perlu deploy atau trigger GitHub Actions workflow.
---

# GitHub Actions Deploy Skill

## Overview

Skill untuk trigger dan manage GitHub Actions workflows untuk deployment.

## Current Workflows

| Workflow | File | Description |
|----------|------|-------------|
| Run All Agents | `00-all-agents.yml` | QA & testing |
| Auto Link Checker | `01-link-checker.yml` | Check broken links |
| Auto PR Reviewer | `02-pr-reviewer.yml` | Auto review PRs |
| Auto QA Checker | `03-qa-checker.yml` | QA checks |
| **Deploy** | `04-deploy.yml` | Deploy to hosting |
| Content Validator | `05-content-validator.yml` | Validate content |
| Auto Update Progress | `06-auto-update-progress.yml` | Update progress page |

## API Endpoints

### List Workflows
```bash
curl -s "https://api.github.com/repos/OWNER/REPO/actions/workflows" \
  -H "Authorization: token ${GITHUB_TOKEN}" | python3 -c "import sys,json; [print(w['name'], w['path']) for w in json.load(sys.stdin).get('workflows',[])]"
```

### Trigger Workflow Dispatch
```bash
curl -X POST "https://api.github.com/repos/OWNER/REPO/actions/workflows/WORKFLOW_FILE/dispatches" \
  -H "Authorization: token ${GITHUB_TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{"ref":"main"}'
```

### List Workflow Runs
```bash
curl -s "https://api.github.com/repos/OWNER/REPO/actions/runs?workflow_id=WORKFLOW_FILE" \
  -H "Authorization: token ${GITHUB_TOKEN}"
```

### Get Run Status
```bash
curl -s "https://api.github.com/repos/OWNER/REPO/actions/runs/RUN_ID" \
  -H "Authorization: token ${GITHUB_TOKEN}"
```

## Common Issues & Solutions

### Issue: "Unrecognized named-value: secrets"
```
Error: Unrecognized named-value: 'secrets'. Located at position 14 within expression: success() && secrets.DISCORD_WEBHOOK != ''
```

**Cause**: Workflow has syntax error with `secrets` in workflow_dispatch context.

**Solution**: 
1. Fix the workflow file syntax
2. Or use alternative deployment method

### Issue: Workflow Not Found
```
Error: workflow not found
```

**Cause**: Wrong workflow file path or workflow_id.

**Solution**: 
```bash
# List all workflows first
curl -s "https://api.github.com/repos/OWNER/REPO/actions/workflows" \
  -H "Authorization: token ${GITHUB_TOKEN}"
```

## Deployment Methods

### Method 1: GitHub Actions (Standard)
```bash
# Trigger deploy workflow
curl -X POST "https://api.github.com/repos/prahlad168/Payangan-Hospital/actions/workflows/04-deploy.yml/dispatches" \
  -H "Authorization: token ${GITHUB_TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{"ref":"main"}'
```

### Method 2: Manual Deploy Script
```
https://payanganhospital.gianyarkab.go.id/deploy.php?key=PAYANGAN_DEPLOY_2026
```

### Method 3: GitHub Webhook
Push to GitHub automatically triggers webhook → hosting pulls.

## Workflow Files Location
```
.github/workflows/
├── 00-all-agents.yml
├── 01-link-checker.yml
├── 02-pr-reviewer.yml
├── 03-qa-checker.yml
├── 04-deploy.yml
├── 05-content-validator.yml
└── 06-auto-update-progress.yml
```

## Quick Commands

### List All Workflows
```bash
curl -s "https://api.github.com/repos/prahlad168/Payangan-Hospital/actions/workflows" \
  -H "Authorization: token ${GITHUB_TOKEN}" | python3 -m json.tool
```

### Trigger Specific Workflow
```bash
# Replace WORKFLOW_FILE with actual file name
curl -X POST "https://api.github.com/repos/prahlad168/Payangan-Hospital/actions/workflows/WORKFLOW_FILE/dispatches" \
  -H "Authorization: token ${GITHUB_TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{"ref":"main"}'
```

### Check Recent Runs
```bash
curl -s "https://api.github.com/repos/prahlad168/Payangan-Hospital/actions/runs?per_page=5" \
  -H "Authorization: token ${GITHUB_TOKEN}"
```

## Workflow Dispatch API

**Endpoint**: `POST /repos/{owner}/{repo}/actions/workflows/{workflow_id}/dispatches`

**Headers**:
- `Authorization: token ${GITHUB_TOKEN}`
- `Content-Type: application/json`

**Body**:
```json
{
  "ref": "main",
  "inputs": {
    "param1": "value1"
  }
}
```

**Response**: 
- 204 No Content = Success
- 422 Unprocessable Entity = Error (check workflow syntax)

## Security Notes

- Never expose `${GITHUB_TOKEN}` in public
- Use environment variables
- Rotate tokens regularly
- Set appropriate permissions in workflow files

## Troubleshooting

| Error | Cause | Solution |
|-------|-------|----------|
| 404 Not Found | Wrong workflow path | Check workflow file exists |
| 422 Invalid | Syntax error in workflow | Fix YAML syntax |
| 403 Forbidden | Missing permissions | Check token permissions |
| 204 No Content | Success | Workflow triggered |
