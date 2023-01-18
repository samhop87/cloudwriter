<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
    project_name: null,
})

function submit() {
    router.post(route('project.store'), form)
}
</script>

<template>
    <Head title="Creation Wizard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Creation Wizard
            </h2>
        </template>

        <div class="bg-yellow-200 p-6">
            <h2 class="text-3xl">Let's create a new project!</h2>
            <div class="w-full border border-cleomagenta my-3"></div>
            <div>
                <p>
                    This first step: naming your new project. Don't worry, you can change this later.
                </p>
            </div>
            <div>
                <form @submit.prevent="submit">
                <div class="flex mt-6 rounded-md shadow-sm">
                    <input type="text"
                           name="project_name"
                           id="project_name"
                           v-model="form.project_name"
                           class="flex w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm"
                           placeholder="My great project!"
                    >
                </div>
                <button class="my-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" >
                    Submit
                </button>
                </form>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>
