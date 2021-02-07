<template>
    <app-layout>
        <template>
            <div class="md:grid md:grid-cols-12 md:gap-6">
                <div class="md:col-span-8">

                </div>

                <div class="xl:col-end-13 lg:col-span-4 xl:col-span-3">

                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import AppLink from '@/Views/Components/Base/Link';
import AppButton from '@/Views/Components/Buttons/Button';

export default {
    props: ['channel'],

    components: {
        AppLayout,
        AppLink,
        AppButton
    },
};
</script>
