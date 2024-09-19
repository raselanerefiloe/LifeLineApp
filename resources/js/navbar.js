document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Button Toggle
    const menuButton = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Close mobile menu if clicking outside
    document.addEventListener('click', function(event) {
        if (mobileMenu && !mobileMenu.contains(event.target) && !menuButton.contains(event
            .target)) {
            mobileMenu.classList.add('hidden');
        }
    });
});

// JavaScript for mobile and desktop user menu toggles
document.getElementById('mobile-user-menu-button')?.addEventListener('click', function() {
    const menu = document.getElementById('mobile-user-menu');
    menu.classList.toggle('hidden');
});

document.getElementById('desktop-user-menu-button')?.addEventListener('click', function() {
    const menu = document.getElementById('desktop-user-menu');
    menu.classList.toggle('hidden');
});

document.addEventListener('click', function(event) {
    const mobileUserMenu = document.getElementById('mobile-user-menu');
    const desktopUserMenu = document.getElementById('desktop-user-menu');
    const mobileUserMenuButton = document.getElementById('mobile-user-menu-button');
    const desktopUserMenuButton = document.getElementById('desktop-user-menu-button');

    if (mobileUserMenu && !mobileUserMenu.contains(event.target) && !mobileUserMenuButton.contains(event
            .target)) {
        mobileUserMenu.classList.add('hidden');
    }

    if (desktopUserMenu && !desktopUserMenu.contains(event.target) && !desktopUserMenuButton.contains(event
            .target)) {
        desktopUserMenu.classList.add('hidden');
    }
});

document.getElementById('menu-btn')?.addEventListener('click', function() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
});