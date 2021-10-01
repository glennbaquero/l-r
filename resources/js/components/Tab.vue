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
			menuChanged(menu, fetch=false, table_num=null) {
				this.selected = menu;

				if(fetch) {
					this.$children[table_num].fetch();
				}
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