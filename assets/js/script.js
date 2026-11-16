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

function initializeMovieSearch() {
    const searchButton = document.createElement('button');
    searchButton.type = 'button';
    searchButton.className = 'movie-search-trigger';
    searchButton.setAttribute('aria-label', 'Search movies');
    searchButton.setAttribute('aria-controls', 'movieSearchOverlay');
    searchButton.setAttribute('aria-expanded', 'false');

    const iconWrapper = document.createElement('span');
    iconWrapper.className = 'movie-search-trigger-icon';
    const searchIcon = document.createElement('i');
    searchIcon.className = 'bi bi-search';
    searchIcon.setAttribute('aria-hidden', 'true');
    iconWrapper.appendChild(searchIcon);

    const label = document.createElement('span');
    label.className = 'movie-search-trigger-label';
    label.textContent = 'Search Movies';

    const arrow = document.createElement('i');
    arrow.className = 'bi bi-chevron-right movie-search-trigger-arrow';
    arrow.setAttribute('aria-hidden', 'true');
    searchButton.append(iconWrapper, label, arrow);

    const headerSearch = document.createElement('form');
    headerSearch.className = 'movie-header-search';
    headerSearch.setAttribute('role', 'search');
    headerSearch.setAttribute('aria-label', 'Search movies');

    const headerInput = document.createElement('input');
    headerInput.type = 'search';
    headerInput.className = 'movie-header-search-input';
    headerInput.placeholder = 'Search movies';
    headerInput.setAttribute('aria-label', 'Search movies');
    headerInput.autocomplete = 'off';
    headerSearch.append(headerInput, searchButton);

    const overlay = document.createElement('div');
    overlay.className = 'movie-search-overlay';
    overlay.id = 'movieSearchOverlay';
    overlay.setAttribute('aria-hidden', 'true');

    const dialog = document.createElement('section');
    dialog.className = 'movie-search-dialog';
    dialog.setAttribute('role', 'dialog');
    dialog.setAttribute('aria-modal', 'true');
    dialog.setAttribute('aria-labelledby', 'movieSearchTitle');

    const header = document.createElement('div');
    header.className = 'movie-search-header';
    const title = document.createElement('h2');
    title.id = 'movieSearchTitle';
    title.textContent = 'Search Movies';

    const closeButton = document.createElement('button');
    closeButton.type = 'button';
    closeButton.className = 'movie-search-close';
    closeButton.setAttribute('aria-label', 'Close movie search');
    const closeIcon = document.createElement('i');
    closeIcon.className = 'bi bi-x-lg';
    closeIcon.setAttribute('aria-hidden', 'true');
    closeButton.appendChild(closeIcon);
    header.append(title, closeButton);

    const form = document.createElement('form');
    form.className = 'movie-search-form';
    const input = document.createElement('input');
    input.type = 'search';
    input.className = 'movie-search-input';
    input.id = 'movieSearchInput';
    input.placeholder = 'Search for a movie...';
    input.setAttribute('aria-label', 'Search for a movie');
    input.autocomplete = 'off';
    form.appendChild(input);

    const results = document.createElement('div');
    results.className = 'movie-search-results';
    results.setAttribute('role', 'listbox');
    results.setAttribute('aria-label', 'Movie search results');
    dialog.append(header, form, results);
    overlay.appendChild(dialog);
    document.body.appendChild(overlay);

    function closeSearch() {
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden', 'true');
        searchButton.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('movie-search-open');
        const focusTarget = searchButton.closest('.movie-side-menu') ?
            document.querySelector('.movie-menu-btn') : searchButton;
        focusTarget?.focus();
    }

    function openSearch(initialQuery) {
        if (typeof window.closeSideMenu === 'function') window.closeSideMenu();
        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        searchButton.setAttribute('aria-expanded', 'true');
        document.body.classList.add('movie-search-open');
        input.value = initialQuery || '';
        renderMovieSearchResults(input.value);
        window.setTimeout(function() {
            input.focus();
        }, 0);
    }

    function navigateToLatestMovies(query) {
        const latestMoviesUrl = new URL('latest-movies.html', window.location.href);
        latestMoviesUrl.searchParams.set('search', query);
        window.location.assign(latestMoviesUrl.href);
    }

    function getMovieCards() {
        const seen = new Set();
        return Array.from(document.querySelectorAll('.movie-card-clickable, .movie_card'))
            .map(function(card) {
                const titleElement = card.querySelector('.movie_title, .movie-title, h3, h4');
                const movieTitle = titleElement?.textContent.trim() ||
                    card.querySelector('img[alt]')?.alt.trim() || '';
                if (!movieTitle) return null;

                const key = card.dataset.movieId || movieTitle.toLowerCase();
                if (seen.has(key)) return null;
                seen.add(key);

                return {
                    card: card,
                    id: card.dataset.movieId,
                    title: movieTitle
                };
            })
            .filter(Boolean);
    }

    function renderMovieSearchResults(query) {
        results.replaceChildren();
        const normalizedQuery = query.trim().toLowerCase();

        if (!normalizedQuery) {
            const prompt = document.createElement('p');
            prompt.className = 'movie-search-message';
            prompt.textContent = 'Type a movie name to see matching titles.';
            results.appendChild(prompt);
            return;
        }

        const matches = getMovieCards()
            .filter(function(movie) {
                return movie.title.toLowerCase().includes(normalizedQuery);
            })
            .sort(function(first, second) {
                return Number(!first.title.toLowerCase().startsWith(normalizedQuery)) -
                    Number(!second.title.toLowerCase().startsWith(normalizedQuery));
            })
            .slice(0, 8);

        if (!matches.length) {
            const message = document.createElement('p');
            message.className = 'movie-search-message';
            message.textContent = 'No matches on this page.';

            const browseButton = document.createElement('button');
            browseButton.type = 'button';
            browseButton.className = 'movie-search-browse';
            browseButton.textContent = 'Search all latest movies';
            browseButton.addEventListener('click', function() {
                navigateToLatestMovies(query.trim());
            });
            results.append(message, browseButton);
            return;
        }

        matches.forEach(function(movie) {
            const resultButton = document.createElement('button');
            resultButton.type = 'button';
            resultButton.className = 'movie-search-result';
            resultButton.setAttribute('role', 'option');

            const poster = movie.card.querySelector('img');
            if (poster?.src) {
                const image = document.createElement('img');
                image.src = poster.src;
                image.alt = '';
                image.loading = 'lazy';
                resultButton.appendChild(image);
            }

            const resultTitle = document.createElement('span');
            resultTitle.textContent = movie.title;
            resultButton.appendChild(resultTitle);
            resultButton.addEventListener('click', function() {
                const detailsOverlay = document.getElementById('movieDetailsOverlay');
                closeSearch();

                if (movie.id && typeof window.openMovieDetails === 'function') {
                    window.openMovieDetails(movie.id);
                }

                if (!detailsOverlay?.classList.contains('is-open')) {
                    movie.card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    movie.card.click();
                }
            });
            results.appendChild(resultButton);
        });
    }

    function placeSearchButton() {
        const topBarSocial = document.querySelector('.top-bar-right .social-icons');
        const navbarRight = document.querySelector('.movie-navbar-right');
        const cityButton = navbarRight?.querySelector('.movie-city-btn');
        const menuList = document.querySelector('.movie-side-menu .movie-menu-list');
        let target;

        if (window.innerWidth >= 1200 && navbarRight) {
            searchButton.className = 'movie-search-trigger navbar-search-trigger';
            searchButton.type = 'submit';
            if (headerSearch.parentElement !== navbarRight) {
                navbarRight.insertBefore(headerSearch, cityButton || navbarRight.firstChild);
            }
            return;
        }

        headerSearch.remove();
        searchButton.type = 'button';

        if (window.innerWidth >= 992 && topBarSocial) {
            target = topBarSocial;
            searchButton.className = 'movie-search-trigger top-bar-search-trigger';
        } else if (window.innerWidth >= 576 && navbarRight) {
            target = navbarRight;
            searchButton.className = 'movie-search-trigger navbar-search-trigger';
        } else if (menuList) {
            target = menuList;
            searchButton.className = 'movie-menu-item movie-search-trigger movie-search-menu-trigger';
        }

        if (target && searchButton.parentElement !== target) {
            target.insertBefore(searchButton, target.firstChild);
        }
    }

    searchButton.addEventListener('click', function(event) {
        if (headerSearch.parentElement) {
            event.preventDefault();
            openSearch(headerInput.value.trim());
        } else {
            openSearch('');
        }
    });
    headerSearch.addEventListener('submit', function(event) {
        event.preventDefault();
        openSearch(headerInput.value.trim());
    });
    closeButton.addEventListener('click', closeSearch);
    input.addEventListener('input', function() {
        renderMovieSearchResults(input.value);
    });
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const firstResult = results.querySelector('.movie-search-result');
        if (firstResult) firstResult.click();
        else if (input.value.trim()) navigateToLatestMovies(input.value.trim());
    });
    overlay.addEventListener('click', function(event) {
        if (event.target === overlay) closeSearch();
    });
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && overlay.classList.contains('is-open')) closeSearch();
    });

    placeSearchButton();
    window.addEventListener('resize', placeSearchButton);
}

