<?php

include 'header.php';

require_once __DIR__ . '/config/watchmode.php';

/*
 * =========================================================
 * WATCHMODE AUTOMATIC CONTENT
 * =========================================================
 */

/*
 * Latest Movies
 *
 * Telugu
 * +
 * English Action / Horror / Sci-Fi / Adventure /
 * Superhero related
 */
$latestMovies =
    sairamWatchmodeLatestMovies(15);


/*
 * OTT
 *
 * JioHotstar Telugu content
 * +
 * Netflix / Prime Video Action / Thriller /
 * Sci-Fi / Adventure / Horror / Sport etc.
 */
$latestOttMovies =
    sairamWatchmodeOttMovies(15);

?>

    <!-- =========================================================
         HERO SECTION START
         ========================================================= -->

    <!-- <section class="hero_section_light py-5">

        <div class="container">

            <div class="hero_wrapper row align-items-center g-4">


                Hero Left
                <div class="hero_left col-12 col-lg-7 text-start">

                    <div class="d-inline-flex align-items-center gap-2 trust_badge mb-3 px-3 py-2 rounded-pill bg-white shadow-sm border">

                        <i class="bi bi-star-fill text-warning"></i>

                        <span class="fw-semibold text-dark">
                            Trusted by 75,000+ Movie Lovers
                        </span>

                        <i class="bi bi-chevron-down text-muted small"></i>

                    </div>


                    <h1 class="hero_main_title fw-bold mb-3">

                        Book Your Favourite Movies

                        <span class="text-primary">
                            Anytime, Anywhere.
                        </span>

                    </h1>


                    <p class="hero_description text-secondary mb-4">

                        Discover the latest blockbusters, choose your favourite seats,
                        explore cast & crew, and enjoy a smooth booking experience
                        with Sairam Movie Hub.

                    </p>


                    Hero Search
                    <div class="hero_search input-group mb-4 shadow-sm rounded-3 overflow-hidden">

                        <input type="text"
                               class="form-control border-end-0 py-3 px-3"
                               placeholder="Search movies, theatres or actors...">

                        <button class="btn btn-primary px-4"
                                type="button">

                            <i class="bi bi-search"></i>

                        </button>

                    </div>


                    Hero Buttons
<div class="d-flex flex-column gap-3 mb-4">

    Book Movie Tickets
    <a href="booking.php"
       class="btn btn-primary primary_hero_btn py-3 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm">

        <i class="bi bi-ticket-perforated-fill"></i>

        Book Movie Tickets

    </a>


    Watch Trailer
    <a href="latest-trailers.php"
       class="btn btn-outline-primary secondary_hero_btn py-3 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2 bg-white">

        <i class="bi bi-play-circle-fill"></i>

        Watch Trailer

    </a>

