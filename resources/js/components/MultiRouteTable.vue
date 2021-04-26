<script>
	export default {
		name: 'multi-route-table',

		props: {
			cities: Array,

			item: Object,
			routeStops: Array,
			availableRoutes: Array,
			hasError: String
		},

		data() {
			return {
				stops: [
					{
						auto: false,
						departure_id: null,
						arrival_id: null,
						route_id: 0,
						new: true, 
						routes: [],
					}
				],

				routes: [],
				loading: false
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        stops: this.stops,
		        addNewStop: this.addNewStop,
		        removeStop: this.removeStop,
		        arrivalChanged: this.arrivalChanged,
		        convertToJSON: this.convertToJSON,
		        routes: this.routes,
		        loading: this.loading,
		    });
		},

		computed: {
			convertToJSON() {
				return JSON.stringify(this.stops);
			},
		},


		watch: {
			stops: {
				handler(value) {
					localStorage.setItem('multi_route_stops', this.convertToJSON);
				},

				deep: true
			}
		},

		mounted() {
			if(!_.isEmpty(this.routeStops)) {
				this.stops = this.routeStops;

				_.each(this.stops, (stop) => {
					
					stop.routes = [];

					_.each(this.availableRoutes, (_stop) => {
						if(_stop.arrival_id == stop.arrival_id && _stop.departure_id == stop.departure_id && !_.find(stop.routes, _stop.route)) {
			    		    stop.routes.push(_stop.route)
					    }
					})

					// stop.routes = _.reduce(this.availableRoutes, (result, _stop) => {
					// 	    if(_stop.arrival_id == stop.arrival_id && _stop.departure_id == stop.departure_id) {
					// 	        result.push(_stop.route)
					// 	    }

					// 	    return result;
					// }, [])
				})
			}

			if(this.hasError == '1' || parseInt(this.hasError)) {
				setTimeout(() => {
					this.stops = JSON.parse(localStorage.getItem('multi_route_stops'));
				}, 500)
			}
		},

		methods: {
			addNewStop() {
				
				var stops = this.stops.length;
				var departure_id = stops >= 1 ? this.stops[stops - 1].arrival_id : null;

				if(_.some(this.stops, { 'deleted_at': null })) {
					var count = _.groupBy(this.stops, 'deleted_at');

					var nullable = count.null.length;
					var undefine = count.undefined ? count.undefined.length + 1 : 0;
					count = nullable + undefine;

					departure_id = this.stops[count - 1].arrival_id;
				}

				var stop = {
						auto: false,
						departure_id: departure_id,
						arrival_id: null,
						route_id: 0,
						new: true,
						routes: []
					}

				this.stops.push(stop);
			},

			removeStop(key, stop={}) {
				if(!_.isEmpty(stop) && _.has(stop, 'deleted_at')) {
					stop.deleted_at = moment().format('Y-MM-DD HH:mm:ss')
				} else {
					this.stops.splice(key, 1);
				}
			},

			arrivalChanged(key, value, stop) {
				var city = _.find(this.cities, (city) => { return city.id == value });

				if(this.stops.length > key+1) {
					this.stops[key+1].departure_id = city.id;
				}

				stop.routes = [];

				_.each(this.availableRoutes, (_stop) => {
					if(_stop.arrival_id == stop.arrival_id && _stop.departure_id == stop.departure_id && !_.find(stop.routes, _stop.route)) {
		    		    stop.routes.push(_stop.route)
				    }
				})
			}
		}
	}
</script>