<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import ContentArea from "@/Pages/Components/ContentArea.vue";
defineProps({
    current_file: Object,
})
</script>

<template>
    <Head title="Current File" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Current File
            </h2>
        </template>

        <div class="p-12">
            <div class="bg-white">
                <div class="flex flex-col">
                    <div class="flex flex-row justify-between">
                        <a class="p-4 m-4 border-black border-2" :href="route('project.edit')">
                            &lt; BACK
                        </a>
                        <Link :href="route('project.file.update', { file_id: current_file.id, file_content: computedFileContent})"
                              method="post"
                              as="button"
                              class="font-bold flex border-black p-3 cursor-pointer"
                              preserve-scroll>
                            Save: {{ current_file.title }}
                        </Link>
                    </div>
                    <content-area :import-content="current_file.content" @magic="registerUpdate"></content-area>
                </div>            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>

export default {
    data() {
        return {
            file: {
                content_changed: false,
                content: null
            }
        }
    },
    created() {
        this.file.content = this.current_file.content
    },
    methods: {
        registerUpdate(e) {
            this.file.content = e
            let options = []
            // TODO: register when the work is being saved, and display it to user.
            this.saveWheel = true
            this.saveWork()
            console.log('save request sent')
            this.saveWheel = false
        },
        saveWork() {
            axios.put('/project/file/update', {file_id: this.current_file.id, text: this.file.content})
        }
    },
    computed: {
        computedFileContent() {
            return this.file && this.file.content ? this.file.content : null
        }
    }
}
</script>
