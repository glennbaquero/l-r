<script>
export default {
    name: 'toggle',

    props: {
        item: Object,
        toggleableData: String,
        hasparenttoggle: {
            default: 0,
            type: Number
        },

        enableDisplay: String,

        toshowdata: {
            default: 0,
            type: Number
        }
    },

    data: () => ({
        display: false,
    }),

    render() {
        return this.$scopedSlots.default({
            display: this.display,
            toggled: this.toggled,
            toggleFalse: this.toggleFalse,
            update: this.update,
            toggledState: this.toggledState
        });
    },

    mounted() {
        if(!_.isEmpty(this.item)) {
            this.display = this.item[this.toggleableData]
        }

        if(this.hasparenttoggle && this.$parent && this.toshowdata && !_.isEmpty(this.item)) {
            this.$parent.display = this.item[this.toggleableData];
        }

        if(this.enableDisplay == '1') {
            this.display = true;
        }
    },

    methods: {
        toggled() {
            this.display = !this.display;

            if(this.$parent && this.hasparenttoggle) {
                this.$parent.display = !this.$parent.display;
            }
        },

        toggledState(state) {
            this.display = state;
        },

        toggleFalse() {
            setTimeout(() => { this.display = false; }, 200)
        },

        update(url) {
            axios.post(url)
                .then(response => {
                    this.$parent.fetch();
                }).catch(errors => {

                })
        }
    }
}
</script>