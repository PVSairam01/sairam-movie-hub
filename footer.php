<footer class="footer">

        <div class="movie_container">

            <div class="row g-4">


                <!-- Footer Brand -->
                <div class="col-lg-4">

                    <h3>
                        🎬 Sairam Movie Hub
                    </h3>

                    <p>
                        Book Your Favourite Movies Anytime, Anywhere.
                    </p>


                    <div class="social_icons">

                        <a href="#">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-youtube"></i>
                        </a>

                    </div>

                </div>


                <!-- Quick Links -->
                <div class="col-lg-2 col-6">

                    <h5>
                        Quick Links
                    </h5>

                    <ul>

                        <li>
                            <a href="Home.php">Home</a>
                        </li>

                        <li>
                            <a href="#">Movies</a>
                        </li>

                        <li>
                            <a href="#">Cast</a>
                        </li>

                        <li>
                            <a href="#">Offers</a>
                        </li>

                    </ul>

                </div>


                <!-- Support -->
                <div class="col-lg-3 col-6">

                    <h5>
                        Support
                    </h5>

                    <ul>

                        <li>
                            <a href="#">Privacy Policy</a>
                        </li>

                        <li>
                            <a href="#">Terms & Conditions</a>
                        </li>

                        <li>
                            <a href="#">FAQs</a>
                        </li>

                        <li>
                            <a href="#">Help Center</a>
                        </li>

                    </ul>

                </div>


                <!-- Contact -->
                <div class="col-lg-3">

                    <h5>
                        Contact
                    </h5>

                    <p>
                        📍 Kakinada, India
                    </p>

                    <p>
                        📞 +91 9390717011
                    </p>

                    <p>
                        ✉ sairampachipala00@gmail.com
                    </p>

                </div>

            </div>


            <hr class="my-4 text-secondary">


            <div class="copyright text-center">

                <p class="mb-0">

                    © <?php echo date('Y'); ?>
                    Sairam Movie Hub.
                    All Rights Reserved.

                </p>

            </div>

        </div>

    </footer>

    <!-- ========================================================= -->
    <!-- FLOATING ACTION BUTTONS + CHATBOT -->
    <!-- Added without changing the existing footer structure -->
    <!-- ========================================================= -->

    <style>
        .floating-btn-container {
            position: fixed;
            right: 22px;
            bottom: 22px;
            z-index: 9998;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .floating-btn {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border: 0;
            color: #fff;
            font-size: 27px;
            cursor: pointer;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.28);
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .floating-btn:hover {
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.34);
            color: #fff;
        }

        .whatsapp-btn {
            background: #25D366;
        }

        .whatsapp-btn:hover {
            background: #1fbe5a;
        }

        .hotline-btn {
            background: #eb102a;
            position: relative;
        }

        .hotline-btn:hover {
            background: #d90d25;
        }

        .instagram-btn {
            background:
                radial-gradient(circle at 30% 107%,
                #fdf497 0%, #fdf497 5%,
                #fd5949 45%, #d6249f 60%, #285AEB 90%);
        }

        .hotline-chat-icon {
            position: relative;
            width: 29px;
            height: 22px;
            border-radius: 6px;
            background: #fff;
            display: block;
        }

        .hotline-chat-icon::after {
            content: "";
            position: absolute;
            left: 6px;
            bottom: -5px;
            width: 0;
            height: 0;
            border-top: 7px solid #fff;
            border-right: 7px solid transparent;
        }

        .hotline-chat-icon .chat-line {
            position: absolute;
            left: 7px;
            right: 7px;
            height: 3px;
            border-radius: 10px;
            background: #eb102a;
        }

        .hotline-chat-icon .line-one {
            top: 7px;
        }

        .hotline-chat-icon .line-two {
            top: 12px;
            right: 11px;
        }

        #chatbot-window {
            position: fixed;
            right: 96px;
            bottom: 24px;
            width: 390px;
            height: 540px;
            z-index: 9999;
            display: none;
            flex-direction: column;
            background: #f7f8fa;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.28);
        }

        #chat-header {
            position: relative;
            flex: 0 0 150px;
            background: #eb102a;
            color: #fff;
            padding: 26px 28px;
        }

        .chat-brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #20c76a;
        }

        .chat-brand-icon .hotline-chat-icon {
            transform: scale(.55);
        }

        .chat-brand-icon .hotline-chat-icon .chat-line {
            background: #20c76a;
        }

        #chat-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 38px;
            height: 38px;
            border: 0;
            border-radius: 50%;
            background: rgba(42, 62, 75, .92);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
        }

        .chat-content-card {
            position: relative;
            margin: -42px 16px 16px;
            height: calc(100% - 108px);
            display: flex;
            flex-direction: column;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        .chat-window-title {
            flex: 0 0 auto;
            padding: 18px 20px 14px;
            font-size: 20px;
            line-height: 1.2;
            font-weight: 700;
            color: #3d5273;
            border-bottom: 1px solid #e8ebef;
        }

        #chat-body {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            padding: 8px 16px 18px;
            background: #fff;
        }

        .service-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 4px;
            background: transparent;
            border: 0;
            border-bottom: 1px solid #e5e8ed;
            text-align: left;
            cursor: pointer;
            transition: background .18s ease;
        }

        .service-btn:hover {
            background: #fafbfc;
        }

        .service-avatar {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 17px;
        }

        .service-avatar.blue { background: #7882d7; }
        .service-avatar.red { background: #ef5c50; }
        .service-avatar.green { background: #46b6ad; }
        .service-avatar.gold { background: #d7a932; }

        .service-text {
            min-width: 0;
        }

        .service-title {
            display: block;
            margin-bottom: 3px;
            color: #3e5272;
            font-size: 16px;
            line-height: 1.2;
            font-weight: 650;
        }

        .service-preview {
            display: block;
            color: #6d819b;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-msg {
            text-align: right;
            margin: 10px 0;
        }

        .bot-msg {
            text-align: left;
            margin: 10px 0;
        }

        .message-bubble {
            display: inline-block;
            max-width: 88%;
            padding: 10px 13px;
            border-radius: 14px;
            font-size: 14px;
            line-height: 1.45;
        }

        .bot-bubble {
            background: #f1f3f6;
            color: #3e5272;
            border: 1px solid #e4e7eb;
        }

        .user-msg .message-bubble {
            background: #eb102a;
            color: #fff;
        }

        .bot-bubble a {
            color: #eb102a;
            font-weight: 700;
            text-decoration: none;
        }

        .restart-btn {
            border: 0;
            border-radius: 8px;
            padding: 9px 14px;
            background: #eb102a;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .restart-btn:hover {
            background: #cf0c22;
        }

        @media (max-width: 767.98px) {
            .floating-btn-container {
                right: 14px;
                bottom: 16px;
                gap: 10px;
            }

            .floating-btn {
                width: 54px;
                height: 54px;
                font-size: 25px;
            }

            #chatbot-window {
                right: 12px;
                bottom: 82px;
                width: calc(100vw - 24px);
                max-width: 390px;
                height: min(560px, calc(100vh - 105px));
            }
        }

        @media (max-width: 420px) {
            #chatbot-window {
                left: 10px;
                right: 10px;
                width: auto;
            }

            #chat-header {
                flex-basis: 138px;
                padding: 22px;
            }

            .chat-content-card {
                margin-left: 12px;
                margin-right: 12px;
            }
        }
    </style>


    <!-- FLOATING ACTION BUTTONS -->
    <div class="floating-btn-container">

        <!-- WhatsApp -->
        <a href="https://wa.me/919390717011"
           class="floating-btn whatsapp-btn"
           aria-label="WhatsApp"
           target="_blank"
           rel="noopener">
            <i class="fa-brands fa-whatsapp"></i>
        </a>

        <!-- Hotline Chatbot -->
        <a href="#"
           id="chatbot-icon"
           class="floating-btn hotline-btn"
           aria-label="Chat with Sairam Movie Hub"
           onclick="toggleChatbot(); return false;">
            <span class="hotline-chat-icon" aria-hidden="true">
                <span class="chat-line line-one"></span>
                <span class="chat-line line-two"></span>
            </span>
        </a>

        <!-- Instagram -->
        <a href="https://www.instagram.com/sairam.patchipala?stkn=MXF3c3J2a2xyYmF4bQ=="
           class="floating-btn instagram-btn"
           aria-label="Instagram"
           target="_blank"
           rel="noopener">
            <i class="fa-brands fa-instagram"></i>
        </a>

    </div>


    <!-- CHATBOT WINDOW -->
    <div id="chatbot-window">

        <div id="chat-header">

            <div class="chat-brand-icon" aria-hidden="true">
                <span class="hotline-chat-icon">
                    <span class="chat-line line-one"></span>
                    <span class="chat-line line-two"></span>
                </span>
            </div>

            <button type="button"
                    id="chat-close"
                    onclick="toggleChatbot()"
                    aria-label="Close chat">
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

        <div class="chat-content-card">

            <div class="chat-window-title">
                Chat with us
            </div>

            <div id="chat-body"></div>

        </div>

    </div>


    <script>
        const chatBody = document.getElementById('chat-body');
        const chatbotWindow = document.getElementById('chatbot-window');

        const chatbotContactNumber = '+91 9390717011';
        const chatbotWhatsappNumber = '919390717011';

        const chatbotServices = {

            booking: {
                name: 'Movie Ticket Booking',
                short: 'Help with shows, seats and ticket booking.',
                avatar: 'B',
                color: 'blue',
                content: 'Need help booking movie tickets? Select your movie, theatre, show time and seats, then continue to payment. If you face any issue during booking, our team can assist you.'
            },

            cancellation: {
                name: 'Cancellation / Exchange Request',
                short: 'Help with booking cancellation or changes.',
                avatar: 'C',
                color: 'red',
                content: 'For cancellation or booking-change requests, keep your booking details ready. Eligibility depends on the booking and theatre policy. Contact our support team for assistance.'
            },

            payment: {
                name: 'Payment / Refund Issue',
                short: 'Payment failed, debited amount or refund help.',
                avatar: 'P',
                color: 'gold',
                content: 'If your payment failed, money was debited, or a refund is pending, please share your booking reference and payment details with our support team. Do not share OTP, CVV or banking passwords.'
            },

            confirmation: {
                name: 'Confirmation Not Received?',
                short: 'Ticket or booking confirmation not received.',
                avatar: 'C',
                color: 'red',
                content: 'If payment was completed but you did not receive a ticket confirmation, please check your SMS/email first. If it is still missing, contact us with your mobile number and transaction reference.'
            },

            feedback: {
                name: 'Cinema Related Feedback',
                short: 'Share theatre, screen or service feedback.',
                avatar: 'F',
                color: 'green',
                content: 'We welcome feedback about your movie-going experience. Tell us the theatre/show details and your feedback, and our team will review it.'
            },

            general: {
                name: 'General Support',
                short: 'Can we connect you to an advisor?',
                avatar: 'G',
                color: 'red',
                content: 'For any other query related to Sairam Movie Hub, our support team can help you.'
            }

        };

        function toggleChatbot() {
            if (!chatbotWindow) return;

            const isOpen = chatbotWindow.style.display === 'flex';

            if (isOpen) {
                chatbotWindow.style.display = 'none';
            } else {
                chatbotWindow.style.display = 'flex';
                displayWelcomeMessage();
            }
        }

        function appendChatbotMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.className = sender + '-msg';

            const bubble = document.createElement('span');
            bubble.className = 'message-bubble';

            if (sender === 'bot') {
                bubble.classList.add('bot-bubble');
            }

            bubble.innerHTML = text;

            messageDiv.appendChild(bubble);
            chatBody.appendChild(messageDiv);
            chatBody.scrollTop = chatBody.scrollHeight;

            return messageDiv;
        }

        function displayWelcomeMessage() {
            if (!chatBody) return;

            chatBody.innerHTML = '';

            Object.keys(chatbotServices).forEach((key) => {
                const service = chatbotServices[key];

                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'service-btn';

                button.innerHTML = `
                    <span class="service-avatar ${service.color}">
                        ${service.avatar}
                    </span>

                    <span class="service-text">
                        <span class="service-title">${service.name}</span>
                        <span class="service-preview">${service.short}</span>
                    </span>
                `;

                button.addEventListener('click', () => showChatbotServiceDetails(key));

                chatBody.appendChild(button);
            });
        }

        function showChatbotServiceDetails(serviceKey) {
            const service = chatbotServices[serviceKey];

            if (!service) return;

            chatBody.innerHTML = '';

            appendChatbotMessage(`I need help with ${service.name}.`, 'user');

            const supportMessage = `
                ${service.content}

                <br><br>

                <b>Need further assistance?</b><br>

                Call us:
                <a href="tel:+919390717011">${chatbotContactNumber}</a>

                <br>

                WhatsApp:
                <a href="https://wa.me/${chatbotWhatsappNumber}"
                   target="_blank"
                   rel="noopener">
                    Chat with our support team
                </a>
            `;

            setTimeout(() => {
                appendChatbotMessage(supportMessage, 'bot');

                const restartContainer = document.createElement('div');
                restartContainer.style.textAlign = 'center';
                restartContainer.style.marginTop = '14px';
                restartContainer.style.marginBottom = '8px';

                const restartButton = document.createElement('button');
                restartButton.type = 'button';
                restartButton.className = 'restart-btn';
                restartButton.textContent = 'Back to Main Menu';
                restartButton.onclick = displayWelcomeMessage;

                restartContainer.appendChild(restartButton);
                chatBody.appendChild(restartContainer);
                chatBody.scrollTop = chatBody.scrollHeight;
            }, 250);
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (chatbotWindow) {
                chatbotWindow.style.display = 'none';
            }
        });
    </script>



    


    <!-- =========================================================
         LOGIN POPUP
         ========================================================= -->

    <div class="login_popup"
         id="loginPopup">


        <div class="login_card">


            <!-- Close -->
            <button class="close_popup"
                    id="closePopup">

                <i class="bi bi-x-lg"></i>

            </button>


            <h2 class="login_title">
                Get Started
            </h2>


            <!-- Google -->
            <button class="login_btn"
                    id="googleLoginBtn">

                <img
                    src="assets/images/icons/google.png"
                    alt="Google"
                    onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg'">

                <span>
                    Continue with Google
                </span>

            </button>


            <!-- Email -->
            <button class="login_btn">

                <i class="bi bi-envelope"></i>

                <span>
                    Continue with Email
                </span>

            </button>


            <!-- Apple -->
            <button class="login_btn">

                <i class="bi bi-apple"></i>

                <span>
                    Continue with Apple
                </span>

            </button>


            <!-- OR -->
            <div class="login_or">

                <span>
                    OR
                </span>

            </div>


            <!-- Mobile Login -->
            <div class="mobile_login_box">


                <div class="country_code">

                    <img
                        src="assets/images/icons/india.png"
                        alt="India"
                        onerror="this.src='https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg'">

                    <span>
                        +91
                    </span>

                    <i class="bi bi-chevron-down"></i>

                </div>


                <input
                    type="text"
                    placeholder="Continue with mobile number">

            </div>


            <!-- Terms -->
            <p class="login_terms">

                I agree to

                <a href="#">
                    Terms & Conditions
                </a>

                and

                <a href="#">
                    Privacy Policy
                </a>

            </p>


        </div>

    </div>

    <!-- ========================================================= -->
