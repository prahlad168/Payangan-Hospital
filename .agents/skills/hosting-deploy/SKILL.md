---
name: hosting-deploy
description: This skill should be used when the user asks to "deploy", "push ke hosting", "update website", "sync hosting", "pull dari github", "webhook tidak jalan", "hosting tidak update", "manual deploy", "direct deploy", "download dari github", atau setiap kali perlu sync file dari GitHub ke hosting Idwebhost.
---

# hosting-deploy

Deploy the Payangan Hospital website from the local Git repository to the Idwebhost hosting via SSH using rsync (fallback: scp).

## Configuration

| Component | Value |
|-----------|-------|
| Project | Payangan Hospital |
| Repository | D:\Payangan-Hospital |
| Git branch | main |
| Domain | https://payanganhospital.gianyarkab.go.id/ |
| SSH username | payangan |
| SSH host | 203.161.184.120 |
| SSH port | 22 |
| Remote home | /home/payangan |
| Web root | detect remotely; do not guess |

SSH keys (preferred order):
1. `C:\Users\Admin\.ssh\id_ed25519`
2. `C:\Users\Admin\.ssh\id_rsa`
3. `C:\Users\Admin\.ssh\admin_rsa`

## Exclusions

Never upload or delete these from the hosting:

```text
.git/
PayanganWeb.zip
video/*.mp4
node_modules/
.env
.env.*
*.log
```

## Workflow

Execute the following steps in order. Do not skip steps.

### 1. Pre-flight checks

Run these commands before any deployment:

```bash
git rev-parse --abbrev-ref HEAD
git rev-parse HEAD
git status --short
```

Record the current branch and commit hash for the final report.

### 2. Detect SSH key

Check for existing private keys in order of preference. Do not create or expose keys.

```powershell
if (Test-Path "$env:USERPROFILE\.ssh\id_ed25519") { echo "SSH key detected: id_ed25519" }
elseif (Test-Path "$env:USERPROFILE\.ssh\id_rsa") { echo "SSH key detected: id_rsa" }
elseif (Test-Path "$env:USERPROFILE\.ssh\admin_rsa") { echo "SSH key detected: admin_rsa" }
else { echo "ERROR: No SSH private key found in $env:USERPROFILE\.ssh"; exit 1 }
```

If no key is found, stop and report exactly what is missing.

### 3. Test SSH connectivity

Test SSH connection without modifying anything:

```bash
ssh -o StrictHostKeyChecking=no -o ConnectTimeout=10 -p 22 payangan@203.161.184.120 "echo SSH_OK"
```

If this fails, stop and report the exact SSH error.

### 4. Detect remote document root

Connect to the server and identify the actual web root. Do not assume `public_html`.

```bash
ssh -o StrictHostKeyChecking=no -p 22 payangan@203.161.184.120 '
  echo "HOME=$HOME";
  echo "PWD=$(pwd)";
  echo "--- ls -la ---";
  ls -la;
  echo "--- find . -maxdepth 2 -name index.html 2>/dev/null ---";
  find . -maxdepth 2 -name index.html 2>/dev/null;
'
```

Determine the document root from the output. Common patterns on cPanel/Idwebhost:
- `/home/payangan/public_html`
- `/home/payangan/www`
- `/home/payangan`

Record the exact detected path. Do not modify anything during detection.

### 5. Dry-run

Run rsync in dry-run mode from the repository root. Use the detected document root as the remote target.

```bash
rsync -avzn \
  --exclude='.git' \
  --exclude='PayanganWeb.zip' \
  --exclude='video/*.mp4' \
  --exclude='node_modules' \
  --exclude='.env' \
  --exclude='.env.*' \
  --exclude='*.log' \
  -e "ssh -p 22 -o StrictHostKeyChecking=no -i C:\Users\Admin\.ssh\id_ed25519" \
  ./ payangan@203.161.184.120:<DOCUMENT_ROOT>/
```

Replace `<DOCUMENT_ROOT>` with the detected path.

If rsync is unavailable, use scp dry-run equivalent (list files only):

```powershell
Get-ChildItem -Recurse -File | Where-Object { $_.FullName -notmatch '\\\.git\\|PayanganWeb\.zip|\\video\\|\\node_modules\\|\A\.env|\A\.env\.|\A.*\.log$' } | Select-Object -ExpandProperty FullName
```

Show:
- Exact target directory
- Summary of files that will be uploaded
- Any files that will be skipped

### 6. User confirmation

Before any actual upload, present the summary and require explicit confirmation:

```text
Target directory: <DOCUMENT_ROOT>
Files to upload: <COUNT>
Files skipped: <COUNT>
Commit: <SHA>

Type 'confirm' to proceed with deployment, or anything else to abort.
```

Wait for the user to type `confirm`. If the user does not confirm, abort and report that deployment was cancelled.

### 7. Deploy (first deployment: no --delete)

For the first deployment, do NOT use `--delete`. Do not delete anything from the hosting.

```bash
rsync -avz \
  --exclude='.git' \
  --exclude='PayanganWeb.zip' \
  --exclude='video/*.mp4' \
  --exclude='node_modules' \
  --exclude='.env' \
  --exclude='.env.*' \
  --exclude='*.log' \
  -e "ssh -p 22 -o StrictHostKeyChecking=no -i C:\Users\Admin\.ssh\id_ed25519" \
  ./ payangan@203.161.184.120:<DOCUMENT_ROOT>/
```

If rsync fails, fallback to scp:

```bash
scp -r -P 22 -o StrictHostKeyChecking=no -i C:\Users\Admin\.ssh\id_ed25519 \
  <FILES> payangan@203.161.184.120:<DOCUMENT_ROOT>/
```

### 8. Verify deployment

After upload, verify files exist on the remote server:

```bash
ssh -o StrictHostKeyChecking=no -p 22 -i C:\Users\Admin\.ssh\id_ed25519 payangan@203.161.184.120 '
  ls -la <DOCUMENT_ROOT>/index.html
  ls -la <DOCUMENT_ROOT>/about.html
  ls -la <DOCUMENT_ROOT>/dokter.html
  ls -la <DOCUMENT_ROOT>/css/
  ls -la <DOCUMENT_ROOT>/js/
'
```

Check that key files are present and have been updated.

### 9. Website availability check

Check that the website is accessible:

```bash
curl.exe -s -o NUL -w "%{http_code}" "https://payanganhospital.gianyarkab.go.id/"
```

Also check a few key pages:

```bash
curl.exe -s -o NUL -w "%{http_code}" "https://payanganhospital.gianyarkab.go.id/index.html"
curl.exe -s -o NUL -w "%{http_code}" "https://payanganhospital.gianyarkab.go.id/about.html"
curl.exe -s -o NUL -w "%{http_code}" "https://payanganhospital.gianyarkab.go.id/dokter.html"
```

### 10. Deployment report

Produce a final report with:

- Deployed commit hash
- Deployed branch
- Target directory
- Files uploaded count
- Any errors or warnings
- Website URL and HTTP status

## Safety Rules

1. Never expose, print, or transmit private keys.
2. Never ask the user to paste a private key, password, or token into the chat.
3. If SSH authentication fails, stop and report exactly what is missing.
4. Do not use `--delete` unless explicitly requested by the user later.
5. Do not modify website functionality during deployment.
6. Do not create new Git commits or push to GitHub during deployment.

## Invocation

Invoke this skill by name:

```
hosting-deploy
```
