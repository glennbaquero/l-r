<script type="text/javascript">
	export default {
		name: 'AccountReceivableFilter',

		props: {
			getOffices: Array,
		},

		data() {
			return {
				list_office: [],
				field: {},
				office: {},
				show: false,

			}
		},

		render() {
		    return this.$scopedSlots.default({
		    	list_office: this.list_office,
		    	search: this.search,
		    	field: this.field,
		    	office: this.office,
		    	show: this.show,
		    });
		},


		watch: {
			'field.office_id'(val) {
				this.office = _.find(this.getOffices, (office) => {
					return office.id == val;
				})
			}
		},

		methods: {
			selectChanged(value, type) {
				this.list_office = _.filter(this.getOffices, (office) => { return office.state_name == value});
			},

			search() {
				this.show = true;
				this.$parent.params['office_id'] = this.field.office_id;
				this.$parent.params['date'] = this.field.date;
				this.$parent.createUrl();
			}
		}

	}
</script>