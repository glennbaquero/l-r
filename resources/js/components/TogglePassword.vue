<script>
export default {
    name: 'toggle-password',

    data: () => ({
        display: false,
    }),

    render() {
        return this.$scopedSlots.default({
            display: this.display,
            toggle: this.toggle
        });
    },

    methods: {
        toggle() {
            this.display = !this.display;
        }
    }
}
</script>