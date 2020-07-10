<template>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <ul class="list-group list-group-flush">
                    <list-item
                        v-for="item in items"
                        :id="item.id"
                        :key="item.id"
                        :item="item"
                    ></list-item>
                </ul>
            </div>
            <div class="col-md-12 mt-3 d-flex justify-content-center">
                <paginator v-if="paginate.last_page > 1" :paginate="paginate" />
            </div>
        </div>
    </div>
</template>
<script>
import Paginator from "../Utilities/Paginator";
import ListItem from "./Item";
export default {
    components: {
        Paginator,
        ListItem,
    },
    data() {
        return {
            items: [],
            paginate: {},
            filters: {
                paginate: 5,
            },
        };
    },
    methods: {
        fetch(url = null) {
            window.axios
                .get(url === null ? `?paginate=${this.filters.paginate}` : url)
                .then(({ data }) => {
                    this.items = data.data;
                    delete data.data;
                    this.paginate = data;
                })
                .catch((errors) => {
                    window.flash(
                        "Something went wrong fetching the results",
                        "danger"
                    );
                });
        },
    },
    created() {
        this.fetch();
        window.events.$on("new_line", (item) => {
            this.items.unshift(item);
        });

        window.events.$on("page", (url) => {
            this.fetch(`${url}&paginate=${this.filters.paginate}`);
        });
    },
};
</script>
