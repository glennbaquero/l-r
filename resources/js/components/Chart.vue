<script type="text/javascript">
	
	import Chart from 'chart.js';

	export default {
		name: 'Chart',

		props: {
			data: Array,
			bgColor: Array,
			labels: Array,

			type: {
				default: 'bar',
				type: String
			},
			canvasId: {
				default: 'canvas',
				type: String
			},
			label: String,
			borderColor: String,

			fill: {
				default: false,
				type: Boolean
			},

			updateUrl: String,
		},

		data() {
			return {
				updatedData: this.data,

				filter: null,

				filter_value: {}
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        changeHandler: this.changeHandler,
		        filter: this.filter,
		        filter_value: this.filter_value,
		        filterChangeHandler: this.filterChangeHandler,
		        dateRangeHandler: this.dateRangeHandler,
		    });
		},

		mounted() {
			setTimeout(() => {
				this.init();
			}, 1000)
		},

		methods: {
			init() {
				var ctx = document.getElementById(this.canvasId).getContext("2d");

				var config = {
					type: this.type,
					data: {
						labels: this.labels,
						datasets: [
							{
								label: this.label,
								data: this.updatedData,
								backgroundColor: !_.isEmpty(this.bgColor) ? this.bgColor : [],
								fill: this.fill,
								borderColor: !_.isEmpty(this.borderColor) ? this.borderColor : null,
							}
						],
					},
				    options: {
				        legend: {
				            display: false,
				        },
				    },
				};


				var myChart = new Chart(ctx, config);
			},

			// yearly
			changeHandler(value) {
				var params = {
					year: value,
					type: 'yearly'
				}
				this.fetch(params)
			},

			// date range
			dateRangeHandler() {
				var params = {
					from: this.filter_value.from,
					to: this.filter_value.to,
					type: 'date_range'
				}

				if(!_.isEmpty(this.filter_value.from) && !_.isEmpty(this.filter_value.to)) {
					this.fetch(params)
				}

			},

			fetch(params) {

				axios.post(this.updateUrl, params)
					.then(response => {
						this.updatedData = response.data.per_month_revenue;
						this.init();
					}).catch(errors => {	

					})
			},

			filterChangeHandler(value) {
				this.filter = value;
			}
		}


	}
</script>