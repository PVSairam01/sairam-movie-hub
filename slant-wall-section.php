<?php
/*
 * =========================================================
 * SLANT WALL MOVIES SECTION (Prception-style)
 * Standalone include - no changes needed to existing code.
 * Usage in index.php:  <?php include 'slant-wall-section.php'; ?>
 * =========================================================
 */

$swMovies = [
    ['id' => 'avengers',          'title' => 'Avengers Endgame',  'tag' => 'Action • English',        'rating' => '9.2', 'img' => 'assets/images/movies/movie1.jpg'],
    ['id' => 'mission-impossible','title' => 'Mission Impossible','tag' => 'Action • English',        'rating' => '8.8', 'img' => 'assets/images/movies/movie2.jpg'],
    ['id' => 'avatar',            'title' => 'Avatar',            'tag' => 'Adventure • English',     'rating' => '9.0', 'img' => 'assets/images/movies/movie3.jpg'],
    ['id' => 'spider-man',        'title' => 'Spider-Man',        'tag' => 'Super Hero • English',    'rating' => '8.9', 'img' => 'assets/images/movies/movie4.jpg'],
    ['id' => 'batman',            'title' => 'The Batman',        'tag' => 'Action • English',        'rating' => '9.1', 'img' => 'assets/images/movies/movie5.png'],
    ['id' => 'pushpa-2',          'title' => 'Pushpa 2',          'tag' => 'Action, Drama • Telugu',  'rating' => '9.4', 'img' => 'assets/images/movies/pushpa-2.png'],
    ['id' => 'devara',            'title' => 'Devara',            'tag' => 'Action, Thriller • Telugu','rating' => '9.1', 'img' => 'assets/images/movies/devara-1.png'],
    ['id' => 'kalki-2898',        'title' => 'Kalki 2898 AD',     'tag' => 'Sci-Fi, Action • Telugu', 'rating' => '9.3', 'img' => 'assets/images/movies/kalki-2898ad.png'],
];
$swCount = count($swMovies);
$swRows  = array_chunk($swMovies, (int) ceil($swCount / 2));
?>

<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

