import { Controller } from '@hotwired/stimulus';
import $ from '../vendor/jquery/jquery.index.js'
import '../vendor/bootstrap/bootstrap.index.js';

export default class extends Controller {
    connect() {
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
