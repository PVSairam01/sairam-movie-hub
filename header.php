<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sairam Movie Hub | Book Your Favourite Movies Anytime, Anywhere.</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="assets/css/tmdb-gold-theme.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
          rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/visual-effects.css">

    <link rel="stylesheet" href="assets/css/header-mobile-theme.css">
</head>

<body>

<!-- ========================================================= -->
<!-- TOP INFORMATION BAR - DESKTOP -->
<!-- ========================================================= -->

<div class="top-bar-bg d-none d-lg-block">
    <div class="container-fluid px-lg-5">

        <div class="top-bar-content">

            <!-- Left Details (Location, Phone, Email) -->
            <div class="top-bar-left">

                <!-- <a href="https://www.google.com/maps/search/?api=1&query=Gangaraju+Nagar+Vakalpudi+Center+Kakinada" -->
                 <a href="https://www.google.com/maps/search/?api=1&query=3%2F186-3%2C+APIIC+Colony%2C+Rayudupalem%2C+Vakalapudi%2C+Andhra+Pradesh+533005%2C+India"
                   target="_blank"
                   rel="noopener"
                   class="top-bar-location-link">

                    <span class="top-info-item">
                        <i class="fa-solid fa-location-dot icon-gold"></i>
                        <span>3/186-2,Gangaraju Nagar,Vakalpudi Center, Kakinada</span>
                    </span>

                </a>

                <span class="top-info-item top-bar-phone">
                    <i class="fa-solid fa-phone icon-gold"></i>
                    <a href="tel:+919390717011">+91 9390717011</a>
                </span>

                <span class="top-info-item top-bar-email">
                    <i class="fa-regular fa-envelope icon-gold"></i>
                    <a href="mailto:sairampachipala00@gmail.com">sairampachipala00@gmail.com</a>
                </span>

            </div>


            <!-- Right Details (Timing & Social Icons) -->
            <div class="top-bar-right">

                <span class="top-info-item top-bar-timing">
                    <i class="fa-regular fa-clock icon-gold"></i>
                    <span>Mon - Sun: 9:00 AM - 12:00 PM</span>
                </span>

                <div class="social-icons top-bar-social-icons">

                    <a href="https://www.facebook.com/share/1AkKiwQYYR/"
                       target="_blank"
                       rel="noopener"
                       aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="https://www.instagram.com/sairam.patchipala?stkn=MXF3c3J2a2xyYmF4bQ=="
                       target="_blank"
                       rel="noopener"
                       aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://api.whatsapp.com/send?phone=919390717011"
                       target="_blank"
                       rel="noopener"
                       aria-label="WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>


<!-- ========================================================= -->
<!-- TOP INFORMATION BAR - MOBILE MARQUEE -->
<!-- ========================================================= -->

<div class="marquee-section top-contact-marquee d-block d-lg-none">

    <marquee
        behavior="scroll"
        direction="left"
        scrollamount="4"
        class="mobile-top-marquee d-block d-lg-none"
        onmouseover="this.stop();"
        onmouseout="this.start();"
    >

        <span class="mobile-marquee-track">

            <span class="top-info-item">
                <i class="fa-solid fa-location-dot icon-gold"></i>
                <span>Gangaraju Nagar, Vakalpudi Center, Kakinada</span>
            </span>

            <span class="marquee-divider">/</span>

            <span class="top-info-item">
                <i class="fa-solid fa-phone icon-gold"></i>
                <a href="tel:+919390717011">+91 9390717011</a>
            </span>

            <span class="marquee-divider">/</span>

            <span class="top-info-item">
                <i class="fa-regular fa-envelope icon-gold"></i>
                <a href="mailto:sairampachipala00@gmail.com">sairampachipala00@gmail.com</a>
            </span>

            <span class="marquee-divider">/</span>

            <span class="top-info-item">
                <i class="fa-regular fa-clock icon-gold"></i>
                <span>Mon - Sun: 9:00 AM - 12:00 PM</span>
            </span>

            <span class="marquee-divider">/</span>

            <span class="top-info-item mobile-marquee-social">

                <a href="https://www.facebook.com/share/1AkKiwQYYR/"
                   target="_blank"
                   rel="noopener"
                   aria-label="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                <a href="https://www.instagram.com/sairam.patchipala?stkn=MXF3c3J2a2xyYmF4bQ=="
                   target="_blank"
                   rel="noopener"
                   aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="https://api.whatsapp.com/send?phone=919390717011"
                   target="_blank"
                   rel="noopener"
                   aria-label="WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

            </span>

        </span>

    </marquee>

</div>



<!-- ========================================================= -->
<!-- PREMIUM MOVIE NAVBAR -->
<!-- ========================================================= -->

