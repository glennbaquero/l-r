<template>
	<div>
		<v-select
			class="my-3"
			multiple 
		    v-model="selectedItem" 
		    :options="items"
		    :label="label"
		    >
		</v-select>
		<input type="text" name="userIds" :value="selected" hidden>
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
			selectedValue: Array,
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
				this.selected = JSON.stringify(_.map(val, 'id'))
			},
		},

		mounted() {
			if(!_.isEmpty(this.selectedValue)) {
				_.each(this.selectedValue, (selected) => {
					var item = _.find(this.items, (item) => { return item.id == selected });

					this.selectedItem.push(item);
				});
			}
		}
	}
</script>