</div>


                    Hero Stats
                    <div class="hero_stats row text-center pt-3 border-top g-2">

                        <div class="col-4">

                            <h3 class="fw-bold mb-0 text-primary">
                                250+
                            </h3>

                            <p class="text-muted small mb-0">
                                Movies
                            </p>

                        </div>


                        <div class="col-4">

                            <h3 class="fw-bold mb-0 text-primary">
                                120+
                            </h3>

                            <p class="text-muted small mb-0">
                                Theatres
                            </p>

                        </div>


                        <div class="col-4">

                            <h3 class="fw-bold mb-0 text-primary">
                                10K+
                            </h3>

                            <p class="text-muted small mb-0">
                                Bookings
                            </p>

                        </div>

                    </div>

                </div>


                Hero Right
                <div class="hero_right col-12 col-lg-5 text-center">

                    <div class="hero_image_wrapper position-relative d-inline-block">

                        <img
                            src="assets/images/movies/hero_movie.png"
                            class="img-fluid rounded-4 shadow-lg hero_movie"
                            alt="Hero Movie"
                            onerror="this.src='https://via.placeholder.com/320x450'">


                    
                    </div>

                </div>

            </div>

        </div>

    </section> -->



    <!-- =========================================================
         HERO SECTION START (Auto Home Slider Carousel)
         ========================================================= -->

    <section class="hero_section_dark position-relative overflow-hidden">

        <!-- Background Auto Slider Carousel (1700x500px) -->
        <div class="swiper heroBgSwiper">
            <div class="swiper-wrapper">

                <!-- Slide 1: INOX Cinema Background Image -->
                <div class="swiper-slide">
                    <div class="slider-item">
                        <img src="assets/images/movies/Movie-theatre-bg.png" 
                             class="img-fluid hero_slider_img" 
                             alt="INOX Cinema Background">
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="slider-item">
                        <img src="assets/images/movies/Movies-bg.png" 
                             class="img-fluid hero_slider_img" 
                             alt="Movie Banner 2">
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="slider-item">
                        <img src="assets/images/movies/Trailers-bg.png" 
                             class="img-fluid hero_slider_img" 
                             alt="Movie Banner 3">
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="slider-item">
                        <img src="assets/images/movies/3d-experience-bg.png" 
                             class="img-fluid hero_slider_img" 
                             alt="Movie Banner 3">
                    </div>
                </div>

            </div>

            <!-- Carousel Pagination Bullets -->
            <div class="swiper-pagination hero-swiper-pagination"></div>
        </div>

        <!-- Dark Theater Overlay Gradient -->
        <!-- <div class="hero_dark_overlay"></div> -->

        <!-- Hero Overlay Content -->
        <div class="hero_content_wrapper position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
            <div class="container">
                <div class="hero_wrapper row align-items-center g-4">

                    <!-- Hero Content Left -->
                    <div class="hero_left col-12 col-lg-7 text-start">

                        <!-- Trust Badge -->
                        <!-- <div class="d-inline-flex align-items-center gap-2 trust_badge_dark mb-3 px-3 py-2 rounded-pill shadow-sm">
                            <i class="bi bi-star-fill text-gold"></i>
                            <span class="fw-semibold text-white">
                                Trusted by 75,000+ Movie Lovers
                            </span>
                            <i class="bi bi-chevron-down text-white-50 small"></i>
                        </div> -->

                        <!-- Main Title -->
                        <!-- <h1 class="hero_main_title_dark fw-bold mb-3 text-white">
                            Book Your Favourite<br>
                            Movies <span class="text-gold">Anytime, Anywhere.</span>
                        </h1> -->

                        <!-- Description -->
                        <!-- <p class="hero_description_dark text-white-75 mb-4">
                            Discover the latest blockbusters, choose your favourite seats,
                            explore cast & crew, and enjoy a smooth booking experience
                            with Sairam Movie Hub.
                        </p> -->

                        <!-- Hero Action Buttons -->
                        <div class="d-flex flex-column flex-sm-row gap-3 mb-4">

                            <!-- Book Movie Tickets -->
                            <a href="booking.php"
                               class="btn btn-gold primary_hero_btn py-3 px-4 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm">
                                <i class="bi bi-ticket-perforated-fill"></i>
                                Book Movie Tickets
                            </a>

                            <!-- Watch Trailer -->
                            <a href="latest-trailers.php"
                               class="btn btn-outline-gold secondary_hero_btn py-3 px-4 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-play-circle-fill"></i>
                                Watch Trailer
                            </a>

                        </div>

                        <!-- Hero Stats -->
                        <!-- <div class="hero_stats row text-start pt-3 border-top border-secondary-subtle g-2 max-w-400">

                            <div class="col-4">
                                <h3 class="fw-bold mb-0 text-gold">250+</h3>
                                <p class="text-white-50 small mb-0">Movies</p>
                            </div>

                            <div class="col-4">
                                <h3 class="fw-bold mb-0 text-gold">120+</h3>
                                <p class="text-white-50 small mb-0">Theatres</p>
                            </div>

                            <div class="col-4">
                                <h3 class="fw-bold mb-0 text-gold">10K+</h3>
                                <p class="text-white-50 small mb-0">Bookings</p>
                            </div>

                        </div> -->

                    </div>

                </div>
            </div>
        </div>

    </section>

    <!-- HERO SECTION END -->


    <!-- =========================================================
         TRENDING MOVIES
         ========================================================= -->

    <section class="movie_section py-5">

        <div class="movie_container">

            <div class="section_header">

                <div>

                    <span class="section_subtitle">
                        🔥 Trending Now
                    </span>

                    <h2 class="section_title">
                        Trending Movies
                    </h2>

                </div>


                <a href="#" class="view_all">

                    View All

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>


            <div class="swiper trendingSwiperDesktop">

                <div class="swiper-wrapper">


                    <!-- Movie 1 -->
                    <div class="swiper-slide">

                        <div class="movie_card movie-card-clickable" data-movie-id="avengers" tabindex="0" role="button">

                            <div class="movie_image">

                                 <img
                                    src="assets/images/movies/movie1.jpg"
                                    class="img-fluid"
                                    alt="Avengers Endgame"
                                    onerror="this.src='https://via.placeholder.com/250x375'"> 

                                <span class="movie_rating">
                                    ⭐ 9.2
                                </span>

                                <button class="wishlist_btn">
                                    <i class="bi bi-heart"></i>
                                </button>

                            </div>


                            <div class="movie_content">

                                <h4 class="movie_title">
                                    Avengers Endgame
                                </h4>

                                <p class="movie_genre">
                                    Action • English
                                </p>


                                <div class="movie_info">

                                    <span>
                                        <i class="bi bi-clock"></i>
                                        3h 01m
                                    </span>

                                    <span>
                                        <i class="bi bi-camera-reels"></i>
                                        3D
                                    </span>

                                </div>


                                <a href="#" class="book_movie_btn">

                                    <i class="bi bi-ticket-perforated-fill"></i>

                                    Book Now

                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- Movie 2 -->
                    <div class="swiper-slide">

                        <div class="movie_card movie-card-clickable" data-movie-id="mission-impossible" tabindex="0" role="button">

                            <div class="movie_image">

                                <img
                                    src="assets/images/movies/movie2.jpg"
                                    class="img-fluid"
                                    alt="Mission Impossible"
                                    onerror="this.src='https://via.placeholder.com/250x375'">

                                <span class="movie_rating">
                                    ⭐ 8.8
                                </span>

                                <button class="wishlist_btn">
                                    <i class="bi bi-heart"></i>
                                </button>

                            </div>


                            <div class="movie_content">

                                <h4 class="movie_title">
                                    Mission Impossible
                                </h4>

                                <p class="movie_genre">
                                    Action • English
                                </p>


                                <div class="movie_info">

                                    <span>
                                        <i class="bi bi-clock"></i>
                                        2h 40m
                                    </span>

                                    <span>
                                        <i class="bi bi-camera-reels"></i>
                                        IMAX
                                    </span>

                                </div>


                                <a href="#" class="book_movie_btn">

                                    <i class="bi bi-ticket-perforated-fill"></i>

                                    Book Now

                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- Movie 3 -->
                    <div class="swiper-slide">

                        <div class="movie_card movie-card-clickable" data-movie-id="avatar" tabindex="0" role="button">

                            <div class="movie_image">

                                <img
                                    src="assets/images/movies/movie3.jpg"
                                    class="img-fluid"
                                    alt="Avatar"
                                    onerror="this.src='https://via.placeholder.com/250x375'">

                                <span class="movie_rating">
                                    ⭐ 9.0
                                </span>

                                <button class="wishlist_btn">
                                    <i class="bi bi-heart"></i>
                                </button>

                            </div>


                            <div class="movie_content">

                                <h4 class="movie_title">
                                    Avatar
                                </h4>

                                <p class="movie_genre">
                                    Adventure • English
                                </p>


                                <div class="movie_info">

                                    <span>
                                        <i class="bi bi-clock"></i>
                                        2h 52m
                                    </span>

                                    <span>
                                        <i class="bi bi-camera-reels"></i>
                                        3D
                                    </span>

                                </div>


                                <a href="#" class="book_movie_btn">

                                    <i class="bi bi-ticket-perforated-fill"></i>

                                    Book Now

                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- Movie 4 -->
                    <div class="swiper-slide">

                        <div class="movie_card movie-card-clickable" data-movie-id="spider-man" tabindex="0" role="button">

                            <div class="movie_image">

                                <img
                                    src="assets/images/movies/movie4.jpg"
                                    class="img-fluid"
                                    alt="Spider-Man"
                                    onerror="this.src='https://via.placeholder.com/250x375'">

                                <span class="movie_rating">
                                    ⭐ 8.9
                                </span>

                                <button class="wishlist_btn">
                                    <i class="bi bi-heart"></i>
                                </button>

                            </div>


                            <div class="movie_content">

                                <h4 class="movie_title">
                                    Spider-Man
                                </h4>

                                <p class="movie_genre">
                                    Super Hero • English
                                </p>


                                <div class="movie_info">

                                    <span>
                                        <i class="bi bi-clock"></i>
                                        2h 28m
                                    </span>

                                    <span>
                                        <i class="bi bi-camera-reels"></i>
                                        4DX
                                    </span>

                                </div>


                                <a href="#" class="book_movie_btn">

                                    <i class="bi bi-ticket-perforated-fill"></i>

                                    Book Now

                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- Movie 5 -->
                    <div class="swiper-slide">

                        <div class="movie_card movie-card-clickable" data-movie-id="batman" tabindex="0" role="button">

                            <div class="movie_image">

                                <img
                                    src="assets/images/movies/movie5.png"
                                    class="img-fluid"
                                    alt="The Batman"
                                    onerror="this.src='https://via.placeholder.com/250x375'">

                                <span class="movie_rating">
                                    ⭐ 9.1
                                </span>

                                <button class="wishlist_btn">
                                    <i class="bi bi-heart"></i>
                                </button>

                            </div>


                            <div class="movie_content">

                                <h4 class="movie_title">
                                    The Batman
                                </h4>

                                <p class="movie_genre">
                                    Action • English
                                </p>


                                <div class="movie_info">

                                    <span>
                                        <i class="bi bi-clock"></i>
                                        2h 56m
                                    </span>

                                    <span>
                                        <i class="bi bi-camera-reels"></i>
                                        IMAX
                                    </span>

                                </div>


                                <a href="#" class="book_movie_btn">

                                    <i class="bi bi-ticket-perforated-fill"></i>

                                    Book Now

                                </a>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="swiper-button-next"></div>

                <div class="swiper-button-prev"></div>

                <div class="swiper-pagination"></div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         MOVIE CATEGORIES
         ========================================================= -->

    <section class="categories_section py-4 bg-white">

        <div class="movie_container">

            <div class="section_header">

                <div>

                    <span class="section_subtitle">
                        🎭 Browse
                    </span>

                    <h2 class="section_title">
                        Movie Categories
                    </h2>

                </div>

            </div>


            <div class="category_buttons">

                <a href="#">Action</a>
                <a href="#">Comedy</a>
                <a href="#">Drama</a>
                <a href="#">Thriller</a>
                <a href="#">Romance</a>
                <a href="#">Adventure</a>
                <a href="#">Animation</a>
                <a href="#">Sci-Fi</a>

            </div>

        </div>

    </section>

    


    <!-- =========================================================
     TELUGU & REGIONAL MOVIES SECTION
     ========================================================= -->