<header class="movie-navbar">

    <!-- TOP NAVBAR -->
    <div class="movie-navbar-main">

        <div class="movie-navbar-container">

            <!-- SAIRAM MOVIES LOGO -->
            <a href="#"
               class="movie-logo"
               aria-label="Sairam Movies Home">

                <img
                    src="assets/images/movies/sairam-movie-logo-removebg-preview.png"
                    alt="Sairam Movies"
                    class="sairam-header-logo"
                >

            </a>


            <!-- SEARCH -->
            <!-- <div class="movie-search-box">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    placeholder="Search for Movies, Events, Plays, Sports and Activities"
                    aria-label="Search movies"
                >

            </div> -->

            <!-- ========================================================= -->
            <!-- HEADER CENTER NAV BUTTONS -->
            <!-- ========================================================= -->
            <div class="header-center-nav d-none d-lg-flex align-items-center justify-content-center gap-3">
               <a href="Home.php" class="header-nav-btn movie-signin-btn text-decoration-none">
                  <i class="fa-solid fa-house me-1"></i> Home
              </a> 
               <a href="latest-movies.php" class="header-nav-btn movie-signin-btn text-decoration-none">
                  <i class="fa-solid fa-film me-1"></i> Movies
              </a>
              <a href="latest-trailers.php" class="header-nav-btn movie-signin-btn text-decoration-none">
                 <i class="bi bi-play-circle-fill me-1"></i> Trailers
              </a>
              <a href="booking.php" class="header-nav-btn movie-signin-btn text-decoration-none">
                 <i class="fa-solid fa-glasses me-1"></i> 3D Experience
              </a>
          </div>
            


            <!-- RIGHT SIDE -->
            <div class="movie-navbar-right">

                <!-- CITY -->
                <button
                    class="movie-city-btn"
                    type="button"
                    onclick="openLocationModal()"
                >

                    <i class="bi bi-geo-alt-fill"></i>

                    <span id="currentLocationDisplay">
                        Kakinada
                    </span>

                    <i class="bi bi-chevron-down city-arrow"></i>

                </button>


                <!-- SIGN IN -->
                <button
                    class="movie-signin-btn"
                    onclick="openLoginModal()"
                >
                    Sign in
                </button>


                <!-- MENU -->
                <button
                    class="movie-menu-btn"
                    type="button"
                    onclick="openSideMenu()"
                    aria-label="Open menu"
                >

                    <span></span>
                    <span></span>
                    <span></span>

                </button>

            </div>

        </div>

    </div>


    <!-- SECOND NAVIGATION - DESKTOP / TABLET ONLY -->
    <!-- <div class="movie-secondary-navbar d-none d-md-block">

        <div class="movie-secondary-container">

            <div class="movie-main-links">
                <a href="#">Movies</a>
                <a href="#">Stream</a>
                <a href="#">Events</a>
                <a href="#">Sports</a>
                <a href="#">Activities</a>
            </div>

            <div class="movie-business-links">
                <a href="#">ListYourShow</a>
                <a href="#">Corporates</a>
                <a href="#">Offers</a>
                <a href="#">Gift Cards</a>
            </div>

        </div>

    </div> -->

</header>

<!-- ========================================================= -->
<!-- SIDE MENU OVERLAY -->
<!-- ========================================================= -->

<div
    class="movie-menu-overlay"
    id="movieMenuOverlay"
    onclick="closeSideMenu()">
</div>


<!-- ========================================================= -->
<!-- RIGHT SIDE MENU -->
<!-- ========================================================= -->

