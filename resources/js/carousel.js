document.addEventListener('DOMContentLoaded', function () {
    const carouselElement = document.getElementById('bannerCarousel');
    const indicators = document.querySelectorAll('.carousel-indicators button');
    
    carouselElement.addEventListener('slide.bs.carousel', function (e) {
        indicators.forEach(function (indicator) {
            indicator.classList.remove('active');
        });
        indicators[e.to].classList.add('active');
    });
});
