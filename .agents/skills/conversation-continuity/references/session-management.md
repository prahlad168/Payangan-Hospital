# Session Management Best Practices

## Understanding Session Limitations

OpenHands (and most AI assistants) have session-based context:
- Each conversation session has a context window
- When session closes, context is cleared
- This is a technical limitation, not a bug

## Ways to Maintain Continuity

### 1. AGENTS.md (Repository Memory)
Store persistent knowledge in `AGENTS.md` at repository root:
- Project structure and conventions
- Current work-in-progress state
- Important decisions and context
- User preferences

### 2. External Note-Taking
User can maintain notes outside OpenHands:
- Use notepad or notes app
- Document file paths and changes
- Keep command history
- Screenshot important outputs

### 3. Git Commits
Commit work regularly:
```bash
git add -A
git commit -m "WIP: feature in progress"
```
Even incomplete work is saved in git history.

### 4. File-Based State
Save state to files:
```bash
# Save current task to file
echo "Current: Building login API" > .session_state
echo "Next: Add validation middleware" >> .session_state
```

## Communication Best Practices

### When Context is Lost

**Indonesian response template:**
```
Maaf, sesi percakapan sebelumnya memang tidak bisa dilanjutkan secara otomatis. 
Ini adalah keterbatasan teknis dari AI assistant.

Untuk melanjutkan, Anda bisa:

1. **Copy-paste** percakapan sebelumnya ke sini
2. **Ringkaskan** apa yang sedang dikerjakan
3. **Arahkan** ke file atau bagian kode yang sedang diedit

Saya akan membantu melanjutkan dari titik tersebut.
```

### Before Closing Session (Proactive)

If user seems to be wrapping up but task is incomplete:

```
Sebelum sesi ditutup, saya akan menyimpan konteks ke AGENTS.md 
agar bisa dilanjutkan nanti:

[Tulis ringkasan ke AGENTS.md]

Konteks tersimpan.下次 session, Anda bisa bilang:
"lanjutkan dari AGENTS.md" atau paste ringkasan ini.
```

## Technical Notes

### What Gets Lost
- Conversation history
- Variables in memory
- Terminal session state
- Uncommitted changes

### What Persists
- Git repository (if committed)
- Files on disk
- AGENTS.md (if updated)
- External documentation

## Pro Tips for Users

1. **Commit often** - Don't wait until complete
2. **Update AGENTS.md** - Save important context
3. **Keep notes** - Document your own summary
4. **Share context** - Paste relevant conversation parts
5. **Be specific** - "File X line Y" is better than "the code"
