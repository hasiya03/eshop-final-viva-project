document.addEventListener('DOMContentLoaded', (event) => {
    const swiperVertical = new Swiper('.mySwiperVertical', {
        direction: 'vertical',
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});
