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
            <a :href="route('baseboard.admin.generate-auth')"
               class="p-6 bg-turquoise flex m-2"
               v-if="!$page.props.auth.user.drive_token">
                Authorise Drive, Redirects to auth page
            </a>

            <a :href="route('project.show')"
               class="p-6 bg-cleomagenta flex m-2"
               v-if="$page.props.auth.user.drive_token">
                Retrieve project
            </a>
        </div>
    </BreezeAuthenticatedLayout>
</template>
