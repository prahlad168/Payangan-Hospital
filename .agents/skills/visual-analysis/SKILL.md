---
name: visual-analysis
description: This skill should be used when the user asks to "lihat gambar", "analisis screenshot", "cek tampilan", "lihat halaman web", "deskripsikan gambar", "lihat UI", "check image", "describe this", "apa yang terlihat", or any request to visually analyze or examine images, screenshots, or web pages. Activate when user wants visual verification, UI inspection, dashboard review, or image description.
---

# Visual Analysis Skill

## Purpose

Enable accurate visual analysis of web pages, screenshots, and images to verify layouts, diagnose UI issues, and provide detailed descriptions of what appears on screen.

## Available Tools for Visual Analysis

### 1. Browser Tools (Primary Method)

```javascript
// Navigate to URL and get state
browser_navigate(url: string)
browser_get_state(include_screenshot?: boolean)  // Returns numbered interactive elements
browser_get_content()  // Extracts main content as markdown
browser_get_content(include_screenshot: true)  // With screenshot included
```

### 2. Image Extraction from Screenshots

```javascript
// Get screenshot from browser state
browser_get_state(include_screenshot: true)
// Returns base64 encoded image in output
```

### 3. File System (For Local Images)

```bash
# View images in repository
file_editor(command: "view", path: "/path/to/image.png")
# Or use terminal to describe
cat /path/to/image.png | file -  # Get image metadata
```

## Visual Analysis Workflow

### Step 1: Determine Image Source

- **URL/Screenshot**: Use `browser_navigate()` then `browser_get_state(include_screenshot: true)`
- **Local File**: Use `file_editor()` to view
- **Web Page**: Navigate then analyze structure with `browser_get_content()`

### Step 2: Extract Visual Information

```javascript
// For web pages - get full content with structure
await browser_navigate("https://example.com")
const state = await browser_get_state(include_screenshot: true)

// Get clean text content
const content = await browser_get_content()

// Get interactive elements (numbered for clicking)
const interactive = await browser_get_state()
```

### Step 3: Analyze and Describe

When describing visual content:

1. **Overall Layout**: Header, sidebar, main content, footer
2. **Color Scheme**: Primary colors, contrast, theme
3. **Typography**: Font sizes, styles, hierarchy
4. **Components**: Buttons, forms, cards, navigation
5. **Spacing**: Margins, padding, whitespace
6. **Issues**: Missing elements, misaligned items, broken layouts

## Common Use Cases

### Dashboard Verification

```javascript
// Check if elements are present and correctly styled
await browser_navigate("https://dashboard.example.com")
const state = await browser_get_state()

// Verify key elements exist
if (state.includes("Company Status")) {
    // Check if status badges show correct colors
}
// Report findings
```

### UI Bug Diagnosis

```javascript
// Navigate to problem page
await browser_navigate("https://site.com/problem-page")

// Get detailed state
const fullState = await browser_get_state(include_screenshot: true)

// Analyze specific elements
const content = await browser_get_content()

// Report: "Found button overlapping with text in section X"
```

### Screenshot Analysis

```javascript
// Get screenshot for detailed analysis
await browser_navigate("https://page.to.analyze")
const screenshot = await browser_get_state(include_screenshot: true)

// The screenshot appears in the output for visual inspection
// Analyze: layout, colors, typography, components, issues
```

## Prompt Engineering for Image Analysis

When asking AI to analyze images:

### Good Prompts

```
"Analyze this screenshot and describe:
1. Overall layout and structure
2. Color scheme and design theme
3. Key UI components visible
4. Any obvious issues or missing elements
5. How it compares to common design patterns"
```

```
"Check this dashboard and verify:
- Sidebar navigation present?
- Header with user menu?
- Main content area loading?
- Any error messages or broken images?"
```

### For Detailed Inspection

```
"Zoom in on the header area. What colors are used?
Is the logo visible? Is the navigation menu present?
Are there any hover effects visible on buttons?"
```

## Best Practices

### 1. Use `browser_get_state()` First

Always get element list before clicking:
```javascript
await browser_navigate(url)
const state = await browser_get_state()  // Get numbered elements first
// Then use indices from state for browser_click(index)
```

### 2. Include Screenshot for Verification

```javascript
const result = await browser_get_state(include_screenshot: true)
// Screenshot appears in output for visual confirmation
```

### 3. Combine Methods

```javascript
// Get both structure and screenshot
await browser_navigate(url)
const structure = await browser_get_content()  // Text/markdown
const elements = await browser_get_state()     // Interactive elements
const screenshot = await browser_get_state(include_screenshot: true)  // Visual
```

### 4. Handle Blocked Pages

If Cloudflare or similar blocks access:
- Try alternative URLs
- Report to user that page is blocked
- Suggest checking from user's local browser

## Output Format for Visual Reports

```markdown
## Visual Analysis Report

**URL/Source:** [where image was captured]

### Layout Structure
- [Describe main sections]

### Color Scheme
- Primary: [colors]
- Secondary: [colors]
- Accent: [colors]

### Key Components
1. [Component 1] - [description]
2. [Component 2] - [description]

### Typography
- Headings: [font info]
- Body: [font info]

### Issues Found
- [Issue 1]
- [Issue 2]

### Assessment
[Overall evaluation]
```

## Troubleshooting

### Page Blocked by Cloudflare
```
Cannot access page due to Cloudflare protection.
Recommendation: Check from local browser or whitelist the IP.
```

### Screenshot Not Clear
```
Request new screenshot with include_screenshot: true
Or use browser_scroll() to reveal hidden elements
```

### Missing Elements
```
Use browser_get_content() to see text content
Use browser_get_state() to see interactive elements
Compare against expected structure
```

## Integration with Other Skills

This skill works with:
- **Frontend Design**: Verify designs match code
- **QA Testing**: Visual regression checks
- **Bug Reports**: Screenshot evidence
- **Documentation**: Capture UI states

## Quick Reference Commands

```javascript
// Full page capture
browser_navigate(url) → browser_get_state(include_screenshot: true)

// Content extraction
browser_navigate(url) → browser_get_content()

// Interactive element analysis
browser_navigate(url) → browser_get_state()

// Detailed element inspection
browser_navigate(url) → browser_scroll(direction) → browser_get_state()
```
