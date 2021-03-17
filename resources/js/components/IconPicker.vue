<script type="text/javascript">
	export default {
		name: 'IconPicker',

		props: {
			cell: Object
		},

		data() {
			return {
				item: {},
				icon: null,
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        item: this.item,
		        icon: this.icon,
		        selectIcon: this.selectIcon,
		    });
		},

		mounted() {
			if(!_.isEmpty(this.cell)) {
				this.item = this.cell;
			}
		},

		methods: {
			selectIcon(type) {
				this.item.icon = type;
				this.item.image_path = 'icons\/'+type;
				this.icon = type;
			}
		}
	}
</script>