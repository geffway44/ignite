<template>
    <app-layout>
        <template>
            <div class="md:grid md:grid-cols-12 md:gap-6">
                <div class="md:col-span-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-800 font-semibold text-2xl">
                                {{ thread.title }}
                            </h3>

                            <div></div>
                        </div>
                    </div>

                    <div class="mt-10">

                    </div>
                </div>

                <div class="xl:col-end-13 lg:col-span-4 xl:col-span-3">
                    <div>
                        <h3 class="text-gray-800 font-semibold text-xl">
                            Trending
                        </h3>

                        <h6 class="text-gray-500">
                            See whats hot in the community
                        </h6>
                    </div>

                    <div class="mt-6">
                        <div class="mb-4">
                            <h6 class="font-semibold text-gray-800">
                                Grid Column Start / End
                            </h6>

                            <div class="flex items-center">
                                <span class="text-sm text-gray-500">12 replies</span>
                                <span class="ml-4 text-sm text-gray-500">8 Likes</span>
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
import AppLink from '@/Views/Components/Base/Link';

export default {
    props: ['thread'],

    components: {
        AppLayout,
        AppLink,
    },
};
</script>
