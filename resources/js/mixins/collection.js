export default {
    data() {
        return {
            items: []
        }
    },

    methods: {
        add(item) {
            this.items.push(item);

            this.$emit('replyAdded');
        },

        remove(index) {
            this.items.splice(index, 1);

            this.$emit('replyRemoved');
        }
    }
}