<section class="telugu_movies_section py-5" id="teluguMovies">
    <div class="movie_container">
        
        <!-- Section Header -->
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div>
                <span class="section_subtitle">🎬 Regional Highlights</span>
                <h2 class="section_title mb-0">Telugu & Language Blockbusters</h2>
            </div>
            
            <!-- Genre Filter Pills -->
            <div class="genre_filters d-flex gap-2 flex-wrap" role="tablist">
                <button class="btn btn-outline-primary btn-sm rounded-pill active" onclick="filterLanguageMovies('all', this)">All</button>
                <button class="btn btn-outline-primary btn-sm rounded-pill" onclick="filterLanguageMovies('action', this)">Action</button>
                <button class="btn btn-outline-primary btn-sm rounded-pill" onclick="filterLanguageMovies('adventure', this)">Adventure</button>
                <button class="btn btn-outline-primary btn-sm rounded-pill" onclick="filterLanguageMovies('comedy', this)">Comedy</button>
                <button class="btn btn-outline-primary btn-sm rounded-pill" onclick="filterLanguageMovies('thriller', this)">Thriller</button>
                <button class="btn btn-outline-primary btn-sm rounded-pill" onclick="filterLanguageMovies('horror', this)">Horror</button>
            </div>
        </div>

        <!-- Movies Swiper Slider -->
        <div class="swiper teluguMoviesSwiper">
            <div class="swiper-wrapper">

                <!-- Movie 1: Pushpa 2 -->
                <div class="swiper-slide movie-genre-item action adventure" data-genre="action adventure">
                    <div class="movie_card movie-card-clickable" data-movie-id="pushpa-2" tabindex="0" role="button" onclick="openMovieDetails('pushpa-2')">
                        <div class="movie_image">
                            <img src="assets/images/movies/pushpa-2.png" class="img-fluid" alt="Pushpa 2: The Rule" onerror="this.src='https://via.placeholder.com/300x450?text=Pushpa+2';">
                            <span class="movie_rating">
                                ⭐ 9.4
                            </span>
                        </div>

                        <div class="movie_content">
                            <h4 class="movie_title">
                                Pushpa 2: The Rule
                            </h4>
                            <p class="movie_genre">
                                Action, Drama • Telugu
                            </p>
                            <a href="#" class="book_movie_btn" onclick="event.preventDefault(); event.stopPropagation(); openMovieDetails('pushpa-2');">
                                Book Tickets
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Movie 2: Devara -->
                <div class="swiper-slide movie-genre-item action adventure" data-genre="action adventure">
                    <div class="movie_card movie-card-clickable" data-movie-id="devara" tabindex="0" role="button" onclick="openMovieDetails('devara')">
                        <div class="movie_image">
                            <img src="assets/images/movies/devara-1.png" class="img-fluid" alt="Devara Part 1" onerror="this.src='https://via.placeholder.com/300x450?text=Devara';">
                            <span class="movie_rating">
                                ⭐ 9.1
                            </span>
                        </div>

                        <div class="movie_content">
                            <h4 class="movie_title">
                                Devara Part 1
                            </h4>
                            <p class="movie_genre">
                                Action, Thriller • Telugu
                            </p>
                            <a href="#" class="book_movie_btn" onclick="event.preventDefault(); event.stopPropagation(); openMovieDetails('devara');">
                                Book Tickets
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Movie 3: Tillu Square -->
                <div class="swiper-slide movie-genre-item comedy" data-genre="comedy">
                    <div class="movie_card movie-card-clickable" data-movie-id="tillu-square" tabindex="0" role="button" onclick="openMovieDetails('tillu-square')">
                        <div class="movie_image">
                            <img src="assets/images/movies/tillu-square.png" class="img-fluid" alt="Tillu Square" onerror="this.src='https://via.placeholder.com/300x450?text=Tillu+Square';">
                            <span class="movie_rating">
                                ⭐ 8.7
                            </span>
                        </div>

                        <div class="movie_content">
                            <h4 class="movie_title">
                                Tillu Square
                            </h4>
                            <p class="movie_genre">
                                Comedy, Romance • Telugu
                            </p>
                            <a href="#" class="book_movie_btn" onclick="event.preventDefault(); event.stopPropagation(); openMovieDetails('tillu-square');">
                                Book Tickets
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Movie 4: Virupaksha -->
                <div class="swiper-slide movie-genre-item horror thriller" data-genre="horror thriller">
                    <div class="movie_card movie-card-clickable" data-movie-id="virupaksha" tabindex="0" role="button" onclick="openMovieDetails('virupaksha')">
                        <div class="movie_image">
                            <img src="assets/images/movies/virupaksha.png" class="img-fluid" alt="Virupaksha" onerror="this.src='https://via.placeholder.com/300x450?text=Virupaksha';">
                            <span class="movie_rating">
                                ⭐ 8.9
                            </span>
                        </div>

                        <div class="movie_content">
                            <h4 class="movie_title">
                                Virupaksha
                            </h4>
                            <p class="movie_genre">
                                Horror, Mystery • Telugu
                            </p>
                            <a href="#" class="book_movie_btn" onclick="event.preventDefault(); event.stopPropagation(); openMovieDetails('virupaksha');">
                                Book Tickets
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Movie 5: Game Changer -->
                <div class="swiper-slide movie-genre-item action thriller" data-genre="action thriller">
                    <div class="movie_card movie-card-clickable" data-movie-id="game-changer" tabindex="0" role="button" onclick="openMovieDetails('game-changer')">
                        <div class="movie_image">
                            <img src="assets/images/movies/game-changer.png" class="img-fluid" alt="Game Changer" onerror="this.src='https://via.placeholder.com/300x450?text=Game+Changer';">
                            <span class="movie_rating">
                                ⭐ 9.0
                            </span>
                        </div>

                        <div class="movie_content">
                            <h4 class="movie_title">
                                Game Changer
                            </h4>
                            <p class="movie_genre">
                                Action, Drama • Telugu
                            </p>
                            <a href="#" class="book_movie_btn" onclick="event.preventDefault(); event.stopPropagation(); openMovieDetails('game-changer');">
                                Book Tickets
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Movie 6: Kalki 2898 AD -->
                <div class="swiper-slide movie-genre-item action adventure" data-genre="action adventure">
                    <div class="movie_card movie-card-clickable" data-movie-id="kalki-2898" tabindex="0" role="button" onclick="openMovieDetails('kalki-2898')">
                        <div class="movie_image">
                            <img src="assets/images/movies/kalki-2898ad.png" class="img-fluid" alt="Kalki 2898 AD" onerror="this.src='https://via.placeholder.com/300x450?text=Kalki+2898+AD';">
                            <span class="movie_rating">
                                ⭐ 9.3
                            </span>
                        </div>

                        <div class="movie_content">
                            <h4 class="movie_title">
                                Kalki 2898 AD
                            </h4>
                            <p class="movie_genre">
                                Sci-Fi, Action • Telugu
                            </p>
                            <a href="#" class="book_movie_btn" onclick="event.preventDefault(); event.stopPropagation(); openMovieDetails('kalki-2898');">
                                Book Tickets
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Swiper Controls -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>


