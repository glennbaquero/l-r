<script type="text/javascript">
	export default {
		name: 'Tab',

		data() {
			return {
				selected: 'Manual'
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