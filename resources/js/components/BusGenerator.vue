<script type="text/javascript">
	export default {
		name: 'BusGenerator',

		props: {
			cells: Array,
			item: Object
		},

		data() {
			return {
				bus: {
					columns: 0,
					rows: 1,
					seats: 0,
					floors: 0,

					columnsCellType: [],
				},

				rowsCount: 0,
				columns: 0,

				default_cell: null,

				updateTypeCell: null,

				itemShow: this.item,

				canUpdate: false

			}
		},

		render() {
		    return this.$scopedSlots.default({
		        bus: this.bus,
		        cellChange: this.cellChange,
		        default_cell: this.default_cell,
		        rowsCount: this.rowsCount,
		        columns: this.columns,
		        showCellType: this.showCellType,
		        updateType: this.updateType,
		        updateTypeCell: this.updateTypeCell,
		        selectColumn: this.selectColumn,
		        changeCellType: this.changeCellType,
		        changeCellOrientation: this.changeCellOrientation,
		        toJson: this.toJson,
		    });
		},

		watch: {
			'bus.columns'(newVal, oldVal) {

				if(newVal < 0) {
					this.bus.columns = 0
				}

				if(_.isEmpty(this.itemShow))  {
					this.bus.columnsCellType = this.totalSeats;
				}


				if(!_.isEmpty(this.item) && this.canUpdate) {
					var default_cell_id = this.bus.default_cell_id;
					var default_image = _.find(this.cells, function(cell) { return cell.id == default_cell_id });
					console.log(newVal > oldVal);
					_.each(this.bus.columnsCellType, (row) => {
						var image = { image_path: default_image.full_image_path, showSelection: false, showInputTypeText: false, label: 0, selected: false, orientation: 360 };

						if(newVal > oldVal) {
							row.push(image);
						} else {
							row.splice(newVal, 1)
						}
					})
				}
			},	

			'bus.rows'(newVal, oldVal) {
				if(newVal < 0) {
					this.bus.rows = 0
				}

				if(_.isEmpty(this.itemShow))  {
					this.bus.columnsCellType = this.totalSeats;
				}

			},	

			// default_cell(val) {
			// 	_.each(this.bus.columnsCellType, (row) => {
			// 		_.each(row, (cell) => {
			// 			cell.image_path = val;
			// 		}) 
			// 	}) 
			// },

		},

		computed: {
			totalSeats() {
				var rows = this.bus.rows;
				var listOfSeat = [];

				if(_.isEmpty(this.itemShow) && _.isEmpty(this.item))  {
					for (var row = 0; row < rows; row++) {
						var array1 = [];
						for (var column = 0; column < this.bus.columns; column++) {
							var image = { image_path: this.default_cell, showSelection: false, showInputTypeText: false, label: column, selected: false, orientation: 360 }
							array1.push(image)
						}

						listOfSeat.push(array1)
					}
				}


				if(!_.isEmpty(this.item) && this.canUpdate) {
					listOfSeat = this.item.columnsCellType;

					if(this.bus.rows != this.item.columnsCellType.length) {
						var new_list = [];
						var default_cell_id = this.bus.default_cell_id;
						var default_image = _.find(this.cells, function(cell) { return cell.id == default_cell_id });

						for (var column = 0; column < this.bus.columns; column++) {
							new_list.push({ image_path: default_image, showSelection: false, showInputTypeText: false, label: column, selected: false, orientation: 360 })
						}
						listOfSeat[rows - 1] = new_list;
					}
				}
				

				return listOfSeat;
			},

			toJson() {
				return JSON.stringify(this.bus.columnsCellType);
			}
		},

		mounted() {
			if(!_.isEmpty(this.item)) {
				this.bus = this.itemShow;

				setTimeout(() => {
					this.itemShow = {}
				}, 2000)
			}


			setTimeout(() => {
				this.canUpdate = true;
			}, 2000)
		},

		methods: {
			cellChange(value, column = null) {
				var item = _.find(this.cells, function(cell) { return cell.id == value });

				if(_.isEmpty(item)) {
					this.default_cell = null;

					if(!_.isEmpty(column)) {
						column.image_path = null;
						column.showSelection = false;
					}
				} else {
					if(!_.isEmpty(column)) {
						column.image_path = item.full_image_path;
						column.cell_id = item.id;
						column.showSelection = false;
					} else {
						this.default_cell = item.full_image_path;
					}
				}
			},

			showCellType(column) {
				column.showSelection = true;

				_.each(this.bus.columnsCellType, (row) => {
					_.each(row, (cell) => {
						if(cell.selected) {
							cell.selected = false;
						}
					}) 
				}) 
			},

			updateType(value) {
				this.updateTypeCell = value;

			},

			selectColumn(column) {
				column.selected = true
			},

			changeCellType(value) {
				var item = _.find(this.cells, function(cell) { return cell.id == value });

				_.each(this.bus.columnsCellType, (row) => {
					_.each(row, (cell) => {
						if(cell.selected) {
							if(!_.isEmpty(item)) {
								cell.image_path = item.full_image_path;
							} else {
								cell.image_path = ''
							}
							cell.selected = false;
						}
					}) 
				}) 
			},

			changeCellOrientation(value) {
				_.each(this.bus.columnsCellType, (row) => {
					_.each(row, (cell) => {
						if(cell.selected) {
							cell.orientation = value;

							cell.selected = false;
						}
					}) 
				}) 
			}

		}
	}
</script>