<script>

import Loading from './Loading.vue'

export default {
    name: 'DataTable',

    components: {
        Loading
    },

    props: {
        searches: {type: Array},
        url: { type: String },
    },

    data:() => ({
        params: {},
        page: 1,
        data: [],
        links: {},
        meta: {},
        baseUrl: null,

        selectedAll: false,

        loading: false,
    }),

    mounted() {
        this.mapParams();
    },

    render() {
        return this.$scopedSlots.default({
            params: this.params,
            setParam: this.setParam,
            data: this.data,
            links: this.links,
            meta: this.meta,
            prev: this.prev,
            next: this.next,

            selectAllHandler: this.selectAllHandler,
            loading: this.loading,
        });
    },

    methods: {
        setParam: _.debounce(function(key, value) {
            this.params[key] = value;
            this.page = 1;
            this.createUrl();
        }, 1000),

        mapParams() {
            _.forEach(this.searches, (value, index) => {
                this.params[value] = null;
            });

            this.createUrl();
        },

        createUrl() {
            this.baseUrl = this.url + '?' + 'page='+ this.page;

            _.forEach(this.params, (value, index) => {
                this.baseUrl += '&' + index + '=' + value;
            });

            this.fetch();
        },

        fetch() {
            this.loading = true;
            axios.get(this.baseUrl)
                .then(response => {
                    this.data = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error.response.data);
                    this.loading = false;
                })
        },

        prev() {
            this.page--;

            this.createUrl();
        },

        next() {
            this.page++;

            this.createUrl();
        },

        selectAllHandler() {
            this.selectedAll = !this.selectedAll;
            
            _.each(this.data, (data) => {
                data.is_selected = this.selectedAll;
            })
        }
    }
}
</script>