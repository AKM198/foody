// Navbar scroll effect and scroll-to-top button
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    const scrollToTopBtn = document.getElementById('scrollToTop');
    const isHomePage = window.location.pathname === '/' || window.location.pathname === '/home';
    
    if (!isHomePage) {
        navbar.classList.add('other-page');
    }
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
            navbar.classList.remove('other-page');
        } else {
            navbar.classList.remove('scrolled');
            if (!isHomePage) {
                navbar.classList.add('other-page');
            }
        }
        
        // Show/hide scroll to top button
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });
    
    // Scroll to top functionality
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});