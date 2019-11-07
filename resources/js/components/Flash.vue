<template>
    <div class="alert alert-dismissible fade show bg-white border-l-4 px-4 py-3 shadow-lg fixed bottom-0 left-0 ml-4 mb-4 border-indigo-500 text-indigo-900" role="alert" v-show="show">
        <div class="flex mr-8">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="absolute top-0 bottom-0 right-0 mt-2 mr-2">
                    <svg class="fill-current h-4 w-4 text-gray-500 hover:text-indigo-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </button>

            <div class="py-1">
                <svg class="fill-current h-6 w-6 text-indigo-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
            </div>

            <div>
                <span class="mb-2 text-sm font-semibold">{{ capitalize(level) + '!' }}</span>

                <p class="text-sm">{{ body }}</p>
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
                this.flash();
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
