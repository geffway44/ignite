<template>
    <span>
        <button @click="subscribe" v-if="!active" class="text-gray-500 hover:text-gray-600 mr-6 outline-none">Follow</button>

        <button @click="unsubscribe" v-else class="text-indigo-500 hover:text-indigo-400 mr-6 outline-none">Following</button>
    </span>
</template>

<script>
    export default {
        props: ['subscribed'],

        data() {
            return {
                active: this.subscribed
            }
        },

        methods: {
            subscribe() {
                axios.post(location.pathname + '/subscribe');

                this.active = true;

                flash('You will be notified every time this conversation is updated.');
            },

            unsubscribe() {
                axios.delete(location.pathname + '/unsubscribe');

                this.active = false;

                flash('You are no longer following this conversation.');
            }
        }
    }
</script>
