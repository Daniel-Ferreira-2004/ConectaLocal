const swiper = new Swiper('.swiper', {
    slidesPerView: 1,
    spaceBetween: 16,
    centeredSlides: false,
    loop: true, // ← aqui está a mudança chave!

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    breakpoints: {
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1024: {
            slidesPerView: 4,
        },
    },
});