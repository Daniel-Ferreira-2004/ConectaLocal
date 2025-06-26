const swiper = new Swiper('.swiper', {
    spaceBetween: 10,
    slidesPerView: 5,
     autoplay: {
        delay: 10000,
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
    breakpoints: {
      0: {
        slidesPerView: 2, // celulares
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 4,
      },
      1200: {
        slidesPerView: 5,
      },
    },

});