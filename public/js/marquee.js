// Récupère la racine de l'élément DOM (document)
const root = document.documentElement;

// Obtient la valeur de la variable CSS '--marquee-elements-displayed' définie dans le fichier CSS
const marqueeElementsDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed");

// Sélectionne l'élément <ul> ayant la classe 'marquee-content' dans le DOM
const marqueeContent = document.querySelector("ul.marquee-content");

// Définit la propriété CSS '--marquee-elements' sur le nombre d'éléments enfants de l'élément 'marqueeContent'
root.style.setProperty("--marquee-elements", marqueeContent.children.length);

// Boucle à travers les éléments enfants de 'marqueeContent' jusqu'à 'marqueeElementsDisplayed'
for (let i = 0; i < marqueeElementsDisplayed; i++) {
    // Clône le i-ème enfant de 'marqueeContent' et l'ajoute à la fin de 'marqueeContent'
    marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true));
}
