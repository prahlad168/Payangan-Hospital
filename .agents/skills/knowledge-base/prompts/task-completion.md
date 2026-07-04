---
Title: Task Completion Prompt Template
Category: AI
Difficulty: Easy
Keywords: prompt, task, completion, knowledge extraction
Date: 2026-07-03
Version: 1.0
Author: AI Agent System
Status: Active
Related: master-continuous-learning, project-checklist
---

# Task Completion Prompt Template

Use this template when completing any task to ensure knowledge extraction.

## Standard Task Completion

```
[SYSTEM PROMPT - Use at end of every task]

After completing this task, follow the Knowledge Pipeline:

1. EXTRACT KNOWLEDGE
   - What worked well?
   - What was challenging?
   - What can be reused?

2. CREATE ASSETS
   - Create or update SOP if process is new/improved
   - Create checklist if applicable
   - Create template if repeatable

3. STORE KNOWLEDGE
   - Document in appropriate category
   - Add metadata (title, keywords, date, version)
   - Link to related documents

4. SHARE KNOWLEDGE
   - Identify if useful for other teams
   - Make recommendations
   - Update relevant indexes

5. IMPROVE
   - Identify improvement opportunities
   - Note for next iteration
   - Never waste learning opportunity
```

## Example Usage

### Before Task
```
Task: Fix broken image on homepage

Knowledge Pipeline Prompt:
Follow the Knowledge Pipeline. After fixing the image:
1. Document what caused the issue
2. Create/update SOP for image verification
3. Add to image-fixing skill
4. Share lesson with team
5. Identify prevention measures
```

### After Task
```
Result stored in:
- SOP: .agents/skills/knowledge-base/hospital-sop/image-maintenance.md
- Checklist: .agents/skills/knowledge-base/checklists/image-checklist.md
- Lesson: .agents/skills/knowledge-base/lessons-learned/image-issues-2026-07.md
```

## Knowledge Pipeline Checklist

- [ ] Identified key learnings
- [ ] Created or updated SOP
- [ ] Created checklist if applicable
- [ ] Added to knowledge base
- [ ] Shared with relevant teams
- [ ] Noted improvement opportunities

---

**Last Updated:** 2026-07-03
**Version:** 1.0
