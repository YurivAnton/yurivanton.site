
window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
});

// Create items of languages menu
const dropdownLang = document.getElementById('dropdownLang');
dropdownLang.addEventListener('click', function(event){
    event.preventDefault();
    const containerLang = document.querySelector('#containerLang');
    containerLang.classList.add('dropdown');
});

//jump to the sections on the page
function jumper(from, to){
    let f = document.getElementById(from);
    let t = document.getElementById(to);

    if(f && t){
        f.addEventListener('click', function(){
            t.scrollIntoView({ alignToTop: "true" });
        });
    }
    f.addEventListener('click', function(){
        t.scrollIntoView({ alignToTop: "true" });
    });
}
jumper('fromPortfolio', 'portfolio');
jumper('fromAbout', 'about');
jumper('fromContact', 'contact');