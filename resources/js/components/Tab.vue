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
		        menuChanged: this.menuChanged
		    });
		},

		methods: {
			menuChanged(menu) {
				this.selected = menu;
			}
		}
	}
</script>