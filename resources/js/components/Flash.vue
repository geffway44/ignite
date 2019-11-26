<template>
    <div class="alert alert-dismissible fade show bg-white px-6 py-5 rounded-lg shadow-xl border border-gray-200 max-w-sm fixed bottom-0 left-0 ml-4 mb-4" role="alert" v-show="show">
        <div class="flex items-center">
            <div class="py-1 mr-3">
                <svg class="fill-current h-6 w-6 text-indigo-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
            </div>

            <div class="font-semibold">
                {{ body }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['message', 'type'],

        data() {
            return {
                body: this.message,
                level: this.type ? this.type : 'success',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on(
                'flash', (message, level) => {
                    this.flash(message, level);
                }
            );
        },

        methods: {
            flash(message, level) {
                this.body = message;
                this.level = level;

                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            },

            capitalize(word) {
                return word.charAt(0).toUpperCase() + word.slice(1);
            }
        }
    }
</script>