<aside
    class="movie-side-menu"
    id="movieSideMenu">

    <!-- MENU HEADER -->

    <div class="movie-side-menu-header">

        <h3>Hey!</h3>

        <button
            class="movie-menu-close"
            onclick="closeSideMenu()">
            <i class="bi bi-x-lg"></i>
        </button>

    </div>


    <!-- LOGIN -->

    <div class="movie-login-row">

        <div class="movie-profile-placeholder">

            <i class="bi bi-person"></i>

        </div>


        <div class="movie-login-text">

            <strong>
                Unlock special offers &
                great benefits
            </strong>

        </div>


        <button
            class="movie-login-register"
            onclick="openLoginModal()">
            Login / Register
        </button>

    </div>


    <!-- MENU ITEMS -->

    <div class="movie-menu-list">

        <!-- Navigation links (mobile + tab only) -->
       <a href="Home.php" class="movie-menu-item d-lg-none">
          <div class="movie-menu-icon"><i class="fa-solid fa-house"></i></div>
          <div class="movie-menu-content"><strong>Home</strong></div>
          <i class="bi bi-chevron-right"></i>
      </a>

      <a href="latest-movies.php" class="movie-menu-item d-lg-none">
          <div class="movie-menu-icon"><i class="fa-solid fa-film"></i></div>
          <div class="movie-menu-content"><strong>Movies</strong></div>
          <i class="bi bi-chevron-right"></i>
      </a>

      <a href="latest-trailers.php" class="movie-menu-item d-lg-none">
         <div class="movie-menu-icon"><i class="bi bi-play-circle-fill"></i></div>
         <div class="movie-menu-content"><strong>Trailers</strong></div>
         <i class="bi bi-chevron-right"></i>
      </a>

      <a href="booking.php" class="movie-menu-item d-lg-none">
         <div class="movie-menu-icon"><i class="fa-solid fa-glasses"></i></div>
         <div class="movie-menu-content"><strong>3D Experience</strong></div>
         <i class="bi bi-chevron-right"></i>
     </a>


        <!-- Notifications -->

        <button class="movie-menu-item">

            <div class="movie-menu-icon">
                <i class="bi bi-bell"></i>
            </div>

            <div class="movie-menu-content">

                <strong>Notifications</strong>

            </div>

            <i class="bi bi-chevron-right"></i>

        </button>


        <!-- Orders -->

        <!-- <button class="movie-menu-item disabled">

            <div class="movie-menu-icon">
                <i class="bi bi-bag"></i>
            </div>

            <div class="movie-menu-content">

                <strong>Your Orders</strong>

                <small>
                    View all your bookings & purchases
                </small>

            </div>

            <i class="bi bi-lock"></i>

        </button> -->
        <!-- Your Orders -->
        <button class="movie-menu-item disabled d-none d-lg-flex">

        <!-- Stream Library -->
       <button class="movie-menu-item disabled d-none d-lg-flex">

       <!-- Accounts & Settings -->
       <button class="movie-menu-item disabled d-none d-lg-flex">

        <!-- Wishlist -->

        <button class="movie-menu-item">

            <div class="movie-menu-icon">
                <i class="bi bi-heart"></i>
            </div>

            <div class="movie-menu-content">

                <strong>Your Wishlist</strong>

            </div>

            <i class="bi bi-chevron-right"></i>

        </button>


        <!-- Stream Library -->

        <!-- <button class="movie-menu-item disabled">

            <div class="movie-menu-icon">
                <i class="bi bi-tv"></i>
            </div>

            <div class="movie-menu-content">

                <strong>Stream Library</strong>

                <small>
                    Rented & Purchased Movies
                </small>

            </div>

            <i class="bi bi-lock"></i>

        </button> -->


        <!-- Credit Card -->

        <button class="movie-menu-item">

            <div class="movie-menu-icon">
                <i class="bi bi-credit-card"></i>
            </div>

            <div class="movie-menu-content">

                <strong>Play Credit Card</strong>

                <small>
                    View your Play Credit Card details and offers
                </small>

            </div>

            <i class="bi bi-chevron-right"></i>

        </button>


        <!-- Help -->

        <button class="movie-menu-item">

            <div class="movie-menu-icon">
                <i class="bi bi-chat-dots"></i>
            </div>

            <div class="movie-menu-content">

                <strong>Help & Support</strong>

                <small>
                    View commonly asked queries and Chat
                </small>

            </div>

            <i class="bi bi-chevron-right"></i>

        </button>


        <!-- Settings -->

        <!-- <button class="movie-menu-item disabled">

            <div class="movie-menu-icon">
                <i class="bi bi-gear"></i>
            </div>

            <div class="movie-menu-content">

                <strong>Accounts & Settings</strong>

                <small>
                    Location, Payments, Permissions & More
                </small>

            </div>

            <i class="bi bi-lock"></i>

        </button> -->


        <!-- Rewards -->

        <button class="movie-menu-item">

            <div class="movie-menu-icon">
                <i class="bi bi-gift"></i>
            </div>

            <div class="movie-menu-content">

                <strong>Rewards</strong>

                <small>
                    View your rewards & unlock new ones
                </small>

            </div>

            <i class="bi bi-chevron-right"></i>

        </button>


        <!-- Book A Change -->

        <button class="movie-menu-item">

            <div class="movie-menu-icon">
                <i class="bi bi-globe"></i>
            </div>

            <div class="movie-menu-content">

                <strong>BookAChange</strong>

            </div>

            <i class="bi bi-chevron-right"></i>

        </button>

    </div>

</aside>


<!-- =========================================================
OFFCANVAS MOBILE MENU
========================================================= -->

<div class="offcanvas offcanvas-end"
        tabindex="-1"
        id="mobileMenu">

        <div class="offcanvas-header border-bottom">

            <h5 class="offcanvas-title fw-bold">
                Menu
            </h5>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="offcanvas">
            </button>

        </div>


        <div class="offcanvas-body">

            <ul class="nav flex-column gap-3 fs-5 fw-semibold">

                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">
                        Movies
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">
                        Theatres
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">
                        Events
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">
                        Offers
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">
                        Contact Us
                    </a>
                </li>


                <?php if (!isset($_SESSION['user_id'])): ?>

                    <li class="nav-item mt-3">

                        <a class="btn btn-primary w-100 py-2"
                           href="#"
                           id="openLoginMobile">
                            Sign In
                        </a>

                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>