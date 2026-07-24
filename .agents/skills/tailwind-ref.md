# Tailwind CSS Quick Reference

## 🚀 Quick Start CDN

```html
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>My Website</title>
</head>
<body>
  <!-- Your content here -->
</body>
</html>
```

---

## 📐 Layout

### Container
```html
<div class="container mx-auto px-4"></div>
<div class="max-w-7xl mx-auto px-4"></div>
```

### Flexbox
```html
<div class="flex"></div>
<div class="flex flex-row"></div>
<div class="flex flex-col"></div>
<div class="flex flex-wrap"></div>
<div class="flex items-center"></div>
<div class="flex items-start"></div>
<div class="flex items-end"></div>
<div class="flex justify-center"></div>
<div class="flex justify-between"></div>
<div class="flex justify-around"></div>
<div class="flex justify-evenly"></div>
<div class="flex gap-4"></div>
<div class="flex gap-x-4 gap-y-8"></div>
<div class="flex-1"></div>
<div class="flex-auto"></div>
<div class="flex-none"></div>
<div class="flex-grow"></div>
<div class="flex-shrink-0"></div>
<div class="flex basis-1/2"></div>
<div class="flex order-1"></div>
<div class="flex self-start"></div>
<div class="flex self-center"></div>
<div class="flex self-end"></div>
```

### Grid
```html
<div class="grid"></div>
<div class="grid grid-cols-1"></div>
<div class="grid grid-cols-2"></div>
<div class="grid grid-cols-3"></div>
<div class="grid grid-cols-4"></div>
<div class="grid grid-cols-6"></div>
<div class="grid grid-cols-12"></div>
<div class="grid grid-cols-[repeat(3,1fr)]"></div>
<div class="grid gap-4"></div>
<div class="grid gap-x-4 gap-y-8"></div>
<div class="grid row-span-2"></div>
<div class="grid col-span-2"></div>
<div class="grid auto-cols-min"></div>
<div class="grid auto-cols-max"></div>
<div class="grid auto-cols-fr"></div>
<div class="grid auto-rows-auto"></div>
<div class="grid auto-rows-fr"></div>
```

### Positioning
```html
<div class="static"></div>
<div class="relative"></div>
<div class="absolute"></div>
<div class="fixed"></div>
<div class="sticky"></div>
<div class="inset-0"></div>
<div class="inset-x-0"></div>
<div class="inset-y-0"></div>
<div class="top-0"></div>
<div class="right-0"></div>
<div class="bottom-0"></div>
<div class="left-0"></div>
<div class="top-1/2"></div>
<div class="left-1/2"></div>
<div class="-top-2"></div>
<div class="z-0"></div>
<div class="z-10"></div>
<div class="z-50"></div>
```

---

## 📏 Spacing

### Padding
```html
<div class="p-0"></div>
<div class="p-1"></div>
<div class="p-2"></div>
<div class="p-4"></div>
<div class="p-6"></div>
<div class="p-8"></div>
<div class="p-12"></div>
<div class="p-16"></div>
<div class="p-px"></div>
<div class="p-0.5"></div>
<div class="py-4 px-8"></div>
<div class="pt-4 pr-8 pb-8 pl-4"></div>
<div class="px-4"></div>
<div class="py-4"></div>
```

### Margin
```html
<div class="m-0"></div>
<div class="m-auto"></div>
<div class="mx-auto"></div>
<div class="my-4"></div>
<div class="mt-4"></div>
<div class="mb-8"></div>
<div class="ml-2"></div>
<div class="mr-4"></div>
<div class="-mt-4"></div>
<div class="-ml-4"></div>
<div class="space-y-4"></div>
<div class="space-x-4"></div>
<div class="space-x-reverse"></div>
```

