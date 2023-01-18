<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="StageOne" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Creation Wizard - Stage One
            </h2>
        </template>

        <div class="bg-yellow-200 p-6">
            <h2 class="text-3xl">Stage One</h2>
            <div class="w-full border border-cleomagenta my-3"></div>
        </div>

    </BreezeAuthenticatedLayout>
</template>
