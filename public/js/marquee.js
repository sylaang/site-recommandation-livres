/* Copyright Mehdi Hachem from Weynspire - Follow me on LinkedIn: https://www.linkedin.com/in/mehdi-hachem-54a8672b0/ */


const root = document.documentElement;


const marqueeElementsDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed");


const marqueeContent = document.querySelector("ul.marquee-content");


root.style.setProperty("--marquee-elements", marqueeContent.children.length);


for (let i = 0; i < marqueeElementsDisplayed; i++) {

    marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true));
}