<style>
    .sw-section {
        --sw-n: <?= $swCount ?>;
        --cw: 200px;
        --ch: 300px;
        --g: 28px;
        --sw-accent: #f5c542;
        position: relative;
        height: calc(var(--sw-n) * 90vh + 100vh);
        background: #07070b;
        color: #fff;
    }
    .sw-sticky {
        position: sticky;
        top: 0;
        height: 100vh;
        overflow: hidden;
    }
    .sw-sticky::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse at 50% 40%, rgba(245,197,66,.10), transparent 60%),
            radial-gradient(ellipse at 50% 120%, rgba(120,60,255,.18), transparent 60%);
        pointer-events: none;
    }
    .sw-stage {
        position: absolute;
        inset: 0;
        perspective: 1800px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sw-wall {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: var(--g);
        transform-style: preserve-3d;
        will-change: transform;
    }
    .sw-row { display: flex; gap: var(--g); }
    .sw-row:nth-child(2) { margin-left: calc(var(--cw) * .55); }

    .sw-card {
        position: relative;
        flex: 0 0 var(--cw);
        width: var(--cw);
        height: var(--ch);
        border-radius: 14px;
        overflow: hidden;
        background: #16161d;
        cursor: pointer;
        box-shadow: 0 30px 60px rgba(0,0,0,.55), 0 0 0 1px rgba(255,255,255,.08);
        will-change: opacity;
    }
    .sw-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        -webkit-user-drag: none;
        user-select: none;
    }
    .sw-card::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(115deg, rgba(255,255,255,.14), transparent 35%);
        pointer-events: none;
    }
    .sw-rate {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 2;
        padding: 3px 9px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        background: rgba(0,0,0,.65);
        color: #fff;
    }

    /* Intro heading (fades out on scroll) */
    .sw-intro {
        position: absolute;
        top: 14%;
        left: 0;
        width: 100%;
        text-align: center;
        z-index: 4;
        pointer-events: none;
    }
    .sw-intro small {
        display: block;
        letter-spacing: .35em;
        font-size: 12px;
        color: var(--sw-accent);
        margin-bottom: 10px;
        text-transform: uppercase;
    }
    .sw-intro h2 {
        font-family: 'Anton', Impact, sans-serif;
        font-size: clamp(2.2rem, 6vw, 5rem);
        letter-spacing: .02em;
        margin: 0;
        text-transform: uppercase;
        text-shadow: 0 6px 30px rgba(0,0,0,.7);
    }
    .sw-hint {
        position: absolute;
        bottom: 5%;
        left: 50%;
        transform: translateX(-50%);
        font-size: 12px;
        letter-spacing: .3em;
        text-transform: uppercase;
        opacity: .7;
        z-index: 4;
        pointer-events: none;
    }

    /* Info overlay */
    .sw-info {
        position: absolute;
        left: 0; right: 0; bottom: 0;
        padding: 0 4vw 4vh;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        z-index: 5;
        pointer-events: none;
        opacity: 0;
        transition: opacity .35s ease;
    }
    .sw-info.show { opacity: 1; }
    .sw-info > * { transition: transform .45s ease, opacity .35s ease; }
    .sw-info.swap > * { transform: translateY(14px); opacity: 0; }
    .sw-count {
        color: var(--sw-accent);
        font-size: 15px;
        letter-spacing: .12em;
        margin-bottom: 4px;
    }
    .sw-title {
        font-family: 'Anton', Impact, sans-serif;
        font-size: clamp(2.2rem, 8vw, 6.5rem);
        line-height: .95;
        margin: 0;
        text-transform: uppercase;
        text-shadow: 0 6px 30px rgba(0,0,0,.8);
    }
    .sw-right { text-align: right; display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
    .sw-pill {
        padding: 9px 22px;
        border: 1px solid rgba(255,255,255,.4);
        border-radius: 999px;
        font-size: 14px;
        letter-spacing: .06em;
        text-transform: uppercase;
        background: rgba(0,0,0,.45);
        backdrop-filter: blur(6px);
    }
    .sw-meta { opacity: .75; font-size: 15px; }
    .sw-btn {
        pointer-events: auto;
        display: inline-block;
        padding: 18px 44px;
        border-radius: 999px;
        background: #fff;
        color: #000;
        font-weight: 600;
        font-size: 17px;
        text-decoration: none;
        transition: transform .25s ease, background .25s ease;
    }
    .sw-btn:hover { transform: scale(1.06); background: var(--sw-accent); color: #000; }

    /* Progress dots */
    .sw-dots {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 6;
    }
    .sw-dots span {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: rgba(255,255,255,.3);
        transition: .3s;
    }
    .sw-dots span.on { background: var(--sw-accent); transform: scale(1.5); }

    @media (max-width: 768px) {
        .sw-section { --cw: 130px; --ch: 195px; --g: 16px; }
        .sw-info { flex-direction: column; align-items: flex-start; }
        .sw-right { align-items: flex-start; text-align: left; }
        .sw-btn { padding: 13px 30px; font-size: 15px; }
        .sw-dots { right: 8px; }
    }
</style>

<section class="sw-section" id="swSection">
    <div class="sw-sticky">

        <div class="sw-intro" id="swIntro">
            <small>🎬 Now Showing</small>
            <h2>Cinema Wall</h2>
        </div>

        <div class="sw-stage">
            <div class="sw-wall" id="swWall">
                <?php $swIndex = 0; foreach ($swRows as $row): ?>
                    <div class="sw-row">
                        <?php foreach ($row as $m): ?>
                            <div class="sw-card" data-index="<?= $swIndex ?>">
                                <img src="<?= htmlspecialchars($m['img']) ?>"
                                     alt="<?= htmlspecialchars($m['title']) ?>"
                                     draggable="false"
                                     onerror="this.src='https://via.placeholder.com/300x450?text=<?= urlencode($m['title']) ?>'">
                                <span class="sw-rate">⭐ <?= htmlspecialchars($m['rating']) ?></span>
                            </div>
                        <?php $swIndex++; endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="sw-hint" id="swHint">Scroll ↓</div>

        <div class="sw-dots" id="swDots">
            <?php for ($i = 0; $i < $swCount; $i++): ?><span></span><?php endfor; ?>
        </div>

        <div class="sw-info" id="swInfo">
            <div>
                <div class="sw-count" id="swCount">01 / <?= str_pad($swCount, 2, '0', STR_PAD_LEFT) ?></div>
                <h3 class="sw-title" id="swTitle"></h3>
            </div>
            <div class="sw-right">
                <span class="sw-pill" id="swTag"></span>
                <span class="sw-meta" id="swMeta"></span>
                <a href="booking.php" class="sw-btn" id="swBtn">Book Tickets</a>
            </div>
        </div>

    </div>
</section>

<script>
(function () {
    var movies = <?= json_encode(array_values($swMovies), JSON_UNESCAPED_SLASHES) ?>;
    var N = movies.length;

    var section = document.getElementById('swSection');
    var wall    = document.getElementById('swWall');
    var cards   = [].slice.call(wall.querySelectorAll('.sw-card'));
    var intro   = document.getElementById('swIntro');
    var hint    = document.getElementById('swHint');
    var info    = document.getElementById('swInfo');
    var dots    = [].slice.call(document.querySelectorAll('#swDots span'));
    var elCount = document.getElementById('swCount');
    var elTitle = document.getElementById('swTitle');
    var elTag   = document.getElementById('swTag');
    var elMeta  = document.getElementById('swMeta');
    var elBtn   = document.getElementById('swBtn');

    var geo = [], wallScale = 1, focusScale = 1;
    var current = 0, target = 0, shownIdx = -2;

    // wall (slanted) pose
    var WALL_A = 58, WALL_B = -24;

    function clamp(v, a, b) { return Math.max(a, Math.min(b, v)); }
    function lerp(a, b, t)  { return a + (b - a) * t; }
    function ease(t)        { return t * t * (3 - 2 * t); }

    function measure() {
        var ww = wall.offsetWidth, wh = wall.offsetHeight;
        geo = cards.map(function (c) {
            return {
                x: (c.offsetLeft + c.offsetWidth / 2) - ww / 2,
                y: (c.offsetTop + c.offsetHeight / 2) - wh / 2
            };
        });
        var vw = window.innerWidth, vh = window.innerHeight;
        var cw = cards[0].offsetWidth, ch = cards[0].offsetHeight;
        focusScale = Math.min((vw * 0.62) / cw, (vh * 0.68) / ch);
        if (vw < 769) focusScale = Math.min((vw * 0.7) / cw, (vh * 0.52) / ch);
        wallScale = Math.max(0.55, (vw * 1.05) / ww);
    }

    function pose(i) {
        return { a: 0, b: 0, s: focusScale, x: -geo[i].x, y: -geo[i].y };
    }
    var WALL = function () { return { a: WALL_A, b: WALL_B, s: wallScale, x: 0, y: 0 }; };

    function setInfo(idx) {
        if (idx === shownIdx) return;
        shownIdx = idx;
        if (idx < 0) { info.classList.remove('show'); dots.forEach(function (d) { d.classList.remove('on'); }); return; }
        info.classList.add('swap');
        setTimeout(function () {
            var m = movies[idx];
            elCount.textContent = String(idx + 1).padStart(2, '0') + ' / ' + String(N).padStart(2, '0');
            elTitle.textContent = m.title;
            elTag.textContent   = m.tag;
            elMeta.textContent  = '⭐ ' + m.rating + ' / 10';
            elBtn.onclick = function (e) {
                if (typeof window.openMovieDetails === 'function') {
                    e.preventDefault();
                    window.openMovieDetails(m.id);
                }
            };
            info.classList.add('show');
            info.classList.remove('swap');
        }, 180);
        dots.forEach(function (d, i) { d.classList.toggle('on', i === idx); });
    }

    function render(u) {
        var from, to, t, f, wFrom = -1, wTo = 0, idx = -1, dip = 0;

        if (u <= 1) {
            t = ease(clamp(u, 0, 1));
            from = WALL(); to = pose(0);
            f = t; wTo = 0;
            idx = u > 0.6 ? 0 : -1;
        } else {
            var i = Math.min(Math.floor(u), N - 1);
            var frac = u >= N ? 1 : u - Math.floor(u);
            if (u >= N) i = N - 1;
            var k = u >= N ? N - 1 : i;        // target card index
            var p = (u >= N) ? k - 1 : k - 1;  // source card index
            if (u < N) { p = i - 1; k = i; } else { p = N - 2; k = N - 1; frac = 1; }
            t = ease(clamp((frac - 0.2) / 0.6, 0, 1));
            from = pose(p); to = pose(k);
            f = 1; wFrom = p; wTo = k;
            dip = Math.sin(t * Math.PI) * 0.18;
            idx = t > 0.5 ? k : p;
        }

        var a = lerp(from.a, to.a, t), b = lerp(from.b, to.b, t);
        var s = lerp(from.s, to.s, t) * (1 - dip);
        var x = lerp(from.x, to.x, t), y = lerp(from.y, to.y, t);

        wall.style.transform =
            'rotateX(' + a + 'deg) rotateZ(' + b + 'deg) scale(' + s + ') translate3d(' + x + 'px,' + y + 'px,0)';

        cards.forEach(function (c, i) {
            var w = 0;
            if (i === wTo) w = u <= 1 ? t : t;
            if (i === wFrom) w = 1 - t;
            c.style.opacity = (1 - f * (1 - w) * 0.88).toFixed(3);
        });

        intro.style.opacity = clamp(1 - u * 3, 0, 1);
        hint.style.opacity  = clamp(0.7 - u * 3, 0, 0.7);
        setInfo(idx);
    }

    function targetU() {
        var rect = section.getBoundingClientRect();
        var total = section.offsetHeight - window.innerHeight;
        var p = clamp(-rect.top / total, 0, 1);
        // reach last card slightly before section ends so it "holds"
        return clamp(p * (N + 0.4), 0, N);
    }

    function loop() {
        target = targetU();
        current += (target - current) * 0.12;
        if (Math.abs(target - current) < 0.0005) current = target;
        render(current);
        requestAnimationFrame(loop);
    }

    // click a card on the wall -> scroll to its focus point
    cards.forEach(function (c, i) {
        c.addEventListener('click', function () {
            var total = section.offsetHeight - window.innerHeight;
            var top = section.getBoundingClientRect().top + window.pageYOffset;
            var p = (i + 1) / (N + 0.4);
            window.scrollTo({ top: top + p * total, behavior: 'smooth' });
        });
    });

    window.addEventListener('resize', measure);
    window.addEventListener('load', measure);
    measure();
    loop();
})();
</script>