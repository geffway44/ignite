<template>
    <nav aria-label="Page navigation" v-if="shouldPaginate">
        <ul class="pagination justify-content-center text-sm">
            <li v-show="prevUrl" class="page-item leading-none">
                <a class="page-link" href="#" tabindex="-1" rel="prev" @click.prevent="page--">
                    <span class="mr-1">&#8249;</span> Previous
                </a>
            </li>

            <li v-show="nextUrl" class="page-item leading-none">
                <a class="page-link" href="#" rel="next" @click.prevent="page++">
                    Next <span class="ml-1">&#8250;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['dataSet'],

        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },

            page() {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },

        methods: {
            broadcast() {
                return this.$emit('changed', this.page);
            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>
