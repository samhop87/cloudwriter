<template>
    <div class="flex flex-row">
        <div :class="type === 'doc' ? 'p-1 border-cleomagenta border-2' : 'w-full border-green-300 border-4'">
            <div @click="toggleChildrenOrOpen(type, id)"
                 class="cursor-pointer flex flex-row"
            >
                <div class="p-4 mx-1">{{ title ? title : name }} - {{ type }}</div>
            </div>
            <Link v-if="type !== 'project'"
                  class="text-xl flex cursor-pointer bg-red-500"
                  :href="type === 'doc' ? route('project.file.delete', { file_id: id }) : route('project.folder.delete', { folder_id: id })"
                  method="delete"
                  preserve-scroll
                  preserve-state
                  as="button">
                X
            </Link>
        </div>
        <div v-if="type !== 'project'" class="flex-row flex justify-center self-center text-center">
            <div class="bg-black p-1 w-16"></div>
            <div class="h-0 w-0 border-y-8 border-y-transparent border-l-[14px] border-l-blue-600"></div>
        </div>
        <div class="flex flex-row flex-wrap">
            <div v-if="type === 'folder' && showChildren || type === 'project' && showChildren"
                 class="p-4 rounded-sm border-turquoise flex flex-row border-b w-full">
                <input v-model="new_title" class="bg-blue-400" placeholder="Create new file inside this folder:">
                <div @click="createFile(id)" class="p-2 bg-red-600 text-xl cursor-pointer">+</div>
                <input v-model="new_folder" class="bg-yellow-500 ml-1" placeholder="Create new folder inside this folder:">
                <Link method="post"
                      as="button"
                      :href="route('project.folder.create', { parent_folder_id: id, title: this.new_folder })"
                      class="p-2 bg-turquoise text-xl cursor-pointer">
                    +
                </Link>
            </div>

            <project-tree
                v-if="showChildren"
                v-for="item in folder"
                :folder="item.content"
                :title="item.title"
                :id="item.id"
                :type="item.internal_type"
                :depth="depth + 1"
            >
            </project-tree>
        </div>
    </div>
</template>
<script>
import {Inertia} from "@inertiajs/inertia";
import {Link} from "@inertiajs/inertia-vue3"

export default {
    components: {
        Link
    },
    props: {
        id: {
            required: false
        },
        type: {
            required: false
        },
        folder: {
            required: true
        },
        title: {
            required: false
        },
        depth: {
            required: false
        }
    },
    name: 'project-tree',
    data() {
        return {
            showChildren: false,
            new_title: null,
            new_folder: null,
        }
    },
    methods: {
        toggleChildrenOrOpen(type, id) {
            if (type !== 'doc') {
                this.showChildren = !this.showChildren;
            } else {
                Inertia.get('/project/file/' + id + '/show')
            }
        },
        toggleContent() {
            this.showContent = !this.showContent
        },
        createFile(folder_id) {
            Inertia.post('/project/file/create', {folder_id: folder_id, title: this.new_title})
        },
        createFolder(folder_id) {
            Inertia.post('/project/folder/create', {folder_id: folder_id, folder_name: this.new_folder})
        }
    },
}
</script>
