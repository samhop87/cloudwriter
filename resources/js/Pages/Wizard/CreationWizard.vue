<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {reactive} from 'vue'
import {router} from "@inertiajs/vue3";
import {Inertia} from "@inertiajs/inertia";
import Themes from "@/Pages/Wizard/Components/Themes.vue";

const form = reactive({
    project_name: null,
    themeChoice: [],
    shapeChoice: null,
    pov: null,
})

defineProps({
    errors: Object,
    shapes: Object,
    genres: Object,
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
            {{ $page.props.errors }}
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

                <div class="mt-16" ref="shape">
                    <h2 class="text-3xl">Choose a story shape</h2>
                    <div class="w-full border border-black my-3"></div>
                    <div class="mt-12">
                        The vast majority of stories can be categorised as being a certain kind of story.
                        <a>link to disclaimer</a>
                        What best fits your idea? Hover over a story shape for more details
                    </div>
                    <themes :shapes="shapes" @shape-selected="shapeChosen"></themes>
                </div>
                <div class="mt-8" ref="theme">
                    <h2 class="text-3xl">Choose a theme</h2>
                    <div class="w-full border border-black my-3"></div>
                    <div class="my-6">
                        What theme(s) best fits your story?
                    </div>
                    <div>
                        <VueMultiselect
                            v-model="form.themeChoice"
                            :options="options"
                            :multiple="true"
                            :close-on-select="false"
                            :clear-on-select="false"
                            :preserve-search="true"
                            placeholder="Pick some"
                            group-values="subgenres"
                            group-label="name"
                            :group-select="false"
                            label="name"
                            track-by="name"
                            :preselect-first="true"
                        >
                            <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                        </VueMultiselect>
                    </div>
                </div>
                <div class="mt-8" ref="pov">
                    <h2 class="text-3xl">Choose a POV</h2>
                    <div class="w-full border border-black my-3"></div>
                    <div class="my-6">
                        What point of view is your story being told from?
                    </div>
                    <div>
                        <VueMultiselect
                            v-model="form.pov"
                            :options="povOptions"
                            :multiple="false"
                            :close-on-select="true"
                            :clear-on-select="false"
                            :preserve-search="true"
                            placeholder="Pick a POV"
                            label="name"
                            track-by="name"
                            :preselect-first="true"
                        >
                            <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                        </VueMultiselect>
                    </div>
                </div>

                <button class="my-6 bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded text-xl" type="submit">
                    Submit
                </button>
            </form>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import frontScroll from "@/Mixins/frontScroll";
import VueMultiselect from 'vue-multiselect'
import {router} from "@inertiajs/vue3";

export default {
    mixins: [frontScroll],
    components: {
        VueMultiselect
    },
    props: {
        genres: Object,
    },
    data() {
        return {
            shapeReady: false,
            value: [],
            povOptions: [
                {name: 'First Person'},
                {name: 'Second Person'},
                {name: 'Third Person'},
            ],
            options: this.genres.data,
        }
    },
    mounted() {
        this.shapeReady = true;
        // this.shapeChoice = router.restore('shapeChoice')
        // this.themeChoice = router.restore('themeChoice')
    },
    computed: {
        genresList() {
            console.log(this.genres.data)
            return this.genres && this.genres.data ? this.genres.data : 'nothing'
        }
    },
    methods: {
        shapeChosen(id) {
            this.shapeChoice = id;
            // router.remember(data, 'shapeChoice')
            this.proceedToNextEmptyStage();
        },
        themeChosen(id) {
            this.themeChoice = id;
            // router.remember(data, 'themeChoice')
            this.proceedToNextEmptyStage();
        },
        proceedToNextEmptyStage() {
            if (this.shapeChoice) {
                this.frontScroll(this.$refs.theme);
            }
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
