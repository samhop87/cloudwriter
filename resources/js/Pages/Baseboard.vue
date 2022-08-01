<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Baseboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Baseboard
            </h2>
        </template>

        <div class="p-12">
            <div class="bg-white">
                This is the user baseboard, welcoming them to the app.
                - It contains the auth journey. Pretty useless without it.
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
