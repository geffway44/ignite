<template>
    <div class="shadow overflow-hidden rounded-xl flex flex-col justify-between">
        <div class="px-4 py-5 bg-white sm:px-6 flex flex-col flex-1 justify-between">
            <slot name="content"></slot>
        </div>

        <div v-show="hasActions" class="flex items-center justify-end px-4 py-5 bg-gray-100 text-right sm:px-6">
            <slot name="actions"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            hasActions: {
                default: false
            }
        }
    }
</script>

