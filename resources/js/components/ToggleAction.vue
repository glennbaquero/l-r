<script>
export default {
    name: 'toggle-action',

    props: {
        items: Array,
    },

    data: () => ({
        display: false,
        type: 'Amount'
    }),

    render() {
        return this.$scopedSlots.default({
            display: this.display,
            toggled: this.toggled,
            toggleFalse: this.toggleFalse,
            type: this.type,
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
    }
}
</script>