<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
defineProps({
    projects: Object,
})
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
            <Link :href="route('baseboard.admin.generate-auth')"
               class="p-6 bg-turquoise flex m-2"
               v-if="!$page.props.auth.user.drive_token">
                Authorise Drive, Redirects to auth page
            </Link>

            <a v-for="project in projects.data"
               :href="route('project.show') + '?project_id=' + project.project_id"
               class="p-6 bg-blue-500 flex m-2"
               v-if="$page.props.auth.user.drive_token">
                Retrieve project: {{ project.project_name }}
            </a>

            <Link
               class="p-6 bg-turquoise flex m-2"
               v-if="$page.props.auth.user.drive_token">
                Create project // will lead to wizard
            </Link>
        </div>
    </BreezeAuthenticatedLayout>
</template>
