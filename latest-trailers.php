<?php
include('header.php');

/*
|--------------------------------------------------------------------------
| WATCHMODE CONFIG
|--------------------------------------------------------------------------
| Latest Trailers data is now fetched from Watchmode.
*/
$watchmodeConfig = __DIR__ . '/config/watchmode.php';

if (file_exists($watchmodeConfig)) {
    require_once $watchmodeConfig;
}

/*
|--------------------------------------------------------------------------
| WATCHMODE TRAILER DATA
|--------------------------------------------------------------------------
*/
$trailerTab = strtolower(trim($_GET['tab'] ?? 'popular'));

$allowedTabs = [
    'popular',
    'streaming',
    'ontv',
    'rent',
    'theaters'
];

if (!in_array($trailerTab, $allowedTabs, true)) {
    $trailerTab = 'popular';
}

/*
|--------------------------------------------------------------------------
| FETCH TRAILERS FROM WATCHMODE
|--------------------------------------------------------------------------
*/
$trailerMovies = [];

if (
    function_exists('sairamWatchmodeLatestTrailers') &&
    function_exists('sairamWatchmodeConfigured') &&
    sairamWatchmodeConfigured()
) {
    $trailerMovies = sairamWatchmodeLatestTrailers(
        10,
        $trailerTab
    );
}

/*
|--------------------------------------------------------------------------
| SAFETY
|--------------------------------------------------------------------------
*/
if (!is_array($trailerMovies)) {
    $trailerMovies = [];
}
?>

<!-- =========================================================
     WATCHMODE LATEST TRAILERS
========================================================= -->

<style>
.latest-trailers-gold-wrapper {
    width: 100%;
    background: #08080c !important;
    color: #ffffff !important;
    padding: 45px 0 !important;
    font-family: system-ui, -apple-system, sans-serif !important;
}

.latest-trailers-gold-wrapper .trailers-container {
    max-width: 1350px;
    margin: 0 auto;
    padding: 0 20px;
}

.latest-trailers-gold-wrapper .trailers-header {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 25px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.latest-trailers-gold-wrapper .trailers-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: #ffffff;
    margin: 0;
}

.latest-trailers-gold-wrapper .tab-selector-pill {
    display: flex;
    align-items: center;
    background: #121216;
    border: 1px solid rgba(212, 175, 55, 0.4);
    border-radius: 50px;
    padding: 3px;
    overflow-x: auto;
    max-width: 100%;
}

.latest-trailers-gold-wrapper .tab-btn {
    padding: 6px 20px;
    border-radius: 50px;
    color: #cccccc;
    font-size: 0.88rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.latest-trailers-gold-wrapper .tab-btn:hover {
    color: #d4af37;
}

.latest-trailers-gold-wrapper .tab-btn.active {
    background: linear-gradient(
        135deg,
        #d4af37 0%,
        #f39c12 100%
    );
    color: #000000 !important;
    font-weight: 700;
    box-shadow: 0 0 12px rgba(212, 175, 55, 0.5);
}

.latest-trailers-gold-wrapper .scroller-track {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    padding-bottom: 25px;
    scroll-behavior: smooth;
}

.latest-trailers-gold-wrapper .scroller-track::-webkit-scrollbar {
    height: 7px;
}

.latest-trailers-gold-wrapper .scroller-track::-webkit-scrollbar-track {
    background: #121216;
    border-radius: 10px;
}

.latest-trailers-gold-wrapper .scroller-track::-webkit-scrollbar-thumb {
    background: #d4af37;
    border-radius: 10px;
}

.latest-trailers-gold-wrapper .trailer-card {
    flex: 0 0 310px;
    width: 310px;
    display: flex;
    flex-direction: column;
    cursor: pointer;
    text-decoration: none;
}

.latest-trailers-gold-wrapper .card-thumbnail {
    position: relative;
    width: 100%;
    height: 175px;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid rgba(212, 175, 55, 0.25);
    background-color: #000000;
    transition: all 0.3s ease;
}

.latest-trailers-gold-wrapper .trailer-card:hover .card-thumbnail {
    transform: translateY(-4px);
    border-color: #d4af37;
    box-shadow: 0 6px 20px rgba(212, 175, 55, 0.35);
}

.latest-trailers-gold-wrapper .backdrop-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.latest-trailers-gold-wrapper .card-options-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.6);
    color: #ffffff;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    z-index: 3;
}

