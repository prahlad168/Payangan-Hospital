/**
 * ==========================================
 * PAYANGAN HOSPITAL - PREMIUM UI JAVASCRIPT
 * Modern Medical Healthcare Theme
 * ==========================================
 */

(function() {
    'use strict';

    // ==========================================
    // 1. SCROLL ANIMATIONS (Intersection Observer)
    // ==========================================
    function initScrollAnimations() {
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        
        if (!animatedElements.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        animatedElements.forEach(el => observer.observe(el));
    }

    // ==========================================
    // 2. HEADER SCROLL EFFECT
    // ==========================================
    function initHeaderScroll() {
        const header = document.getElementById('header');
        const announcementBar = document.getElementById('announcementBar');
        
        if (!header) return;

        let lastScroll = 0;
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.scrollY;
            
            if (currentScroll > 100) {
                header.classList.remove('transparent');
                header.classList.add('scrolled');
                if (announcementBar) {
                    announcementBar.style.display = 'none';
                }
            } else {
                header.classList.add('transparent');
                header.classList.remove('scrolled');
                if (announcementBar) {
                    announcementBar.style.display = 'block';
                }
            }
            
            lastScroll = currentScroll;
        }, { passive: true });
    }

    // ==========================================
    // 3. MOBILE MENU
    // ==========================================
    function initMobileMenu() {
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (!mobileMenuToggle || !mobileMenu) return;

        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
            
            // Animate hamburger
            const spans = mobileMenuToggle.querySelectorAll('span');
            if (mobileMenu.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
            } else {
                spans[0].style.transform = '';
                spans[1].style.opacity = '1';
                spans[2].style.transform = '';
            }
        });

        // Close on link click
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }

    // ==========================================
    // 4. SMOOTH SCROLL
    // ==========================================
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const headerHeight = document.getElementById('header')?.offsetHeight || 80;
                    const targetPosition = target.getBoundingClientRect().top + window.scrollY - headerHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // ==========================================
    // 5. COUNTER ANIMATION
    // ==========================================
    function initCounterAnimation() {
        const counters = document.querySelectorAll('.counter');
        
        if (!counters.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target'));
                    const duration = 2000;
                    const step = target / (duration / 16);
                    let current = 0;
                    
                    const updateCounter = () => {
                        current += step;
                        if (current < target) {
                            counter.textContent = Math.floor(current);
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target;
                        }
                    };
                    
                    updateCounter();
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    }

    // ==========================================
    // 6. RIPPLE EFFECT FOR BUTTONS
    // ==========================================
    function initRippleEffect() {
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.style.cssText = `
                    position: absolute;
                    background: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s ease-out;
                    pointer-events: none;
                    width: 100px;
                    height: 100px;
                    left: ${x - 50}px;
                    top: ${y - 50}px;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple keyframes
        if (!document.getElementById('ripple-styles')) {
            const style = document.createElement('style');
            style.id = 'ripple-styles';
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }

    // ==========================================
    // 7. LANGUAGE SWITCHER
    // ==========================================
    function initLanguageSwitcher() {
        const translations = {
            id: {
                heroBadge: '22+ Dokter Spesialis Berpengalaman',
                heroTitle: 'Pelayanan Kesehatan Modern dengan <span>Sentuhan Humanis</span>',
                heroSubtitle: 'RS Payangan Hospital memberikan pelayanan kesehatan berkualitas dengan tenaga medis profesional dan fasilitas modern untuk masyarakat Gianyar dan sekitarnya.'
            },
            en: {
                heroBadge: '22+ Experienced Specialist Doctors',
                heroTitle: 'Modern Healthcare with <span>Compassionate Care</span>',
                heroSubtitle: 'Payangan Hospital provides quality healthcare services with professional medical staff and modern facilities for the community of Gianyar and surrounding areas.'
            }
        };

        window.toggleLanguage = function() {
            const html = document.documentElement;
            const currentLang = html.lang === 'id' ? 'en' : 'id';
            html.lang = currentLang;
            
            // Update active state
            document.getElementById('langId')?.classList.toggle('active', currentLang === 'id');
            document.getElementById('langEn')?.classList.toggle('active', currentLang === 'en');
            
            // Update content
            const t = translations[currentLang];
            const heroBadge = document.getElementById('heroBadge');
            const heroTitle = document.getElementById('heroTitle');
            const heroSubtitle = document.getElementById('heroSubtitle');
            
            if (heroBadge) heroBadge.textContent = t.heroBadge;
            if (heroTitle) heroTitle.innerHTML = t.heroTitle;
            if (heroSubtitle) heroSubtitle.textContent = t.heroSubtitle;
        };
    }

    // ==========================================
    // 8. DOCTOR SLIDER
    // ==========================================
    function initDoctorSlider() {
        const slider = document.getElementById('doctorsSlider');
        if (!slider) return;

        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.style.cursor = 'grabbing';
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.style.cursor = 'grab';
        });

        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.style.cursor = 'grab';
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2;
            slider.scrollLeft = scrollLeft - walk;
        });

        // Touch support
        slider.addEventListener('touchstart', (e) => {
            startX = e.touches[0].pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('touchmove', (e) => {
            const x = e.touches[0].pageX - slider.offsetLeft;
            const walk = (x - startX) * 2;
            slider.scrollLeft = scrollLeft - walk;
        });

        // Arrow navigation
        window.slideDoctors = function(direction) {
            const scrollAmount = 320;
            slider.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        };
    }

    // ==========================================
    // 9. BACK TO TOP BUTTON
    // ==========================================
    function initBackToTop() {
        const backToTop = document.getElementById('backToTop');
        if (!backToTop) return;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ==========================================
    // 10. FORM VALIDATION
    // ==========================================
    function initFormValidation() {
        const forms = document.querySelectorAll('form[data-validate]');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                this.querySelectorAll('[required]').forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('error');
                    } else {
                        input.classList.remove('error');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang diperlukan.');
                }
            });
        });
    }

    // ==========================================
    // 11. TABS
    // ==========================================
    function initTabs() {
        const tabButtons = document.querySelectorAll('[data-tab]');
        
        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const tabId = btn.getAttribute('data-tab');
                const tabContainer = btn.closest('.tabs');
                
                // Remove active from all buttons and contents
                tabContainer.querySelectorAll('[data-tab]').forEach(b => b.classList.remove('active'));
                tabContainer.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                // Add active to clicked
                btn.classList.add('active');
                document.getElementById(tabId)?.classList.add('active');
            });
        });
    }

    // ==========================================
    // 12. ACCORDION
    // ==========================================
    function initAccordion() {
        const accordionHeaders = document.querySelectorAll('.accordion-header');
        
        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const accordion = header.closest('.accordion');
                const content = header.nextElementSibling;
                const isOpen = header.classList.contains('active');
                
                // Close all in accordion
                accordion.querySelectorAll('.accordion-header').forEach(h => h.classList.remove('active'));
                accordion.querySelectorAll('.accordion-content').forEach(c => c.style.maxHeight = null);
                
                // Toggle current
                if (!isOpen) {
                    header.classList.add('active');
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            });
        });
    }

    // ==========================================
    // 13. PARALLAX EFFECT
    // ==========================================
    function initParallax() {
        const parallaxElements = document.querySelectorAll('[data-parallax]');
        
        if (!parallaxElements.length) return;

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            
            parallaxElements.forEach(el => {
                const speed = parseFloat(el.getAttribute('data-parallax')) || 0.5;
                el.style.transform = `translateY(${scrollY * speed}px)`;
            });
        }, { passive: true });
    }

    // ==========================================
    // 14. LAZY LOADING IMAGES
    // ==========================================
    function initLazyLoading() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        if (!lazyImages.length) return;

        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.getAttribute('data-src');
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });

        lazyImages.forEach(img => imageObserver.observe(img));
    }

    // ==========================================
    // INITIALIZE ALL
    // ==========================================
    function init() {
        initScrollAnimations();
        initHeaderScroll();
        initMobileMenu();
        initSmoothScroll();
        initCounterAnimation();
        initRippleEffect();
        initLanguageSwitcher();
        initDoctorSlider();
        initBackToTop();
        initFormValidation();
        initTabs();
        initAccordion();
        initParallax();
        initLazyLoading();
        
        console.log('Premium UI initialized successfully');
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
