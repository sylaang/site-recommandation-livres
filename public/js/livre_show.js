/* Copyright Mehdi Hachem from Weynspire - Follow me on LinkedIn: https://www.linkedin.com/in/mehdi-hachem-54a8672b0/ */


const parallaxImage = document.getElementById('parallaxImage');
const parallaxText = document.getElementById('parallaxText');


const stopPosition = parallaxText.offsetTop + parallaxText.offsetHeight - window.innerHeight;


window.addEventListener('scroll', function() {

    let scrollPosition = window.scrollY;


    if (scrollPosition <= stopPosition) {
        // Déplacer l'image vers le bas par rapport à la position de défilement
        parallaxImage.style.transform = 'translateY(' + (scrollPosition * 1) + 'px)';
    } else {

        parallaxImage.style.transform = 'translateY(' + stopPosition + 'px)';
    }
});