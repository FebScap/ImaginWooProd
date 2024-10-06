import { Controller } from '@hotwired/stimulus';
import '../vendor/bootstrap/bootstrap.index.js';

export default class extends Controller {
    connect() {
        const randomNumber = (min, max) => Math.floor(Math.random() * (max - min + 1) + min);
        const randomByte = () => randomNumber(0, 150);
        const randomCssRgba = () => `rgba(${[randomByte(), randomByte(), randomByte(), 0.8].join(',')})`;

        const cardDiv = document.getElementById('cardDiv');

        for (let i = 0; i < cardDiv.children.length; i++) {
            let element = cardDiv.children[i];
            element.firstElementChild.style.backgroundColor = randomCssRgba();
        }
    }
}
