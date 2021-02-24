<script>
export default {
    name: 'toggle-action',

    props: {
        items: Array,
    },

    data: () => ({
        display: false,
    }),

    render() {
        return this.$scopedSlots.default({
            display: this.display,
            toggled: this.toggled,
            toggleFalse: this.toggleFalse,
            selectChanged: this.selectChanged,
        });
    },

    mounted() {
        if(!_.isEmpty(this.item)) {
            this.display = this.item[this.toggleableData]
        }
    },

    methods: {
        toggled() {
            this.display = !this.display;
        },

        toggleFalse() {
            setTimeout(() => { this.display = false; }, 200)
        },

        selectChanged(groups, value) {
            var group = _.find(groups, function(o) { return o.id == value });

            if(group.has_commission) this.display = true;
            else this.display = false;
        },
    }
}
</script>