<template>
		<div id="map" class="h-full w-full"></div>
</template>

<script type="text/javascript">
	export default {
		name: 'GoogleMapDirection',

		props: {
			origin: Object,
			destination: Object,
			waypoints: Array
		},

		watch: {
			origin(val) {
				this.initMap();
			},

			destination(val) {
				this.initMap();
			},

			waypoints(val) {
				this.initMap();
			}
		},

		// mounted() {
		// 	this.initMap();
		// },

		methods: {
			initMap() {
			  	const directionsRenderer = new google.maps.DirectionsRenderer();
			  	const directionsService = new google.maps.DirectionsService();
			  	const map = new google.maps.Map(document.getElementById("map"), {
			  	  	zoom: 14,
			  	  	center: { lat: 37.77, lng: -122.447 },
			  	});
			  	directionsRenderer.setMap(map);
			  	this.calculateAndDisplayRoute(directionsService, directionsRenderer);
			},

			calculateAndDisplayRoute(directionsService, directionsRenderer) {
			    const selectedMode = 'DRIVING';
			    directionsService.route(
			       	{
			            origin: { lat: parseFloat(this.origin.latitude), lng: parseFloat(this.origin.longitude) },
			            destination: { lat: parseFloat(this.destination.latitude), lng: parseFloat(this.destination.longitude) },
			            // Note that Javascript allows us to access the constant
			            // using square brackets and a string value as its
			            // "property."
			            travelMode: google.maps.TravelMode[selectedMode],
			            waypoints: this.waypoints
			        },(response, status) => {
			            if (status == "OK") {
							directionsRenderer.setDirections(response);
			            } else {
			              	window.alert("Directions request failed due to " + status);
			            }
			        }
				);
	      	}
		}
	}
</script>