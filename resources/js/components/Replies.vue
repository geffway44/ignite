<template>
    <div>
        <new-reply @created="add"></new-reply>

        <div class="font-semibold text-gray-800 text-xl mb-10">
            <span v-text="count"></span> Comments
        </div>

        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :reply="reply" @deleted="remove(index)"></reply>
        </div>

        <paginator :dataSet="dataSet" @changed="fetchData"></paginator>
    </div>
</template>

<script>
    import Reply from './Reply.vue';
    import collection from '../mixins/collection';
    import NewReply from '../components/NewReply.vue';

    export default {
        components: { Reply, NewReply },

        mixins: [collection],

        props: ['count'],

        data() {
            return {
                dataSet: false,
            }
        },

        created() {
            this.fetchData();
        },

        methods: {
            fetchData(page) {
                axios.get(this.url(page)).then(this.refresh);
            },

            url(page = 1) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                return `${location.pathname}/replies?page=${page}`;
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0, 0);
            }
        }
    }
</script>
