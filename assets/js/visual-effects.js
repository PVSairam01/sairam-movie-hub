/* =========================================================
   PRCEPTION-STYLE EFFECTS v2 - JS
   Runtime only: your HTML/PHP files are NOT edited.
   Load AFTER script.js / location.js
   ========================================================= */
(function () {
    'use strict';
    var W = window, D = document;
    if (W.matchMedia && W.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var fine = W.matchMedia('(hover: hover) and (pointer: fine)').matches;
    var vh = W.innerHeight;
    W.addEventListener('resize', function () { vh = W.innerHeight; });

    function $(s, r) { return Array.prototype.slice.call((r || D).querySelectorAll(s)); }
    function el(t, c, h) { var e = D.createElement(t); if (c) e.className = c; if (h) e.innerHTML = h; return e; }
    function clamp(v, a, b) { return Math.max(a, Math.min(b, v)); }
    function lerp(a, b, t) { return a + (b - a) * t; }

    /* ======================================================
       A. PAGE CURTAIN (enter + exit transitions)
       ====================================================== */
    var curtain = el('div', 'pc-curtain', '<span class="pc-curtain-txt">SAIRAM <b>MOVIES</b></span>');
    D.body.appendChild(curtain);
    setTimeout(function () { curtain.classList.add('pc-open'); }, 750);
    W.addEventListener('pageshow', function (e) { if (e.persisted) curtain.classList.add('pc-open'); });

    D.addEventListener('click', function (e) {
        var a = e.target.closest && e.target.closest('a[href]');
        if (!a || e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey) return;
        var h = a.getAttribute('href');
        if (!h || h.charAt(0) === '#' || /^(tel|mailto|javascript)/i.test(h) || a.target === '_blank' || a.hasAttribute('download')) return;
        var u; try { u = new URL(a.href, location.href); } catch (x) { return; }
        if (u.origin !== location.origin) return;
        if (u.pathname === location.pathname && u.search === location.search) return;
        e.preventDefault();
        curtain.classList.add('pc-prep');
        curtain.classList.remove('pc-open');
        void curtain.offsetHeight;
        curtain.classList.remove('pc-prep');
        setTimeout(function () { location.href = u.href; }, 700);
    });

    /* ======================================================
       B. SCROLL PROGRESS BAR
       ====================================================== */
    var bar = el('div', 'pc-progress');
    D.body.appendChild(bar);

    /* ======================================================
       C. OBSERVER (shared)
       ====================================================== */
    var io = ('IntersectionObserver' in W) ? new IntersectionObserver(function (es) {
        es.forEach(function (e) {
            if (!e.isIntersecting) return;
            e.target.classList.add('pc-in');
            io.unobserve(e.target);
            if (e.target.__pcDone) e.target.__pcDone();
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' }) : null;
    function watch(n) { if (io) io.observe(n); else n.classList.add('pc-in'); }
    function once(n) { if (n.__pc) return false; n.__pc = 1; return true; }

    /* ======================================================
       D. SCROLL REVEAL (fade-up, staggered)
       ====================================================== */
    var REVEAL = ['.section_header', '.category_buttons', '.genre_filters', '.swiper:not(.heroBgSwiper)',
        '.cast_card', '.coming_card', '.offer_card', '.why_card', '.review_card', '.partner_logo',
        '.trailer_card', '.newsletter_box', '.app_section .container', '.stats_section .col-6',
        '.stats_section .col-md-3', '.footer .col-lg-4', '.footer .col-lg-2', '.footer .col-lg-3',
        '.footer .copyright'].join(',');

    function revealInit() {
        $(REVEAL).forEach(function (n) {
            if (!once(n)) return;
            var sib = n.parentElement ? Array.prototype.filter.call(n.parentElement.children, function (c) { return c.matches(REVEAL); }) : [];
            n.style.setProperty('--pc-delay', (Math.min(Math.max(0, sib.indexOf(n)), 6) * 0.1) + 's');
            n.classList.add('pc-rv');
            watch(n);
        });
    }

    /* ======================================================
       E. HEADINGS - tilt+fade (gradient text) / word-mask split
       ====================================================== */
    var heads = [];
    function hasClip(n) {
        return [n].concat($('*', n)).some(function (x) {
            var c = getComputedStyle(x);
            return c.webkitBackgroundClip === 'text' || c.backgroundClip === 'text';
        });
    }
    function splitWords(node, st) {
        Array.prototype.slice.call(node.childNodes).forEach(function (c) {
            if (c.nodeType === 3) {
                var f = D.createDocumentFragment();
                c.textContent.split(/(\s+)/).forEach(function (p) {
                    if (!p) return;
                    if (/^\s+$/.test(p)) { f.appendChild(D.createTextNode(' ')); return; }
                    var w = el('span', 'pc-word'), s = el('span');
                    s.textContent = p; s.style.setProperty('--i', st.i++);
                    w.appendChild(s); f.appendChild(w);
                });
                c.parentNode.replaceChild(f, c);
            } else if (c.nodeType === 1 && !c.classList.contains('pc-word')) {
                splitWords(c, st);
            }
        });
    }
    function headingsInit() {
        $('.hero_main_title_dark,.hero_main_title,.newsletter_box h2,.section_title,.footer h3,.footer h5').forEach(function (h) {
            if (!once(h)) return;
            if (hasClip(h)) { h.classList.add('pc-head'); }
            else { h.classList.add('pc-split'); splitWords(h, { i: 0 }); }
            heads.push(h);
            watch(h);
        });
    }

    /* ======================================================
       F. IMAGES - focus-pull reveal + scroll parallax
       ====================================================== */
    var pars = [];
    function imagesInit() {
        $('.movie_image img,.trailer_card img,.coming_card>img,.cast_card img,.partner_logo img,.app_section img').forEach(function (img) {
            if (!once(img)) return;
            img.classList.add('pc-img');
            img.__pcDone = function () { setTimeout(function () { img.classList.remove('pc-img', 'pc-in'); }, 1600); };
            watch(img);
        });
        $('.trailer_card img,.coming_card>img').forEach(function (img) {
            if (img.__pcPar) return; img.__pcPar = 1;
            img.classList.add('pc-par'); pars.push(img);
        });
    }

    /* ======================================================
       G. SCRUB TEXT (words light up while scrolling)
       ====================================================== */
    var scrubs = [];
    function scrubInit() {
        $('.app_section p,.newsletter_box p').forEach(function (p) {
            if (p.children.length || !once(p)) return;
            var words = p.textContent.trim().split(/\s+/);
            p.innerHTML = '';
            words.forEach(function (w, i) {
                var s = el('span', 'pc-sw'); s.textContent = w;
                p.appendChild(s); if (i < words.length - 1) p.appendChild(D.createTextNode(' '));
            });
            p.classList.add('pc-scrub');
            scrubs.push(p);
        });
    }

    /* ======================================================
       H. MAGNETIC BUTTONS + SIDE MENU INDEX
       ====================================================== */
    function miscInit() {
        $('.movie-signin-btn,.primary_hero_btn,.secondary_hero_btn,.btn-gold,.btn-outline-gold,.header-nav-btn,.movie-menu-btn,.social_icons a,.movie-book-btn,.floating-btn,.sairam-header-logo').forEach(function (b) {
            b.classList.add('pc-mag');
        });
        $('.movie-side-menu .movie-menu-item').forEach(function (it, i) { it.style.setProperty('--k', i + 1); });
    }

    /* ======================================================
       I. HERO: viewfinder + badge + parallax
       ====================================================== */
    var hero = null, vf = null, vfCross = null, vfTxt = null;
    var lens = null, lensImg = null, lensRing = null, lx = 0, ly = 0, lr = 0, lensSrc = '';
    var walls = [];
    function heroInit() {
        hero = D.querySelector('.hero_section_dark') || D.querySelector('.hero_section_light');
        if (!hero || hero.__pcHero) return; hero.__pcHero = 1;
        if (fine) {
            lens = el('div', 'pc-lens'); lensImg = el('img'); lensImg.alt = ''; lens.appendChild(lensImg);
            lensRing = el('div', 'pc-lens-ring');
            hero.appendChild(lens); hero.appendChild(lensRing);
            vf = el('div', 'pc-vf',
                '<i class="tl"></i><i class="tr"></i><i class="bl"></i><i class="br"></i>' +
                '<div class="pc-vf-rec"><b></b>REC</div>' +
                '<div class="pc-vf-bot">SAIRAM MOVIES &mdash; FRAME 001 &middot; FOCUS <span class="pc-vf-xy">X 0.50 &middot; Y 0.50</span></div>' +
                '<div class="pc-vf-cross"></div>');
            hero.appendChild(vf);
            vfCross = vf.querySelector('.pc-vf-cross');
            vfTxt = vf.querySelector('.pc-vf-xy');
        }
        var badge = el('div', 'pc-badge',
            '<svg viewBox="0 0 120 120" aria-hidden="true"><defs><path id="pcCirc" d="M60,60 m-46,0 a46,46 0 1,1 92,0 a46,46 0 1,1 -92,0"/></defs>' +
            '<text><textPath href="#pcCirc" textLength="285" lengthAdjust="spacing">BOOK TICKETS \u2022 WATCH TRAILERS \u2022 3D EXPERIENCE \u2022 </textPath></text></svg>' +
            '<span class="pc-badge-arrow">\u2193</span>');
        badge.setAttribute('role', 'button'); badge.setAttribute('aria-label', 'Scroll down');
        badge.addEventListener('click', function () {
            var n = hero.nextElementSibling;
            if (n) n.scrollIntoView({ behavior: 'smooth' });
        });
        hero.appendChild(badge);
    }

    /* ======================================================
       I2. MOVIE WALL (tilted 3D wall -> flat on scroll)
       ====================================================== */
    function wallInit() {
        $('.trendingSwiperDesktop,.latestSwiperDesktop,.teluguMoviesSwiper').forEach(function (n) {
            if (!once(n)) return;
            n.classList.add('pc-wall'); walls.push(n);
        });
    }

    /* ======================================================
       J. COUNT-UP NUMBERS
       ====================================================== */
    function runCount(n) {
        var orig = n.textContent.trim(), m = orig.match(/^([\d.,]+)(.*)$/);
        if (!m) return;
        var comma = m[1].indexOf(',') > -1, target = parseFloat(m[1].replace(/,/g, '')),
            dec = (m[1].split('.')[1] || '').length, suf = m[2], t0 = null;
        function fmt(v) {
            var s = v.toFixed(dec);
            if (comma) s = Number(s).toLocaleString('en-IN', { minimumFractionDigits: dec, maximumFractionDigits: dec });
            return s + suf;
        }
        (function step(ts) {
            if (!t0) t0 = ts;
            var p = Math.min((ts - t0) / 1800, 1);
            n.textContent = fmt(target * (1 - Math.pow(1 - p, 4)));
            if (p < 1) requestAnimationFrame(step); else n.textContent = orig;
        })(performance.now());
    }
    function countersInit() {
        if (!io) return;
        var cio = new IntersectionObserver(function (es) {
            es.forEach(function (e) { if (e.isIntersecting) { cio.unobserve(e.target); runCount(e.target); } });
        }, { threshold: 0.4 });
        $('.stats_section h2,.hero_stats h3').forEach(function (n) {
            if (/^\s*[\d.,]+/.test(n.textContent) && once(n)) cio.observe(n);
        });
    }

    /* ======================================================
       K. SCROLL LOOP (progress, parallax, velocity tilt, scrub)
       ====================================================== */
    var lastY = W.pageYOffset, vel = 0, running = false;
    function scrollTick() {
        var y = W.pageYOffset, dv = y - lastY; lastY = y;
        vel = lerp(vel, dv, 0.15);

        var max = D.documentElement.scrollHeight - vh;
        bar.style.transform = 'scaleX(' + (max > 0 ? clamp(y / max, 0, 1) : 0) + ')';

        pars.forEach(function (img) {
            var p = img.parentElement; if (!p) return;
            var r = p.getBoundingClientRect();
            if (r.bottom < 0 || r.top > vh) return;
            img.style.setProperty('--py', clamp(((r.top + r.height / 2 - vh / 2) / vh) * -22, -12, 12).toFixed(1) + 'px');
        });

        walls.forEach(function (n) {
            var r = n.getBoundingClientRect();
            if (r.bottom < -200 || r.top > vh + 200) return;
            var p = clamp((vh - r.top) / (vh * 0.75), 0, 1), w = Math.pow(1 - p, 3);
            n.style.setProperty('--w', w.toFixed(3));
            n.classList.toggle('pc-wall-flat', w < 0.015);
        });

        var tilt = clamp(vel * -0.12, -2.2, 2.2).toFixed(2) + 'deg';
        heads.forEach(function (h) {
            var r = h.getBoundingClientRect();
            if (r.bottom < 0 || r.top > vh) return;
            h.style.rotate = tilt;
        });

        scrubs.forEach(function (p) {
            var r = p.getBoundingClientRect();
            if (r.bottom < 0 || r.top > vh) return;
            var prog = clamp((vh * 0.9 - r.top) / (vh * 0.55), 0, 1), ws = p.children, on = Math.round(prog * ws.length);
            for (var i = 0; i < ws.length; i++) ws[i].classList.toggle('on', i < on);
        });

        if (Math.abs(vel) > 0.05) requestAnimationFrame(scrollTick); else { running = false; heads.forEach(function (h) { h.style.rotate = '0deg'; }); }
    }
    W.addEventListener('scroll', function () { if (!running) { running = true; requestAnimationFrame(scrollTick); } }, { passive: true });

    /* ======================================================
       L. MOUSE: cursor, tilt, spotlight, magnetic, hero camera
       ====================================================== */
    var TILT = '.movie_card,.cast_card,.offer_card,.why_card,.review_card,.coming_card,.partner_logo,.trailer_card,.movie-related-card,.movie-person-card';
    var mx = -200, my = -200, rx = -200, ry = -200;
    var tilted = null, magged = null;
    var hnx = 0.5, hny = 0.5, heroIn = false, hx = 0, hy = 0, cx = 0, cy = 0;
    var dot, ring, ringLbl;

    function resetTilt(n) { n.style.transform = ''; n.style.transition = ''; }

    if (fine) {
        dot = el('div', 'pc-cur-dot pc-hide');
        ringLbl = el('span');
        ring = el('div', 'pc-cur-ring pc-hide'); ring.appendChild(ringLbl);
        D.body.appendChild(dot); D.body.appendChild(ring);

        D.addEventListener('mousemove', function (e) {
            mx = e.clientX; my = e.clientY;
            dot.classList.remove('pc-hide'); ring.classList.remove('pc-hide');

            /* 3D tilt + spotlight */
            var t = e.target.closest ? e.target.closest(TILT) : null;
            if (t !== tilted) { if (tilted) resetTilt(tilted); tilted = t; }
            if (t) {
                var r = t.getBoundingClientRect(), x = (e.clientX - r.left) / r.width, y = (e.clientY - r.top) / r.height;
                t.style.setProperty('--mx', (x * 100).toFixed(1) + '%');
                t.style.setProperty('--my', (y * 100).toFixed(1) + '%');
                t.style.transition = 'transform .12s ease-out';
                t.style.transform = 'perspective(900px) rotateX(' + ((0.5 - y) * 10).toFixed(2) + 'deg) rotateY(' + ((x - 0.5) * 12).toFixed(2) + 'deg) translateY(-6px)';
            }

            /* magnetic */
            var m = e.target.closest ? e.target.closest('.pc-mag') : null;
            if (m !== magged) { if (magged) magged.style.translate = ''; magged = m; }
            if (m) {
                var b = m.getBoundingClientRect();
                m.style.translate = ((e.clientX - (b.left + b.width / 2)) * 0.22).toFixed(1) + 'px ' + ((e.clientY - (b.top + b.height / 2)) * 0.3).toFixed(1) + 'px';
            }

            /* hero camera */
            if (hero) {
                var hr = hero.getBoundingClientRect();
                heroIn = e.clientX >= hr.left && e.clientX <= hr.right && e.clientY >= hr.top && e.clientY <= hr.bottom;
                if (heroIn) { hnx = (e.clientX - hr.left) / hr.width; hny = (e.clientY - hr.top) / hr.height; }
            }
        }, { passive: true });

        D.addEventListener('mouseover', function (e) {
            var t = e.target, lab = '', grow = false;
            if (t.closest('a,button,.menu_icon,.location,.pc-badge')) grow = true;
            else if (t.closest('.trailer_card')) lab = 'PLAY';
            else if (t.closest('.movie_card,.movie-related-card')) lab = 'VIEW';
            ring.classList.toggle('pc-grow', grow);
            ring.classList.toggle('pc-label', !!lab);
            ringLbl.textContent = lab;
        });

        D.addEventListener('mouseout', function (e) {
            if (e.relatedTarget) return;
            dot.classList.add('pc-hide'); ring.classList.add('pc-hide');
            if (tilted) { resetTilt(tilted); tilted = null; }
            if (magged) { magged.style.translate = ''; magged = null; }
            heroIn = false;
        });

        (function loop() {
            rx = lerp(rx, mx, 0.17); ry = lerp(ry, my, 0.17);
            dot.style.translate = mx + 'px ' + my + 'px';
            ring.style.translate = rx.toFixed(1) + 'px ' + ry.toFixed(1) + 'px';

            if (hero) {
                var tx = heroIn ? (hnx - 0.5) * -34 : 0, ty = heroIn ? (hny - 0.5) * -18 : 0;
                hx = lerp(hx, tx, 0.08); hy = lerp(hy, ty, 0.08);
                hero.style.setProperty('--hx', hx.toFixed(2) + 'px');
                hero.style.setProperty('--hy', hy.toFixed(2) + 'px');
                if (lens) {
                    var act = hero.querySelector('.swiper-slide-active .hero_slider_img');
                    var src = act ? (act.currentSrc || act.src) : '';
                    if (src && src !== lensSrc) { lensSrc = src; lensImg.src = src; }
                    var hw = hero.clientWidth, hh = hero.clientHeight;
                    /* scroll progress while hero leaves the screen (0 -> 1) */
                    var hbox = hero.getBoundingClientRect();
                    var sp = clamp(-hbox.top / (hbox.height * 0.8), 0, 1);
                    sp = sp * sp * (3 - 2 * sp);
                    /* centre drifts from cursor to hero centre as the circle grows */
                    var tx2 = lerp(hnx * hw, hw / 2, sp), ty2 = lerp(hny * hh, hh / 2, sp);
                    var maxR = Math.hypot(hw, hh) / 2 * 1.08;
                    var wantR = Math.max((heroIn && src) ? 135 : 0, src ? sp * maxR : 0);
                    if (lr < 2 && (heroIn || sp > 0)) { lx = tx2; ly = ty2; }
                    lx = lerp(lx, tx2, 0.16); ly = lerp(ly, ty2, 0.16);
                    lr = lerp(lr, wantR, sp > 0 ? 0.22 : 0.12);
                    lens.style.clipPath = 'circle(' + lr.toFixed(1) + 'px at ' + lx.toFixed(1) + 'px ' + ly.toFixed(1) + 'px)';
                    lensImg.style.transformOrigin = lx.toFixed(1) + 'px ' + ly.toFixed(1) + 'px';
                    lensImg.style.transform = 'scale(' + (1.5 + sp * 0.7).toFixed(3) + ')';
                    lensRing.style.width = lensRing.style.height = (lr * 2).toFixed(1) + 'px';
                    lensRing.style.translate = (lx - lr).toFixed(1) + 'px ' + (ly - lr).toFixed(1) + 'px';
                    lensRing.style.opacity = lr > 4 ? (1 - clamp((sp - 0.55) * 2.2, 0, 1)).toFixed(2) : 0;
                }
                if (vf) {
                    vf.classList.toggle('pc-on', heroIn);
                    var w = vf.clientWidth, h = vf.clientHeight;
                    cx = lerp(cx, hnx * w, 0.14); cy = lerp(cy, hny * h, 0.14);
                    vfCross.style.translate = cx.toFixed(1) + 'px ' + cy.toFixed(1) + 'px';
                    if (heroIn) vfTxt.innerHTML = 'X ' + hnx.toFixed(2) + ' &middot; Y ' + hny.toFixed(2);
                }
            }
            requestAnimationFrame(loop);
        })();
    }

    /* ======================================================
       INIT
       ====================================================== */
    function init() {
        revealInit(); headingsInit(); imagesInit(); scrubInit();
        miscInit(); heroInit(); wallInit(); countersInit();
        if (!running) { running = true; requestAnimationFrame(scrollTick); }
    }
    if (D.readyState === 'loading') D.addEventListener('DOMContentLoaded', init); else init();
    W.addEventListener('load', function () {
        setTimeout(init, 600); /* catch late-rendered cards */
        /* safety net: never leave anything hidden in the viewport */
        setTimeout(function () {
            $('.pc-rv:not(.pc-in),.pc-head:not(.pc-in),.pc-split:not(.pc-in)').forEach(function (n) {
                var r = n.getBoundingClientRect();
                if (r.bottom > 0 && r.top < vh) n.classList.add('pc-in');
            });
        }, 3000);
    });
})();