<script type="text/javascript">

	export default {
		name: 'Increment',

		props: {
			data: Array,
		},

		data() {
			return {
				increment: 1,
				array: [
					{
						id: 1,
						value: null,
						_id: 1,
						new: true,
					}
				],
				selected: {
					monday: false,
					tuesday: false,
					wednesday: false,
					thursday: false,
					friday: false,
					saturday: false,
					sunday: false,
				}
			}
		},
		
		render() {
		    return this.$scopedSlots.default({
		        addNewHandler: this.addNewHandler,
		        removeHandler: this.removeHandler,
		        increment: this.increment,
		        array: this.array,
		        selected: this.selected,
		    });
		},

		mounted() {
			if(!_.isEmpty(this.data)) {
				this.array = this.data;
				this.increment = this.data.length;
			}
		},

		methods: {
			addNewHandler() {
				this.increment += 1;
				var data = {
					_id: this.increment,
					value: null,
					new: true,
					id: null
				};
				this.array.push(data);
			},
			removeHandler(key, item=null) {
				this.array.splice(key, 1);

				if(!_.isEmpty(item)) {
					axios.get(item.deleteUrl)
						.then(response => {

						}).catch(errors => {

						})
				}
			},
		}
	}
</script>