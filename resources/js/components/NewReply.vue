<template>
    <form class="mb-16" @submit.prevent="addReply">
        <div class="mb-5">
            <textarea class="transition bg-white outline-none border border-gray-300 placeholder-gray-700 rounded-lg py-3 px-4 block w-full appearance-none leading-normal bg-gray-100 ds-input rounded-lg" :class="{ 'bg-red-200': error }" id="body" name="body" rows="5" v-model="body" placeholder="Type here to reply to conversation..."></textarea>

            <span v-if="error"  v-text="message" class="text-red-500 text-xs mt-2 block px-3" role="alert"></span>
        </div>

        <div class="mb-0 flex items-center">
            <button class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm" :class="postable ? 'cursor-pointer' : 'opacity-50 cursor-not-allowed'" type="submit">Post Reply</button>
        </div>
    </form>
</template>

<script>
    import 'jquery.caret';
    import 'at.js';

    export default {
        data() {
            return {
                body: '',
                message: '',
                error: false
            }
        },

        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function(query, callback) {
                        $.getJSON('/api/users', {username: query}, function(username) {
                            callback(username);
                        });
                    }
                }
            });
        },

        computed: {
            postable() {
                if (this.body) {
                    return true;
                }

                return false;
            }
        },

        methods: {
            addReply() {
                if (this.postable == true) {
                    axios.post(location.pathname, {
                        body: this.body,
                        user_id: window.App.user.id
                    }).catch(error => {
                        this.error = true;

                        this.message = error.response.data.message;

                        flash('Your reply could not be saved at this time.');
                    }).then(response => {
                        if (this.error === false) {
                            this.body = '';

                            $('#replyModal').modal('hide');

                            this.$emit('created', response.data);

                            flash('Your reply has been posted.');
                        }
                    });
                }
            }
        }
    }
</script>
