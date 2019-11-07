<template>
    <div>
        <button @click="subscribe" v-if="!active" class="button-secondary outline-none">Follow</button>

        <button @click="unsubscribe" v-else class="button outline-none">Following</button>
    </div>
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
