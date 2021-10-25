<script type="text/javascript">
	export default {
	    name: 'google-map',

	    props: {
	        destination: Object,
	        origin: Object,
	    },

	    data: () => ({
	        map: null,
	        message: '',
	    }),

	    render() {
	        return this.$scopedSlots.default({
	           directionsURL: this.directionsURL,
	           hasOrigin: this.hasOrigin
	        });
	    },

	    computed: {
	        hasOrigin() {
	            return !_.isEmpty(this.origin)
	        },

	        /**
	         * Used when the notary location is true
	         */
	        directionsURL() {
	        	if(this.hasOrigin) {
		            return 'https://www.google.com/maps/embed/v1/directions?key=AIzaSyDPLv-AF_sX_-ZKx-NAAx3uP_MJYtAzwII&origin=' + this.origin.latitude + ',' + this.origin.longitude+ '&destination=' + this.destination.latitude + ',' + this.destination.longitude;
	        	}

	        	return false;
	            // '&avoid=tolls|highways'; include this if needed
	        }
	    },

	    mounted() {
	        if(!this.hasOrigin) {
	            /* Load only the basic map */
	            this.map = new google.maps.Map((this.$refs.map), {center: this.destination, zoom: 16,});
	            this.orderMarker();
	        }
	    },

	    methods : {
	        orderMarker() {
	            new google.maps.Marker({position: this.destination, map: this.map, draggable:true,});
	        },

	        /**
	         * 2nd Option to display simple routes from notary to order location
	         */
	        getRoutes() {
	            let directionsService = new google.maps.DirectionsService();
	            let directionsRenderer = new google.maps.DirectionsRenderer();

	            directionsRenderer.setMap(this.map);

	            const route = {
	                origin: this.origin,
	                destination: this.destination,
	                travelMode: 'DRIVING',
	            };

	            directionsService.route(route, (response, status) => { // anonymous function to capture directions
	                if (status !== 'OK') {
	                    window.alert('Directions request failed due to ' + status);
	                    return;
	                    
	                } else {
	                    directionsRenderer.setDirections(response); // Add route to the map
	                    var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
	                    
	                    if (!directionsData) {
	                        window.alert('Directions request failed');
	                        return;
	                    }
	                    else {
	                        this.message =  "Driving distance is " + directionsData.distance.text + " (" + directionsData.duration.text + ").";
	                    }
	                }
	            })
	        }
	    }
	}
</script>