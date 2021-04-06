<script>
export default {
    name: 'toggle-select',

    props: {
        items: Array,
        selectedValue: Number,
        selectedValueString: {
            type: String,
            default: null
        },
        type: {
            default: 'user',
            type: String
        }
    },

    data: () => ({
        display: false,
        conditionalFieldToDisplay: false,

        item: {
            printer_models: []
        },

        voucherType: 'Amount'
    }),

    render() {
        return this.$scopedSlots.default({
            display: this.display,
            conditionalFieldToDisplay: this.conditionalFieldToDisplay,
            toggled: this.toggled,
            toggleFalse: this.toggleFalse,
            selectChanged: this.selectChanged,
            item: this.item,
            voucherType: this.voucherType
        });
    },

    mounted() {
        if(!_.isEmpty(this.items)) {
            if(!_.isEmpty(this.selectedValueString)) {
                this.selectChanged(this.items, this.selectedValueString, this.type)
            } else {
                this.selectChanged(this.items, this.selectedValue, this.type)
            }
        }
    },

    methods: {
        toggled() {
            this.display = !this.display;
        },

        toggleFalse() {
            setTimeout(() => { this.display = false; }, 200)
        },

        selectChanged(items, value, type='user', oldValue=null) {
            var item = _.find(items, function(o) { return o.id == value });

            switch(type) {
                case 'user':
                        if(item.has_commission) this.display = true;
                        else this.display = false;
                    break;
                    
                case 'office':
                        if(item.has_added_field) this.display = true;
                        else this.display = false;

                        if(item.has_main_agency) this.conditionalFieldToDisplay = true;
                        else this.conditionalFieldToDisplay = false
                    break;

                case 'printer':
                    this.item = item;
                    break;

                case 'route':
                    this.item = item;
                    break;

                case 'baggage':
                    this.item = item.passenger;
                    break;

                case 'transport_type': 
                    if(value == 'Carga') this.display = false;
                    else this.display = true;
                    break;

                case 'voucher': 
                    this.voucherType = value;
                    break;
            }
        },
    }
}
</script>