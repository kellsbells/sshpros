// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {

    var hamburgerNav = document.querySelector('div.hamburger');
    var mobileNavMenu = document.querySelector('div.nav-items');

    hamburgerNav.onclick = function() {
        mobileNavMenu.classList.toggle('active');
        hamburgerNav.classList.toggle('active');
    }

});

