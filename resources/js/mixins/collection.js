export default {
    data() {
        return {
            items: []
        }
    },

    methods: {
        add(item) {
            this.items.push(item);

            this.count++;
        },

        remove(index) {
            this.items.splice(index, 1);

            this.count--;
        }
    }
}
