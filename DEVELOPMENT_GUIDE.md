# DEVELOPMENT GUIDE

Payangan Hospital Website — Development Standards & Conventions

---

## Coding Conventions

### General Principles

1. **Semantic HTML** — Use appropriate HTML5 elements (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`)
2. **Indonesian language** — All content (text, comments, commit messages) in Indonesian unless technical terms require English
3. **No framework dependencies** — Vanilla HTML, CSS, and JavaScript only
4. **Progressive enhancement** — Core content always accessible; enhancements layer on top
5. **Mobile-first** — Design and test for mobile first, then desktop

---

## HTML Standards

### Document Structure

Every HTML page must include:

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="...">
    <meta name="keywords" content="...">
    <meta name="robots" content="index, follow">
    <title>Page Title — Payangan Hospital</title>
    <link rel="icon" type="image/png" href="img/logo-official.png">
    <!-- External CSS -->
    <!-- External Fonts -->
    <!-- Schema.org structured data (homepage only) -->
</head>
<body>
    <nav>...</nav>
    <main>...</main>
    <footer>...</footer>
    <!-- External JS -->
    <!-- Inline script (page-specific) -->
</body>
</html>
```

### Semantic HTML Rules

| Element | Usage |
|---------|-------|
| `<header>` | Page or section header |
| `<nav>` | Navigation areas |
| `<main>` | Primary content (one per page) |
| `<section>` | Thematic content grouping |
| `<article>` | Self-contained content (blog, news) |
| `<aside>` | Sidebar or related content |
| `<footer>` | Page or section footer |
| `<h1>` | One per page, main page title |
| `<h2>`–`<h6>` | Section headings in descending order |

### Required Attributes

- All `<img>` elements must have `alt` attributes
- All `<a>` elements must have meaningful text (no "click here")
- All form inputs must have associated `<label>` elements with `for` attributes
- All interactive elements must be keyboard accessible

### Anti-Patterns to Avoid

- Do not use `style` attributes for presentation (use CSS classes)
- Do not use `<div>` or `<span>` semantically (use proper elements)
- Do not use `inline onclick` handlers (use event listeners in JS)
- Do not use `document.write()`
- Do not use `alert()` for user interaction (use non-blocking UI patterns)

---

## CSS Standards

### Naming Conventions

| Type | Convention | Example |
|------|-----------|---------|
| **Classes** | kebab-case | `.doctor-card`, `.hero-title` |
| **IDs** | kebab-case | `#mobile-menu`, `#header` |
| **CSS Variables** | kebab-case with `--` prefix | `--primary`, `--bg-white` |
| **BEM modifiers** | Block `__` Element `--` Modifier | `.card__title`, `.btn--primary` |

### CSS Organization

Files should be organized in the following order:

1. **CSS Custom Properties** (`:root` variables)
2. **Reset/Base** (normalize, box-sizing, typography defaults)
3. **Layout** (container, grid, flex utilities)
4. **Components** (cards, buttons, nav, modals)
5. **Sections** (hero, features, contact, footer)
6. **Utilities** (text, spacing, display helpers)
7. **Media Queries** (responsive breakpoints)
8. **Animations** (keyframes, transitions)

### CSS Custom Properties

Use the design tokens from `css/design-system.css`:

```css
/* ✅ Use design tokens */
color: var(--primary);
background: var(--bg-light);
font-size: var(--text-lg);
padding: var(--space-6);
border-radius: var(--radius-xl);

/* ❌ Do not hardcode values */
color: #0891b2;  /* use var(--primary) instead */
```

### Responsive Design

- Use `@media (max-width: ...)` for mobile-first breakpoints
- Breakpoints: 480px, 768px, 992px, 1024px, 1200px
- Use `clamp()`, `min()`, `max()` for fluid typography and spacing
- Test on actual devices where possible

### Anti-Patterns

- Do not duplicate CSS variables across files — use `design-system.css` as single source of truth
- Do not use `!important` except in exceptional cases (add comment explaining why)
- Do not use vendor prefixes unless absolutely necessary (autoprefixer handles this in build)
- Do not write inline `<style>` blocks in HTML files — move to external CSS

---

## JavaScript Standards

### General Rules

- **No frameworks** — vanilla JavaScript only
- **IIFE pattern** — wrap code in `(function() { ... })()` to avoid global scope pollution
- **`'use strict'`** — always declare strict mode
- **ES5+ compatible** — no ES6+ features that break older browsers (no arrow functions in critical paths, no template literals where interpolation isn't needed for compatibility)
- **No `alert()`** — use custom UI for notifications
- **No `document.write()`** — use DOM manipulation methods

### Naming Conventions

| Type | Convention | Example |
|------|-----------|---------|
| **Variables** | camelCase | `doctorList`, `userRole` |
| **Functions** | camelCase | `initScrollAnimations()`, `findResponse()` |
| **Constants** | UPPER_SNAKE_CASE | `MAHACARE_CONFIG`, `KNOWLEDGE_BASE` |
| **CSS classes** | kebab-case | `doctor-card`, `hero-title` |
| **Event names** | kebab-case | `click`, `scroll`, `DOMContentLoaded` |
| **DOM IDs** | kebab-case | `mobile-menu`, `back-to-top` |

### Code Structure

```javascript
(function() {
    'use strict';

    // === Constants / Config ===
    const CONFIG = { ... };

    // === Data ===
    const KNOWLEDGE_BASE = { ... };

    // === Class Definition ===
    class MyWidget {
        constructor() { ... }
        init() { ... }
        handleEvent() { ... }
    }

    // === Helper Functions ===
    function formatDate(date) { ... }
    function validateInput(input) { ... }

    // === Initialization ===
    function init() { ... }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
```

### Event Handling

- Use `addEventListener()` instead of inline `onclick`/`onchange`/etc.
- Use event delegation where possible (parent element handles events for children)
- Use `{ passive: true }` for scroll/event listeners that don't call `preventDefault()`
- Clean up event listeners when components are destroyed

### DOM Manipulation

- Prefer `textContent` over `innerHTML` when inserting plain text (prevents XSS)
- When using `innerHTML`, sanitize all user-generated content with `textContent` or `escapeHtml()`
- Cache DOM references in variables instead of re-querying
- Use `document.createElement()` for dynamic elements instead of string concatenation

### Code Quality

- All functions must have JSDoc-style comments
- Complex logic must be refactored into smaller functions
- Magic numbers must be named constants
- Error handling with try/catch around DOM operations
- Console logging should be removed or wrapped in a debug flag

---

## PHP Standards

### General Rules

- PHP 7.4+ compatible
- PSR-1 and PSR-12 coding style
- 4 spaces for indentation (no tabs)
- Closing `?>` tag omitted when file contains only PHP
- `htmlspecialchars()` for all user output to prevent XSS
- `session_start()` at the top of every PHP file using sessions

### File Structure

```
<?php
/**
 * File description — RS Payangan Hospital
 *
 * @package    RS Payangan
 * @subpackage Submodule
 * @author     Nama Pengembang
 * @version    1.0.0
 * @since      2026-07-30
 */

// Security checks
// ...

// Constants
// ...

// Functions
// ...

// Main logic
```

### Naming Conventions

| Type | Convention | Example |
|------|-----------|---------|
| **Variables** | camelCase | `$userName`, `$currentRole` |
| **Functions** | camelCase | `isLoggedIn()`, `getRoleDisplay()` |
| **Constants** | UPPER_SNAKE_CASE | `REPORT_DIR`, `ADMIN_EMAIL` |
| **Class methods** | camelCase | `getChatLogs()`, `saveChatLog()` |
| **File names** | kebab-case | `auth.php`, `daily-report.php` |
| **Database tables** | lowercase plural | `users`, `doctors`, `patients` |

### Security Rules

1. Always validate/sanitize input: `trim()`, `htmlspecialchars()`, `filter_var()`
2. Always use prepared statements when connecting to MySQL
3. Always hash passwords with `password_hash()` — never store plaintext
4. Always check `$_SERVER['REQUEST_METHOD']` before processing form data
5. Always set `session_regenerate_id(true)` after successful login
6. Always set `Content-Type` header for API endpoints
7. Never expose error details to end users (log to file, show generic message)
8. Never use `eval()`, `exec()`, `shell_exec()` with user input (webhook is a notable exception with `git pull`)

### Session Management

```php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,      // HTTPS only
    'httponly' => true,    // No JavaScript access
    'samesite' => 'Lax'   // CSRF protection
]);
session_start();
```

---

## Naming Conventions

### Files

| Type | Convention | Example |
|------|-----------|---------|
| **HTML pages** | kebab-case | `kontak.html`, `rawat-inap.html` |
| **CSS files** | kebab-case | `design-system.css`, `brand.css` |
| **JS files** | kebab-case | `premium-ui.js`, `mahacare-ai.js` |
| **PHP files** | kebab-case | `login.php`, `daily-report.php` |
| **Image files** | descriptive, lowercase | `dr-angung-desy-spjp.png` |

### CSS Classes

| Pattern | Convention | Example |
|---------|-----------|---------|
| **Components** | Block | `.card`, `.btn`, `.nav` |
| **Component parts** | Block `__` Element | `.card__title`, `.btn__icon` |
| **Modifiers** | Block `__` Element `--` Modifier | `.btn--primary`, `.card--featured` |
| **Utilities** | `u-` prefix | `.u-text-center`, `.u-hidden` |
| **States** | `.is-` or `.has-` prefix | `.is-active`, `.has-error` |

### HTML IDs

- kebab-case
- Semantic and descriptive
- Unique per page
- Examples: `#header`, `#mobileMenu`, `#doctorsSlider`, `#backToTop`

### Git Branches

| Type | Prefix | Example |
|------|--------|---------|
| **Feature** | `feat/` | `feat/add-contact-page` |
| **Bug fix** | `fix/` | `fix/contact-page-404` |
| **Docs** | `docs/` | `docs/update-readme` |
| **Refactor** | `refactor/` | `refactor/cleanup-css` |
| **Hotfix** | `hotfix/` | `hotfix/fix-deploy-script` |
| **Release** | `release/` | `release/v0.2.0` |

---

## Git Commit Standards

### Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

### Types

| Type | Description | Example |
|------|-------------|---------|
| `feat` | New feature | `feat(homepage): tambah section doctor slider` |
| `fix` | Bug fix | `fix(contact): perbaiki tautanWhatsApp` |
| `docs` | Documentation | `docs(readme): tambah deskripsi proyek` |
| `style` | CSS/formatting only | `style(brand): perbarui warna primary` |
| `refactor` | Code refactoring | `refactor(css): konsolidasi design tokens` |
| `test` | Testing changes | `test(chat): tambah validasi input` |
| `chore` | Maintenance | `chore(deploy): update webhook script` |

### Subject Line Rules

- Max 72 characters
- Start with a verb (tambah, perbaiki, hapus, update, dll.)
- Use Indonesian for scope and subject
- Do not end with period

### Commit Examples

```
feat(dokter): tambah halaman detail dokter dengan jadwal praktik
fix(kontak): perbaiki tautan WhatsApp yang rusak
style(css): konsolidasi CSS variabel ke design-system.css
refactor(html): hapus inline style duplikat dari halaman kontak
chore(deploy): perbarui webhook.php dengan secret verification
```

---

## Pull Request Standards

### Before Opening a PR

- [ ] Code follows all coding standards in this guide
- [ ] All pages tested in browser (Chrome, Firefox, mobile)
- [ ] Responsive design checked on 320px, 768px, 1024px, 1440px
- [ ] No broken links introduced
- [ ] No console errors
- [ ] Images optimized (WebP where possible, compressed)
- [ ] SEO meta tags added for new pages
- [ ] Schema.org markup added for new content pages
- [ ] All changes committed with conventional commits

### PR Template

```markdown
## Description
Brief description of the changes.

## Checklist
- [ ] Code follows coding standards
- [ ] Tested in browser
- [ ] Responsive design verified
- [ ] No broken links
- [ ] SEO meta tags updated

## Screenshots
(If applicable)

## Link
Closes #XXX
```

### Review Checklist

- [ ] HTML valid (no unclosed tags, proper nesting)
- [ ] CSS follows design system conventions
- [ ] JavaScript has no global leakage, uses IIFE pattern
- [ ] PHP uses prepared statements, sanitizes all inputs
- [ ] No hardcoded credentials or secrets
- [ ] Accessibility: alt texts on images, semantic HTML, ARIA attributes
- [ ] SEO: meta description, canonical URL, Open Graph on new pages
- [ ] Performance: images optimized, no unnecessary font loads, no render-blocking resources
- [ ] Mobile: all interactive elements usable on touch devices
- [ ] Documentation updated if needed

---

## Review Process

1. Developer creates PR against `main` branch
2. At least one reviewer must approve
3. CI checks pass (link checker, QA checker, content validator)
4. PR merged with squash commit
5. Auto-deploy triggered by webhook
6. Verify deployment on staging/production
