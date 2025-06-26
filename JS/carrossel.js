const swiper = new Swiper('.swiper', {
    spaceBetween: 10,
    slidesPerView: 5,
     autoplay: {
        delay: 2000,
        disableOnInteraction: false, //Continua o autoPlay mesmo se o usuario interagir
    },

    fadeEffect: {CrossFade: true}, //Permite a troca de imagem pelo deslizar do usuario
    allowTouchMove: true,
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,

    },
    navigation: {
        nextEl: '.swiper-button-next', // Botão próximo
        prevEl: '.swiper-button-prev', // Botão anterior
    },

});