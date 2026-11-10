// =============================================
// GOOGLE SIGN-IN CONFIGURATION
// =============================================
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Google Sign-In
    if (typeof google !== 'undefined') {
        google.accounts.id.initialize({
            client_id: 'YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com',
            callback: handleGoogleCredentialResponse
        });
    }

    // Handle Google Login Button Click
    const googleLoginBtn = document.getElementById('googleLoginBtn');
    if (googleLoginBtn) {
        googleLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (typeof google !== 'undefined') {
                google.accounts.id.prompt();
            } else {
                console.warn('Google Sign-In library not loaded');
            }
        });
    }
});

// =============================================
// HANDLE GOOGLE CREDENTIAL RESPONSE
// =============================================
function handleGoogleCredentialResponse(response) {
    console.log('Google Sign-In successful:', response);
    
    const credential = response.credential;
    
    fetch('google-login-process.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            credential: credential
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const loginPopup = document.getElementById('loginPopup');
            if (loginPopup) {
                loginPopup.classList.remove('active');
            }
            window.location.reload();
        } else {
            alert('Google Sign-In failed. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error during Google Sign-In:', error);
        alert('An error occurred during Google Sign-In.');
    });
}

// =============================================
// LOGOUT FUNCTION
// =============================================
function logoutUser() {
    fetch('logout.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Logout error:', error);
    });
}