<!-- MOVIE DETAILS - PREMIUM MOVIE OVERLAY                    -->
<!-- ========================================================= -->
<div class="movie-details-overlay" id="movieDetailsOverlay" aria-hidden="true">
    <div class="movie-details-backdrop" onclick="closeMovieDetails()"></div>

    <section class="movie-details-panel" id="movieDetailsPanel" role="dialog" aria-modal="true" aria-labelledby="movieDetailsTitle">
        <button type="button" class="movie-details-close" onclick="closeMovieDetails()" aria-label="Close movie details">
            <i class="bi bi-x-lg"></i>
        </button>

        <div class="movie-details-hero">
            <img id="movieDetailsBackdrop" src="" alt="Movie background">
            <div class="movie-details-hero-overlay"></div>
        </div>

        <div class="movie-details-body">
            <div class="movie-details-main">
                <div class="movie-details-poster-wrap">
                    <img id="movieDetailsPoster" class="movie-details-poster" src="" alt="Movie poster">
                    <span class="movie-details-status">In cinemas</span>
                </div>

                <div class="movie-details-info">
                    <span class="movie-details-kicker">MOVIE DETAILS</span>
                    <h2 id="movieDetailsTitle">Movie Title</h2>

                    <div class="movie-details-rating-row">
                        <div class="movie-details-rating">
                            <i class="bi bi-star-fill"></i>
                            <strong id="movieDetailsRating">9.2/10</strong>
                            <span id="movieDetailsVotes">120K+ Votes</span>
                        </div>
                        <button type="button" class="movie-rate-btn">Rate now</button>
                    </div>

                    <p class="movie-details-meta" id="movieDetailsMeta"></p>

                    <div class="movie-details-tags" id="movieDetailsTags"></div>

                    <div class="movie-details-actions">
                        <button type="button" class="movie-book-btn" onclick="bookSelectedMovie()">
                            <i class="bi bi-ticket-perforated-fill"></i>
                            Book tickets
                        </button>
                        <button type="button" class="movie-share-btn" onclick="shareSelectedMovie()">
                            <i class="bi bi-share"></i>
                            Share
                        </button>
                    </div>
                </div>
            </div>

            <div class="movie-about-section">
                <h3>About the movie</h3>
                <p class="movie-accessibility"><strong>Accessibility:</strong> Closed Captions (CC) &amp; Audio Description (AD) available.</p>
                <p id="movieDetailsStory"></p>
            </div>

            <div class="movie-offers-section">
                <div class="movie-details-section-heading">
                    <h3>Top offers for you</h3>
                    <span>View all <i class="bi bi-chevron-right"></i></span>
                </div>
                <div class="movie-offers-grid">
                    <button type="button" class="movie-offer-card">
                        <i class="bi bi-ticket-perforated-fill"></i>
                        <span><strong>Enjoy special ticket offers</strong><small>Tap to view details</small></span>
                    </button>
                    <button type="button" class="movie-offer-card">
                        <i class="bi bi-check2-circle"></i>
                        <span><strong>Buy 1 get 1 movie tickets</strong><small>Tap to view details</small></span>
                    </button>
                </div>
            </div>

            <div class="movie-cast-section">
                <div class="movie-details-section-heading">
                    <h3>Cast</h3>
                    <button type="button" class="movie-carousel-arrow" onclick="scrollMovieRow('movieCastRow')"><i class="bi bi-chevron-right"></i></button>
                </div>
                <div class="movie-person-row" id="movieCastRow"></div>
            </div>

            <div class="movie-crew-section">
                <div class="movie-details-section-heading">
                    <h3>Crew</h3>
                    <button type="button" class="movie-carousel-arrow" onclick="scrollMovieRow('movieCrewRow')"><i class="bi bi-chevron-right"></i></button>
                </div>
                <div class="movie-person-row" id="movieCrewRow"></div>
            </div>

            <div class="movie-reviews-section">
                <div class="movie-details-section-heading">
                    <h3>Critic reviews</h3>
                    <span>See all <i class="bi bi-chevron-right"></i></span>
                </div>
                <article class="movie-review-card">
                    <div class="movie-review-top">
                        <span class="movie-review-avatar"><i class="bi bi-person"></i></span>
                        <strong>Free Press Journal</strong>
                        <span class="movie-review-score"><i class="bi bi-star-fill"></i> 7/10</span>
                    </div>
                    <h4 id="movieReviewTitle">Movie Review</h4>
                    <p id="movieReviewText">A strong cinematic experience with memorable performances, engaging visuals and a story built for the big screen.</p>
                    <div class="movie-review-actions"><button type="button"><i class="bi bi-hand-thumbs-up"></i></button><button type="button"><i class="bi bi-hand-thumbs-down"></i></button><button type="button" onclick="shareSelectedMovie()"><i class="bi bi-share"></i></button></div>
                </article>
            </div>

            <div class="movie-related-section">
                <div class="movie-details-section-heading">
                    <h3>You might also like</h3>
                    <span>View All <i class="bi bi-chevron-right"></i></span>
                </div>
                <div class="movie-related-row" id="movieRelatedRow"></div>
            </div>
        </div>
    </section>
