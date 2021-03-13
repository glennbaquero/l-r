<script type="text/javascript">
	export default {
		name: 'FilterTable',

		data() {
			return {
				display: false,
				field: this.$parent.params
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        search: this.search,
		        display: this.display,
		        toggledState: this.toggledState,
		        field: this.field,
		    });
		},

		methods: {
			search(byRange = false) {
				const datepicker = this.$el.querySelector('#datepicker');

				if(byRange) {
					var split = datepicker.value.split(',');
					this.field['date'] = null;
					this.field['date_range'] = {
						from: split[0],
						to: split[1]
					}

					this.field['date_range'] = JSON.stringify(this.field['date_range']);
				} else {
					this.field['date'] = datepicker.value;
					this.field['date_range'] = null;
				}

				this.$parent.params = this.field;
				console.log(this.field);
				this.$parent.createUrl();
			},

			toggledState(state) {
				this.display = state;
			},
		}
	}
</script>