.latest-trailers-gold-wrapper .play-btn-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50px;
    height: 50px;
    background: rgba(0, 0, 0, 0.5);
    border: 2px solid #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 1.6rem;
    transition: all 0.3s ease;
    z-index: 2;
}

.latest-trailers-gold-wrapper .trailer-card:hover .play-btn-overlay {
    background: #d4af37;
    border-color: #d4af37;
    color: #000000;
    transform: translate(-50%, -50%) scale(1.15);
}

.latest-trailers-gold-wrapper .card-meta {
    padding-top: 10px;
    text-align: center;
}

.latest-trailers-gold-wrapper .movie-title {
    color: #ffffff;
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.latest-trailers-gold-wrapper .trailer-subtitle {
    color: #a0a0a0;
    font-size: 0.82rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: 0;
}

/* Empty / Error */
.latest-trailers-gold-wrapper .watchmode-empty {
    width: 100%;
    padding: 35px 20px;
    border: 1px solid rgba(212, 175, 55, 0.25);
    border-radius: 12px;
    background: #101014;
    color: #d4af37;
    text-align: center;
}

.latest-trailers-gold-wrapper .watchmode-empty i {
    font-size: 2rem;
    margin-bottom: 10px;
    display: block;
}

.latest-trailers-gold-wrapper .watchmode-empty strong {
    color: #ffffff;
    display: block;
    margin-bottom: 5px;
}

.latest-trailers-gold-wrapper .watchmode-empty small {
    color: #999999;
}

/* Modal */
.trailers-gold-modal .modal-content {
    background-color: #0c0c10 !important;
    border: 1px solid #d4af37 !important;
    border-radius: 12px !important;
    overflow: hidden;
}

.trailers-gold-modal .modal-header {
    border-bottom: 1px solid rgba(212, 175, 55, 0.3) !important;
}

.trailers-gold-modal .modal-title {
    color: #d4af37 !important;
    font-weight: 700;
}

.trailers-gold-modal .modal-body {
    background: #000000;
}

/* Mobile */
@media (max-width: 767px) {

    .latest-trailers-gold-wrapper {
        padding: 30px 0 !important;
    }

    .latest-trailers-gold-wrapper .trailers-container {
        padding: 0 15px;
    }

    .latest-trailers-gold-wrapper .trailers-header {
        gap: 15px;
        margin-bottom: 20px;
    }

    .latest-trailers-gold-wrapper .trailers-title {
        font-size: 1.45rem;
        width: 100%;
    }

    .latest-trailers-gold-wrapper .tab-selector-pill {
        width: 100%;
        justify-content: flex-start;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .latest-trailers-gold-wrapper .tab-selector-pill::-webkit-scrollbar {
        display: none;
    }

    .latest-trailers-gold-wrapper .tab-btn {
        padding: 6px 15px;
        font-size: 0.82rem;
    }

    .latest-trailers-gold-wrapper .trailer-card {
        flex: 0 0 270px;
        width: 270px;
    }

    .latest-trailers-gold-wrapper .card-thumbnail {
        height: 152px;
    }

    .latest-trailers-gold-wrapper .movie-title {
        font-size: 0.95rem;
    }

    .latest-trailers-gold-wrapper .trailer-subtitle {
        font-size: 0.78rem;
    }
}
</style>


<!-- =========================================================
     MAIN LAYOUT
========================================================= -->

<div class="latest-trailers-gold-wrapper">

    <div class="trailers-container">

        <!-- HEADER + TABS -->
        <div class="trailers-header">

            <h2 class="trailers-title">
                Latest Trailers
            </h2>

            <div class="tab-selector-pill">

                <?php
                $tabs = [
                    'popular'   => 'Popular',
                    'streaming' => 'Streaming',
                    'ontv'      => 'On TV',
                    'rent'      => 'For Rent',
                    'theaters'  => 'In Theaters'
                ];

                foreach ($tabs as $tKey => $tName):

                    $isActive = (
                        $trailerTab === $tKey
                    ) ? 'active' : '';

                ?>

                    <a
                        href="?tab=<?php echo urlencode($tKey); ?>"
                        class="tab-btn <?php echo $isActive; ?>"
                    >
                        <?php echo htmlspecialchars($tName); ?>
                    </a>

                <?php endforeach; ?>

            </div>

        </div>


        <!-- =================================================
             TRAILER SCROLLER
        ================================================== -->

        <div id="trailerScroller" class="scroller-track">

            <?php if (!empty($trailerMovies)): ?>

                <?php foreach ($trailerMovies as $idx => $movie): ?>

                    <?php

                    /*
                    |--------------------------------------------------------------------------
                    | SAFE MOVIE VALUES
                    |--------------------------------------------------------------------------
                    */

                    $movieTitle = trim(
                        $movie['title']
                        ?? $movie['name']
                        ?? 'Untitled Movie'
                    );

                    $backdrop = trim(
    $movie['_sairam_trailer_thumbnail']
    ?? $movie['trailer_thumbnail']
    ?? $movie['backdrop']
    ?? $movie['backdrop_url']
    ?? $movie['poster_url']
    ?? $movie['poster']
    ?? $movie['image']
    ?? ''
);

                    $subtitle = trim(
    $movie['_sairam_trailer_category']
    ?? $movie['subtitle']
    ?? $movie['trailer_name']
    ?? 'Official Trailer'
);

                    $youtubeKey = trim(
                        $movie['youtube_key']
                        ?? $movie['youtube']
                        ?? ''
                    );

                    $embedUrl = '';

                    /*
                    |--------------------------------------------------------------------------
                    | USE WATCHMODE TRAILER EMBED HELPER
                    |--------------------------------------------------------------------------
                    */

                    if (
                        function_exists('sairamWatchmodeTrailerEmbedUrl')
                    ) {

                        $embedUrl = sairamWatchmodeTrailerEmbedUrl(
                            $movie
                        );

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | FALLBACK IF HELPER RETURNS EMPTY
                    |--------------------------------------------------------------------------
                    */

                    if (
                        empty($embedUrl) &&
                        !empty($youtubeKey)
                    ) {

                        $embedUrl =
                            'https://www.youtube-nocookie.com/embed/' .
                            rawurlencode($youtubeKey) .
                            '?autoplay=1&rel=0';

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | MODAL ID
                    |--------------------------------------------------------------------------
                    */

                    $modalId =
                        'watchmodeTrailerModal_' .
                        $idx .
                        '_' .
                        preg_replace(
                            '/[^a-zA-Z0-9]/',
                            '',
                            (string)($movie['id'] ?? $idx)
                        );

                    ?>

                    <!-- =========================================
                         TRAILER CARD
                    ========================================== -->

                    <div
                        class="trailer-card"
                        data-bs-toggle="modal"
                        data-bs-target="#<?php echo htmlspecialchars($modalId); ?>"
                    >

                        <div class="card-thumbnail">

                            <?php if (!empty($backdrop)): ?>

                                <img
                                    class="backdrop-img"
                                    src="<?php echo htmlspecialchars($backdrop); ?>"
                                    alt="<?php echo htmlspecialchars($movieTitle); ?>"
                                    loading="lazy"
                                >

                            <?php else: ?>

                                <div
                                    style="
                                        width:100%;
                                        height:100%;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        color:#777;
                                        background:#111;
                                    "
                                >
                                    <i class="bi bi-film" style="font-size:2.5rem;"></i>
                                </div>

                            <?php endif; ?>


                            <!-- OPTIONS -->

                            <div class="card-options-btn">
                                <i class="bi bi-three-dots"></i>
                            </div>


                            <!-- PLAY -->

                            <div class="play-btn-overlay">
                                <i class="bi bi-play-fill"></i>
                            </div>

                        </div>


                        <!-- META -->

                        <div class="card-meta">

                            <div class="movie-title">
                                <?php
                                echo htmlspecialchars(
                                    $movieTitle
                                );
                                ?>
                            </div>

                            <p class="trailer-subtitle">
                                <?php
                                echo htmlspecialchars(
                                    $subtitle
                                );
                                ?>
                            </p>

                        </div>

                    </div>


                    <!-- =========================================
                         VIDEO MODAL
                    ========================================== -->

                    <div
                        class="modal fade trailers-gold-modal"
                        id="<?php echo htmlspecialchars($modalId); ?>"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div
                            class="modal-dialog modal-lg modal-dialog-centered"
                        >

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">
                                        <?php
                                        echo htmlspecialchars(
                                            $movieTitle
                                        );
                                        ?>
                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>

                                </div>


                                <div class="modal-body p-0">

                                    <?php if (!empty($embedUrl)): ?>

                                        <div class="ratio ratio-16x9">

                                            <iframe
                                                data-src="<?php echo htmlspecialchars($embedUrl); ?>"
                                                allowfullscreen
                                                allow="autoplay; encrypted-media; picture-in-picture"
                                                loading="lazy"
                                            ></iframe>

                                        </div>

                                    <?php else: ?>

                                        <div
                                            style="
                                                min-height:220px;
                                                display:flex;
                                                align-items:center;
                                                justify-content:center;
                                                flex-direction:column;
                                                color:#aaa;
                                                text-align:center;
                                                padding:30px;
                                            "
                                        >

                                            <i
                                                class="bi bi-play-circle"
                                                style="
                                                    font-size:3rem;
                                                    color:#d4af37;
                                                    margin-bottom:10px;
                                                "
                                            ></i>

                                            <strong
                                                style="color:#ffffff;"
                                            >
                                                Trailer not available
                                            </strong>

                                            <small>
                                                Watchmode did not return a
                                                playable trailer for this title.
                                            </small>

                                        </div>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>


            <?php else: ?>

                <!-- =========================================
                     EMPTY STATE
                ========================================== -->

                <div class="watchmode-empty">

                    <i class="bi bi-film"></i>

                    <strong>
                        No trailers available right now.
                    </strong>

                    <small>
                        Please check your Watchmode API key,
                        region settings, or try another tab.
                    </small>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | HORIZONTAL AUTO SCROLL
    |--------------------------------------------------------------------------
    */

    const scroller =
        document.getElementById('trailerScroller');

    let isHovered = false;

    if (scroller) {

        scroller.addEventListener(
            'mouseenter',
            function () {
                isHovered = true;
            }
        );

        scroller.addEventListener(
            'mouseleave',
            function () {
                isHovered = false;
            }
        );


        setInterval(function () {

            /*
            | Don't auto-scroll when user is interacting
            */

            if (!isHovered) {

                if (
                    scroller.scrollLeft +
                    scroller.clientWidth >=
                    scroller.scrollWidth - 1
                ) {

                    scroller.scrollLeft = 0;

                } else {

                    scroller.scrollLeft += 0.8;

                }

            }

        }, 25);

    }


    /*
    |--------------------------------------------------------------------------
    | BOOTSTRAP MODAL
    |--------------------------------------------------------------------------
    | Load YouTube iframe only when modal opens.
    */

    document
        .querySelectorAll('.trailers-gold-modal')
        .forEach(function (modal) {

            modal.addEventListener(
                'show.bs.modal',
                function () {

                    const iframe =
                        modal.querySelector(
                            'iframe[data-src]'
                        );

                    if (
                        iframe &&
                        !iframe.getAttribute('src')
                    ) {

                        iframe.setAttribute(
                            'src',
                            iframe.getAttribute('data-src')
                        );

                    }

                }
            );


            /*
            | Stop YouTube video when modal closes
            */

            modal.addEventListener(
                'hidden.bs.modal',
                function () {

                    const iframe =
                        modal.querySelector('iframe');

                    if (iframe) {

                        iframe.setAttribute(
                            'src',
                            ''
                        );

                    }

                }
            );

        });

});

</script>


<?php include('footer.php'); ?>