<script>
export default {
    name: 'toggle-select',

    props: {
        items: Array,
        selectedValue: Number,
        type: {
            default: 'user',
            type: String
        }
    },

    data: () => ({
        display: false,
        conditionalFieldToDisplay: false
    }),

    render() {
        return this.$scopedSlots.default({
            display: this.display,
            conditionalFieldToDisplay: this.conditionalFieldToDisplay,
            toggled: this.toggled,
            toggleFalse: this.toggleFalse,
            selectChanged: this.selectChanged,
        });
    },

    mounted() {
        if(!_.isEmpty(this.items)) {
            this.selectChanged(this.items, this.selectedValue, this.type)
        }
    },

    methods: {
        toggled() {
            this.display = !this.display;
        },

        toggleFalse() {
            setTimeout(() => { this.display = false; }, 200)
        },

        selectChanged(items, value, type='user') {
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
            }
        },
    }
}
</script>