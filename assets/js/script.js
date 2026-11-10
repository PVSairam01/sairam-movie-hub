// =============================================
// SWIPER INITIALIZATIONS
// =============================================
document.addEventListener('DOMContentLoaded', function() {
    // Trending Movies Swiper
    const trendingSwiper = new Swiper(".trendingSwiperDesktop", {
        slidesPerView: 1,
        spaceBetween: 20,
        centeredSlides: false,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: true,
            pauseOnMouseEnter: true,
        },
        navigation: {
            nextEl: ".trendingSwiperDesktop .swiper-button-next",
            prevEl: ".trendingSwiperDesktop .swiper-button-prev",
        },
        pagination: {
            el: ".trendingSwiperDesktop .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            576: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 25,
            }
        }
    });

    // Latest Movies Swiper
    const latestSwiper = new Swiper(".latestSwiperDesktop", {
        slidesPerView: 1,
        spaceBetween: 20,
        centeredSlides: false,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: true,
            pauseOnMouseEnter: true,
        },
        navigation: {
            nextEl: ".latestSwiperDesktop .swiper-button-next",
            prevEl: ".latestSwiperDesktop .swiper-button-prev",
        },
        pagination: {
            el: ".latestSwiperDesktop .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            576: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 25,
            }
        }
    });

    // =============================================
    // LOGIN POPUP HANDLERS
    // =============================================
    const openLoginBtn = document.getElementById('openLogin');
    const openLoginMobile = document.getElementById('openLoginMobile');
    const closeLoginBtn = document.getElementById('closePopup');
    const loginPopup = document.getElementById('loginPopup');

    if (openLoginBtn) {
        openLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            loginPopup.classList.add('active');
        });
    }

    if (openLoginMobile) {
        openLoginMobile.addEventListener('click', function(e) {
            e.preventDefault();
            loginPopup.classList.add('active');
        });
    }

    if (closeLoginBtn) {
        closeLoginBtn.addEventListener('click', function() {
            loginPopup.classList.remove('active');
        });
    }

    if (loginPopup) {
        loginPopup.addEventListener('click', function(e) {
            if (e.target === loginPopup) {
                loginPopup.classList.remove('active');
            }
        });
    }

    // =============================================
    // WISHLIST BUTTON TOGGLE
    // =============================================
    const wishlistBtns = document.querySelectorAll('.wishlist_btn');
    
    wishlistBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const icon = this.querySelector('i');
            icon.classList.toggle('bi-heart');
            icon.classList.toggle('bi-heart-fill');
            
            if (icon.classList.contains('bi-heart-fill')) {
                this.style.color = '#dc3545';
            } else {
                this.style.color = '#dc3545';
            }
        });
    });

    // =============================================
    // SEARCH FUNCTIONALITY
    // =============================================
    const searchInputs = document.querySelectorAll('.nav_search input, .hero_search input');
    
    searchInputs.forEach(function(input) {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const searchTerm = this.value.trim();
                if (searchTerm) {
                    console.log('Searching for:', searchTerm);
                }
            }
        });
    });

    // =============================================
    // NAVIGATION ACTIVE STATE
    // =============================================
    const navLinks = document.querySelectorAll('.movie_menu_left a, .movie_menu_right a');
    
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            document.querySelectorAll('.movie_menu_left a, .movie_menu_right a').forEach(function(l) {
                l.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // =============================================
    // MOBILE MENU CLOSE ON LINK CLICK
    // =============================================
    const mobileNavLinks = document.querySelectorAll('#mobileMenu .nav-link');
    const offcanvas = document.getElementById('mobileMenu');
    
    if (offcanvas) {
        const bsOffcanvas = new bootstrap.Offcanvas(offcanvas);
        
        mobileNavLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                bsOffcanvas.hide();
            });
        });
    }

    // =============================================
    // SUBSCRIBE NEWSLETTER
    // =============================================
    const subscribeForm = document.querySelector('.newsletter_form');
    
    if (subscribeForm) {
        const subscribeBtn = subscribeForm.querySelector('button');
        const emailInput = subscribeForm.querySelector('input[type="email"]');
        
        if (subscribeBtn && emailInput) {
            subscribeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const email = emailInput.value.trim();
                
                if (email && isValidEmail(email)) {
                    alert('Thank you for subscribing! You\'ll receive our latest updates.');
                    emailInput.value = '';
                } else {
                    alert('Please enter a valid email address.');
                }
            });
        }
    }

    // =============================================
    // HERO SEARCH BUTTON
    // =============================================
    const heroSearchBtn = document.querySelector('.hero_search .btn-primary');
    const heroSearchInput = document.querySelector('.hero_search input');
    
    if (heroSearchBtn && heroSearchInput) {
        heroSearchBtn.addEventListener('click', function() {
            const searchTerm = heroSearchInput.value.trim();
            if (searchTerm) {
                console.log('Hero search:', searchTerm);
            }
        });
    }
});

// =============================================
// HELPER FUNCTIONS
// =============================================
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}