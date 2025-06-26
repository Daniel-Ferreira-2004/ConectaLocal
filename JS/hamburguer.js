const menuButton = document.getElementById('hamburguerButton');
const menu = document.getElementById('menuMobile');

menuButton.addEventListener('click', () => {
    menu.classList.toggle('active');
});