/* Copyright Mehdi Hachem from Weynspire - Follow me on LinkedIn: https://www.linkedin.com/in/mehdi-hachem-54a8672b0/ */

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    var navbar = document.querySelector('.navbar');
    if (window.pageYOffset > 0) {
        navbar.classList.add('fixed-navbar');
    } else {
        navbar.classList.remove('fixed-navbar');
    }
}