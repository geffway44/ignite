<template>
    <app-layout>
        <template>
            <div>
                <div class="md:grid md:grid-cols-12 md:gap-6">
                    <inertia-link :href="route('threads.index', { channel: channel.slug })" v-for="channel in channels" :key="channel.id" class="md:col-span-3 rounded-lg overflow-hidden border border-transparent hover:border-blue-100 flex flex-col transition ease-in-out duration-150">
                        <div class="px-4 py-5 sm:px-6 flex flex-col flex-1 justify-between bg-gray-50">
                            <div>
                                <div>
                                    <h6 class="capitalize font-semibold text-gray-800">{{ channel.name }}</h6>
                                </div>

                                <div class="mt-3">
                                    <p class="text-sm">{{ channel.description }}</p>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center justify-end">
                                <span class="text-xs text-gray-500">{{ channel.threads_count }} discussions</span>
                            </div>
                        </div>
                    </inertia-link>
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
