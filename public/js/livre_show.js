
// Sélectionner l'image et le texte
const parallaxImage = document.getElementById('parallaxImage');
const parallaxText = document.getElementById('parallaxText');

// Calculer la position verticale à laquelle l'image doit s'arrêter
const stopPosition = parallaxText.offsetTop + parallaxText.offsetHeight - window.innerHeight;

// Écouter l'événement de défilement de la page
window.addEventListener('scroll', function() {
    // Récupérer la position verticale de la page
    let scrollPosition = window.scrollY;

    // Arrêter le défilement de l'image lorsque la position de défilement atteint la position de fin
    if (scrollPosition <= stopPosition) {
        // Déplacer l'image vers le bas par rapport à la position de défilement
        parallaxImage.style.transform = 'translateY(' + (scrollPosition * 1) + 'px)';
    } else {
        // Arrêter le défilement de l'image lorsque la position de défilement atteint la position de fin
        parallaxImage.style.transform = 'translateY(' + stopPosition + 'px)';
    }
});