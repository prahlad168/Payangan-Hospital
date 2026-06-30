# Web Builder Skill - Modern Frontend Development

## Overview
This skill provides comprehensive guidance for building modern, beautiful websites using current best practices in frontend development.

---

## 🚀 Quick Start

### Modern Stack Recommendation
```
HTML5 + Tailwind CSS + Vanilla JS
```

### Why Tailwind?
- No build step required
- Utility-first = fast development
- JIT compilation = small CSS
- Responsive by default

---

## 🎨 Design Principles

### 1. Color Theory
- Primary: Use teal/cyan for medical/health sites (#0d7377)
- Accent: Gold/amber for CTAs (#f4c430)
- Background: Light grays (#f8f9fa)

### 2. Typography
- Headings: Playfair Display (elegant)
- Body: Inter or Montserrat (readable)
- Line-height: 1.6-1.7 for body text

### 3. Spacing
- Container max-width: 1200px-1280px
- Section padding: 80px-100px vertical
- Card padding: 24px-40px
- Gap: 24px-32px

### 4. Visual Effects
```css
/* Card shadow */
box-shadow: 0 10px 40px rgba(0,0,0,0.08);

/* Hover lift */
transform: translateY(-8px);
box-shadow: 0 20px 60px rgba(0,0,0,0.12);

/* Gradient */
background: linear-gradient(135deg, var(--primary) 0%, var(--light) 100%);
```

---

## 📦 Component Patterns

### Navigation
```html
<nav class="fixed top-0 w-full z-50 bg-white/95 backdrop-blur-md shadow-sm">
  <div class="max-w-7xl mx-auto px-6 py-4">
    <!-- Logo + Links -->
  </div>
</nav>
```

### Hero Section
```html
<section class="min-h-screen bg-gradient-to-br from-teal-900 to-teal-600">
  <div class="container mx-auto px-6 py-24">
    <h1 class="text-5xl font-display font-bold text-white mb-6">
      Main Headline
    </h1>
    <p class="text-xl text-white/90 max-w-2xl mb-8">
      Supporting text
    </p>
    <a href="#" class="inline-flex items-center gap-2 bg-amber-400 text-gray-900 px-8 py-4 rounded-full font-semibold hover:bg-amber-300 transition-all">
      CTA Button <i class="fas fa-arrow-right"></i>
    </a>
  </div>
</section>
```

### Card Component
```html
<div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
  <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
    <i class="fas fa-heart text-white text-2xl"></i>
  </div>
  <h3 class="text-xl font-semibold mb-3">Card Title</h3>
  <p class="text-gray-600">Card description text.</p>
</div>
```

### Grid Layout
```html
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
  <!-- Cards go here -->
</div>
```

### Footer
```html
<footer class="bg-gray-900 text-white py-16">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
      <!-- Footer columns -->
    </div>
    <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
      &copy; 2025 Company Name
    </div>
  </div>
</footer>
```

---

## 🎯 Animation Guidelines

### CSS Transitions
```css
/* Default */
transition: all 0.3s ease;

/* Smooth hover */
transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);

/* Staggered animation */
animation: fadeInUp 0.6s ease forwards;
animation-delay: calc(var(--i) * 100ms);
```

### Keyframe Examples
```css
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}
```

---

## 📱 Responsive Breakpoints

```css
/* Mobile first */
/* sm: 640px */
/* md: 768px */
/* lg: 1024px */
/* xl: 1280px */
/* 2xl: 1536px */

/* Usage with Tailwind */
/* <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4"> */
```

---

## 🔧 Useful Tailwind Classes

### Spacing
- `p-4`, `px-6`, `py-8`, `m-auto`, `mx-auto`
- `gap-4`, `space-y-6`

### Typography
- `text-sm`, `text-lg`, `text-xl`, `text-4xl`, `text-5xl`
- `font-light`, `font-medium`, `font-bold`, `font-extrabold`
- `leading-relaxed`, `tracking-wide`

### Colors
- `text-gray-600`, `text-white`, `text-teal-600`
- `bg-white`, `bg-gray-100`, `bg-teal-600`
- `border-gray-200`, `border-teal-500`

### Effects
- `rounded-lg`, `rounded-xl`, `rounded-full`
- `shadow-md`, `shadow-lg`, `shadow-xl`, `shadow-2xl`
- `blur-sm`, `blur-md`, `backdrop-blur-md`

---

## 🎨 Popular UI Patterns

### 1. Stats Counter
```html
<div class="flex justify-center gap-16">
  <div class="text-center">
    <div class="text-5xl font-bold text-amber-400">500+</div>
    <div class="text-gray-400 uppercase tracking-wider text-sm">Patients</div>
  </div>
</div>
```

### 2. Testimonial Card
```html
<div class="bg-gray-50 rounded-2xl p-8">
  <div class="flex items-center gap-4 mb-4">
    <div class="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold">JD</div>
    <div>
      <div class="font-semibold">John Doe</div>
      <div class="text-amber-400">★★★★★</div>
    </div>
  </div>
  <p class="text-gray-600 italic">"Testimonial text here..."</p>
</div>
```

### 3. Feature List
```html
<div class="space-y-4">
  <div class="flex items-start gap-4">
    <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
      <i class="fas fa-check text-white text-sm"></i>
    </div>
    <div>
      <h4 class="font-semibold">Feature Title</h4>
      <p class="text-gray-600 text-sm">Feature description.</p>
    </div>
  </div>
</div>
```

---

## 🌟 Premium Effects

### Glass Morphism
```css
.glass {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
}
```

### Gradient Text
```css
.gradient-text {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
```

### Floating Animation
```css
@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-20px); }
}
.floating {
  animation: float 3s ease-in-out infinite;
}
```

---

## 📚 Resources

### Free Icons
- Font Awesome 6: https://fontawesome.com
- Heroicons: https://heroicons.com
- Lucide: https://lucide.dev

### Fonts
- Google Fonts: https://fonts.google.com
- Inter, Poppins, Playfair Display, Montserrat

### Images
- Unsplash: https://unsplash.com (free photos)
- Pexels: https://pexels.com
- Hero patterns: https://heropatterns.com

### UI Inspiration
- Dribbble: https://dribbble.com
- Behance: https://behance.net
- Awwwards: https://awwwards.com

---

## ⚡ Quick Tips

1. **Mobile First**: Start with mobile, then add `md:`, `lg:` breakpoints
2. **Consistent Spacing**: Use 4px, 8px, 16px, 24px, 32px, 48px, 64px, 80px
3. **Shadows**: Use subtle shadows, increase on hover
4. **Border Radius**: Mix `rounded-lg` (8px) and `rounded-xl` (12px) with `rounded-2xl` (16px)
5. **Gradients**: Use 2-3 color stops, angle 135deg or 180deg
6. **Animations**: Keep it subtle, 200-400ms duration

---

## 🎯 When Building a Page

1. Define color palette in CSS variables
2. Set up base typography
3. Build layout grid
4. Create component library
5. Add animations last
6. Test responsive breakpoints
