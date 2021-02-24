<script>
export default {
    name: 'toggle-alert',

    data: () => ({
        display: true,
    }),

    render() {
        return this.$scopedSlots.default({
            display: this.display,
            toggled: this.toggled,
            toggleFalse: this.toggleFalse,
        });
    },


    methods: {
        toggled() {
            this.display = !this.display;
        },

        toggleFalse() {
            setTimeout(() => { this.display = false; }, 200)
        }
    }
}
</script>
