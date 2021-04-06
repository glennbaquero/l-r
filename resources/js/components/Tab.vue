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
		        menuChangedVoucherTable: this.menuChangedVoucherTable
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
			}
		}
	}
</script>