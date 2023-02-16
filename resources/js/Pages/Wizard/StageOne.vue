<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import Themes from "@/Pages/Wizard/Components/Themes.vue";
import { router } from '@inertiajs/vue3'

defineProps({
    shapes: Object,
    genres: Object,
})
</script>

<template>
    <Head title="StageOne"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Creation Wizard - Stage One
            </h2>
        </template>

<!--        test {{ genresList }}-->
        <div class="p-6 mt-8" ref="shape">
            <h2 class="text-3xl">Choose a story shape</h2>
            <div class="w-full border border-black my-3"></div>
            <div class="mt-12">
                The vast majority of stories can be categorised as being a certain kind of story.
                <a>link to disclaimer</a>
                What best fits your idea? Hover over a story shape for more details
            </div>
            <themes :shapes="shapes" @shape-selected="shapeChosen"></themes>
        </div>
        <div class="p-6 mt-8" ref="theme">
            <h2 class="text-3xl">Choose a theme</h2>
            <div class="w-full border border-black my-3"></div>
            <div class="my-6">
                What theme(s) best fits your story?
            </div>
            <div>
                <VueMultiselect
                    v-model="themeChoice"
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
        <div class="p-6 mt-8" ref="pov">
            <h2 class="text-3xl">Choose a POV</h2>
            <div class="w-full border border-black my-3"></div>
            <div class="my-6">
                What point of view is your story being told from?
            </div>
            <div>
                <VueMultiselect
                    v-model="pov"
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
    </BreezeAuthenticatedLayout>
</template>

<script>
import frontScroll from "@/Mixins/frontScroll";
import VueMultiselect from 'vue-multiselect'

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
            themeChoice: [],
            shapeChoice: null,
            shapeReady: false,
            value: [],
            pov: null,
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
        this.shapeChoice = router.restore('shapeChoice')
        this.themeChoice = router.restore('themeChoice')
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
            router.remember(data, 'shapeChoice')
            this.proceedToNextEmptyStage();
        },
        themeChosen(id) {
            this.themeChoice = id;
            router.remember(data, 'themeChoice')
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
