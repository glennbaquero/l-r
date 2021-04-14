<script type="text/javascript">
	export default {
		name: 'OpenCash',

		data() {
			return {
				cash: 0.00,
				cash_entry: 0.00,
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        cash: this.cash,
		        cash_entry: this.cash_entry,
		        addCash: this.addCash,
		        enterCash: this.enterCash,
		    });
		},

		methods: {
			addCash() {
				this.cash += parseFloat(this.cash_entry);
				this.cash_entry = 0;
				document.getElementById('amount_added').value = 0;
			},

			enterCash(value) {
				this.cash_entry = value;
			}
		}
	}

</script>