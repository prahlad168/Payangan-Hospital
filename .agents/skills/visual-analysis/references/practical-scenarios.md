# Practical Visual Analysis Scenarios

## Common Tasks & How to Handle Them

### Scenario 1: Verify Dashboard Deployment

**User Request**: "Cek apakah dashboard sudah muncul dengan benar"

**Approach**:
```javascript
// 1. Navigate to the URL
await browser_navigate("https://example.com/dashboard")

// 2. Get visual confirmation
const result = await browser_get_state(include_screenshot: true)

// 3. Extract content for analysis
const content = await browser_get_content()

// 4. Report findings
```

**What to Check**:
- Header with logo and navigation
- Sidebar with menu items
- Main content area populated
- Stats cards displaying data
- Footer with copyright

**Report Template**:
```markdown
## Dashboard Verification Report

**URL**: https://example.com/dashboard
**Status**: ✅ DEPLOYED / ❌ NOT LOADING / ⚠️ PARTIAL

### Visual Elements Found
- [x] Header with logo
- [x] Navigation menu
- [x] Stats cards
- [x] Content area
- [ ] Footer (not visible - may need scroll)

### Color Scheme Detected
- Primary: Teal gradient (#0d7377 to #14919b)
- Accent: Gold (#FFD700)
- Background: Dark (#0F0F23)

### Issues
None / List issues here

### Overall Assessment
Dashboard appears correctly deployed and styled.
```

---

### Scenario 2: Check Button/Styling

**User Request**: "Apakah tombol Kasir sudah muncul?"

**Approach**:
```javascript
await browser_navigate("https://example.com")
const state = await browser_get_state()

// Look for button in elements list
// Elements are numbered for interaction
```

**What Buttons Should Look Like**:
- Purple gradient background for "Kasir"
- Green gradient background for "CEO Report"
- Gold gradient for "Submit"

**Visual Description Template**:
```markdown
### Button Analysis

| Button | Position | Color | Text | Visible |
|--------|----------|-------|------|---------|
| 💰 Kasir | Header area, right side | Purple gradient | 💰 Kasir | ✅ Yes |
| 👑 CEO Report | Next to Kasir | Green gradient | 👑 CEO Report | ✅ Yes |
| 🔄 Refresh | Right side | Gold gradient | 🔄 Refresh | ✅ Yes |

**Styling Assessment**:
- All buttons have proper gradient styling
- Hover effects visible (lift/shadow)
- Text clearly readable
- Consistent border radius (10px)
```

---

### Scenario 3: Modal/Popup Verification

**User Request**: "Cek apakah modal CEO Report muncul"

**Approach**:
```javascript
// Click the button to open modal
await browser_navigate("https://example.com")
const state = await browser_get_state()

// Find index of CEO Report button (let's say it's 5)
await browser_click(index: 5)

// Wait and get state of modal
const modalState = await browser_get_state(include_screenshot: true)
```

**Modal Analysis Template**:
```markdown
### CEO Report Modal Analysis

**Trigger**: Click "👑 CEO Report" button

**Modal Appearance**:
- Background overlay: Semi-transparent black
- Modal box: Dark card (#1A1A2E) with gold border
- Close button: Top-right (×)
- Width: ~700px max

**Content Sections**:
1. Summary stats (2x2 grid)
   - 💰 Total Revenue
   - ✅ Aktif count
   - ⚡ Ready count
   - ⏳ Pending count

2. Company list (scrollable)
   - Each company with status badge
   - Revenue amount
   - Progress indicator

3. Progress bar (overall)
   - Gold gradient fill
   - Percentage text

**Assessment**: ✅ Modal displays correctly with all sections
```

---

### Scenario 4: Color Accuracy Check

**User Request**: "Apakah warna emas (#FFD700) sudah digunakan?"

**Approach**:
```javascript
await browser_navigate("https://example.com")
const screenshot = await browser_get_state(include_screenshot: true)
// Analyze colors in screenshot
```

**Color Analysis Template**:
```markdown
### Color Verification

**Expected**: Gold accent color (#FFD700 / RGB(255,215,0))

**Found in**:
| Element | Approx Color | Match |
|---------|-------------|-------|
| Header border | Gold-ish | ✅ Yes |
| Button primary | Gold gradient | ✅ Yes |
| Text accent | Bright gold | ✅ Yes |
| Progress bars | Dark to gold | ✅ Yes |

**Assessment**: ✅ Gold (#FFD700) consistently applied
```

---

### Scenario 5: Responsive/Mobile Check

**User Request**: "Cek tampilan di mobile"

**Note**: Browser tools may not support viewport changes. Report limitations:
```markdown
### Mobile Responsiveness

**Note**: Cannot change viewport size in current environment.

**Recommendation**: Manually test at:
- iPhone SE (375px)
- iPhone 12/13/14 (390px)
- Android various sizes

**What to Check When Testing**:
- [ ] Hamburger menu replaces horizontal nav
- [ ] Cards stack vertically
- [ ] Images resize appropriately
- [ ] Text remains readable
- [ ] Buttons remain tappable (min 44px)
```

