<script>
    import Replies from '../components/Replies.vue';

    export default {
        components: { Replies },

        props: ['thread'],

        data() {
            return {
                repliesCount: this.thread.replies_count
            }
        },
    }
</script>
