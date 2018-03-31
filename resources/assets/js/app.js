
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        darkMode: null,
        onlyNight: null,
        latitude: null,
        longitude: null,
        error: false,
        errorMessage: null,
    },
    methods: {
        location: function(event) {
            navigator.geolocation.getCurrentPosition(_.bind(function(position) {
                this.latitude = position.coords.latitude;
                this.longitude = position.coords.longitude;
            },this),_.bind(function (error) {
                this.error = true;
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        this.errorMessage = "Toegang tot locatie geweigerd."
                        break;
                    case error.POSITION_UNAVAILABLE:
                        this.errorMessage = "Locatie is niet beschikbaar"
                        break;
                    case error.TIMEOUT:
                        this.errorMessage = "Time-out bij ophalen locatie"
                        break;
                    case error.UNKNOWN_ERROR:
                    default:
                        this.errorMessage = "Onbekende fout"
                        break;
                }
            },this));
        }
    },
    computed: {
        urlParameters: function () {
            var response = '';
            if(this.darkMode !== null)
                response += '?darkMode='+(this.darkMode?'1':'0');
            if(this.onlyNight !== null)
                response += '&onlyNight='+(this.onlyNight?'1':'0');
            if(this.latitude !== null)
                response += '&latitude='+(this.latitude);
            if(this.longitude !== null)
                response += '&longitude='+(this.longitude);
            return response;
        }
        
    },
    watch: {
        darkMode: function () {
            if(this.darkMode === false) {
                this.onlyNight = null;

            }
        },
        onlyNight: function () {
            if(this.onlyNight === false || this.onlyNight === null) {
                this.latitude = null;
                this.longitude = null;
            }
        }
    }
});


