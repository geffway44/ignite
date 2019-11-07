<template>
    <div class="py-3 mb-4 flex">
        <div class="flex mr-4">
            <div>
                <div class="flex items-center flex-1 w-10 h-10">
                    <img class="h-full rounded-full mr-3" :src="reply.user.profile.avatar" :alt="reply.user.username">
                </div>
            </div>
        </div>

        <div class="mb-4 flex-1">
            <div v-if="editing">
                <form @submit="update" class="block">
                    <div class="form-group">
                        <textarea name="body" id="body" class="w-full" rows="7" v-model="body" required></textarea>

                        <span v-if="error"  v-text="message" class="text-red-500 text-xs mt-2 block" role="alert"></span>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <button class="text-indigo-500 hover:text-indigo-400 text-white mr-4">Update</button>

                        <button type="button" @click="editing = false" class="text-red-500 hover:text-red-400">Cancel</button>
                    </div>
                </form>
            </div>

            <div v-else v-cloak>
                <div class="flex items-center">
                    <a class="font-semibold mr-4 text-gray-800" :href="'/user/@' + reply.user.name">{{ reply.user.name }}</a>

                    <span class="text-gray-600" v-text="ago"></span>
                </div>

                <div class="mb-4">
                    <span class="markdown-container text-gray-600 leading-relaxed mb-4" v-html="body"></span>
                </div>

                <div class="text-sm text-gray-500">
                    <favorite :reply="reply"></favorite>

                    <a class="mr-5" href="#" @click.prevent="editing = true">Edit</a>

                    <a class="mr-5" href="#" @click.prevent="destroy">Delete</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        components: { Favorite },

        props: ['reply'],

        data() {
            return {
                body: this.reply.body,
                id: this.reply.id,
                message: '',
                error: false,
                editing: false
            }
        },

        computed: {
            ago() {
                return moment(this.reply.created_at).fromNow();
            },

            canUpdate() {
                return this.authorize(user => this.reply.user.id == user.id);
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.id + '/update', {
                        body: this.body
                    })
                    .catch(error => {
                        this.message = error.response.data.message;

                        flash(this.message, 'error');
                    });

                this.editing = false;

                flash(response.data.status, 'success');
            },

            destroy() {
                axios.delete('/replies/' + this.id + '/destroy');

                this.$emit('replyDeleted', this.id);
            }
        }
    }
</script>

