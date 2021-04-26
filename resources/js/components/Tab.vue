<script type="text/javascript">
	export default {
		name: 'Tab',

		props: {
			defaultSelected: {
				default: 'Manual',
				type: String
			}
		},

		data() {
			return {
				selected: this.defaultSelected
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        selected: this.selected,
		        menuChanged: this.menuChanged,
		        menuChangedVoucherTable: this.menuChangedVoucherTable,
		        menuChangedFrequentTraveler: this.menuChangedFrequentTraveler,
		    });
		},

		methods: {
			menuChanged(menu) {
				this.selected = menu;
			},

			menuChangedVoucherTable(menu) {
				this.selected = menu;

				this.$children[0].params['type_of_voucher'] = menu;
				this.$children[0].createUrl();
			},

			menuChangedFrequentTraveler(menu) {
				this.selected = menu;

				this.$parent.$parent.params['type'] = menu;
				this.$parent.$parent.createUrl();
			},
		}
	}
</script>