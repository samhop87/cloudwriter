<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import UserProjects from "@/Pages/Components/UserProjects.vue";
import Accordion from "@/Pages/Components/Accordion.vue";
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

        <div
             v-if="!$page.props.auth.user.drive_token">
            <div class="mx-auto max-w-7xl py-12 px-6 lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8">
                <h2 class="text-3xl tracking-tight text-gray-900 sm:text-4xl">
                    <span class="block">Ready to dive in?</span>
                    <span class="block text-cleomagenta">Authorise the app with Google Drive</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-md shadow">
                        <a :href="route('baseboard.admin.generate-auth')"
                           v-if="!$page.props.auth.user.drive_token"
                           class="inline-flex items-center justify-center rounded-md border border-transparent
                           bg-cleomagenta px-5 py-3 text-base font-medium text-white hover:bg-red-700">
                            Authorise App
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div
             v-if="$page.props.auth.user.drive_token">
            <div class="mx-auto max-w-7xl py-12 px-6 lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8">
                <h2 class="text-3xl tracking-tight text-gray-900 sm:text-4xl">
                    <span class="flex">Creation Wizard</span>
                    <span class="flex text-cleomagenta text-xl mt-4">
                        Create new projects using Cloudwriter's AI-driven creation wizard.
                    </span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-md shadow">
                        <a :href="route('project.create')"
                           v-if="$page.props.auth.user.drive_token"
                           class="inline-flex items-center justify-center rounded-md border border-transparent
                           bg-cleomagenta px-5 py-3 text-base font-medium text-white hover:bg-red-700">
                            Get started
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div
             v-if="$page.props.auth.user.drive_token">
            <accordion class="mx-auto max-w-7xl">
                <template v-slot:title>
                    <div class="mx-auto max-w-7xl py-8 px-6 lg:flex lg:items-center lg:justify-between lg:py-12 lg:px-8">
                        <h2 class="text-3xl tracking-tight text-gray-900 sm:text-4xl">
                            <span class="flex">My Projects</span>
                        </h2>
                    </div>
                </template>
                <template v-slot:content>
                    <div class="px-6 lg:px-8 mx-auto max-w-7xl">
                        <div v-if="$page.props.auth.user.drive_token">
                            <UserProjects v-for="project in projects.data" :project="project" class="py-3"></UserProjects>
                        </div>
                        <div v-else>
                            <p>You haven't begun a project yet.</p>
                        </div>
                    </div>
                </template>
            </accordion>
        </div>
    </BreezeAuthenticatedLayout>
</template>
