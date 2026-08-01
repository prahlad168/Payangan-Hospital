(function () {
    'use strict';

    var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    function fadeIn() {
        if (window.initFadeIn) {
            window.initFadeIn();
        } else {
            document.querySelectorAll('.fade-in').forEach(function (el) {
                var obs = new IntersectionObserver(function (entries) {
                    entries.forEach(function (e) {
                        if (e.isIntersecting) e.target.classList.add('visible');
                    });
                }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
                obs.observe(el);
            });
        }
    }

    window.PayanganNews = {
        articles: [],

        init: function () {
            var self = this;
            fetch('data/news.json', { cache: 'no-store' })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    data.sort(function (a, b) { return new Date(b.date) - new Date(a.date); });
                    self.articles = data;
                    self.renderGrid();
                    self.renderSlider();
                    self.initFilter();
                    self.initSliderControls();
                })
                .catch(function (err) {
                    console.error('[PayanganNews] Gagal memuat data/news.json:', err);
                });
        },

        renderGrid: function () {
            var container = document.getElementById('newsPostsGrid');
            if (!container) return;
            container.innerHTML = this.articles.map(function (a) {
                return '<article class="post-card fade-in" data-category="' + a.categoryFilter + '">' +
                    '<div class="post-image" style="background:none;padding:0;">' +
                    '<img src="' + a.image + '" alt="' + a.title + '" style="width:100%;height:100%;object-fit:cover;">' +
                    '<span class="post-date"><i class="fas fa-calendar"></i> ' + a.dateDisplay + '</span>' +
                    '</div>' +
                    '<div class="post-content">' +
                    '<span class="post-category">' + a.category + '</span>' +
                    '<h3><a href="' + a.slug + '">' + a.title + '</a></h3>' +
                    '<p class="post-excerpt">' + a.excerpt + '</p>' +
                    '<div class="post-footer">' +
                    '<div class="post-author"><div class="post-author-avatar">' + a.authorAvatar + '</div><span>' + a.author + '</span></div>' +
                    '<span class="post-read-time"><i class="fas fa-clock"></i> ' + a.readTime + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</article>';
            }).join('');
            fadeIn();
        },

        renderSlider: function () {
            var container = document.getElementById('newsSlider');
            if (!container) return;
            var items = this.articles.slice(0, 5);
            container.innerHTML = items.map(function (a) {
                return '<article class="news-card">' +
                    '<div class="news-card-image">' +
                    '<img src="' + a.image + '" alt="' + a.title + '" loading="lazy" decoding="async">' +
                    '</div>' +
                    '<div class="news-card-content">' +
                    '<div class="news-card-date"><i class="far fa-calendar"></i> ' + a.dateDisplay + '</div>' +
                    '<span class="news-card-category">' + a.category + '</span>' +
                    '<h3 class="news-card-title"><a href="' + a.slug + '">' + a.title + '</a></h3>' +
                    '<p class="news-card-excerpt">' + a.excerpt + '</p>' +
                    '<div class="news-card-footer">' +
                    '<div class="news-card-author"><div class="news-card-avatar">' + a.authorAvatar + '</div><span>' + a.author + '</span></div>' +
                    '<span class="news-card-read-time"><i class="far fa-clock"></i> ' + a.readTime + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</article>';
            }).join('');
        },

        initFilter: function () {
            var container = document.getElementById('newsPostsGrid');
            if (!container) return;
            var self = this;
            var buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    buttons.forEach(function (b) { b.classList.remove('active'); });
                    btn.classList.add('active');
                    self.applyFilter(btn.getAttribute('data-filter'));
                });
            });
            var urlCat = new URLSearchParams(window.location.search).get('cat');
            if (urlCat) {
                var targetBtn = document.querySelector('.filter-btn[data-filter="' + urlCat + '"]');
                if (targetBtn) {
                    buttons.forEach(function (b) { b.classList.remove('active'); });
                    targetBtn.classList.add('active');
                    self.applyFilter(urlCat);
                }
            }
        },

        applyFilter: function (filter) {
            var cards = document.querySelectorAll('#newsPostsGrid .post-card');
            cards.forEach(function (card) {
                card.style.display = (filter === 'semua' || card.getAttribute('data-category') === filter) ? '' : 'none';
            });
        },

        initSliderControls: function () {
            var slider = document.getElementById('newsSlider');
            var dotsContainer = document.getElementById('newsDots');
            if (!slider) return;
            var current = 0;
            function cards() { return slider.querySelectorAll('.news-card'); }
            function cardsPerView() { return window.innerWidth < 768 ? 1 : window.innerWidth < 1024 ? 2 : 3; }
            function getCardStep() {
                var cs = cards();
                if (!cs.length) return 360;
                var first = cs[0];
                var second = cs[1];
                if (second) return second.getBoundingClientRect().left - first.getBoundingClientRect().left;
                return first.offsetWidth;
            }
            function createDots() {
                if (!dotsContainer) return;
                var perView = cardsPerView();
                var total = Math.max(1, cards().length - perView + 1);
                dotsContainer.innerHTML = '';
                for (var i = 0; i < total; i++) {
                    var dot = document.createElement('span');
                    dot.className = 'news-dot' + (i === 0 ? ' active' : '');
                    dot.onclick = function (idx) { return function () { goTo(idx); }; }(i);
                    dotsContainer.appendChild(dot);
                }
            }
            function updateDots() {
                if (!dotsContainer) return;
                var dots = dotsContainer.querySelectorAll('.news-dot');
                dots.forEach(function (dot, i) { dot.classList.toggle('active', i === current); });
            }
            function maxIndex() { return Math.max(0, cards().length - cardsPerView()); }
            function goTo(i) {
                if (!cards().length) return;
                current = Math.max(0, Math.min(i, maxIndex()));
                slider.scrollTo({ left: current * getCardStep(), behavior: 'smooth' });
                updateDots();
            }
            function next() { goTo(current + 1); }
            createDots();
            var scrollT;
            slider.addEventListener('scroll', function () {
                if (scrollT) cancelAnimationFrame(scrollT);
                scrollT = requestAnimationFrame(function () {
                    var s = getCardStep();
                    if (s <= 0) return;
                    var idx = Math.round(slider.scrollLeft / s);
                    var mx = maxIndex();
                    if (idx !== current && idx >= 0 && idx <= mx) {
                        current = idx;
                        updateDots();
                    }
                });
            }, { passive: true });
            window.addEventListener('resize', function () { createDots(); goTo(Math.min(current, maxIndex())); });
            var prevBtn = document.querySelector('.news-prev');
            var nextBtn = document.querySelector('.news-next');
            if (prevBtn) prevBtn.onclick = function () { goTo(current - 1); };
            if (nextBtn) nextBtn.onclick = next;
        }
    };

    document.addEventListener('DOMContentLoaded', function () { window.PayanganNews.init(); });
})();
