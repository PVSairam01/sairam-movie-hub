<?php
/*
 * Sairam Movie Hub - Floating WhatsApp + Hotline Chat + Instagram
 * Place near the end of footer.php, before </body>, or include with:
 * <?php include 'floating_chatbot.php'; ?>
 */
?>

<style>
/* ========================= FLOATING ACTION BUTTONS ========================= */
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
    box-shadow: 0 8px 22px rgba(0,0,0,.28);
    transition: transform .22s ease, box-shadow .22s ease;
}

.floating-btn:hover {
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 12px 28px rgba(0,0,0,.34);
}

.whatsapp-btn {
    background: #25D366;
}

.whatsapp-btn:hover {
    background: #1fbe5a;
    color: #fff;
}

.hotline-btn {
    background: #eb102a;
    position: relative;
}

.hotline-btn:hover {
    background: #d90d25;
}

.instagram-btn {
    background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
}

.instagram-btn:hover {
    color: #fff;
}

/* Freshchat / Hotline-style white chat glyph */
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

.hotline-chat-icon .line-one { top: 7px; }
.hotline-chat-icon .line-two { top: 12px; right: 11px; }

/* ========================= CHAT WINDOW ========================= */
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
    border: 1px solid rgba(0,0,0,.08);
    box-shadow: 0 20px 55px rgba(0,0,0,.28);
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
    background: rgba(42,62,75,.92);
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
    box-shadow: 0 8px 24px rgba(0,0,0,.08);
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

/* ========================= SUPPORT LIST ========================= */
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

.service-btn:hover { background: #fafbfc; }

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

.service-text { min-width: 0; }

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

/* ========================= CHAT MESSAGES ========================= */
.user-msg { text-align: right; margin: 10px 0; }
.bot-msg { text-align: left; margin: 10px 0; }

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

.restart-btn:hover { background: #cf0c22; }

/* ========================= MOBILE ========================= */
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

<!-- ========================= FLOATING ACTION BUTTONS ========================= -->
<div class="floating-btn-container">

    <a href="https://wa.me/919390717011"
       class="floating-btn whatsapp-btn"
       aria-label="WhatsApp"
       target="_blank"
       rel="noopener">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

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

    <a href="https://www.instagram.com/sairam.patchipala?stkn=MXF3c3J2a2xyYmF4bQ=="
       class="floating-btn instagram-btn"
       aria-label="Instagram"
       target="_blank"
       rel="noopener">
        <i class="fa-brands fa-instagram"></i>
    </a>

</div>

<!-- ========================= CHATBOT WINDOW ========================= -->
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
        <div class="chat-window-title">Chat with us</div>
        <div id="chat-body"></div>
    </div>

</div>

<script>
const chatBody = document.getElementById('chat-body');
const chatbotWindow = document.getElementById('chatbot-window');

const contactNumber = '+91 9390717011';
const whatsappNumber = '919390717011';
const businessName = 'Sairam Movie Hub';

const services = {
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
        content: 'If payment was completed but you did not receive a ticket confirmation, check your SMS and email first. If it is still missing, contact us with your mobile number and transaction reference.'
    },
    feedback: {
        name: 'Cinema Related Feedback',
        short: 'Share theatre, screen or service feedback.',
        avatar: 'F',
        color: 'green',
        content: 'We welcome feedback about your movie-going experience. Tell us the theatre or show details and your feedback, and our team will review it.'
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

function appendMessage(text, sender) {
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

    Object.keys(services).forEach((key) => {
        const service = services[key];
        const button = document.createElement('button');

        button.type = 'button';
        button.className = 'service-btn';
        button.innerHTML = `
            <span class="service-avatar ${service.color}">${service.avatar}</span>
            <span class="service-text">
                <span class="service-title">${service.name}</span>
                <span class="service-preview">${service.short}</span>
            </span>
        `;

        button.addEventListener('click', () => showServiceDetails(key));
        chatBody.appendChild(button);
    });
}

function showServiceDetails(serviceKey) {
    const service = services[serviceKey];
    if (!service) return;

    chatBody.innerHTML = '';
    appendMessage(`I need help with ${service.name}.`, 'user');

    const supportMessage = `
        ${service.content}
        <br><br>
        <b>Need further assistance?</b><br>
        Call us: <a href="tel:+919390717011">${contactNumber}</a><br>
        WhatsApp: <a href="https://wa.me/${whatsappNumber}" target="_blank" rel="noopener">Chat with our support team</a>
    `;

    setTimeout(() => {
        appendMessage(supportMessage, 'bot');

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
