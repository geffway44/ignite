<template>
    <app-layout>
        <template #title>
            Community
        </template>

        <template #content>
            <div>
                <div class="md:grid md:grid-cols-12 md:gap-6">
                    <div v-for="channel in channels" :key="channel.id" class="md:col-span-3 rounded-lg overflow-hidden shadow flex flex-col">
                        <div class="px-4 py-5 sm:px-6 flex flex-col flex-1 justify-between bg-white">
                            <div>
                                <div>
                                    <h6 class="font-semibold text-gray-800">{{ channel.name }}</h6>
                                </div>

                                <div class="mt-3">
                                    <p class="text-sm truncate">{{ channel.description }}</p>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center justify-end">
                                <span class="text-xs text-gray-500">{{ channel.threads_count }} discussions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';

export default {
    props: ['channels'],

    components: {
        AppLayout
    },
};
</script>
