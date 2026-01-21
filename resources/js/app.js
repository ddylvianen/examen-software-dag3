import './bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
// Session timeout on inactivity (30 minutes)
const SESSION_TIMEOUT = 30 * 60 * 1000; // 30 minutes in milliseconds
const WARNING_TIMEOUT = 27 * 60 * 1000; // Warn at 27 minutes
let inactivityTimer;
let warningTimer;

function resetTimers() {
    clearTimeout(inactivityTimer);
    clearTimeout(warningTimer);
    
    warningTimer = setTimeout(() => {
        showSessionWarning();
    }, WARNING_TIMEOUT);

    inactivityTimer = setTimeout(() => {
        logoutUser();
    }, SESSION_TIMEOUT);
}

function showSessionWarning() {
    const userConfirmed = confirm('Your session will expire in 3 minutes due to inactivity. Click OK to continue your session.');
    if (userConfirmed) {
        resetTimers();
    }
}

function logoutUser() {
    window.location.href = '/logout';
}

// Track user activity
['mousedown', 'keydown', 'scroll', 'touchstart', 'click'].forEach(event => {
    document.addEventListener(event, resetTimers, true);
});

// Initialize timers on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', resetTimers);
} else {
    resetTimers();
}