---

### Scenario 6: Compare Before/After

**User Request**: "Bandingkan tampilan sebelum dan sesudah update"

**Approach**:
```javascript
// Before (if available in screenshots)
// After
await browser_navigate("https://example.com")
const after = await browser_get_state(include_screenshot: true)
```

**Comparison Template**:
```markdown
## Before/After Comparison

### Layout Changes
| Element | Before | After | Status |
|---------|--------|-------|--------|
| Header | Simple | With stats | ✅ Changed |
| Buttons | 1 button | 3 buttons | ✅ Added |
| Sidebar | Hidden | Visible | ✅ Added |

### Color Changes
| Element | Before | After | Notes |
|---------|--------|-------|-------|
| Primary | Blue | Teal | ✅ Brand update |
| Accent | Orange | Gold | ✅ More elegant |

### New Features Added
- [x] CEO Report modal
- [x] Refresh button
- [x] Live status indicators

**Assessment**: ✅ Changes successfully deployed
```

---

### Scenario 7: Error/Issue Documentation

**User Request**: "Ada masalah dengan tampilan, tolong cek"

**Approach**:
```javascript
await browser_navigate("https://problem-url.com")
const state = await browser_get_state(include_screenshot: true)
const content = await browser_get_content()
```

**Issue Report Template**:
```markdown
## Issue Documentation

**URL**: [problem URL]
**Date**: [timestamp]
**Issue Type**: [UI/Functional/Both]

### Problem Description
[User's reported issue]

### Visual Evidence
[Screenshot captured]

### Analysis
| Check | Result |
|-------|--------|
| Page loads | ✅/❌ |
| Elements present | ✅/❌ |
| Styling applied | ✅/❌ |
| JavaScript working | ✅/❌ |

### Root Cause
[Analysis of why issue occurred]

### Recommendation
[How to fix]
```

---

### Scenario 8: Full Page Audit

**User Request**: "Lakukan audit visual lengkap"

**Approach**:
```javascript
await browser_navigate("https://example.com")

// Get initial view
const above = await browser_get_state(include_screenshot: true)

// Scroll through page
await browser_scroll(direction: "down")
const middle = await browser_get_state(include_screenshot: true)

await browser_scroll(direction: "down")
const below = await browser_get_state(include_screenshot: true)
```

**Full Audit Template**:
```markdown
## Visual Audit Report: [Page Name]

**URL**: [URL]
**Date**: [Date]
**Auditor**: AI Visual Analysis

### 1. Above the Fold
- Header with navigation
- Hero section or main widget
- Primary CTA visible

### 2. Middle Section
- Secondary content
- Feature cards
- Supporting information

### 3. Below the Fold
- Footer
- Additional links
- Copyright info

### 4. Component Inventory
| Component | Count | Condition |
|-----------|-------|-----------|
| Buttons | 5 | ✅ All styled |
| Forms | 1 | ✅ Functional |
| Cards | 8 | ✅ Aligned |
| Tables | 2 | ✅ Scrollable |
| Images | 12 | ⚠️ 1 broken |

### 5. Design System Compliance
| Element | Standard | Found | Status |
|---------|----------|-------|--------|
| Primary color | #0d7377 | #0d7377 | ✅ |
| Border radius | 12px | 12px | ✅ |
| Spacing | 8px grid | 8px | ✅ |

### 6. Accessibility
| Check | Status |
|-------|--------|
| Alt text on images | ⚠️ Missing 2 |
| Color contrast | ✅ Pass |
| Keyboard navigation | ⚠️ Not tested |

### 7. Issues Summary
**Critical**: 0
**Major**: 1 (1 broken image)
**Minor**: 2 (missing alt text)

### Overall Score: 8/10

**Recommendation**: Good visual implementation with minor accessibility improvements needed.
```

---

## Quick Reference: Report Phrases

### When Everything is Good ✅
```
- "Tampilan sesuai dengan yang diharapkan"
- "Semua elemen sudah muncul dengan benar"
- "Styling sudah konsisten"
- "Dashboard berhasil di-deploy"
```

### When There Are Issues ❌
```
- "Ada masalah dengan [elemen]"
- "[Elemen] tidak muncul/tidak styled"
- "Warna tidak sesuai spesifikasi"
- "Layout berantakan di bagian [area]"
```

### When Blocked ⛔
```
- "Halaman diblokir oleh Cloudflare"
- "Tidak bisa akses karena proteksi keamanan"
- "Saran: Cek langsung dari browser Anda"
```

### When Uncertain 🤔
```
- "Warna tampak seperti [deskripsi], tapi tidak bisa tentukan hex exact"
- "Sepertinya ada [issue], tapi perlu konfirmasi lebih lanjut"
- "Tidak dapat memverifikasi [fitur] tanpa interaksi langsung"
```
