import { Controller } from '@hotwired/stimulus';
import $ from '../vendor/jquery/jquery.index.js'
import '../vendor/bootstrap/bootstrap.index.js';

export default class extends Controller {
    connect() {
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()

    }
}
