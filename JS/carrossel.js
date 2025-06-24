// Função para mostrar ou esconder as setas dependendo do tamanho da tela
function toggleArrows() {
    const next = document.querySelector('.swiper-button-next');
    const prev = document.querySelector('.swiper-button-prev');

    if (window.innerWidth <= 768) {
        next.style.display = 'none';
        prev.style.display = 'none';
    } else {
        next.style.display = 'block';
        prev.style.display = 'block';
    }
}

// Cria o carrossel Swiper
const swiper = new Swiper('.swiper', {
    slidesPerView: 2,          // Quantos slides aparecem por vez (mobile)
    spaceBetween: 10,          // Espaço entre os slides


    navigation: {
        nextEl: '.swiper-button-next', // Botão próximo
        prevEl: '.swiper-button-prev', // Botão anterior
    },

    pagination: {
        el: '.swiper-pagination',      // Bolinhas de paginação
        clickable: true,               // Permite clicar nas bolinhas
    },

    // Configurações responsivas
    breakpoints: {
        640: {
            slidesPerView: 2,          // Em telas a partir de 640px -> 1 slide
        },
        768: {
            slidesPerView: 3,          // A partir de 768px -> 2 slides
        },
        1024: {
            slidesPerView: 4,          // A partir de 1024px -> 3 slides
        },
    },
});

// Executa quando a página carrega
window.addEventListener('load', toggleArrows);

// Executa toda vez que redimensiona a janela
window.addEventListener('resize', toggleArrows);