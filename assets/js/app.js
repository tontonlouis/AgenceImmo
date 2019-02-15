/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
import Places from 'places.js';
import Map from './modules/map';

/**
 * Initailise le module Map (map.js)
 */
Map.init();

/**
 * @function adresse_add
 */
let inputAddress = document.querySelector('#property_address')

if (inputAddress !== null) {
    let place = Places({
        container: inputAddress
    })

    place.on('change', e => {
        document.querySelector('#property_city').value = e.suggestion.city
        document.querySelector('#property_postal_code').value = e.suggestion.postcode
        document.querySelector('#property_lat').value = e.suggestion.latlng.lat
        document.querySelector('#property_lng').value = e.suggestion.latlng.lng
    })
}

/**
 * @function search_address
 */
let searchAddress = document.querySelector('#search_address')

if (searchAddress !== null) {
    let place = Places({
        container: searchAddress
    })

    place.on('change', e => {
        document.querySelector('#lat').value = e.suggestion.latlng.lat
        document.querySelector('#lng').value = e.suggestion.latlng.lng
    })
}

// Required fichier CSS et le module select2
require('../css/app.css');
require('select2')

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

/**
 * Met en forme tout les selecteurs avec le module Select2
 */
$('select').select2()

/**
 * Permet de mettre de l'animation sur le bouton contact
 */
let $contactButton = $('#contactButton')

$contactButton.click(e => {
    e.preventDefault();
    $('#contactForm').slideDown();
    $contactButton.slideUp();
});

// Suppression des éléments
document.querySelectorAll('[data-delete]').forEach(a => {

    a.addEventListener('click', e => {

        e.preventDefault()

        fetch(a.getAttribute('href'), {

                method: 'DELETE',

                headers: {

                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    '_token': a.dataset.token
                })

            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    a.parentNode.parentNode.removeChild(a.parentNode);
                } else {
                    alert(data.error)
                }
            })
            .catch(e => alert(e))
    })
});

/**
 *  Permet de mettre de l'animation sur le carousel d'image
 */
$('.carousel').carousel()

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');