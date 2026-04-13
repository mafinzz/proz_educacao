document.addEventListener('DOMContentLoaded', function() {
    // Gallery Modal
    const thumbs = document.querySelectorAll('.thumb');
    const modal = document.getElementById('modal');
    const modalImg = modal.querySelector('img');
    const close = modal.querySelector('.close');
    const prev = modal.querySelector('.prev');
    const next = modal.querySelector('.next');
    
    const images = Array.from(thumbs).map(t => t.href);
    let current = 0;

    thumbs.forEach((thumb, i) => {
        thumb.addEventListener('click', function(e) {
            e.preventDefault();
            current = i;
            openModal();
        });
    });

    function openModal() {
        modalImg.src = images[current];
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    function showNext() {
        current = (current + 1) % images.length;
        modalImg.src = images[current];
    }

    function showPrev() {
        current = (current - 1 + images.length) % images.length;
        modalImg.src = images[current];
    }

    close.addEventListener('click', closeModal);
    prev.addEventListener('click', showPrev);
    next.addEventListener('click', showNext);
    modal.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', function(e) {
        if (modal.classList.contains('active')) {
            if (e.key === 'Escape') closeModal();
            else if (e.key === 'ArrowRight') showNext();
            else if (e.key === 'ArrowLeft') showPrev();
        }
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});