function removeNonfunctionalViewAllLinks() {
    document.querySelectorAll('a.view_all[href="#"]').forEach(function(link) {
        if (!link.hasAttribute('onclick')) link.remove();
    });

    document.querySelectorAll('.movie-details-section-heading > span').forEach(function(label) {
        if (/^(view all|see all)$/i.test(label.textContent.trim())) label.remove();
    });
}

function applyLatestMovieSearch() {
    const searchTerm = new URLSearchParams(window.location.search).get('search')?.trim();
    if (!searchTerm || !window.location.pathname.toLowerCase().endsWith('/latest-movies.html')) return;

    const normalizedTerm = searchTerm.toLowerCase();
    const cards = Array.from(document.querySelectorAll('.movie_section .movie_card'));
    if (!cards.length) return;

    let matchingCards = 0;
    cards.forEach(function(card) {
        const title = card.querySelector('.movie_title, .movie-title, h3, h4')?.textContent.trim() ||
            card.querySelector('img[alt]')?.alt.trim() || '';
        const matches = title.toLowerCase().includes(normalizedTerm);
        const container = card.closest('.swiper-slide, [class*="col-"]') || card;
        container.style.display = matches ? '' : 'none';
        if (matches) matchingCards += 1;
    });

    document.querySelectorAll('.swiper').forEach(function(swiperElement) {
        if (swiperElement.swiper) swiperElement.swiper.update();
    });

    document.querySelectorAll('section.movie_section').forEach(function(section) {
        const sectionCards = section.querySelectorAll('.movie_card');
        if (sectionCards.length) {
            section.style.display = Array.from(sectionCards).some(function(card) {
                const container = card.closest('.swiper-slide, [class*="col-"]') || card;
                return container.style.display !== 'none';
            }) ? '' : 'none';
        }
    });

    if (!matchingCards) {
        const message = document.createElement('p');
        message.className = 'movie-search-page-empty';
        message.textContent = 'No movies found for "' + searchTerm + '".';
        const firstSection = document.querySelector('section.movie_section');
        if (firstSection) firstSection.before(message);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initializeMovieSearch();
    removeNonfunctionalViewAllLinks();
    applyLatestMovieSearch();

    document.addEventListener('click', function(event) {
        if (!(event.target instanceof Element)) return;

        const bookingControl = event.target.closest(
            '.book_movie_btn, .movie-book-btn, [onclick*="bookSelectedMovie"]'
        );
        if (!bookingControl || bookingControl.closest('.booking-page')) return;

        const href = bookingControl.getAttribute('href');
        if (href && href !== '#') {
            const targetUrl = new URL(href, window.location.href);
            if (targetUrl.pathname.toLowerCase().endsWith('/booking.html')) return;
        }

        const movieCard = bookingControl.closest('.movie_card, .movie-card-clickable');
        const movieTitle =
            movieCard?.querySelector('.movie_title, .movie-title, h3, h4')?.textContent.trim() ||
            document.querySelector('#movieDetailsOverlay.is-open #movieDetailsTitle')?.textContent.trim();
        const bookingUrl = new URL('booking.html', window.location.href);

        if (movieTitle && movieTitle !== 'Movie Title') {
            bookingUrl.searchParams.set('movie', movieTitle);
        }

        event.preventDefault();
        event.stopPropagation();
        window.location.assign(bookingUrl.href);
    }, true);
});