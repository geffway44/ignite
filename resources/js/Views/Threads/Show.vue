<template>
    <app-layout>
        <template #title>
            {{ thread.title }}
        </template>

        <template #content>
            <div></div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import Card from '@/Views/Components/Cards/Card';

export default {
    props: ['thread'],

    components: {
        AppLayout,
        Card
    },
};
</script>
