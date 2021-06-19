<template>
    <inertia-link @click="$emit('clicked')" :href="href" class="text-blue-500 underline hover:text-blue-600 hover:underline focus:text-blue-600 focus:underline active:text-blue-700 active:underline transition ease-in-out duration-150"><slot></slot></inertia-link>
</template>

<script>
export default {
    emits: ['clicked'],

    props: {
        href: {
            required: true,
            type: String
        }
    }
}
</script>