</div>


<!-- PREMIUM LOCATION MODAL -->
<div class="modal fade location-modal" id="locationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <!-- SEARCH & DETECT LOCATION SECTION -->
            <div class="location-search-section">
                <div class="location-search-box">
                    <i class="bi bi-search location-search-icon"></i>
                    <input type="text" id="citySearchInput" class="location-search-input" placeholder="Search for your city" onkeyup="searchCities()">
                </div>
                
                <button id="detectLocationBtn" class="detect-location-btn" onclick="detectLocation(); return false;">
                    <span class="detect-location-icon"><i class="bi bi-crosshair"></i></span>
                    <span id="detectLocationText">Detect my location</span>
                </button>
                <div id="locationStatus" class="location-status" style="display: none;"></div>
            </div>

            <!-- SCROLLABLE BODY CONTAINER -->
            <div class="modal-scrollable-body">
                
                <!-- POPULAR CITIES -->
                <div class="popular-cities-section text-center">
                    <div class="location-section-title">
                        <h6>Popular Cities</h6>
                    </div>
                    <div id="initialCities" class="popular-cities-grid"></div>
                </div>

                <!-- VIEW ALL CITIES BUTTON -->
                <div class="text-center my-3">
                    <a href="#" id="viewAllCitiesBtn" class="city-action-btn" onclick="showAllCities(); return false;">View All Cities</a>
                </div>

                <!-- EXPANDABLE A-Z CITIES SECTION -->
                <div id="allCitiesList" class="all-cities-wrapper" style="display: none;">
                    <div class="location-section-title text-center my-3">
                        <h6>Other Cities</h6>
                    </div>
                    
                    <!-- 5-Column Grid Container -->
                    <div id="allCities" class="all-cities-grid"></div>
                    
                    <!-- HIDE ALL CITIES BUTTON -->
                    <div class="text-center my-4">
                        <a href="#" id="hideAllCitiesBtn" class="city-action-btn" onclick="hideAllCities(); return false;" style="display: none;">Hide all cities</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


    <!-- =========================================================
         JAVASCRIPT
         ========================================================= -->

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <!-- Google Sign-In -->
    <script src="https://accounts.google.com/gsi/client"
            async
            defer>
    </script>


    <!-- Custom JavaScript -->
    <script src="assets/js/script.js"></script>

    <script src="assets/js/google-login.js"></script>

    <script src="assets/js/location.js"></script>

    <script src="assets/js/visual-effects.js"></script>

    <!-- =========================================================
     PAGE INTERACTION FALLBACKS & TELUGU MOVIES FUNCTIONALITY
     ========================================================= -->
