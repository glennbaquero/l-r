Vue.mixin({
    methods: {
        autoCompletePlaces() {
            this.autocomplete = new google.maps.places.Autocomplete(
                (document.getElementById("autocomplete")),
                {types: ['geocode']}
            );
        },

        placeChanged(obj, formatted = false) {
            this.autocomplete.addListener('place_changed', () => {
                this.place = this.autocomplete.getPlace();
                
                if(formatted) {
                    this.address = this.place.formatted_address;
                } else {
                    obj.latitude = this.place.geometry.location.lat();
                    obj.longitude = this.place.geometry.location.lng();

                    obj.address_line_1 = this.concatAddress();
                    
                    obj.city = !_.isEmpty(this.findLocality('locality')) ?
                                this.findLocality('locality').short_name : '';

                    obj.state = !_.isEmpty(this.findLocality('administrative_area_level_1')) ?
                                this.findLocality('administrative_area_level_1').short_name : '';

                    obj.state_name = !_.isEmpty(this.findLocality('administrative_area_level_1')) ?
                                this.findLocality('administrative_area_level_1').long_name : '';

                    obj.postal_code = !_.isEmpty(this.findLocality('postal_code')) ?
                                    this.findLocality('postal_code').short_name : '';
                    this.fetchTimezone(obj);
                }
            });
        },

        concatAddress() {
            let street = !_.isEmpty(this.findLocality('street_number')) ? 
                         this.findLocality('street_number').long_name + ' ' : '';

            let route = !_.isEmpty(this.findLocality('route')) ? 
                        this.findLocality('route').long_name + ' ' : '';

            return street + route;
        },

        findLocality(locality) {
            return this.place.address_components.find(location => {
                        return location.types.find(type => type == locality);
                    });
        },

        fetchTimezone(obj) {
            let timestamp = moment().unix();

            var instance = axios.create({});
            delete instance.defaults.headers.common['X-CSRF-TOKEN'];
            delete instance.defaults.headers.common['X-Requested-With'];
            delete instance.defaults.headers.common['Authorization'];

            instance.get('https://maps.googleapis.com/maps/api/timezone/json?location='+ obj.latitude  + ',' + obj.longitude + '&timestamp='+ timestamp + '&key=AIzaSyDPLv-AF_sX_-ZKx-NAAx3uP_MJYtAzwII')
                .then(response => {
                    obj.timezone_id = response.data.timeZoneId;
                    obj.timezone_name = response.data.timeZoneName;
                });
        }
    }
});