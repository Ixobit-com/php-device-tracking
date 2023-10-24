import './bootstrap';

const message = document.getElementById('message');
if (message) setTimeout(() => message.remove(), 3000);

function toggleNavbar() {
    const navbar = document.getElementById('navbar-sticky');
    navbar.classList.toggle('hidden');
}

const navbarCollapseBtn = document.getElementById('navbar-collapse-button');
if (navbarCollapseBtn) navbarCollapseBtn.addEventListener('click', toggleNavbar);

window.addEventListener('notification-modal', event => {
    const { message, type } = event.detail;
    const modal = document.getElementById('notification-modal');
    const messageElement = document.getElementById('notification-message');

    messageElement.innerText = message;

    modal.classList.remove('hidden', 'bg-red-500', 'bg-green-500');
    modal.classList.add(type === 'error' ? 'bg-red-500' : 'bg-green-500');

    function hideModal() {
        modal.classList.add('hidden');
    }

    if (window.myTimeout) {
        clearTimeout(window.myTimeout);
    }

    window.myTimeout = setTimeout(hideModal, 3000);
});
