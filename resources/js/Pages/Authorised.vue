<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Authorisation page" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Authorisation Status
            </h2>
        </template>

        <div class="p-12">
            <div class="bg-white">
                You have successfully authorised your account. Get writing!
            </div>
            <a class="flex p-4 border-black" :href="route('baseboard.index')">
                Go back to baseboard.
            </a>
        </div>
    </BreezeAuthenticatedLayout>
</template>
