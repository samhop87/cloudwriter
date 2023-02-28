<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';

defineProps({
})
</script>

<template>
    <Head title="StageOne"/>

    <BreezeAuthenticatedLayout>
        <div>
            yo, your project is created
        </div>
    </BreezeAuthenticatedLayout>
</template>