### Width & Height
```html
<div class="w-1"></div>
<div class="w-2"></div>
<div class="w-4"></div>
<div class="w-8"></div>
<div class="w-16"></div>
<div class="w-32"></div>
<div class="w-1/2"></div>
<div class="w-1/3"></div>
<div class="w-2/3"></div>
<div class="w-1/4"></div>
<div class="w-3/4"></div>
<div class="w-full"></div>
<div class="w-screen"></div>
<div class="w-min"></div>
<div class="w-max"></div>
<div class="w-fit"></div>
<div class="w-auto"></div>
<div class="w-px"></div>
<div class="min-w-0"></div>
<div class="min-w-full"></div>
<div class="min-w-min"></div>
<div class="min-w-max"></div>
<div class="max-w-none"></div>
<div class="max-w-xs"></div>
<div class="max-w-sm"></div>
<div class="max-w-md"></div>
<div class="max-w-lg"></div>
<div class="max-w-xl"></div>
<div class="max-w-2xl"></div>
<div class="max-w-3xl"></div>
<div class="max-w-4xl"></div>
<div class="max-w-5xl"></div>
<div class="max-w-6xl"></div>
<div class="max-w-7xl"></div>
<div class="max-w-full"></div>
<div class="max-w-screen-sm"></div>
<div class="max-w-screen-md"></div>
<div class="max-w-screen-lg"></div>
<div class="max-w-screen-xl"></div>
<div class="max-w-screen-2xl"></div>

<div class="h-1"></div>
<div class="h-4"></div>
<div class="h-8"></div>
<div class="h-16"></div>
<div class="h-32"></div>
<div class="h-1/2"></div>
<div class="h-1/3"></div>
<div class="h-2/3"></div>
<div class="h-full"></div>
<div class="h-screen"></div>
<div class="h-auto"></div>
<div class="h-px"></div>
<div class="min-h-0"></div>
<div class="min-h-full"></div>
<div class="min-h-screen"></div>
<div class="max-h-full"></div>
<div class="max-h-screen"></div>
```

---

## 🎨 Colors

### Text Color
```html
<p class="text-black"></p>
<p class="text-white"></p>
<p class="text-gray-50"></p>
<p class="text-gray-100"></p>
<p class="text-gray-200"></p>
<p class="text-gray-300"></p>
<p class="text-gray-400"></p>
<p class="text-gray-500"></p>
<p class="text-gray-600"></p>
<p class="text-gray-700"></p>
<p class="text-gray-800"></p>
<p class="text-gray-900"></p>
<p class="text-red-500"></p>
<p class="text-orange-500"></p>
<p class="text-amber-500"></p>
<p class="text-yellow-500"></p>
<p class="text-lime-500"></p>
<p class="text-green-500"></p>
<p class="text-emerald-500"></p>
<p class="text-teal-500"></p>
<p class="text-cyan-500"></p>
<p class="text-sky-500"></p>
<p class="text-blue-500"></p>
<p class="text-indigo-500"></p>
<p class="text-violet-500"></p>
<p class="text-purple-500"></p>
<p class="text-fuchsia-500"></p>
<p class="text-pink-500"></p>
<p class="text-rose-500"></p>
```

### Background Color
```html
<div class="bg-black"></div>
<div class="bg-white"></div>
<div class="bg-gray-100"></div>
<div class="bg-gray-500"></div>
<div class="bg-gray-900"></div>
<div class="bg-red-500"></div>
<div class="bg-teal-500"></div>
<div class="bg-teal-600"></div>
<div class="bg-teal-700"></div>
<div class="bg-amber-400"></div>
<div class="bg-transparent"></div>
<div class="bg-current"></div>
<div class="bg-slate-50"></div>
<div class="bg-zinc-50"></div>
<div class="bg-neutral-50"></div>
<div class="bg-stone-50"></div>
<div class="bg-orange-50"></div>
<div class="bg-lime-50"></div>
<div class="bg-emerald-50"></div>
<div class="bg-cyan-50"></div>
<div class="bg-sky-50"></div>
<div class="bg-blue-50"></div>
<div class="bg-indigo-50"></div>
<div class="bg-violet-50"></div>
```

---

## ✏️ Typography

### Font Size
```html
<p class="text-xs"></p>
<p class="text-sm"></p>
<p class="text-base"></p>
<p class="text-lg"></p>
<p class="text-xl"></p>
<p class="text-2xl"></p>
<p class="text-3xl"></p>
<p class="text-4xl"></p>
<p class="text-5xl"></p>
<p class="text-6xl"></p>
<p class="text-7xl"></p>
<p class="text-8xl"></p>
<p class="text-9xl"></p>
```

### Font Weight
```html
<p class="font-thin"></p>
<p class="font-extralight"></p>
<p class="font-light"></p>
<p class="font-normal"></p>
<p class="font-medium"></p>
<p class="font-semibold"></p>
<p class="font-bold"></p>
<p class="font-extrabold"></p>
<p class="font-black"></p>
```

