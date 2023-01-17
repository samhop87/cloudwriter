<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import ProjectDiagram from "@/Pages/Components/ProjectDiagram.vue";

defineProps({
    project: Object,
})
</script>

<template>
    <Head title="Current Project"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ project.name }}
            </h2>
        </template>
        <div v-if="!project" class="p-6">
            You haven't loaded a project yet.
        </div>
        <div class="p-12">
            <div class="bg-white">
                <div v-if="project">
                    <project-diagram :id="project.id"
                                     :title="project.name"
                                     :folder="project.project"
                                     :project="project"
                                     :type="'project'">
                    </project-diagram>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    computed: {
        computedProject() {
            return this.project.project
        }
    }
}
</script>
