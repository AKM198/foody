// Menu Carousel for Mobile (800px and below)
(function() {
    if (window.innerWidth > 800) return;

    let currentIndex = 0;
    const menuCols = document.querySelectorAll('.menu-col');
    
    if (menuCols.length === 0) return;

    // Add active class to first card
    menuCols[0].classList.add('active');

    // Create prev/next buttons
    const menuRow = document.querySelector('.menu-row');
    if (!menuRow) return;

    const prevBtn = document.createElement('button');
    prevBtn.className = 'menu-carousel-btn prev';
    prevBtn.innerHTML = '&lt;';
    prevBtn.setAttribute('aria-label', 'Previous');

    const nextBtn = document.createElement('button');
    nextBtn.className = 'menu-carousel-btn next';
    nextBtn.innerHTML = '&gt;';
    nextBtn.setAttribute('aria-label', 'Next');

    menuRow.parentElement.style.position = 'relative';
    menuRow.parentElement.appendChild(prevBtn);
    menuRow.parentElement.appendChild(nextBtn);

    function showCard(index) {
        menuCols.forEach(col => col.classList.remove('active'));
        menuCols[index].classList.add('active');
    }

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + menuCols.length) % menuCols.length;
        showCard(currentIndex);
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % menuCols.length;
        showCard(currentIndex);
    });

    // Touch swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    menuRow.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });

    menuRow.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        if (touchStartX - touchEndX > 50) {
            nextBtn.click();
        } else if (touchEndX - touchStartX > 50) {
            prevBtn.click();
        }
    });
})();