### Font Family
```html
<p class="font-sans"></p>
<p class="font-serif"></p>
<p class="font-mono"></p>
```

### Text Alignment
```html
<p class="text-left"></p>
<p class="text-center"></p>
<p class="text-right"></p>
<p class="text-justify"></p>
<p class="text-start"></p>
<p class="text-end"></p>
```

### Text Decoration
```html
<p class="underline"></p>
<p class="overline"></p>
<p class="line-through"></p>
<p class="no-underline"></p>
<p class="decoration-auto"></p>
<p class="decoration-solid"></p>
<p class="decoration-double"></p>
<p class="decoration-dotted"></p>
<p class="decoration-dashed"></p>
<p class="decoration-wavy"></p>
<p class="decoration-1"></p>
<p class="decoration-2"></p>
<p class="decoration-4"></p>
<p class="underline-offset-auto"></p>
<p class="underline-offset-4"></p>
```

### Line Height
```html
<p class="leading-none"></p>
<p class="leading-tight"></p>
<p class="leading-snug"></p>
<p class="leading-normal"></p>
<p class="leading-relaxed"></p>
<p class="leading-loose"></p>
<p class="leading-3"></p>
<p class="leading-4"></p>
<p class="leading-10"></p>
```

### Letter Spacing
```html
<p class="tracking-tighter"></p>
<p class="tracking-tight"></p>
<p class="tracking-normal"></p>
<p class="tracking-wide"></p>
<p class="tracking-wider"></p>
<p class="tracking-widest"></p>
```

### Text Transform
```html
<p class="uppercase"></p>
<p class="lowercase"></p>
<p class="capitalize"></p>
<p class="normal-case"></p>
```

### Text Overflow
```html
<p class="truncate"></p>
<p class="text-ellipsis"></p>
<p class="text-clip"></p>
<p class="overflow-ellipsis"></p>
<p class="overflow-clip"></p>
```

---

## 🖼️ Borders

### Border Width
```html
<div class="border"></div>
<div class="border-0"></div>
<div class="border-2"></div>
<div class="border-4"></div>
<div class="border-8"></div>
<div class="border-t"></div>
<div class="border-r"></div>
<div class="border-b"></div>
<div class="border-l"></div>
```

### Border Color
```html
<div class="border-black"></div>
<div class="border-white"></div>
<div class="border-gray-200"></div>
<div class="border-gray-300"></div>
<div class="border-gray-400"></div>
<div class="border-teal-500"></div>
<div class="border-transparent"></div>
<div class="border-current"></div>
```

### Border Radius
```html
<div class="rounded"></div>
<div class="rounded-none"></div>
<div class="rounded-sm"></div>
<div class="rounded-md"></div>
<div class="rounded-lg"></div>
<div class="rounded-xl"></div>
<div class="rounded-2xl"></div>
<div class="rounded-3xl"></div>
<div class="rounded-full"></div>
<div class="rounded-t"></div>
<div class="rounded-r"></div>
<div class="rounded-b"></div>
<div class="rounded-l"></div>
<div class="rounded-tl"></div>
<div class="rounded-tr"></div>
<div class="rounded-br"></div>
<div class="rounded-bl"></div>
<div class="rounded-t-full"></div>
<div class="rounded-b-full"></div>
```

---

## 🌫️ Effects

### Shadows
```html
<div class="shadow-sm"></div>
<div class="shadow"></div>
<div class="shadow-md"></div>
<div class="shadow-lg"></div>
<div class="shadow-xl"></div>
<div class="shadow-2xl"></div>
<div class="shadow-inner"></div>
<div class="shadow-none"></div>
```

### Opacity
```html
<div class="opacity-0"></div>
<div class="opacity-5"></div>
<div class="opacity-10"></div>
<div class="opacity-20"></div>
<div class="opacity-25"></div>
<div class="opacity-30"></div>
<div class="opacity-40"></div>
<div class="opacity-50"></div>
<div class="opacity-60"></div>
<div class="opacity-70"></div>
<div class="opacity-75"></div>
<div class="opacity-80"></div>
<div class="opacity-90"></div>
<div class="opacity-95"></div>
<div class="opacity-100"></div>
```

