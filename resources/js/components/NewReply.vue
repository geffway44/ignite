<template>
    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <svg class="fill-current h-4 w-4 text-gray-500 hover:text-indigo-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </button>
                </div>

                <div class="modal-body pt-0">
                    <div class="form-group mb-5">
                        <textarea class="transition bg-white outline-none border-none placeholder-gray-700 rounded-lg py-2 px-3 pl-10 block w-full appearance-none leading-normal ds-input" :class="{ 'bg-red-200': error }" id="body" name="body" rows="7" v-model="body" placeholder="Reply to conversation" required></textarea>

                        <span v-if="error"  v-text="message" class="text-red-500 text-xs mt-2 block px-3" role="alert"></span>
                    </div>

                    <div class="form-group mb-0 flex items-center justify-between">
                        <button class="button" @click="addReply">Post reply</button>

                        <button type="button" class="btn btn-link text-red-500 hover:text-red-400" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        methods: {
            addReply() {
                axios.post(location.pathname, {
                    body: this.body,
                    user_id: window.App.user.id
                }).catch(error => {
                    this.error = true;

                    this.message = error.response.data.message;

                    flash('Your reply could not be saved at this time.', 'error');
                }).then(response => {
                    if (this.error === false) {
                        this.body = '';

                        $('#replyModal').modal('hide');

                        this.$emit('replyCreated', response.data);

                        flash(response.data.status);
                    }
                });
            }
        }
    }
</script>
