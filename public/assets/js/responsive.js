/**
 * FOODY RESPONSIVE INTERACTIONS
 * Mobile-first JavaScript for enhanced user experience
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile Footer Accordion
    initMobileFooterAccordion();
    
    // Touch-friendly carousel
    initTouchCarousel();
    
    // Responsive image lazy loading
    initLazyLoading();
    
    // Orientation change handler
    handleOrientationChange();
    
    // Reduced motion preference
    respectReducedMotion();
});

/**
 * Mobile Footer Accordion Functionality
 */
function initMobileFooterAccordion() {
    if (window.innerWidth <= 767) {
        const footerTitles = document.querySelectorAll('.footer-title');
        
        footerTitles.forEach(title => {
            title.addEventListener('click', function() {
                const isActive = this.classList.contains('active');
                
                // Close all other accordions
                footerTitles.forEach(t => {
                    t.classList.remove('active');
                    const list = t.nextElementSibling;
                    if (list) list.classList.remove('active');
                });
                
                // Toggle current accordion
                if (!isActive) {
                    this.classList.add('active');
                    const list = this.nextElementSibling;
                    if (list) list.classList.add('active');
                }
            });
        });
    }
}

/**
 * Touch-friendly Carousel with Swipe Gestures
 */
function initTouchCarousel() {
    const carousels = document.querySelectorAll('.product-carousel-wrapper, .gallery-carousel-container');
    
    carousels.forEach(carousel => {
        let startX = 0;
        let startY = 0;
        let distX = 0;
        let distY = 0;
        let threshold = 100;
        let restraint = 100;
        
        carousel.addEventListener('touchstart', function(e) {
            const touchobj = e.changedTouches[0];
            startX = touchobj.pageX;
            startY = touchobj.pageY;
        }, { passive: true });
        
        carousel.addEventListener('touchend', function(e) {
            const touchobj = e.changedTouches[0];
            distX = touchobj.pageX - startX;
            distY = touchobj.pageY - startY;
            
            if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint) {
                if (distX > 0) {
                    // Swipe right - previous slide
                    const prevBtn = carousel.querySelector('.carousel-nav.prev');
                    if (prevBtn) prevBtn.click();
                } else {
                    // Swipe left - next slide
                    const nextBtn = carousel.querySelector('.carousel-nav.next');
                    if (nextBtn) nextBtn.click();
                }
            }
        }, { passive: true });
    });
}

/**
 * Lazy Loading for Images
 */
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback for older browsers
        images.forEach(img => {
            img.src = img.dataset.src;
            img.classList.remove('lazy');
        });
    }
}

/**
 * Handle Orientation Change
 */
function handleOrientationChange() {
    window.addEventListener('orientationchange', function() {
        setTimeout(() => {
            // Recalculate carousel dimensions
            const carousels = document.querySelectorAll('.product-carousel-wrapper');
            carousels.forEach(carousel => {
                const img = carousel.querySelector('img');
                if (img) {
                    img.style.height = 'auto';
                    setTimeout(() => {
                        img.style.height = '';
                    }, 100);
                }
            });
            
            // Refresh masonry layout if exists
            if (typeof Masonry !== 'undefined') {
                const masonryContainers = document.querySelectorAll('.masonry');
                masonryContainers.forEach(container => {
                    const masonry = Masonry.data(container);
                    if (masonry) masonry.layout();
                });
            }
        }, 500);
    });
}

/**
 * Respect Reduced Motion Preference
 */
function respectReducedMotion() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    
    if (prefersReducedMotion.matches) {
        // Disable animations
        const style = document.createElement('style');
        style.textContent = `
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        `;
        document.head.appendChild(style);
    }
}

/**
 * Responsive Utilities
 */
const ResponsiveUtils = {
    // Get current breakpoint
    getCurrentBreakpoint() {
        const width = window.innerWidth;
        if (width < 768) return 'mobile';
        if (width < 1024) return 'tablet';
        if (width < 1440) return 'desktop';
        return 'large-desktop';
    },
    
    // Check if mobile
    isMobile() {
        return window.innerWidth < 768;
    },
    
    // Check if tablet
    isTablet() {
        return window.innerWidth >= 768 && window.innerWidth < 1024;
    },
    
    // Check if desktop
    isDesktop() {
        return window.innerWidth >= 1024;
    },
    
    // Debounce function for resize events
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
};

// Export for global use
window.ResponsiveUtils = ResponsiveUtils;

// Handle window resize with debounce
window.addEventListener('resize', ResponsiveUtils.debounce(() => {
    // Re-initialize mobile footer accordion on resize
    if (ResponsiveUtils.isMobile()) {
        initMobileFooterAccordion();
    } else {
        // Remove mobile accordion functionality
        const footerTitles = document.querySelectorAll('.footer-title');
        footerTitles.forEach(title => {
            title.classList.remove('active');
            title.style.cursor = 'default';
            const list = title.nextElementSibling;
            if (list) list.classList.remove('active');
        });
    }
}, 250));