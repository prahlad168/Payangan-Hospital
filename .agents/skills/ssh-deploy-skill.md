# SSH Deploy Skill — Payangan Hospital

## Overview
Skill for deploying Payangan Hospital website via SSH/GitHub Actions to Idwebhost hosting.

## Idwebhost Credentials
| Field | Value |
|-------|-------|
| Host | 203.161.184.120 |
| Port | 4422 |
| User | payangan |
| Path | /home/payangan/public_html |

## GitHub Repository
- Repo: `prahlad168/Payangan-Hospital`
- Branch: `main`
- Domain: `https://payanganhospital.gianyarkab.go.id/`

## Required GitHub Secrets
| Secret Name | Description |
|-------------|-------------|
| `SSH_HOST` | Server IP: `203.161.184.120` |
| `SSH_PORT` | SSH port: `4422` |
| `SSH_USER` | SSH user: `payangan` |
| `SSH_PATH` | Deploy path: `/home/payangan/public_html` |
| `SSH_PRIVATE_KEY` | SSH private key for payangan user |

## Workflow File
Path: `.github/workflows/ssh-deploy.yml`

### Common Bugs & Fixes
1. **SSH_HOST missing from rsync step env** — Add `SSH_HOST: ${{ secrets.SSH_HOST }}` to the rsync step's `env` section
2. **SSH_PORT missing from Setup SSH key step env** — Add `SSH_PORT: ${{ secrets.SSH_PORT }}` to the Setup SSH key step's `env` section
3. **ssh-keyscan uses wrong port** — Must use `ssh-keyscan -p "$SSH_PORT" -H "$SSH_HOST"` (not default port 22)
4. **ssh-keyscan fails and blocks workflow** — Add `|| true` to ssh-keyscan since rsync uses `StrictHostKeyChecking=no`

### Corrected Workflow Structure
```yaml
- name: Setup SSH key
  run: |
    mkdir -p ~/.ssh
    echo "$SSH_PRIVATE_KEY" > ~/.ssh/id_rsa
    chmod 600 ~/.ssh/id_rsa
    ssh-keyscan -p "$SSH_PORT" -H "$SSH_HOST" >> ~/.ssh/known_hosts 2>/dev/null || true
  env:
    SSH_PRIVATE_KEY: ${{ secrets.SSH_PRIVATE_KEY }}
    SSH_HOST: ${{ secrets.SSH_HOST }}
    SSH_PORT: ${{ secrets.SSH_PORT }}

- name: Deploy to hosting via rsync
  run: |
    rsync -avz --delete \
      --exclude '.git' \
      --exclude 'node_modules' \
      --exclude '.github' \
      --exclude 'scripts' \
      --exclude '*.md' \
      -e "ssh -p $SSH_PORT -o StrictHostKeyChecking=no" \
      ./ $SSH_USER@$SSH_HOST:$SSH_PATH/
  env:
    SSH_HOST: ${{ secrets.SSH_HOST }}
    SSH_USER: ${{ secrets.SSH_USER }}
    SSH_PORT: ${{ secrets.SSH_PORT }}
    SSH_PATH: ${{ secrets.SSH_PATH }}
```

## Deployment Methods (Priority Order)

### 1. Webhook Auto-Deploy (Recommended)
- Trigger: `curl -X POST "https://payanganhospital.gianyarkab.go.id/webhook.php"`
- Most reliable — server pulls from GitHub directly
- No firewall issues from GitHub Actions

### 2. GitHub Actions Webhook Deploy (`deploy-manual.yml`)
- Workflow: `.github/workflows/deploy-manual.yml`
- Triggers webhook endpoint from GitHub Actions
- Falls back when SSH is blocked

### 3. SSH Deploy via GitHub Actions (`ssh-deploy.yml`)
- Workflow: `.github/workflows/ssh-deploy.yml`
- Requires GitHub Actions runner to reach server on port 4422
- **Known issue**: GitHub Actions IPs may be blocked by server firewall

## Known Blockers
- **GitHub Actions → Idwebhost SSH**: GitHub Actions runners cannot reach 203.161.184.120:4422 ("Network is unreachable"). This is a firewall/network-level block. Use webhook method instead.

## Deployment Checklist
1. [ ] Verify `.github/workflows/ssh-deploy.yml` has all 5 secrets in env sections
2. [ ] Verify `ssh-keyscan` uses `-p $SSH_PORT`
3. [ ] Commit and push workflow fix
4. [ ] Trigger deployment via `gh workflow run ssh-deploy.yml --ref main`
5. [ ] If SSH fails, fall back to webhook: `gh workflow run deploy-manual.yml --ref main`
6. [ ] Verify website: `curl -s -o /dev/null -w "%{http_code}" https://payanganhospital.gianyarkab.go.id/`
7. [ ] Confirm deployed commit: `git log --oneline -1`

## Quick Commands
```bash
# Trigger SSH deploy
gh workflow run ssh-deploy.yml --repo prahlad168/Payangan-Hospital --ref main

# Trigger webhook deploy (fallback)
gh workflow run deploy-manual.yml --repo prahlad168/Payangan-Hospital --ref main

# Check workflow status
gh run view RUN_ID --repo prahlad168/Payangan-Hospital --json status,conclusion

# Get workflow logs
gh run view RUN_ID --repo prahlad168/Payangan-Hospital --log

# Verify website
curl -s -o /dev/null -w "%{http_code}" https://payanganhospital.gianyarkab.go.id/
```