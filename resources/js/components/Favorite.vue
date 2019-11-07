<template>
    <a :class="classes" href="#" @click="toggle">
        <span v-text="favoritesCount"></span> Likes
    </a>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited
            }
        },

        computed: {
            classes() {
                return ['mr-5', this.isFavorited ? 'text-indigo-500' : ''];
            }
        },

        methods: {
            toggle() {
                return this.isFavorited ? this.unfavorite() : this.favorite();
            },

            favorite() {
                axios.post('/replies/' + this.reply.id + '/favorite');

                this.isFavorited = true;
                this.favoritesCount++;
            },

            unfavorite() {
                axios.delete('/replies/' + this.reply.id + '/unfavorite');

                this.isFavorited = false;
                this.favoritesCount--;
            }
        }
    }
</script>
