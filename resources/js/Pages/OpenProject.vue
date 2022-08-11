<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import ProjectTree from "@/Pages/Components/ProjectTree.vue";

defineProps({
    project: Object,
})
</script>

<template>
    <Head title="Current Project" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Current Project
            </h2>
        </template>

        <div class="p-12">
            <div class="bg-white">
                {{ project }}
            </div>
        </div>

        <div v-if="project" class="my-4 border-black border-4">
            <project-tree :id="project.id"
                          :title="project.name"
                          :folder="project.project"
                          :depth="0"
                          :type="'project'">
            </project-tree>
        </div>
    </BreezeAuthenticatedLayout>
</template>
