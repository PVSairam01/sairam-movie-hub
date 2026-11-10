<?php include 'header.php'; ?>
<?php
// Booking page data - shared header/footer layout retained.
$movie_title = isset($_GET['movie']) ? htmlspecialchars($_GET['movie']) : 'Avatar: The Way of Water';
$cinema_name = isset($_GET['cinema']) ? htmlspecialchars($_GET['cinema']) : 'Sairam Grand Multiplex (Screen 1)';
?>

<main class="booking-page">

    <div class="booking-context-bar">
        <div class="booking-context-title">
            <i class="bi bi-ticket-perforated-fill"></i>
            <span><?php echo $movie_title; ?></span>
        </div>
        <div class="booking-context-meta">
            <span><i class="bi bi-building"></i> <?php echo $cinema_name; ?></span>
            <span id="header-date-time"><i class="bi bi-calendar-event"></i> Mon, 10 Aug • 07:30 PM</span>
        </div>
    </div>

<!-- STEP PROGRESS TABS -->
    <div class="step-header mb-4">
        <div class="container d-flex justify-content-center gap-2 gap-md-4">
            <div class="step-tab active" id="tab-step-1" onclick="switchStep(1)">
                <i class="bi bi-grid-3x3-gap-fill me-1"></i> 1. Select Seats (A-Z)
            </div>
            <div class="step-tab disabled" id="tab-step-2" onclick="switchStep(2)">
                <i class="bi bi-cup-straw me-1"></i> 2. Food & Beverages
            </div>
            <div class="step-tab disabled" id="tab-step-3" onclick="switchStep(3)">
                <i class="bi bi-credit-card-fill me-1"></i> 3. Payment
            </div>
        </div>
    </div>

    <!-- MAIN WORKSPACE -->
    <div class="container pb-5">
        <div class="row g-4">
            
            <!-- LEFT WORKFLOW SECTION -->
            <div class="col-lg-8">
                
                <!-- STEP 1: DATE, TIME & FULL A-Z SEATING MAP -->
                <div id="step-1-content" class="card-dark p-4">
                    
                    <!-- DATE & SHOWTIME SELECTOR -->
                    <div class="bg-slate-900 p-3 rounded mb-4 border border-secondary border-opacity-25">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold small text-info m-0"><i class="bi bi-calendar3 me-1"></i> SELECT DATE</label>
                                <input type="date" id="custom-date-picker" class="form-control form-control-sm bg-dark text-white border-secondary w-auto" onchange="selectCustomDate(this.value)">
                            </div>
                            <div class="d-flex gap-2 overflow-auto py-1" id="date-picker-container">
                                <!-- Populated dynamically by JS for Mon-Sun -->
                            </div>
                        </div>

                        <div>
                            <label class="form-label fw-bold small text-info m-0 mb-2"><i class="bi bi-clock me-1"></i> SELECT SHOW TIME</label>
                            <div class="d-flex gap-2 overflow-auto" id="time-picker-container">
                                <div class="selector-pill" onclick="selectTime(this, '10:30 AM')">10:30 AM</div>
                                <div class="selector-pill" onclick="selectTime(this, '02:15 PM')">02:15 PM</div>
                                <div class="selector-pill active" onclick="selectTime(this, '07:30 PM')">07:30 PM</div>
                                <div class="selector-pill" onclick="selectTime(this, '10:45 PM')">10:45 PM</div>
                            </div>
                        </div>
                    </div>

                    <!-- Screen Position Header -->
                    <div class="screen-container">
                        <div class="screen-curve"></div>
                        <div class="screen-indicator">ALL EYES THIS WAY (SCREEN)</div>
                    </div>

                    <!-- Legend -->
                    <div class="d-flex justify-content-center gap-3 gap-md-4 mb-4 flex-wrap">
                        <div class="seat-legend-item"><span class="seat-box-sample available"></span> Available</div>
                        <div class="seat-legend-item"><span class="seat-box-sample selected"></span> Selected</div>
                        <div class="seat-legend-item"><span class="seat-box-sample sold"></span> Sold Out</div>
                        <div class="seat-legend-item"><span class="seat-box-sample vip"></span> VIP Recliner</div>
                    </div>

                    <!-- SEATING SECTIONS (FULL A-Z GRID) -->
                    <div class="seat-grid-wrapper">
                        
                        <!-- VIP Recliners (Rows A - B) -->
                        <div class="tier-header tier-vip"><i class="bi bi-star-fill me-1"></i> VIP Recliners — ₹380</div>
                        <div class="seat-grid mb-3" id="vip-seat-container"></div>

                        <!-- Executive Seats (Rows C - M) -->
                        <div class="tier-header tier-executive"><i class="bi bi-award-fill me-1"></i> Executive Seats — ₹240</div>
                        <div class="seat-grid mb-3" id="exec-seat-container"></div>

                        <!-- Standard Seats (Rows N - Z) -->
                        <div class="tier-header tier-standard"><i class="bi bi-ticket-perforated-fill me-1"></i> Standard Seats — ₹160</div>
                        <div class="seat-grid" id="std-seat-container"></div>

                    </div>

                </div>

                <!-- STEP 2: EXPANDED FOOD & BEVERAGES INTERFACE -->
                <div id="step-2-content" class="card-dark p-4 d-none">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold m-0"><i class="bi bi-cup-straw text-info me-2"></i> Food & Beverages Menu</h5>
                        <span class="badge bg-danger">Fast Delivery to Seat</span>
                    </div>

                    <!-- F&B Category Tabs -->
                    <ul class="nav fnb-nav mb-4" id="fnb-tabs">
                        <li class="nav-item"><button class="nav-link active" onclick="filterSnacks('all', this)">All Items</button></li>
                        <li class="nav-item"><button class="nav-link" onclick="filterSnacks('combos', this)">Value Combos</button></li>
                        <li class="nav-item"><button class="nav-link" onclick="filterSnacks('popcorn', this)">Popcorn & Fries</button></li>
                        <li class="nav-item"><button class="nav-link" onclick="filterSnacks('snacks', this)">Puffs & Samosas</button></li>
                        <li class="nav-item"><button class="nav-link" onclick="filterSnacks('drinks', this)">Beverages</button></li>
                    </ul>

                    <!-- Food Items Grid -->
                    <div class="row g-3" id="snack-cards-container">
                        <!-- Populated dynamically via JS -->
                    </div>
                </div>

                <!-- STEP 3: PREMIUM PAYMENT INTERFACE -->
                <div id="step-3-content" class="card-dark p-4 d-none">
                    <div class="payment-panel-heading">
                        <h5 class="fw-bold m-0"><i class="bi bi-shield-lock-fill me-2 section-gold"></i> Secure Payment</h5>
                        <span class="secure-chip"><i class="bi bi-shield-check"></i> 256-bit secure checkout</span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="nav flex-column nav-pills payment-nav" role="tablist">
                                <button class="nav-link active" id="pills-upi-tab" data-bs-toggle="pill" data-bs-target="#pills-upi" type="button" onclick="setPaymentMethod('upi')"><i class="bi bi-qr-code-scan me-2"></i> UPI & QR</button>
                                <button class="nav-link" id="pills-cards-tab" data-bs-toggle="pill" data-bs-target="#pills-cards" type="button" onclick="setPaymentMethod('card')"><i class="bi bi-credit-card-2-front me-2"></i> Cards</button>
                                <button class="nav-link" id="pills-netbanking-tab" data-bs-toggle="pill" data-bs-target="#pills-netbanking" type="button" onclick="setPaymentMethod('netbanking')"><i class="bi bi-bank me-2"></i> Net Banking</button>
                                <button class="nav-link" id="pills-wallets-tab" data-bs-toggle="pill" data-bs-target="#pills-wallets" type="button" onclick="setPaymentMethod('wallet')"><i class="bi bi-wallet2 me-2"></i> Wallets</button>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="tab-content p-3" id="payment-tabContent">

                                <!-- UPI -->
                                <div class="tab-pane fade show active" id="pills-upi">
                                    <div class="payment-panel-heading">
                                        <div>
                                            <h6 class="fw-bold mb-1 section-gold">Choose a UPI app</h6>
                                            <small class="text-muted">Select your preferred app or enter a UPI ID.</small>
                                        </div>
                                    </div>

                                    <div class="payment-app-grid mb-3" id="upiAppGrid">
                                        <button type="button" class="app-badge active" data-upi-app="gpay" onclick="selectUpiApp('gpay', this)">
                                            <img class="payment-app-icon" src="assets/images/payments/Google-pay.png" alt="Google Pay">
                                            <span>Google Pay</span>
                                        </button>
                                        <button type="button" class="app-badge" data-upi-app="phonepe" onclick="selectUpiApp('phonepe', this)">
                                            <img class="payment-app-icon" src="assets/images/payments/phone-pe.png" alt="PhonePe">
                                            <span>PhonePe</span>
                                        </button>
                                        <button type="button" class="app-badge" data-upi-app="paytm" onclick="selectUpiApp('paytm', this)">
                                            <img class="payment-app-icon contain" src="assets/images/payments/paytm.png" alt="Paytm">
                                            <span>Paytm</span>
                                        </button>
                                        <button type="button" class="app-badge" data-upi-app="upi" onclick="selectUpiApp('upi', this)">
                                            <img class="payment-app-icon contain" src="assets/images/payments/UPI.png" alt="UPI">
                                            <span>UPI</span>
                                        </button>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">UPI ID / VPA</label>
                                        <input type="text" id="upi-vpa" class="form-control" placeholder="example@upi" autocomplete="off">
                                        <div class="form-text" style="color:#7f7563;">Optional when paying through the QR/app button.</div>
                                    </div>

                                    <div class="payment-divider">OR SCAN TO PAY</div>

                                    <div class="text-center">
                                        <div class="upi-qr-shell">
                                            <img id="upiQrImage" src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=SairamMoviesPayment" alt="UPI QR Code">
                                        </div>
                                        <p class="small text-muted mt-3 mb-0">Scan with any UPI app. QR updates with the payable amount after seats are selected.</p>
                                    </div>
                                </div>

                                <!-- CARD -->
                                <div class="tab-pane fade" id="pills-cards">
                                    <div class="payment-panel-heading">
                                        <div>
                                            <h6 class="fw-bold mb-1 section-gold">Credit / Debit Card</h6>
                                            <small class="text-muted">Visa, Mastercard, RuPay and supported cards.</small>
                                        </div>
                                        <i class="bi bi-credit-card-2-front fs-3 section-gold"></i>
                                    </div>

                                    <form id="cardPaymentForm" onsubmit="event.preventDefault();">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Card Number</label>
                                            <input id="card-number" inputmode="numeric" type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19" oninput="formatCardNumber(this)">
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">Expiry</label>
                                                <input id="card-expiry" inputmode="numeric" type="text" class="form-control" placeholder="MM/YY" maxlength="5" oninput="formatExpiry(this)">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">CVV</label>
                                                <input id="card-cvv" inputmode="numeric" type="password" class="form-control" placeholder="•••" maxlength="4">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Name on Card</label>
                                            <input id="card-name" type="text" class="form-control" placeholder="Cardholder name">
                                        </div>
                                    </form>
                                    <div class="payment-note"><i class="bi bi-lock-fill me-1"></i> Card details must be sent to a PCI-compliant payment gateway. This UI never stores card data.</div>
                                </div>

                                <!-- NET BANKING -->
                                <div class="tab-pane fade" id="pills-netbanking">
                                    <div class="payment-panel-heading">
                                        <div>
                                            <h6 class="fw-bold mb-1 section-gold">Net Banking</h6>
                                            <small class="text-muted">Choose your bank to continue.</small>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-3" id="bankGrid">
                                        <div class="col-6"><button type="button" class="bank-option" onclick="selectBank('State Bank of India', this)"><span class="bank-logo">SBI</span><span>SBI</span></button></div>
                                        <div class="col-6"><button type="button" class="bank-option" onclick="selectBank('HDFC Bank', this)"><span class="bank-logo">HDFC</span><span>HDFC</span></button></div>
                                        <div class="col-6"><button type="button" class="bank-option" onclick="selectBank('ICICI Bank', this)"><span class="bank-logo">ICICI</span><span>ICICI</span></button></div>
                                        <div class="col-6"><button type="button" class="bank-option" onclick="selectBank('Axis Bank', this)"><span class="bank-logo">AXIS</span><span>Axis</span></button></div>
                                    </div>
                                    <label class="form-label small fw-bold">Other Banks</label>
                                    <select id="other-bank" class="form-select" onchange="selectOtherBank(this.value)">
                                        <option value="">Select your bank...</option>
                                        <option>Kotak Mahindra Bank</option>
                                        <option>Bank of Baroda</option>
                                        <option>Punjab National Bank</option>
                                        <option>Union Bank of India</option>
                                        <option>Canara Bank</option>
                                        <option>Indian Bank</option>
                                    </select>
                                    <div class="payment-note mt-3"><i class="bi bi-bank me-1"></i> Final redirect to your bank is handled by the connected payment gateway.</div>
                                </div>

                                <!-- WALLETS -->
                                <div class="tab-pane fade" id="pills-wallets">
                                    <div class="payment-panel-heading">
                                        <div>
                                            <h6 class="fw-bold mb-1 section-gold">Mobile Wallets</h6>
                                            <small class="text-muted">Choose an available wallet.</small>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2" id="walletGrid">
                                        <label class="wallet-option active" onclick="selectWallet('Paytm Wallet', this)">
                                            <img class="wallet-logo" src="assets/images/payments/paytm.png" alt="Paytm"><span class="flex-grow-1">Paytm Wallet</span><input class="form-check-input" type="radio" name="wallet" value="Paytm Wallet" checked>
                                        </label>
                                        <label class="wallet-option" onclick="selectWallet('Amazon Pay', this)">
                                            <img class="wallet-logo" src="assets/images/payments/amazon-pay.png" alt="Amazon Pay"><span class="flex-grow-1">Amazon Pay</span><input class="form-check-input" type="radio" name="wallet" value="Amazon Pay">
                                        </label>
                                        <label class="wallet-option" onclick="selectWallet('MobiKwik', this)">
                                            <span class="wallet-logo">MOBI</span><span class="flex-grow-1">MobiKwik</span><input class="form-check-input" type="radio" name="wallet" value="MobiKwik">
                                        </label>
                                    </div>
                                    <div class="payment-note mt-3"><i class="bi bi-wallet2 me-1"></i> Wallet availability depends on the gateway/account enabled for your merchant profile.</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT SUMMARY SIDEBAR -->
            <div class="col-lg-4">
                <div class="card summary-card p-4">
                    <h5 class="fw-bold mb-3 border-bottom border-secondary pb-2">Booking Summary</h5>
                    
                    <div class="d-flex justify-content-between mb-2 fs-6">
                        <span class="text-slate-400">Movie:</span>
                        <span class="fw-semibold text-end text-info"><?php echo $movie_title; ?></span>
                    </div>

                    <div class="d-flex justify-content-between mb-2 fs-6">
                        <span class="text-slate-400">Showtime:</span>
                        <span id="summary-showtime" class="fw-semibold text-end text-warning">Mon, 10 Aug • 07:30 PM</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2 fs-6">
                        <span class="text-slate-400">Selected Seats:</span>
                        <span id="summary-seats" class="fw-bold text-primary text-end">None</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2 fs-6">
                        <span class="text-slate-400">Tickets Subtotal:</span>
                        <span id="summary-tickets-price" class="fw-bold text-white">₹0</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2 fs-6">
                        <span class="text-slate-400">Food & Beverages:</span>
                        <span id="summary-food-price" class="fw-bold text-white">₹0</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-3 fs-6">
                        <span class="text-slate-400">Convenience Fee:</span>
                        <span id="summary-fee" class="fw-bold text-white">₹0</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fs-5 fw-bold">Grand Total:</span>
                        <span id="summary-grand-total" class="fs-3 fw-bold text-success">₹0</span>
                    </div>

                    <button id="main-proceed-btn" class="btn btn-proceed w-100 fs-5" onclick="handleProceed()" disabled>
                        Proceed to Food & Drinks
                    </button>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
        /* ==========================================
           STATE & CONFIGURATION
           ========================================== */
        let selectedSeatsMap = {}; // Format: { 'A1': 380, 'C4': 240 }
        let selectedDate = '';
        let selectedTime = '07:30 PM';
        let convenienceFeePerBooking = 35;
        let activeStep = 1;

        /* ==========================================
           PAYMENT UI STATE
           IMPORTANT: Replace merchantUpiId with your real merchant UPI ID.
           Card / Net Banking / Wallet live transactions must be connected
           to a payment gateway backend (Razorpay / Cashfree / PayU / etc.).
           ========================================== */
        const PAYMENT_CONFIG = {
            merchantUpiId: 'YOUR_UPI_ID@bank',
            merchantName: 'Sairam Movies',
            note: 'Movie ticket booking'
        };
        let selectedPaymentMethod = 'upi';
        let selectedUpiApp = 'gpay';
        let selectedBank = '';
        let selectedWallet = 'Paytm Wallet';

        // Expanded Food & Beverages Catalog
        const snacksCatalog = [
            { id: 'combo_duo', name: 'Movie Duo Combo', price: 420, category: 'combos', desc: '1 Large Salted Popcorn + 2 Large Soft Drinks', badge: 'Best Seller' },
            { id: 'combo_solo', name: 'Solo Snack Combo', price: 270, category: 'combos', desc: '1 Medium Popcorn + 1 Medium Soft Drink', badge: 'Saver' },
            { id: 'popcorn_salted_m', name: 'Classic Salted Popcorn (Medium)', price: 180, category: 'popcorn', desc: 'Freshly popped warm salted popcorn', badge: 'Classic' },
            { id: 'popcorn_caramel_l', name: 'Caramel Popcorn (Large)', price: 240, category: 'popcorn', desc: 'Rich golden caramel glazed popcorn', badge: 'Popular' },
            { id: 'popcorn_cheese_l', name: 'Cheese Burst Popcorn (Large)', price: 250, category: 'popcorn', desc: 'Tangy cheddar cheese coated popcorn', badge: 'Cheesy' },
            { id: 'fries_peri', name: 'Peri Peri French Fries', price: 170, category: 'popcorn', desc: 'Crispy potato fries tossed in spicy peri peri mix', badge: 'Hot' },
            { id: 'samosa_pair', name: 'Crispy Veg Samosas (2 Pcs)', price: 110, category: 'snacks', desc: 'Traditional potato pea samosas with chutney', badge: 'Snack' },
            { id: 'puff_veg', name: 'Golden Veg Puff', price: 85, category: 'snacks', desc: 'Flaky baked pastry filled with spiced vegetables', badge: 'Fresh' },
            { id: 'puff_chicken', name: 'Spicy Chicken Puff', price: 120, category: 'snacks', desc: 'Layered puff pastry filled with minced chicken', badge: 'Non-Veg' },
            { id: 'coke_l', name: 'Coca-Cola (500ml)', price: 140, category: 'drinks', desc: 'Chilled carbonated soft drink', badge: 'Cold' },
            { id: 'pepsi_l', name: 'Pepsi Chill (500ml)', price: 140, category: 'drinks', desc: 'Refreshing iced cola drink', badge: 'Cold' },
            { id: 'water_bottle', name: 'Mineral Water (1 Litre)', price: 40, category: 'drinks', desc: 'Packaged natural mineral water', badge: 'Essential' }
        ];

        // Quantity tracker for snacks
        let snackQuantities = {};
        snacksCatalog.forEach(item => snackQuantities[item.id] = 0);

        /* ==========================================
           INITIALIZATION & DATE/TIME GENERATION
           ========================================== */
        document.addEventListener('DOMContentLoaded', () => {
            initDateSelector();
            renderAZSeatGrid();
            renderSnacksGrid('all');
            updateSummary();
            updatePaymentQr();
        });

        // Generate Mon-Sun 7-Day Picker Dynamically
        function initDateSelector() {
            const container = document.getElementById('date-picker-container');
            container.innerHTML = '';
            
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            
            const today = new Date();
            
            for (let i = 0; i < 7; i++) {
                const dateObj = new Date();
                dateObj.setDate(today.getDate() + i);
                
                const dayName = days[dateObj.getDay()];
                const dateNum = dateObj.getDate();
                const monthName = months[dateObj.getMonth()];
                const formattedStr = `${dayName}, ${dateNum} ${monthName}`;

                if (i === 0) selectedDate = formattedStr;

                const pill = document.createElement('div');
                pill.className = `selector-pill ${i === 0 ? 'active' : ''}`;
                pill.onclick = function() {
                    document.querySelectorAll('#date-picker-container .selector-pill').forEach(el => el.classList.remove('active'));
                    pill.classList.add('active');
                    selectedDate = formattedStr;
                    updateHeaderAndSummary();
                };

                pill.innerHTML = `<div>${dayName.toUpperCase()}</div><div>${dateNum} ${monthName.toUpperCase()}</div>`;
                container.appendChild(pill);
            }
            updateHeaderAndSummary();
        }

        function selectCustomDate(val) {
            if (!val) return;
            const d = new Date(val);
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            selectedDate = `${days[d.getDay()]}, ${d.getDate()} ${months[d.getMonth()]}`;
            
            document.querySelectorAll('#date-picker-container .selector-pill').forEach(el => el.classList.remove('active'));
            updateHeaderAndSummary();
        }

        function selectTime(element, timeStr) {
            document.querySelectorAll('#time-picker-container .selector-pill').forEach(el => el.classList.remove('active'));
            element.classList.add('active');
            selectedTime = timeStr;
            updateHeaderAndSummary();
        }

        function updateHeaderAndSummary() {
            const formatted = `${selectedDate} • ${selectedTime}`;
            document.getElementById('header-date-time').textContent = formatted;
            document.getElementById('summary-showtime').textContent = formatted;
        }

        /* ==========================================
           DYNAMIC FULL A-Z SEATING GRID GENERATOR
           ========================================== */
        function renderAZSeatGrid() {
            const vipContainer = document.getElementById('vip-seat-container');
            const execContainer = document.getElementById('exec-seat-container');
            const stdContainer = document.getElementById('std-seat-container');

            vipContainer.innerHTML = '';
            execContainer.innerHTML = '';
            stdContainer.innerHTML = '';

            // Rows breakdown: A-B (VIP), C-M (Executive), N-Z (Standard)
            const seatsPerRow = 12; // 6 left aisle 6 right

            for (let i = 0; i < 26; i++) {
                const rowLetter = String.fromCharCode(65 + i); // 65 = 'A'
                let tier = 'standard';
                let price = 160;
                let targetContainer = stdContainer;

                if (i <= 1) { // A, B
                    tier = 'vip';
                    price = 380;
                    targetContainer = vipContainer;
                } else if (i >= 2 && i <= 12) { // C - M
                    tier = 'executive';
                    price = 240;
                    targetContainer = execContainer;
                }

                const rowDiv = document.createElement('div');
                rowDiv.className = 'seat-row';

                // Left row label
                rowDiv.innerHTML = `<span class="row-label">${rowLetter}</span>`;

                for (let s = 1; s <= seatsPerRow; s++) {
                    const seatCode = `${rowLetter}${s}`;
                    // Simulated random sold seats for realism
                    const isSold = (i * 7 + s) % 11 === 0 || (i === 3 && s === 5) || (i === 8 && s === 6);
                    
                    const seatEl = document.createElement('div');
                    seatEl.className = `seat ${tier === 'vip' ? 'vip-seat' : ''} ${isSold ? 'sold' : ''}`;
                    seatEl.textContent = s;

                    if (!isSold) {
                        seatEl.onclick = function() { toggleSeat(this, seatCode, price); };
                    }

                    rowDiv.appendChild(seatEl);

                    // Add center aisle space after 6th seat
                    if (s === 6) {
                        const aisle = document.createElement('div');
                        aisle.className = 'seat-aisle';
                        rowDiv.appendChild(aisle);
                    }
                }

                // Right row label
                const rightLabel = document.createElement('span');
                rightLabel.className = 'row-label';
                rightLabel.textContent = rowLetter;
                rowDiv.appendChild(rightLabel);

                targetContainer.appendChild(rowDiv);
            }
        }

        function toggleSeat(element, seatCode, price) {
            if (element.classList.contains('sold')) return;

            if (element.classList.contains('selected')) {
                element.classList.remove('selected');
                delete selectedSeatsMap[seatCode];
            } else {
                element.classList.add('selected');
                selectedSeatsMap[seatCode] = price;
            }

            updateSummary();
        }

        /* ==========================================
           FOOD & BEVERAGES UI & CONTROLS
           ========================================== */
        function renderSnacksGrid(filterCategory) {
            const container = document.getElementById('snack-cards-container');
            container.innerHTML = '';

            const itemsToDisplay = filterCategory === 'all' 
                ? snacksCatalog 
                : snacksCatalog.filter(item => item.category === filterCategory);

            itemsToDisplay.forEach(snack => {
                const qty = snackQuantities[snack.id];
                const col = document.createElement('div');
                col.className = 'col-md-6 col-lg-6';

                col.innerHTML = `
                    <div class="snack-card">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="fw-bold m-0 text-white">${snack.name}</h6>
                                <span class="snack-badge bg-primary text-white">${snack.badge}</span>
                            </div>
                            <p class="small text-muted mb-2">${snack.desc}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold text-info fs-6">₹${snack.price}</span>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-secondary text-white border-secondary" onclick="updateSnackQty('${snack.id}', -1)">-</button>
                                <span id="qty-${snack.id}" class="fw-bold px-1">${qty}</span>
                                <button class="btn btn-sm btn-outline-info" onclick="updateSnackQty('${snack.id}', 1)">+</button>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(col);
            });
        }

        function filterSnacks(cat, buttonEl) {
            document.querySelectorAll('#fnb-tabs .nav-link').forEach(btn => btn.classList.remove('active'));
            buttonEl.classList.add('active');
            renderSnacksGrid(cat);
        }

        function updateSnackQty(snackId, delta) {
            if (snackQuantities[snackId] + delta >= 0) {
                snackQuantities[snackId] += delta;
                const qtyElement = document.getElementById(`qty-${snackId}`);
                if (qtyElement) qtyElement.textContent = snackQuantities[snackId];
                updateSummary();
            }
        }

        /* ==========================================
           SUMMARY CALCULATIONS & NAVIGATION LOGIC
           ========================================== */
        function updateSummary() {
            const seatCodes = Object.keys(selectedSeatsMap);
            
            // Render selected seats
            const seatsElement = document.getElementById('summary-seats');
            seatsElement.textContent = seatCodes.length > 0 ? seatCodes.join(', ') : 'None';

            // Calculate Base Tickets Subtotal
            let ticketsTotal = 0;
            for (let code in selectedSeatsMap) {
                ticketsTotal += selectedSeatsMap[code];
            }
            document.getElementById('summary-tickets-price').textContent = `₹${ticketsTotal}`;

            // Calculate Food & Beverages Total
            let foodTotal = 0;
            snacksCatalog.forEach(item => {
                foodTotal += (snackQuantities[item.id] || 0) * item.price;
            });
            document.getElementById('summary-food-price').textContent = `₹${foodTotal}`;

            // Calculate Convenience Fee
            const fee = seatCodes.length > 0 ? convenienceFeePerBooking : 0;
            document.getElementById('summary-fee').textContent = `₹${fee}`;

            // Calculate Grand Total
            const grandTotal = seatCodes.length > 0 ? (ticketsTotal + foodTotal + fee) : 0;
            document.getElementById('summary-grand-total').textContent = `₹${grandTotal}`;
            updatePaymentQr(grandTotal);

            // Control Button & Tab Permissions
            const btn = document.getElementById('main-proceed-btn');
            if (activeStep === 1) {
                btn.disabled = seatCodes.length === 0;
                btn.textContent = 'Proceed to Food & Drinks';
            } else if (activeStep === 2) {
                btn.disabled = false;
                btn.textContent = 'Proceed to Payment';
            } else if (activeStep === 3) {
                btn.disabled = false;
                btn.textContent = `Pay ₹${grandTotal}`;
            }
        }

        function switchStep(step) {
            const seatCodes = Object.keys(selectedSeatsMap);
            if (step > 1 && seatCodes.length === 0) {
                alert('Please select at least one seat from the A-Z map to proceed.');
                return;
            }

            activeStep = step;

            // Update Tab Headings
            document.getElementById('tab-step-1').classList.toggle('active', step === 1);
            document.getElementById('tab-step-2').classList.toggle('active', step === 2);
            document.getElementById('tab-step-3').classList.toggle('active', step === 3);

            if (seatCodes.length > 0) {
                document.getElementById('tab-step-2').classList.remove('disabled');
                document.getElementById('tab-step-3').classList.remove('disabled');
            }

            // Toggle visibility of step contents
            document.getElementById('step-1-content').classList.toggle('d-none', step !== 1);
            document.getElementById('step-2-content').classList.toggle('d-none', step !== 2);
            document.getElementById('step-3-content').classList.toggle('d-none', step !== 3);

            updateSummary();
        }

        function setPaymentMethod(method) {
            selectedPaymentMethod = method;
        }

        function selectUpiApp(app, el) {
            selectedPaymentMethod = 'upi';
            selectedUpiApp = app;
            document.querySelectorAll('#upiAppGrid .app-badge').forEach(x => x.classList.remove('active'));
            if (el) el.classList.add('active');
        }

        function selectBank(bank, el) {
            selectedPaymentMethod = 'netbanking';
            selectedBank = bank;
            document.getElementById('other-bank').value = '';
            document.querySelectorAll('#bankGrid .bank-option').forEach(x => x.classList.remove('active'));
            if (el) el.classList.add('active');
        }

        function selectOtherBank(bank) {
            if (!bank) return;
            selectedPaymentMethod = 'netbanking';
            selectedBank = bank;
            document.querySelectorAll('#bankGrid .bank-option').forEach(x => x.classList.remove('active'));
        }

        function selectWallet(wallet, el) {
            selectedPaymentMethod = 'wallet';
            selectedWallet = wallet;
            document.querySelectorAll('#walletGrid .wallet-option').forEach(x => x.classList.remove('active'));
            if (el) {
                el.classList.add('active');
                const radio = el.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;
            }
        }

        function formatCardNumber(input) {
            let value = input.value.replace(/\D/g, '').slice(0, 16);
            input.value = value.replace(/(.{4})/g, '$1 ').trim();
        }

        function formatExpiry(input) {
            let value = input.value.replace(/\D/g, '').slice(0, 4);
            if (value.length >= 3) value = value.slice(0, 2) + '/' + value.slice(2);
            input.value = value;
        }

        function getGrandTotalNumber() {
            const raw = document.getElementById('summary-grand-total').textContent || '₹0';
            return Number(raw.replace(/[^0-9.]/g, '')) || 0;
        }

        function buildUpiUrl(amount) {
            const params = new URLSearchParams({
                pa: PAYMENT_CONFIG.merchantUpiId,
                pn: PAYMENT_CONFIG.merchantName,
                am: amount.toFixed(2),
                cu: 'INR',
                tn: PAYMENT_CONFIG.note
            });
            return 'upi://pay?' + params.toString();
        }

        function updatePaymentQr(amount = getGrandTotalNumber()) {
            const qr = document.getElementById('upiQrImage');
            if (!qr) return;
            const qrData = PAYMENT_CONFIG.merchantUpiId.startsWith('YOUR_')
                ? `Sairam Movies | Amount ₹${amount}`
                : buildUpiUrl(amount);
            qr.src = 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' + encodeURIComponent(qrData);
        }

        function validateCardForm() {
            const number = (document.getElementById('card-number').value || '').replace(/\s/g, '');
            const expiry = document.getElementById('card-expiry').value || '';
            const cvv = document.getElementById('card-cvv').value || '';
            const name = (document.getElementById('card-name').value || '').trim();
            if (number.length < 13 || number.length > 16) return 'Enter a valid card number.';
            if (!/^\d{2}\/\d{2}$/.test(expiry)) return 'Enter expiry in MM/YY format.';
            if (!/^\d{3,4}$/.test(cvv)) return 'Enter a valid CVV.';
            if (name.length < 2) return 'Enter the cardholder name.';
            return '';
        }

        function processPayment(total) {
            if (total <= 0) {
                alert('Please select seats before payment.');
                return;
            }

            if (selectedPaymentMethod === 'upi') {
                const enteredVpa = (document.getElementById('upi-vpa').value || '').trim();
                if (enteredVpa && !/^[\w.\-]{2,}@[\w.\-]{2,}$/.test(enteredVpa)) {
                    alert('Please enter a valid UPI ID, for example name@bank.');
                    return;
                }
                if (PAYMENT_CONFIG.merchantUpiId.startsWith('YOUR_')) {
                    alert('UPI UI is ready. Replace PAYMENT_CONFIG.merchantUpiId with your real merchant UPI ID to accept live UPI payments.');
                    return;
                }
                window.location.href = buildUpiUrl(total);
                return;
            }

            if (selectedPaymentMethod === 'card') {
                const error = validateCardForm();
                if (error) { alert(error); return; }
                alert('Card details validated. Connect this step to your PCI-compliant payment gateway backend to charge the card securely.');
                return;
            }

            if (selectedPaymentMethod === 'netbanking') {
                if (!selectedBank) { alert('Please select a bank.'); return; }
                alert(`Net Banking selected: ${selectedBank}. Connect your payment gateway redirect here for live payment.`);
                return;
            }

            if (selectedPaymentMethod === 'wallet') {
                alert(`${selectedWallet} selected. Connect your payment gateway wallet flow here for live payment.`);
            }
        }

        function handleProceed() {
            if (activeStep === 1) {
                switchStep(2);
            } else if (activeStep === 2) {
                switchStep(3);
            } else if (activeStep === 3) {
                processPayment(getGrandTotalNumber());
            }
        }
    </script>

<?php include 'footer.php'; ?>
