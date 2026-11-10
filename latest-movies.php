<?php include 'header.php'; ?>

<!-- =========================================================
     WATCHMODE AUTOMATED MOVIES
     ========================================================= -->

<?php

/*
 * Watchmode is used only for the automated
 * Latest Movies and OTT sections.
 *
 * Other website sections remain independent.
 */

require_once __DIR__ . '/config/watchmode.php';

/*
 * Latest Movies
 */
$latestMovies = sairamWatchmodeLatestMovies(15);

/*
 * OTT Movies
 */
$latestOttMovies = sairamWatchmodeOttMovies(15);

?>


<!-- =========================================================
     LATEST MOVIES
     ========================================================= -->

<section class="movie_section latest_section py-5 bg-light">

    <div class="movie_container">

        <div class="section_header">

            <div>

                <span class="section_subtitle">
                    🎥 Just Released
                </span>

                <h2 class="section_title">
                    Latest Movies
                </h2>

            </div>


            <a href="#" class="view_all">

                View All

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>


        <div class="swiper latestSwiperDesktop">

            <div class="swiper-wrapper">


                <?php if (!empty($latestMovies)): ?>


                    <?php foreach ($latestMovies as $movie): ?>

                        <?php

                        /*
                         * -------------------------------------------------
                         * WATCHMODE MOVIE DATA
                         * -------------------------------------------------
                         */

                        $watchmodeId = (int) (
                            $movie['id']
                            ?? $movie['watchmode_id']
                            ?? 0
                        );


                        /*
                         * Watchmode also provides TMDB ID.
                         * We keep it only for compatibility with
                         * the existing booking.php system.
                         */

                        $tmdbId = (int) (
                            $movie['tmdb_id']
                            ?? 0
                        );


                        /*
                         * Movie title
                         */

                        $movieTitleRaw =
                            $movie['title']
                            ?? $movie['original_title']
                            ?? $movie['name']
                            ?? 'Untitled Movie';


                        $movieTitle = htmlspecialchars(
                            $movieTitleRaw,
                            ENT_QUOTES,
                            'UTF-8'
                        );


                        /*
                         * Language
                         */

                        $languageLabel =
                            $movie['_sairam_language']
                            ?? $movie['language']
                            ?? 'Movie';


                        /*
                         * Watchmode poster
                         */

                        $posterUrl = trim((string) (
                            $movie['poster_url']
                            ?? $movie['poster']
                            ?? $movie['image_url']
                            ?? $movie['thumbnail_url']
                            ?? ''
                        ));


                        if ($posterUrl === '') {

                            $posterUrl =
                                'https://placehold.co/500x750/0b0b0b/d6aa3d?text=No+Poster';

                        }


                        /*
                         * Rating
                         */

                        $ratingValue =
                            $movie['user_rating']
                            ?? $movie['rating']
                            ?? $movie['vote_average']
                            ?? null;


                        $rating =
                            is_numeric($ratingValue)
                            && (float) $ratingValue > 0
                                ? number_format(
                                    (float) $ratingValue,
                                    1
                                )
                                : 'New';


                        /*
                         * Genre
                         */

                        if (!empty($movie['genre_text'])) {

                            $genreText = $movie['genre_text'];

                        } elseif (!empty($movie['_sairam_genres'])) {

                            $genreText = $movie['_sairam_genres'];

                        } elseif (
                            !empty($movie['genres'])
                            && is_array($movie['genres'])
                        ) {

                            $genreNames = [];

                            foreach (
                                array_slice($movie['genres'], 0, 3)
                                as $genre
                            ) {

                                if (is_array($genre)) {

                                    $genreNames[] =
                                        $genre['name']
                                        ?? $genre['title']
                                        ?? '';

                                } else {

                                    $genreNames[] = (string) $genre;

                                }

                            }

                            $genreText = implode(
                                ' • ',
                                array_filter($genreNames)
                            );

                        } else {

                            $genreText = 'Movie';

                        }


                        if ($genreText === '') {

                            $genreText = 'Movie';

                        }


                        /*
                         * Booking URL
                         *
                         * Keep tmdb_id when available so your
                         * existing booking.php remains compatible.
                         */

                        $bookingParams = [

                            'movie' =>
                                $movieTitleRaw,

                            'language' =>
                                $languageLabel

                        ];


                        if ($tmdbId > 0) {

                            $bookingParams['tmdb_id'] =
                                $tmdbId;

                        }


                        if ($watchmodeId > 0) {

                            $bookingParams['watchmode_id'] =
                                $watchmodeId;

                        }


                        $bookingUrl =
                            'booking.php?' .
                            http_build_query(
                                $bookingParams
                            );

                        ?>


                        <div class="swiper-slide">

                            <div
                                class="movie_card movie-card-clickable"
                                data-movie-id="watchmode-<?php echo $watchmodeId; ?>"
                                tabindex="0"
                                role="button"
                                onclick="window.location.href='<?php echo htmlspecialchars($bookingUrl, ENT_QUOTES, 'UTF-8'); ?>';"
                            >

                                <div class="movie_image">

                                    <img
                                        src="<?php echo htmlspecialchars($posterUrl, ENT_QUOTES, 'UTF-8'); ?>"
                                        class="img-fluid"
                                        alt="<?php echo $movieTitle; ?>"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.src='https://placehold.co/500x750/0b0b0b/d6aa3d?text=No+Poster';"
                                    >


                                    <span class="movie_rating">

                                        ⭐
                                        <?php
                                        echo htmlspecialchars(
                                            $rating,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                        ?>

                                    </span>

                                </div>


                                <div class="movie_content">

                                    <h4 class="movie_title">

                                        <?php
                                        echo $movieTitle;
                                        ?>

                                    </h4>


                                    <p class="movie_genre">

                                        <?php
                                        echo htmlspecialchars(
                                            $genreText,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                        ?>

                                    </p>


                                    <a
                                        href="<?php echo htmlspecialchars($bookingUrl, ENT_QUOTES, 'UTF-8'); ?>"
                                        class="book_movie_btn"
                                        onclick="event.stopPropagation();"
                                    >
                                        Book Tickets
                                    </a>

                                </div>

                            </div>

                        </div>


                    <?php endforeach; ?>


                <?php else: ?>


                    <div class="swiper-slide">

                        <div class="movie_card">

                            <div class="movie_content">

                                <h4 class="movie_title">
                                    Latest Movies
                                </h4>

                                <p class="movie_genre mb-0">
                                    Watchmode is currently unavailable.
                                    Please check your
                                    config/watchmode.php API key.
                                </p>

                            </div>

                        </div>

                    </div>


                <?php endif; ?>


            </div>


            <div class="swiper-button-next"></div>

            <div class="swiper-button-prev"></div>

            <div class="swiper-pagination"></div>

        </div>

    </div>

</section>



<!-- =========================================================
     NOW STREAMING ON OTT
     AUTOMATED FROM WATCHMODE
     ========================================================= -->

<section class="movie_section ott_section py-5 bg-white">

    <div class="movie_container">


        <div class="section_header">

            <div>

                <span class="section_subtitle">
                    📺 Streaming Now
                </span>

                <h2 class="section_title">
                    Now Streaming on OTT
                </h2>

            </div>


            <a href="#" class="view_all">

                View All

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>



        <div class="swiper ottSwiperDesktop">

            <div class="swiper-wrapper">


                <?php if (!empty($latestOttMovies)): ?>


                    <?php foreach ($latestOttMovies as $movie): ?>

                        <?php

                        /*
                         * -------------------------------------------------
                         * WATCHMODE OTT DATA
                         * -------------------------------------------------
                         */

                        $watchmodeId = (int) (
                            $movie['id']
                            ?? $movie['watchmode_id']
                            ?? 0
                        );


                        $tmdbId = (int) (
                            $movie['tmdb_id']
                            ?? 0
                        );


                        /*
                         * Movie title
                         */

                        $movieTitleRaw =
                            $movie['title']
                            ?? $movie['original_title']
                            ?? $movie['name']
                            ?? 'Untitled Movie';


                        $movieTitle = htmlspecialchars(
                            $movieTitleRaw,
                            ENT_QUOTES,
                            'UTF-8'
                        );


                        /*
                         * Language
                         */

                        $languageLabel =
                            $movie['_sairam_language']
                            ?? $movie['language']
                            ?? 'Movie';


                        /*
                         * Poster
                         */

                        $posterUrl = trim((string) (
                            $movie['poster_url']
                            ?? $movie['poster']
                            ?? $movie['image_url']
                            ?? $movie['thumbnail_url']
                            ?? ''
                        ));


                        if ($posterUrl === '') {

                            $posterUrl =
                                'https://placehold.co/500x750/0b0b0b/d6aa3d?text=No+Poster';

                        }


                        /*
                         * Rating
                         */

                        $ratingValue =
                            $movie['user_rating']
                            ?? $movie['rating']
                            ?? $movie['vote_average']
                            ?? null;


                        $rating =
                            is_numeric($ratingValue)
                            && (float) $ratingValue > 0
                                ? number_format(
                                    (float) $ratingValue,
                                    1
                                )
                                : 'New';


                        /*
                         * Genre
                         */

                        if (!empty($movie['genre_text'])) {

                            $genreText =
                                $movie['genre_text'];

                        } elseif (
                            !empty($movie['_sairam_genres'])
                        ) {

                            $genreText =
                                $movie['_sairam_genres'];

                        } elseif (
                            !empty($movie['genres'])
                            && is_array($movie['genres'])
                        ) {

                            $genreNames = [];

                            foreach (
                                array_slice(
                                    $movie['genres'],
                                    0,
                                    3
                                ) as $genre
                            ) {

                                if (is_array($genre)) {

                                    $genreNames[] =
                                        $genre['name']
                                        ?? $genre['title']
                                        ?? '';

                                } else {

                                    $genreNames[] =
                                        (string) $genre;

                                }

                            }


                            $genreText =
                                implode(
                                    ' • ',
                                    array_filter(
                                        $genreNames
                                    )
                                );

                        } else {

                            $genreText = 'Movie';

                        }


                        if ($genreText === '') {

                            $genreText = 'Movie';

                        }


                        /*
                         * Streaming link
                         */

                        $watchLink = trim((string) (
                            $movie['_sairam_watch_link']
                            ?? $movie['watch_link']
                            ?? $movie['web_url']
                            ?? ''
                        ));


                        /*
                         * Providers
                         */

                        $providers =
                            $movie['_sairam_providers']
                            ?? $movie['providers']
                            ?? [];


                        /*
                         * If providers are returned as a
                         * single associative array, normalize them.
                         */

                        if (
                            !empty($providers)
                            && isset($providers['name'])
                        ) {

                            $providers = [$providers];

                        }

                        ?>


                        <div class="swiper-slide">

                            <div class="movie_card">


                                <div class="movie_image">

                                    <img
                                        src="<?php echo htmlspecialchars($posterUrl, ENT_QUOTES, 'UTF-8'); ?>"
                                        class="img-fluid"
                                        alt="<?php echo $movieTitle; ?>"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.src='https://placehold.co/500x750/0b0b0b/d6aa3d?text=No+Poster';"
                                    >


                                    <span class="movie_rating">

                                        ⭐
                                        <?php
                                        echo htmlspecialchars(
                                            $rating,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                        ?>

                                    </span>

                                </div>



                                <div class="movie_content">


                                    <h4 class="movie_title">

                                        <?php
                                        echo $movieTitle;
                                        ?>

                                    </h4>


                                    <p class="movie_genre">

                                        <?php
                                        echo htmlspecialchars(
                                            $genreText,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                        ?>

                                    </p>



                                    <!-- =================================================
                                         WATCHMODE OTT PROVIDER LOGOS
                                         ================================================= -->

                                    <div
                                        class="d-flex align-items-center flex-wrap gap-2 mb-3"
                                        aria-label="Streaming providers"
                                    >


                                        <?php
                                        foreach (
                                            array_slice(
                                                $providers,
                                                0,
                                                4
                                            )
                                            as $provider
                                        ):
                                        ?>

                                            <?php

                                            if (!is_array($provider)) {
                                                continue;
                                            }


                                            $providerName =
                                                htmlspecialchars(
                                                    $provider['name']
                                                    ?? $provider['source_name']
                                                    ?? 'OTT',
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                );


                                            /*
                                             * Watchmode source logos
                                             */

                                            $providerLogo =
                                                trim((string) (
                                                    $provider['logo_100px']
                                                    ?? $provider['logo_url']
                                                    ?? $provider['logo']
                                                    ?? ''
                                                ));

                                            ?>


                                            <?php if ($providerLogo !== ''): ?>

                                                <img
                                                    src="<?php echo htmlspecialchars($providerLogo, ENT_QUOTES, 'UTF-8'); ?>"
                                                    alt="<?php echo $providerName; ?>"
                                                    title="<?php echo $providerName; ?>"
                                                    width="30"
                                                    height="30"
                                                    loading="lazy"
                                                    style="
                                                        width:30px;
                                                        height:30px;
                                                        object-fit:cover;
                                                        border-radius:8px;
                                                        border:1px solid rgba(214,170,61,.28);
                                                    "
                                                >

                                            <?php endif; ?>


                                        <?php endforeach; ?>


                                    </div>



                                    <!-- =================================================
                                         WATCHMODE STREAMING BUTTON
                                         ================================================= -->

                                    <?php if ($watchLink !== ''): ?>

                                        <a
                                            href="<?php echo htmlspecialchars($watchLink, ENT_QUOTES, 'UTF-8'); ?>"
                                            class="book_movie_btn"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            View Streaming Options
                                        </a>

                                    <?php else: ?>

                                        <span
                                            class="book_movie_btn"
                                            style="display:inline-block;"
                                        >
                                            Streaming Info
                                        </span>

                                    <?php endif; ?>


                                </div>

                            </div>

                        </div>


                    <?php endforeach; ?>


                <?php else: ?>


                    <div class="swiper-slide">

                        <div class="movie_card">

                            <div class="movie_content">

                                <h4 class="movie_title">
                                    OTT Movies
                                </h4>

                                <p class="movie_genre mb-0">
                                    Watchmode is currently unavailable.
                                    Please check your
                                    config/watchmode.php API key.
                                </p>

                            </div>

                        </div>

                    </div>


                <?php endif; ?>


            </div>


            <div class="swiper-button-next"></div>

            <div class="swiper-button-prev"></div>

            <div class="swiper-pagination"></div>

        </div>


        <p
            class="small text-muted mt-2 mb-0"
            style="font-size:11px;"
        >
            Streaming availability powered by Watchmode.
        </p>


    </div>

</section>



<!-- =========================================================
     COMBINED SWIPER INITIALIZATION
     ========================================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {


    const swiperConfig = {

        slidesPerView: 1,

        spaceBetween: 20,

        breakpoints: {

            576: {
                slidesPerView: 2,
                spaceBetween: 20
            },

            768: {
                slidesPerView: 3,
                spaceBetween: 20
            },

            992: {
                slidesPerView: 4,
                spaceBetween: 24
            },

            1200: {
                slidesPerView: 5,
                spaceBetween: 24
            }

        }

    };



    /*
     * =========================================================
     * LATEST MOVIES SWIPER
     * =========================================================
     */

    if (
        typeof Swiper !== 'undefined'
        &&
        document.querySelector(
            '.latestSwiperDesktop'
        )
    ) {

        new Swiper(
            '.latestSwiperDesktop',
            {

                ...swiperConfig,

                navigation: {

                    nextEl:
                        '.latestSwiperDesktop .swiper-button-next',

                    prevEl:
                        '.latestSwiperDesktop .swiper-button-prev'

                },

                pagination: {

                    el:
                        '.latestSwiperDesktop .swiper-pagination',

                    clickable: true

                }

            }
        );

    }



    /*
     * =========================================================
     * OTT MOVIES SWIPER
     * =========================================================
     */

    if (
        typeof Swiper !== 'undefined'
        &&
        document.querySelector(
            '.ottSwiperDesktop'
        )
    ) {

        new Swiper(
            '.ottSwiperDesktop',
            {

                ...swiperConfig,

                navigation: {

                    nextEl:
                        '.ottSwiperDesktop .swiper-button-next',

                    prevEl:
                        '.ottSwiperDesktop .swiper-button-prev'

                },

                pagination: {

                    el:
                        '.ottSwiperDesktop .swiper-pagination',

                    clickable: true

                }

            }
        );

    }

});

</script>


<?php include 'footer.php'; ?>