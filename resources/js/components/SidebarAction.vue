<script type="text/javascript">
	export default {
		name: 'SidebarAction',

		data() {
			return {
				open: false,
				showMobileResponsive: false,
				showDropdown: false,

			}
		},

		render() {
		    return this.$scopedSlots.default({
		    	open: this.open,
		    	updateOpen: this.updateOpen,
		    	updateMobileResponsive: this.updateMobileResponsive,
		    	showMobileResponsive: this.showMobileResponsive,
		    	showDropdown: this.showDropdown,
		    	updateShowDropdown: this.updateShowDropdown,
		    });
		},

		methods: {
			updateOpen() {
				this.open  = !this.open;
			},

			updateMobileResponsive() {
				this.showMobileResponsive = !this.showMobileResponsive;
			},

			updateShowDropdown() {
				this.showDropdown = !this.showDropdown;
			},
		}
	}
</script>