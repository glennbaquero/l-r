<script type="text/javascript">
 	 
	export default {
		name: 'PdfViewer',

		props: {
			getOffices: Array,
			getUsers: Array,
			searchUrl: String
		},

		data() {
			return {
				src: null,
				offices: [],
				users: [],
			}
		},

		render() {
		    return this.$scopedSlots.default({
		    	src: this.src,
		    	offices: this.offices,
		    	users: this.users,
		    	getPdfData: this.getPdfData,
		    });
		},

		methods: {
			selectChanged(value, type) {
				switch(type) {
					case 'office_type':
						this.offices = _.filter(this.getOffices, (office) => { return office.office_type_id == value});
						break;
					case 'office':
						this.users = _.filter(this.getUsers, (user) => { return user.office_id == value});
						break;
				}
			},

			getPdfData() {

				var date_type = this.$children[4].display;
				var office_type_id = this.$children[1].selectedItem.id;
				var office_id = this.$children[2].selectedItem.id;
				var user_ids = this.$children[3].selected;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				// var payloads = {
				// 	office_type_id: this.$children[1].selectedItem.id,
				// 	office_id: this.$children[2].selectedItem.id,
				// 	user_ids: JSON.parse(this.$children[3].selected),
				// 	date_type: date_type,
				// 	start_date: document.getElementById("start_date").value,
				// 	end_date: date_type ? document.getElementById("end_date").value : null,
				// }
				var url = this.searchUrl+'/'+user_ids+'/'+date_type+'/'+start_date+'/'+end_date;

				// window.open(url,'_blank');

				axios.get(url)
					.then(response => {
						setTimeout(() => {
							document.getElementById('pdf_viewer').contentWindow.location.reload();
						}, 500)
					})
			}
		}
	}
</script>>