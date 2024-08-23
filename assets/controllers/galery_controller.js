import { Controller } from '@hotwired/stimulus';
import $ from '../vendor/jquery/jquery.index.js'
import '../vendor/bootstrap/bootstrap.index.js';

export default class extends Controller {
    connect() {
        const images = document.getElementsByClassName('gallery-img');
        const gallery = document.getElementsByClassName('gallery')[0];
        const progressBar = document.getElementById('progress-bar');
        let loaded= 0;

        [].forEach.call( images, function( img ) {
            if(img.complete)
                incrementCounter();
            else
                img.addEventListener( 'load', incrementCounter, false );
        } );

        function incrementCounter() {
            loaded++;
            let percent = Math.round(loaded/images.length*100) + '%';
            progressBar.innerText = 'Chargement... ' + percent;
            progressBar.style.width = percent;
            console.log(percent);
            if ( loaded === images.length ) {
                console.log('images finished loading');
                gallery.classList.remove('d-none');
                progressBar.parentElement.classList.add('d-none');
            }
        }

        $('.gallery-link').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function(item) {
                    return item.el.find('figcaption').text() || item.el.attr('title');
                }
            },
            zoom: {
                enabled: true
            },
            // duration: 300
            gallery: {
                enabled: true,
                navigateByImgClick: false,
                tCounter: ''
            },
            disableOn: function() {
                return $(window).width() > 640;
            }
        });
    }
}
