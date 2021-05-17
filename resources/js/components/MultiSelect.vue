<template>
	<div>
		<v-select
			class="my-3"
			:multiple="multiple" 
		    v-model="selectedItem" 
		    :options="items"
		    :label="label"
		    @input="selectedChanged"
		    >
		</v-select>
		<input type="text" :name="name" :value="selected" hidden>
		<input type="text" :name="name_2" :value="selectedItem.id" hidden v-if="valueName">
	</div>
</template>
<script>
	import Vselect from "vue-select";
	import "vue-select/dist/vue-select.css";

	export default {

		name: 'multi-select',

		props: {
			items: Array,
			label: String,
			value: String,
			searchBy: String,
			selectedValue: {
				default: null
			},
			name: {
				default: 'userIds',
				type: String
			},

			multiple: {
				default: true,
				type: Boolean
			},

			valueName: {
				default: false,
				type: Boolean
			},

			name_2: {
				default: '',
				type: String
			},

			stop: Object,
			type: String,

			findValue:{
				default: 'id',
				type: String
			}

		},

		render() {
		    return this.$scopedSlots.default({
		        selected: this.selected
		    });
		},

		components: {
		    'v-select' : Vselect,
		},

		data() {
			return {
				selectedItem: [],
				selected: []
			}
		},

		watch: {
			selectedItem(val) {
				if(this.multiple) {
					this.selected = JSON.stringify(_.map(val, 'id'))
				} else {
					if(this.valueName) {
						this.selected = val.name;
					} else {
						this.selected = val.id;
					}
				}
			},

			selectedValue(val) {
				if(this.valueName) {
					var city = _.find(this.items, (item) => { return item.name == val});					
					if(!_.isEmpty(city)) {
						this.selectedItem = city;
					}
				}
			}
		},

		mounted() {
			setTimeout(() => {
				if(!_.isEmpty(this.selectedValue) || this.selectedValue) {
					if(this.multiple) {
						_.each(this.selectedValue, (selected) => {
							var item = _.find(this.items, (item) => { return item.id == selected });

							this.selectedItem.push(item);
						});
					} else {
						var city = _.find(this.items, (item) => { return item[this.findValue] == this.selectedValue});
						if(!_.isEmpty(city)) {
							this.selectedItem = city;
						}
						// this.selectedItem = _.find(this.items, (item) => { return item.id == this.selectedValue});
					}
					
				}
			}, 1000)
			
		},

		methods: {
			selectedChanged() {
				if(typeof this.$parent.selectChanged == 'function') {
					setTimeout(() => {
						this.$parent.selectChanged(this.items, this.selected, 'baggage')
					}, 500)
				}

				if(!_.isEmpty(this.stop)) {
					setTimeout(() => {
						this.stop.route_id = this.selected
					}, 1000)
				}
				

				if(!_.isEmpty(this.type)) {
					setTimeout(() => {
						if(!this.multiple) {
							this.$parent.selectChanged(this.selectedItem.id, this.type, this.searchBy);
						} else {
							this.$parent.selectChanged(JSON.parse(this.selected), this.type, this.searchBy);
						}
					}, 500)
					
				}
			}
		}
	}
</script>