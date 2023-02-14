<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {reactive} from 'vue'
import {router} from '@inertiajs/vue3'
import {Inertia} from "@inertiajs/inertia";

const form = reactive({
    project_name: null,
})

function submit() {
    Inertia.post(route('project.store'), form)
}
</script>

<template>
    <Head title="Creation Wizard"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Creation Wizard - Title
            </h2>
        </template>

        <div class="bg-white p-6 flex flex-col">
            <form @submit.prevent="submit" class="w-full p-6">
                <div class="flex mt-6">
                    <input type="text"
                           name="project_name"
                           id="project_name"
                           v-model="form.project_name"
                           class="flex w-full pl-3 pt-12 pb-2 pr-12 border-none focus:border-gray-100
                           focus:ring-gray-100 text-headline min-h-title font-new placeholder-gray-200"
                           placeholder="Give it a name"
                    >
                </div>
                <div class="w-full border border-black my-3"></div>

                <div class="w-full text-sm">
                    <div>
                        <p>
                            This first step: naming your new project. Don't worry, you can change this later.
                        </p>
                    </div>
                </div>
                <button class="my-6 bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded text-xl" type="submit">
                    Submit
                </button>
            </form>
        </div>

    </BreezeAuthenticatedLayout>
</template>
