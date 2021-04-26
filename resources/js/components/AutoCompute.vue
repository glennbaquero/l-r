<script type="text/javascript">
	export default {
		name: 'AutoCompute',

		props: {
			items: Array,
			hasError: String,
			item: Object
		},

		data() {
			return {
				basePrice: 0,
				selectedArrival: {},
				selectedDeparture: {}
			}
		},

		render() {
		    return this.$scopedSlots.default({
		    	basePrice: this.basePrice,
		    	departurePrice: this.departurePrice,
		    	arrivalPrice: this.arrivalPrice,
		    	roundtripPrice: this.roundtripPrice,
		    	cityChange: this.cityChange,
		    	basePriceChangeHandler: this.basePriceChangeHandler,
		    });
		},

		computed: {
			miles() {
				return (haversine(this.selectedDeparture, this.selectedArrival) / 1000) / 1.609;
			},

			departurePrice() {
				return this.basePrice;
			},

			arrivalPrice() {
				var total = this.basePrice * this.miles;
				total = Math.round((total + Number.EPSILON) * 100) / 100
				return total;
			},

			roundtripPrice() {
				return this.departurePrice + this.arrivalPrice;
			}
		},

		mounted() {
			if(parseInt(this.hasError) || !_.isEmpty(this.item)) {
				setTimeout(() => {
					var departure = document.getElementById('departure_id').value;
					var arrival = document.getElementById('arrival_id').value;
					this.cityChange(parseInt(arrival), 'Arrival')
					this.cityChange(parseInt(departure), 'Departure')

					var price = document.getElementById('price_per_mile').value;
					this.basePriceChangeHandler(price);
				}, 500)
			}
		},

		methods: {
			cityChange(value, type) {
				var item = _.find(this.items, (item) => { return item.id == value });

				switch(type) {
					case 'Departure':
						this.selectedDeparture = { latitude: item.latitude, longitude: item.longitude };
						break;
					case 'Arrival':
						this.selectedArrival = { latitude: item.latitude, longitude: item.longitude };
						break;
				}

			},

			basePriceChangeHandler(value) {
				this.basePrice = parseFloat(value);
			}
		}
	}
</script>