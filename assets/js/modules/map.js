import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export default class Map{
    static init(){
        let map = document.querySelector('#map')
        if(map === null ){
            return 
        }

        var icon = L.icon({
            iconUrl: '/images/media/marker.png'
        });

        var lat = map.dataset.lat;
        var lng = map.dataset.lng;

        map = L.map('map').setView([lat, lng], 13);
        let token = 'pk.eyJ1IjoidG9udG9ubG91aXM1OSIsImEiOiJjanJsc3Q1NzkwYjA2NDNudHZrdHNzanl5In0.VlTuuNUfq7Uw8I7JMiCY2Q';

        L.tileLayer(`https://api.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=${token}`, {
            maxZoom: 18,
            minZoom: 12,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox.streets',
            accessToken: 'your.mapbox.access.token'
        }).addTo(map);

        L.marker([lat, lng], {icon: icon}).addTo(map);
    }
}