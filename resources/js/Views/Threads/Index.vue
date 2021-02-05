<template>
    <app-layout>
        <template #title>
            Discussions
        </template>

        <template #content>
            <div class="md:grid md:grid-cols-12 md:gap-6">
                <div class="md:col-span-8">
                    <inertia-link :href="thread.path" v-for="thread in threads" :key="thread.id">
                        <card class="mb-6">
                            <template #content>
                                <div class="flex items-start">
                                    <img class="w-12 h-12 rounded-full" :src="thread.user.profile_photo_url" alt="thread.user.name">

                                    <div class="ml-10">
                                        <h5 class="font-semibold text-gray-800 text">
                                            {{ thread.title }}
                                        </h5>

                                        <div class="mt-2 flex items-center">
                                            <span class="text-sm text-gray-500">{{ thread.user.name }}</span>
                                            <span class="ml-3 text-sm text-gray-500">{{ diffForHumans(thread.updated_at) }}</span>
                                            <span class="ml-3 text-sm text-gray-500">{{ thread.replies_count }} replies</span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </card>
                    </inertia-link>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import Card from '@/Views/Components/Cards/Card';

export default {
    props: ['threads'],

    components: {
        AppLayout,
        Card
    },
};
</script>
