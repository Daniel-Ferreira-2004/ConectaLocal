window.revelar = ScrollReveal({reset:true});

function aplicarScrollReveal(selectores) {
    selectores.forEach(seletor => {
        revelar.reveal(seletor, {
            duration: 2000,
            distance: "70px",
            origin: "top"
        });
    });
}

// Lista de seletores que você quer animar
const elementosParaAnimar = [
    ".ComoFunciona",
    ".façaParte",
    ".empresas",
    ".Banner",
    ".swiper-slide"
];

// Aplica a animação a todos os seletores
aplicarScrollReveal(elementosParaAnimar);