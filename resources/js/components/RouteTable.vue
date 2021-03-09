<script>
	export default {
		name: 'route-table',

		props: {
			cities: Array,

			item: Object,
			routeStops: Array,
		},

		data() {
			return {
				stops: [
					{
						division_point: false,
						show: true,
						departure_id: null,
						arrival_id: null,
						trip_length: null,
						wait_time: null,
						distance: 0,
						new: true
					}
				],
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        stops: this.stops,
		        addNewStop: this.addNewStop,
		        removeStop: this.removeStop,
		        departureRouteChanged: this.departureRouteChanged,
		        arrivalChanged: this.arrivalChanged,
		        convertToJSON: this.convertToJSON,
		        tripLengthTotal: this.tripLengthTotal,
		        waitTimeTotal: this.waitTimeTotal,
		        totalDistance: this.totalDistance,
		    });
		},

		computed: {
			convertToJSON() {
				return JSON.stringify(this.stops);
			},

			tripLengthTotal() {

				var durations = _.map(this.stops, 'trip_length');

				if(_.some(this.stops, 'deleted_at')) {
					durations = _.filter(this.stops, function (item) {
							return item.deleted_at == null || item.deleted_at == undefined;
						}, 'trip_length');

					durations = _.map(durations, 'trip_length');
				}

				var totalHours = durations.slice(1).reduce((prev, cur) => moment.duration(cur).add(prev), moment.duration(durations[0]));

				var milliseconds = totalHours._milliseconds
				var ticks = milliseconds / 1000;
				var hours = Math.floor(ticks / 3600);
				var minutes = Math.floor((ticks % 3600) / 60);
				var seconds = ticks % 60;

				hours = hours < 10 ? '0'+hours : hours;
				minutes = minutes < 10 ? '0'+minutes : minutes;
				seconds = seconds < 10 ? '0'+seconds : seconds;

				return hours+":"+minutes+":"+seconds;

			},

			waitTimeTotal() {
				var durations = _.map(this.stops, 'wait_time');

				if(_.some(this.stops, 'deleted_at')) {
					durations = _.filter(this.stops, function (item) {
							return item.deleted_at == null || item.deleted_at == undefined;
						}, 'wait_time');

					durations = _.map(durations, 'wait_time');
				}


				var totalHours = durations.slice(1).reduce((prev, cur) => moment.duration(cur).add(prev), moment.duration(durations[0]));

				var milliseconds = totalHours._milliseconds
				var ticks = milliseconds / 1000;
				var hours = Math.floor(ticks / 3600);
				var minutes = Math.floor((ticks % 3600) / 60);
				var seconds = ticks % 60;

				hours = hours < 10 ? '0'+hours : hours;
				minutes = minutes < 10 ? '0'+minutes : minutes;
				seconds = seconds < 10 ? '0'+seconds : seconds;

				return hours+":"+minutes+":"+seconds;

			},

			totalDistance() {
				var totalDistance = _.sumBy(this.stops, (stop) => {
					if(stop.deleted_at == undefined || stop.deleted_at == null) {
						return parseFloat(stop.distance);
					}
				});

				return totalDistance;

			}
		},

		mounted() {
			if(!_.isEmpty(this.routeStops)) {
				this.stops = this.routeStops;
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
						division_point: false,
						show: true,
						departure_id: departure_id,
						arrival_id: null,
						trip_length: null,
						wait_time: null,
						distance: 0,
						new: true
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

			departureRouteChanged(value) {
				var city = _.find(this.cities, (city) => { return city.id == value });
				this.stops[0].departure_id = city.id;
			},

			arrivalChanged(key, value) {
				var city = _.find(this.cities, (city) => { return city.id == value });

				if(this.stops.length > key+1) {
					this.stops[key+1].departure_id = city.id;
				}
			}
		}
	}
</script>