<script>
(function () {
    'use strict';

    let teluguSwiperInstance = null;
    let selectedMovieId = null;

    // Full Movie Database
    const movieData = {
        'avengers': {
            title: 'Avengers Endgame',
            image: 'assets/images/movies/movie1.jpg',
            rating: '9.2/10',
            votes: '210K+ Votes',
            meta: '3h 01m  •  Action, Adventure, Sci-Fi  •  UA  •  English',
            tags: ['2D', '3D', 'IMAX', 'English', 'Hindi'],
            story: 'After the devastating events of Infinity War, the remaining Avengers unite for one final mission. They must find a way to reverse the damage, face impossible choices and fight for the future of their world.',
            cast: [['Robert Downey Jr.', 'Actor', 'assets/images/profile/cast1.jpg'], ['Chris Evans', 'Actor', 'assets/images/cast/cast2.jpg'], ['Scarlett Johansson', 'Actress', 'assets/images/cast/cast3.jpg'], ['Tom Holland', 'Actor', 'assets/images/cast/cast4.jpg']],
            crew: [['Anthony Russo', 'Director', 'assets/images/profile/cast1.jpg'], ['Joe Russo', 'Director', 'assets/images/cast/cast2.jpg'], ['Kevin Feige', 'Producer', 'assets/images/cast/cast3.jpg']],
            review: 'A massive superhero spectacle that balances action, emotion and character moments with a satisfying big-screen payoff.'
        },
        'mission-impossible': {
            title: 'Mission Impossible',
            image: 'assets/images/movies/movie2.jpg',
            rating: '8.8/10',
            votes: '180K+ Votes',
            meta: '2h 40m  •  Action, Thriller  •  UA  •  English',
            tags: ['IMAX', '4DX', 'English', 'Hindi'],
            story: 'A highly trained agent faces a dangerous mission where every decision carries a consequence. With time running out, the team must rely on trust, skill and courage to prevent a global threat.',
            cast: [['Tom Cruise', 'Actor', 'assets/images/cast/cast1.jpg'], ['Rebecca Ferguson', 'Actress', 'assets/images/cast/cast2.jpg'], ['Simon Pegg', 'Actor', 'assets/images/cast/cast3.jpg']],
            crew: [['Christopher McQuarrie', 'Director', 'assets/images/cast/cast4.jpg'], ['Tom Cruise', 'Producer', 'assets/images/cast/cast1.jpg']],
            review: 'Fast, stylish and packed with practical action, this is the kind of movie designed to be experienced in a theatre.'
        },
        'avatar': {
            title: 'Avatar',
            image: 'assets/images/movies/movie3.jpg',
            rating: '9.0/10',
            votes: '195K+ Votes',
            meta: '2h 52m  •  Adventure, Fantasy  •  UA  •  English',
            tags: ['3D', 'IMAX', 'English', 'Hindi'],
            story: 'A journey into a spectacular world filled with extraordinary landscapes, powerful relationships and a conflict that changes the fate of an entire people.',
            cast: [['Sam Worthington', 'Actor', 'assets/images/cast/cast1.jpg'], ['Zoe Saldana', 'Actress', 'assets/images/cast/cast2.jpg'], ['Sigourney Weaver', 'Actress', 'assets/images/cast/cast3.jpg']],
            crew: [['James Cameron', 'Director', 'assets/images/cast/cast4.jpg'], ['Jon Landau', 'Producer', 'assets/images/cast/cast1.jpg']],
            review: 'Visually ambitious and immersive, Avatar continues to stand out for its world-building and theatrical scale.'
        },
        'spider-man': {
            title: 'Spider-Man',
            image: 'assets/images/movies/about-movie4.png',
            rating: '8.9/10',
            votes: '175K+ Votes',
            meta: '2h 28m  •  Action, Super Hero  •  UA  •  English',
            tags: ['4DX', 'IMAX', 'English', 'Hindi'],
            story: 'A young hero balances everyday life with the responsibility of protecting his city. New challenges force him to discover what being a hero truly means.',
            cast: [['Tom Holland', 'Actor', 'assets/images/profile/tom-holland.png'], ['Zendaya', 'Actress', 'assets/images/profile/zendaya.png'], ['Jacob Batalon', 'Actor', 'assets/images/profile/jacob-batalon.png']],
            crew: [['Jon Watts', 'Director', 'assets/images/profile/cast1.jpg'], ['Kevin Feige', 'Producer', 'assets/images/profile/cast3.jpg']],
            review: 'A fun, energetic superhero adventure with heart, humour and plenty of crowd-pleasing action.'
        },
        'batman': {
            title: 'The Batman',
            image: 'assets/images/movies/movie5.png',
            rating: '9.1/10',
            votes: '205K+ Votes',
            meta: '2h 56m  •  Action, Crime, Drama  •  UA  •  English',
            tags: ['IMAX', '2D', 'English', 'Hindi'],
            story: 'A mysterious crime pushes Batman deeper into Gotham’s underworld. As he follows a trail of clues, he discovers how corruption connects powerful figures across the city.',
            cast: [['Robert Pattinson', 'Actor', 'assets/images/cast/cast1.jpg'], ['Zoë Kravitz', 'Actress', 'assets/images/cast/cast2.jpg'], ['Jeffrey Wright', 'Actor', 'assets/images/cast/cast3.jpg']],
            crew: [['Matt Reeves', 'Director', 'assets/images/cast/cast4.jpg'], ['Dylan Clark', 'Producer', 'assets/images/cast/cast1.jpg']],
            review: 'A dark, atmospheric detective story that gives the superhero genre a grounded and intense identity.'
        },
        'jurassic-world': {
            title: 'Jurassic World',
            image: 'assets/images/movies/latest1.jpg',
            rating: '9.1/10',
            votes: '160K+ Votes',
            meta: '2h 20m  •  Adventure, Sci-Fi  •  UA  •  English',
            tags: ['3D', 'IMAX', 'English'],
            story: 'A new chapter of the Jurassic adventure brings humans and dinosaurs into an unpredictable world where survival depends on courage and quick decisions.',
            cast: [['Chris Pratt', 'Actor', 'assets/images/cast/cast1.jpg'], ['Bryce Dallas Howard', 'Actress', 'assets/images/cast/cast2.jpg']],
            crew: [['Colin Trevorrow', 'Director', 'assets/images/cast/cast4.jpg']],
            review: 'A thrilling dinosaur adventure with spectacle, suspense and family-friendly entertainment.'
        },
        'captain-america': {
            title: 'Captain America',
            image: 'assets/images/movies/latest2.jpg',
            rating: '8.8/10',
            votes: '145K+ Votes',
            meta: '2h 18m  •  Action, Super Hero  •  UA  •  English',
            tags: ['2D', 'IMAX', 'English'],
            story: 'A new mission tests a hero’s values and leadership as he confronts threats from both outside and within the system.',
            cast: [['Anthony Mackie', 'Actor', 'assets/images/cast/cast1.jpg'], ['Harrison Ford', 'Actor', 'assets/images/cast/cast2.jpg']],
            crew: [['Julius Onah', 'Director', 'assets/images/cast/cast4.jpg']],
            review: 'A solid superhero action film driven by character, responsibility and large-scale set pieces.'
        },
        'superman': {
            title: 'Superman',
            image: 'assets/images/movies/latest3.jpg',
            rating: '9.4/10',
            votes: '220K+ Votes',
            meta: '2h 10m  •  Action, Adventure  •  UA  •  English',
            tags: ['IMAX', '4DX', 'English'],
            story: 'A hopeful hero discovers that extraordinary power comes with extraordinary responsibility while protecting a world that is still learning to trust him.',
            cast: [['David Corenswet', 'Actor', 'assets/images/cast/cast1.jpg'], ['Rachel Brosnahan', 'Actress', 'assets/images/cast/cast2.jpg']],
            crew: [['James Gunn', 'Director', 'assets/images/cast/cast4.jpg']],
            review: 'A bright and character-focused superhero adventure built around optimism, courage and spectacle.'
        },
        'the-batman': {
            title: 'The Batman',
            image: 'assets/images/movies/latest4.jpg',
            rating: '9.0/10',
            votes: '190K+ Votes',
            meta: '2h 56m  •  Action, Crime, Drama  •  UA  •  English',
            tags: ['IMAX', '2D', 'English'],
            story: 'Gotham faces another dangerous mystery as its masked protector follows a trail that reveals deeper secrets beneath the city.',
            cast: [['Robert Pattinson', 'Actor', 'assets/images/cast/cast1.jpg'], ['Paul Dano', 'Actor', 'assets/images/cast/cast2.jpg']],
            crew: [['Matt Reeves', 'Director', 'assets/images/cast/cast4.jpg']],
            review: 'A gripping comic-book crime drama with strong atmosphere and detective-driven storytelling.'
        },
        'dune': {
            title: 'Dune',
            image: 'assets/images/movies/latest5.jpg',
            rating: '9.3/10',
            votes: '185K+ Votes',
            meta: '2h 46m  •  Sci-Fi, Drama  •  UA  •  English',
            tags: ['IMAX', 'Dolby Cinema', 'English'],
            story: 'On a distant desert world, a young heir is drawn into a dangerous struggle involving power, prophecy and the future of an entire civilisation.',
            cast: [['Timothée Chalamet', 'Actor', 'assets/images/cast/cast1.jpg'], ['Zendaya', 'Actress', 'assets/images/cast/cast2.jpg']],
            crew: [['Denis Villeneuve', 'Director', 'assets/images/cast/cast4.jpg']],
            review: 'Epic science fiction with extraordinary production design, sound and world-building.'
        },
        'pushpa-2': {
            title: 'Pushpa 2: The Rule',
            image: 'assets/images/movies/Pushpa-2-theRule.png',
            rating: '9.4/10',
            votes: '350K+ Votes',
            meta: '3h 20m  •  Action, Drama  •  UA16+  •  Telugu',
            tags: ['2D', '3D', 'IMAX 2D', 'Telugu', 'Hindi', 'Tamil'],
            story: 'Pushpa Raj expands his red sandalwood empire while facing unrelenting opposition from SP Bhanwar Singh Shekhawat in a high-stakes battle for dominance.',
            cast: [['Allu Arjun', 'Actor', 'assets/images/profile/pushpa-2.png'], ['Rashmika Mandanna', 'Actress', 'assets/images/cast/cast2.jpg'], ['Fahadh Faasil', 'Actor', 'assets/images/cast/cast3.jpg']],
            crew: [['Sukumar', 'Director', 'assets/images/cast/cast4.jpg'], ['DSP', 'Music Director', 'assets/images/cast/cast1.jpg']],
            review: 'An explosive mass entertainer with powerful performances and high-voltage action sequences.'
        },
        'devara': {
            title: 'Devara Part 1',
            image: 'assets/images/movies/devara1.png',
            rating: '9.1/10',
            votes: '240K+ Votes',
            meta: '2h 58m  •  Action, Thriller  •  UA  •  Telugu',
            tags: ['2D', 'IMAX 2D', 'Telugu', 'Hindi'],
            story: 'An epic action saga set against coastal lands, telling the story of a fearless man who rises up to protect his people from coastal crime networks.',
            cast: [['NTR Jr.', 'Actor', 'assets/images/cast/cast1.jpg'], ['Janhvi Kapoor', 'Actress', 'assets/images/cast/cast2.jpg'], ['Saif Ali Khan', 'Actor', 'assets/images/cast/cast3.jpg']],
            crew: [['Koratala Siva', 'Director', 'assets/images/cast/cast4.jpg'], ['Anirudh Ravichander', 'Music', 'assets/images/cast/cast1.jpg']],
            review: 'NTR delivers a fierce performance backed by Anirudh\'s thrilling background score.'
        },
        'tillu-square': {
            title: 'Tillu Square',
            image: 'assets/images/movies/tillu-square.jpg',
            rating: '8.7/10',
            votes: '110K+ Votes',
            meta: '2h 05m  •  Comedy, Crime, Romance  •  UA  •  Telugu',
            tags: ['2D', 'Telugu'],
            story: 'DJ Tillu finds himself tangled in another bizarre mystery when an enigmatic woman enters his life, leading to endless hilarious mix-ups.',
            cast: [['Siddhu Jonnalagadda', 'Actor', 'assets/images/cast/cast1.jpg'], ['Anupama Parameswaran', 'Actress', 'assets/images/cast/cast2.jpg']],
            crew: [['Mallik Ram', 'Director', 'assets/images/cast/cast4.jpg']],
            review: 'Non-stop laugh riot packed with witty dialogues and Siddhu\'s energetic screen presence.'
        },
        'virupaksha': {
            title: 'Virupaksha',
            image: 'assets/images/movies/virupaksha.jpg',
            rating: '8.9/10',
            votes: '95K+ Votes',
            meta: '2h 25m  •  Horror, Mystery, Thriller  •  UA  •  Telugu',
            tags: ['2D', 'Telugu'],
            story: 'Mysterious deaths occur in a remote village due to an ancient occult curse. A young man uncovers dark secrets to save the village before time runs out.',
            cast: [['Sai Durgha Tej', 'Actor', 'assets/images/cast/cast1.jpg'], ['Samyuktha Menon', 'Actress', 'assets/images/cast/cast2.jpg']],
            crew: [['Karthik Varma Dandu', 'Director', 'assets/images/cast/cast4.jpg']],
            review: 'A genuinely gripping occult horror mystery with brilliant sound design and atmospheric tension.'
        },
        'game-changer': {
            title: 'Game Changer',
            image: 'assets/images/movies/game-changer.jpg',
            rating: '9.0/10',
            votes: '180K+ Votes',
            meta: '2h 50m  •  Action, Drama  •  UA  •  Telugu',
            tags: ['2D', 'IMAX', 'Telugu', 'Hindi'],
            story: 'An honest IAS officer takes on electoral corruption and political syndicates to reform the governance system.',
            cast: [['Ram Charan', 'Actor', 'assets/images/cast/cast1.jpg'], ['Kiara Advani', 'Actress', 'assets/images/cast/cast2.jpg']],
            crew: [['Shankar', 'Director', 'assets/images/cast/cast4.jpg'], ['Thaman S', 'Music', 'assets/images/cast/cast1.jpg']],
            review: 'A classic Shankar political drama combined with Ram Charan\'s impactful dual roles.'
        },
        'kalki-2898': {
            title: 'Kalki 2898 AD',
            image: 'assets/images/movies/kalki.jpg',
            rating: '9.3/10',
            votes: '310K+ Votes',
            meta: '3h 01m  •  Sci-Fi, Action, Fantasy  •  UA  •  Telugu',
            tags: ['3D', 'IMAX 3D', 'EPIQ', 'Telugu', 'Hindi'],
            story: 'A modern avatar of Vishnu descends to Earth in a dystopian post-apocalyptic future to protect the world from dark forces.',
            cast: [['Prabhas', 'Actor', 'assets/images/cast/cast1.jpg'], ['Amitabh Bachchan', 'Actor', 'assets/images/cast/cast2.jpg'], ['Kamal Haasan', 'Actor', 'assets/images/cast/cast3.jpg']],
            crew: [['Nag Ashwin', 'Director', 'assets/images/cast/cast4.jpg'], ['Santhosh Narayanan', 'Music', 'assets/images/cast/cast1.jpg']],
            review: 'A visionary sci-fi epic blending Indian mythology with futuristic world-building.'
        }
    };

    // Filter Movies by Genre Pill
    window.filterLanguageMovies = function (genre, btnElement) {
        const buttons = btnElement.parentElement.querySelectorAll('button');
        buttons.forEach(btn => btn.classList.remove('active'));
        btnElement.classList.add('active');

        const slides = document.querySelectorAll('#teluguMovies .movie-genre-item');
        slides.forEach(slide => {
            const slideGenres = slide.getAttribute('data-genre') || '';
            if (genre === 'all' || slideGenres.includes(genre)) {
                slide.style.display = 'block';
            } else {
                slide.style.display = 'none';
            }
        });

        if (teluguSwiperInstance && typeof teluguSwiperInstance.update === 'function') {
            teluguSwiperInstance.update();
            teluguSwiperInstance.slideTo(0);
        }
    };

    window.openSideMenu = function () {
        const menu = document.getElementById('movieSideMenu');
        const overlay = document.getElementById('movieMenuOverlay');
        if (!menu || !overlay) return;
        menu.classList.add('is-open');
        overlay.classList.add('is-visible');
        document.body.classList.add('menu-open');
    };

    window.closeSideMenu = function () {
        const menu = document.getElementById('movieSideMenu');
        const overlay = document.getElementById('movieMenuOverlay');
        if (menu) menu.classList.remove('is-open');
        if (overlay) overlay.classList.remove('is-visible');
        document.body.classList.remove('menu-open');
    };

    window.openLoginModal = function () {
        closeSideMenu();
        const popup = document.getElementById('loginPopup');
        if (popup) { popup.classList.add('active', 'show'); popup.style.display = 'flex'; document.body.classList.add('modal-open-custom'); }
    };

    window.closeLoginModal = function () {
        const popup = document.getElementById('loginPopup');
        if (popup) { popup.classList.remove('active', 'show'); popup.style.display = 'none'; }
        document.body.classList.remove('modal-open-custom');
    };

    window.openLocationModal = function () {
        const el = document.getElementById('locationModal');
        if (!el || !window.bootstrap) return;
        const modal = bootstrap.Modal.getOrCreateInstance(el);
        modal.show();
        if (typeof window.showInitialCities === 'function') window.showInitialCities();
    };

    window.openMovieDetails = function (id) {
        const movie = movieData[id];
        if (!movie) return;
        selectedMovieId = id;
        const overlay = document.getElementById('movieDetailsOverlay');
        if (!overlay) return;

        document.getElementById('movieDetailsTitle').textContent = movie.title;
        document.getElementById('movieDetailsRating').textContent = movie.rating;
        document.getElementById('movieDetailsVotes').textContent = movie.votes;
        document.getElementById('movieDetailsMeta').textContent = movie.meta;
        document.getElementById('movieDetailsStory').textContent = movie.story;
        document.getElementById('movieReviewTitle').textContent = movie.title;
        document.getElementById('movieReviewText').textContent = movie.review;
        document.getElementById('movieDetailsPoster').src = movie.image;
        document.getElementById('movieDetailsBackdrop').src = movie.image;
        document.getElementById('movieDetailsPoster').alt = movie.title;
        document.getElementById('movieDetailsBackdrop').alt = movie.title;
        document.getElementById('movieDetailsTags').innerHTML = movie.tags.map(tag => `<span>${tag}</span>`).join('');
        renderPeople('movieCastRow', movie.cast);
        renderPeople('movieCrewRow', movie.crew);
        renderRelated(id);

        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('movie-details-open');
        const panel = document.getElementById('movieDetailsPanel');
        if (panel) panel.scrollTop = 0;
    };

    function renderPeople(targetId, people) {
        const row = document.getElementById(targetId);
        if (!row) return;
        row.innerHTML = people.map(person => `<article class="movie-person-card"><img src="${person[2]}" alt="${person[0]}" onerror="this.src='https://via.placeholder.com/150x180?text=Photo'"><h4>${person[0]}</h4><p>${person[1]}</p></article>`).join('');
    }

    function renderRelated(activeId) {
        const row = document.getElementById('movieRelatedRow');
        if (!row) return;
        const related = Object.keys(movieData).filter(id => id !== activeId).slice(0, 4);
        row.innerHTML = related.map(id => `<button type="button" class="movie-related-card" onclick="openMovieDetails('${id}')"><img src="${movieData[id].image}" alt="${movieData[id].title}"><strong>${movieData[id].title}</strong><span>${movieData[id].rating}</span></button>`).join('');
    }

    window.closeMovieDetails = function () {
        const overlay = document.getElementById('movieDetailsOverlay');
        if (!overlay) return;
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('movie-details-open');
        selectedMovieId = null;
    };

    window.bookSelectedMovie = function () {
        if (!selectedMovieId) return;
        const movie = movieData[selectedMovieId];
        alert('Booking flow for ' + movie.title + ' is ready to connect to your booking page.');
    };

    window.shareSelectedMovie = async function () {
        if (!selectedMovieId) return;
        const movie = movieData[selectedMovieId];
        const shareData = { title: movie.title, text: 'Check out ' + movie.title + ' on Sairam Movie Hub.', url: window.location.href };
        try {
            if (navigator.share) await navigator.share(shareData);
            else if (navigator.clipboard) { await navigator.clipboard.writeText(window.location.href); alert('Movie link copied.'); }
        } catch (e) { }
    };

    window.scrollMovieRow = function (id) {
        const row = document.getElementById(id);
        if (row) row.scrollBy({ left: Math.max(260, row.clientWidth * .7), behavior: 'smooth' });
    };

    function attachMovieClicks() {
        document.querySelectorAll('.movie-card-clickable').forEach(card => {
            if (card.dataset.movieClickBound) return;
            card.dataset.movieClickBound = '1';
            card.addEventListener('click', function (e) {
                if (e.target.closest('a,button')) return;
                openMovieDetails(card.dataset.movieId);
            });
            card.addEventListener('keydown', function (e) {
                if ((e.key === 'Enter' || e.key === ' ') && !e.target.closest('a,button')) {
                    e.preventDefault();
                    openMovieDetails(card.dataset.movieId);
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        attachMovieClicks();

        // Safely initialize Swiper for Telugu Movies section with Auto-swiping & Capsule Pagination
        if (typeof Swiper !== 'undefined' && document.querySelector('.teluguMoviesSwiper')) {
            teluguSwiperInstance = new Swiper('.teluguMoviesSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: '#teluguMovies .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '#teluguMovies .swiper-button-next',
                    prevEl: '#teluguMovies .swiper-button-prev',
                },
                breakpoints: {
                    576: { slidesPerView: 2, spaceBetween: 20 },
                    768: { slidesPerView: 3, spaceBetween: 20 },
                    992: { slidesPerView: 4, spaceBetween: 24 },
                    1200: { slidesPerView: 5, spaceBetween: 24 },
                }
            });
        }

        const closeLogin = document.getElementById('closePopup');
        if (closeLogin) closeLogin.addEventListener('click', closeLoginModal);
        const loginPopup = document.getElementById('loginPopup');
        if (loginPopup) loginPopup.addEventListener('click', e => { if (e.target === loginPopup) closeLoginModal(); });

        const clearSearch = document.getElementById('locationSearchClear');
        const citySearch = document.getElementById('citySearchInput');
        if (clearSearch && citySearch) clearSearch.addEventListener('click', () => { citySearch.value = ''; if (typeof window.searchCities === 'function') window.searchCities(); citySearch.focus(); });

        const savedCity = localStorage.getItem('selectedCity');
        if (savedCity) {
            const display = document.getElementById('currentLocationDisplay');
            if (display) display.textContent = savedCity;
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { closeSideMenu(); closeMovieDetails(); closeLoginModal(); }
        });
    });

    window.setTimeout(attachMovieClicks, 700);
})();
</script>

</body>
</html>