### Mix Blend Mode
```html
<div class="mix-blend-normal"></div>
<div class="mix-blend-multiply"></div>
<div class="mix-blend-screen"></div>
<div class="mix-blend-overlay"></div>
<div class="mix-blend-darken"></div>
<div class="mix-blend-lighten"></div>
<div class="mix-blend-color-dodge"></div>
<div class="mix-blend-color-burn"></div>
<div class="mix-blend-hard-light"></div>
<div class="mix-blend-soft-light"></div>
<div class="mix-blend-difference"></div>
<div class="mix-blend-exclusion"></div>
<div class="mix-blend-hue"></div>
<div class="mix-blend-saturation"></div>
<div class="mix-blend-color"></div>
<div class="mix-blend-luminosity"></div>
```

---

## 🎭 Transitions & Animations

### Transition
```html
<div class="transition-none"></div>
<div class="transition-all"></div>
<div class="transition"></div>
<div class="transition-colors"></div>
<div class="transition-opacity"></div>
<div class="transition-shadow"></div>
<div class="transition-transform"></div>
```

### Duration
```html
<div class="duration-75"></div>
<div class="duration-100"></div>
<div class="duration-150"></div>
<div class="duration-200"></div>
<div class="duration-300"></div>
<div class="duration-500"></div>
<div class="duration-700"></div>
<div class="duration-1000"></div>
```

### Timing
```html
<div class="ease-linear"></div>
<div class="ease-in"></div>
<div class="ease-out"></div>
<div class="ease-in-out"></div>
```

### Animation
```html
<div class="animate-none"></div>
<div class="animate-spin"></div>
<div class="animate-ping"></div>
<div class="animate-pulse"></div>
<div class="animate-bounce"></div>
```

---

## 📱 Responsive

### Breakpoints
```html
<!-- sm: 640px -->
<div class="sm:flex"></div>

<!-- md: 768px -->
<div class="md:grid-cols-2"></div>

<!-- lg: 1024px -->
<div class="lg:grid-cols-3"></div>

<!-- xl: 1280px -->
<div class="xl:grid-cols-4"></div>

<!-- 2xl: 1536px -->
<div class="2xl:grid-cols-5"></div>

<!-- Custom breakpoints in tailwind.config.js -->
```

### Responsive Example
```html
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
  <!-- Responsive card grid -->
</div>
```

---

## 🎯 Hover, Focus & Active

### Hover
```html
<div class="hover:bg-gray-100"></div>
<div class="hover:text-gray-500"></div>
<div class="hover:shadow-lg"></div>
<div class="hover:scale-105"></div>
<div class="hover:-translate-y-1"></div>
<div class="hover:opacity-80"></div>
<div class="hover:underline"></div>
<div class="hover:ring"></div>
<div class="hover:ring-offset-2"></div>
```

### Focus
```html
<div class="focus:bg-gray-100"></div>
<div class="focus:text-gray-500"></div>
<div class="focus:outline-none"></div>
<div class="focus:ring-2"></div>
<div class="focus:ring-blue-500"></div>
<div class="focus:ring-offset-2"></div>
<div class="focus:border-blue-500"></div>
```

### Active
```html
<div class="active:bg-gray-200"></div>
<div class="active:text-gray-600"></div>
<div class="active:scale-95"></div>
```

### Group Hover
```html
<div class="group hover:bg-gray-100">
  <div class="group-hover:text-blue-500">
    <!-- Content -->
  </div>
</div>
```

---

## 📚 Official Resources

- **Docs**: https://tailwindcss.com/docs
- **Playground**: https://play.tailwindcss.com
- **Components**: https://tailwindcomponents.com
- **Templates**: https://tailblocks.cc
- **UI Kits**: https://flowbite.com
- **Cheatsheet**: https://umeshmk.github.io/Tailwindcss-cheatsheet

---

## ⚡ Pro Tips

1. **Use `mx-auto`** for centering horizontally
2. **Use `my-0 mx-auto`** for centering both
3. **Use `space-y-*`** instead of `mb-*` for gaps
4. **Use `grid`** for 2D layouts
5. **Use `flex`** for 1D layouts
6. **Use `gap-*`** for spacing between flex/grid items
7. **Use `w-full`** instead of `w-1/1`
8. **Use `w-auto`** to reset width
9. **Use `w-max`** for max-width content
10. **Use `block`** instead of `hidden` for showing
