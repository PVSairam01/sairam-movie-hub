let selectedSeats = [];
let ticketTotal = 0;
let foodTotal = 0;
const convenienceFee = 30;
let currentStep = 1;

// Seat Click Handler
document.querySelectorAll('.seat.available, .seat.vip').forEach(seat => {
    seat.addEventListener('click', () => {
        const seatNo = seat.dataset.seat;
        const seatPrice = parseInt(seat.dataset.price);

        if (seat.classList.contains('selected')) {
            seat.classList.remove('selected');
            selectedSeats = selectedSeats.filter(s => s.seat !== seatNo);
            ticketTotal -= seatPrice;
        } else {
            seat.classList.add('selected');
            selectedSeats.push({ seat: seatNo, price: seatPrice });
            ticketTotal += seatPrice;
        }
        updateSummary();
    });
});

function addSnack(name, price) {
    foodTotal += price;
    updateSummary();
}

function updateSummary() {
    const seatsText = selectedSeats.map(s => s.seat).join(', ') || 'None';
    document.getElementById('summary-seats').textContent = seatsText;
    document.getElementById('summary-ticket-price').textContent = `₹${ticketTotal}`;
    document.getElementById('summary-food-price').textContent = `₹${foodTotal}`;
    
    const grandTotal = ticketTotal > 0 ? (ticketTotal + foodTotal + convenienceFee) : 0;
    document.getElementById('summary-grand-total').textContent = `₹${grandTotal}`;

    document.getElementById('next-btn').disabled = selectedSeats.length === 0;
}

// Multi-Step Navigation
function nextStep() {
    if (currentStep === 1) {
        document.getElementById('step-1').classList.add('d-none');
        document.getElementById('step-2').classList.remove('d-none');
        document.getElementById('step1-tab').classList.remove('active-step');
        document.getElementById('step2-tab').classList.add('active-step');
        document.getElementById('back-btn').classList.remove('d-none');
        document.getElementById('next-btn').textContent = 'Proceed to Payment';
        currentStep = 2;
    } else if (currentStep === 2) {
        document.getElementById('step-2').classList.add('d-none');
        document.getElementById('step-3').classList.remove('d-none');
        document.getElementById('step2-tab').classList.remove('active-step');
        document.getElementById('step3-tab').classList.add('active-step');
        document.getElementById('next-btn').textContent = 'Make Payment';
        currentStep = 3;
    } else if (currentStep === 3) {
        alert('Booking Confirmed! Redirecting to Ticket Receipt...');
    }
}

function previousStep() {
    if (currentStep === 2) {
        document.getElementById('step-2').classList.add('d-none');
        document.getElementById('step-1').classList.remove('d-none');
        document.getElementById('step2-tab').classList.remove('active-step');
        document.getElementById('step1-tab').classList.add('active-step');
        document.getElementById('back-btn').classList.add('d-none');
        document.getElementById('next-btn').textContent = 'Proceed to Food & Drinks';
        currentStep = 1;
    } else if (currentStep === 3) {
        document.getElementById('step-3').classList.add('d-none');
        document.getElementById('step-2').classList.remove('d-none');
        document.getElementById('step3-tab').classList.remove('active-step');
        document.getElementById('step2-tab').classList.add('active-step');
        document.getElementById('next-btn').textContent = 'Proceed to Payment';
        currentStep = 2;
    }
}