<?php include 'slant-wall-section.php'; ?>

<!-- =========================================================
COMING SOON
========================================================= -->

    <section class="coming_section py-5 bg-white">

        <div class="movie_container">

            <div class="section_header">

                <div>

                    <span class="section_subtitle">
                        🎬 Upcoming
                    </span>

                    <h2 class="section_title">
                        Coming Soon
                    </h2>

                </div>

            </div>


            <div class="row g-4">


                <div class="col-lg-4 col-md-6">

                    <div class="coming_card">

                        <!-- <img
                            src="assets/images/movies/coming1.jpg"
                            class="img-fluid"
                            alt="Avatar 3"
                            onerror="this.src='https://via.placeholder.com/400x200'"> -->

                        <div class="coming_content">

                            <h4>
                                Avatar 3
                            </h4>

                            <p>
                                Release: December 2026
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-lg-4 col-md-6">

                    <div class="coming_card">

                        <!-- <img
                            src="assets/images/movies/coming2.jpg"
                            class="img-fluid"
                            alt="Avengers Secret Wars"
                            onerror="this.src='https://via.placeholder.com/400x200'"> -->

                        <div class="coming_content">

                            <h4>
                                Avengers Secret Wars
                            </h4>

                            <p>
                                Release: 2027
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-lg-4 col-md-6">

                    <div class="coming_card">

                        <!-- <img
                            src="assets/images/movies/coming3.jpg"
                            class="img-fluid"
                            alt="Batman Returns"
                            onerror="this.src='https://via.placeholder.com/400x200'"> -->

                        <div class="coming_content">

                            <h4>
                                Batman Returns
                            </h4>

                            <p>
                                Release: 2027
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         SPECIAL OFFERS
         ========================================================= -->

    <section class="offers_section py-5 bg-light">

        <div class="movie_container">

            <div class="section_header">

                <div>

                    <span class="section_subtitle">
                        🎁 Limited Time
                    </span>

                    <h2 class="section_title">
                        Special Offers
                    </h2>

                </div>

            </div>


            <div class="row g-4">


                <div class="col-lg-4 col-md-6">

                    <div class="offer_card">

                        <i class="bi bi-ticket-perforated-fill"></i>

                        <h4>
                            Flat 20% OFF
                        </h4>

                        <p>
                            Book your first movie ticket and enjoy 20% discount.
                        </p>

                    </div>

                </div>


                <div class="col-lg-4 col-md-6">

                    <div class="offer_card">

                        <i class="bi bi-people-fill"></i>

                        <h4>
                            Family Combo
                        </h4>

                        <p>
                            Buy 4 tickets and get free popcorn with soft drinks.
                        </p>

                    </div>

                </div>


                <div class="col-lg-4 col-md-6">

                    <div class="offer_card">

                        <i class="bi bi-stars"></i>

                        <h4>
                            Premium Member
                        </h4>

                        <p>
                            Exclusive cashback and early access to movie bookings.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         WHY CHOOSE US
         ========================================================= -->

    <section class="why_section py-5 bg-white">

        <div class="movie_container">

            <div class="section_header">

                <div>

                    <span class="section_subtitle">
                        ⭐ Our Features
                    </span>

                    <h2 class="section_title">
                        Why Choose Sairam Movie Hub
                    </h2>

                </div>

            </div>


            <div class="row g-4">


                <div class="col-lg-3 col-sm-6">

                    <div class="why_card">

                        <i class="bi bi-phone-fill"></i>

                        <h5>
                            Easy Booking
                        </h5>

                        <p>
                            Book tickets in just a few clicks.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-sm-6">

                    <div class="why_card">

                        <i class="bi bi-shield-check"></i>

                        <h5>
                            Secure Payment
                        </h5>

                        <p>
                            100% safe online payment methods.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-sm-6">

                    <div class="why_card">

                        <i class="bi bi-clock-history"></i>

                        <h5>
                            Instant Confirmation
                        </h5>

                        <p>
                            Receive tickets immediately after payment.
                        </p>

                    </div>

                </div>


                <div class="col-lg-3 col-sm-6">

                    <div class="why_card">

                        <i class="bi bi-star-fill"></i>

                        <h5>
                            Premium Experience
                        </h5>

                        <p>
                            Modern theatres with best facilities.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         STATISTICS
         ========================================================= -->

    <section class="stats_section py-5">

        <div class="movie_container">

            <div class="row text-center g-4">


                <div class="col-lg-3 col-6">

                    <h2>
                        500+
                    </h2>

                    <p>
                        Movies
                    </p>

                </div>


                <div class="col-lg-3 col-6">

                    <h2>
                        150+
                    </h2>

                    <p>
                        Theatres
                    </p>

                </div>


                <div class="col-lg-3 col-6">

                    <h2>
                        50K+
                    </h2>

                    <p>
                        Bookings
                    </p>

                </div>


                <div class="col-lg-3 col-6">

                    <h2>
                        25K+
                    </h2>

                    <p>
                        Happy Customers
                    </p>

                </div>

            </div>

        </div>

    </section>


    


    <!-- =========================================================
         REVIEWS
         ========================================================= -->

    <section class="review_section py-5 bg-light">

        <div class="movie_container">

            <div class="section_header">

                <div>

                    <span class="section_subtitle">
                        💬 Reviews
                    </span>

                    <h2 class="section_title">
                        What Our Users Say
                    </h2>

                </div>

            </div>


            <div class="row g-4">


                <div class="col-lg-4 col-md-6">

                    <div class="review_card">

                        <p class="text-warning">
                            ★★★★★
                        </p>

                        <p>
                            "Very smooth booking experience. Loved the interface."
                        </p>

                        <h5>
                            Rahul
                        </h5>

                    </div>

                </div>


                <div class="col-lg-4 col-md-6">

                    <div class="review_card">

                        <p class="text-warning">
                            ★★★★★
                        </p>

                        <p>
                            "Seat booking was simple and payment was quick."
                        </p>

                        <h5>
                            Priya
                        </h5>

                    </div>

                </div>


                <div class="col-lg-4 col-md-6">

                    <div class="review_card">

                        <p class="text-warning">
                            ★★★★★
                        </p>

                        <p>
                            "Beautiful design and easy to use."
                        </p>

                        <h5>
                            Sairam
                        </h5>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         PARTNER CINEMAS
         ========================================================= -->

    <section class="partner_section py-5 bg-white">

        <div class="movie_container">

            <div class="section_header">

                <div>

                    <span class="section_subtitle">
                        🏢 Partners
                    </span>

                    <h2 class="section_title">
                        Our Theatre Partners
                    </h2>

                </div>

            </div>


            <div class="row text-center g-4">


                <div class="col-lg-3 col-6">

                    <div class="partner_logo">
                        PVR
                    </div>

                </div>


                <div class="col-lg-3 col-6">

                    <div class="partner_logo">
                        INOX
                    </div>

                </div>


                <div class="col-lg-3 col-6">

                    <div class="partner_logo">
                        Cinepolis
                    </div>

                </div>


                <div class="col-lg-3 col-6">

                    <div class="partner_logo">
                        Asian Cinemas
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         DOWNLOAD APP
         ========================================================= -->

    <section class="app_section py-5 bg-light">

        <div class="movie_container">

            <div class="row align-items-center g-4">


                <div class="col-lg-7">

                    <span class="section_subtitle">
                        📱 Mobile App
                    </span>

                    <h2 class="section_title">

                        Book Movies Anytime with

                        <span class="text-primary">
                            Sairam Movie Hub
                        </span>

                    </h2>


                    <p class="my-3">

                        Download our mobile app to book tickets faster,
                        save your favourite movies, receive notifications,
                        and enjoy exclusive member offers.

                    </p>


                    <div class="d-flex gap-3 flex-wrap">

                        <a href="#" class="btn btn-dark">

                            <i class="bi bi-google-play me-2"></i>

                            Google Play

                        </a>


                        <a href="#" class="btn btn-dark">

                            <i class="bi bi-apple me-2"></i>

                            App Store

                        </a>

                    </div>

                </div>


                <div class="col-lg-5 text-center">

                    <!-- <img
                        src="assets/images/mobile/mobile-app.png"
                        class="img-fluid"
                        alt="app"
                        style="max-height:300px;"
                        onerror="this.src='https://via.placeholder.com/300x400?text=App'"> -->

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         NEWSLETTER
         ========================================================= -->

    <section class="newsletter_section py-5 bg-white">

        <div class="movie_container">

            <div class="newsletter_box">

                <h2>
                    Subscribe for Latest Movie Updates
                </h2>

                <p>
                    Get updates about new movies, offers and exclusive discounts.
                </p>


                <div class="newsletter_form">

                    <input
                        type="email"
                        placeholder="Enter your email address">

                    <button>
                        Subscribe
                    </button>

                </div>

            </div>

        </div>

        <script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Hero Background Slider
    var heroBgSwiper = new Swiper('.heroBgSwiper', {
        loop: true,
        autoplay: {
            delay: 4500,
            disableOnInteraction: false,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        speed: 1200,
        pagination: {
            el: '.hero-swiper-pagination',
            clickable: true,
        },
    });
});
</script>

    </section>


    <!-- =========================================================
         FOOTER
         ========================================================= -->

<?php include 'footer.php'; ?>

