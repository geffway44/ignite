<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :reply="reply" @replyDeleted="remove(index)"></reply>
        </div>

        <paginator :dataSet="dataSet" @changed="fetchData"></paginator>

        <new-reply @replyCreated="add"></new-reply>
    </div>
</template>

<script>
    import Reply from './Reply.vue';
    import NewReply from '../components/NewReply.vue';
    import collection from '../mixins/collection';

    export default {
        components: { Reply, NewReply },

        mixins: [collection],

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
