<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import Themes from "@/Pages/Wizard/Components/Themes.vue";

defineProps({
    shapes: Object,
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
            <div class="mt-12">
                What theme best fits your story?
            </div>
            <div>
                <VueMultiselect
                    v-model="value"
                    :options="options"
                    :multiple="true"
                    :close-on-select="false"
                    :clear-on-select="false"
                    :preserve-search="true"
                    placeholder="Pick some"
                    label="value"
                    track-by="value"
                    :preselect-first="true"
                >
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
    data() {
        return {
            themeChoice: null,
            shapeChoice: null,
            shapeReady: false,
            value: [],
            options: [
                { value: 'batman', label: 'Batman' },
                { value: 'robin', label: 'Robin' },
                { value: 'joker', label: 'Joker' },
            ],
        }
    },
    mounted() {
        this.shapeReady = true;
    },
    methods: {
        shapeChosen(id) {
            this.shapeChoice = id;
            this.proceedToNextEmptyStage();
        },
        themeChosen(id) {
            this.themeChoice = id;
            this.proceedToNextEmptyStage();
        },
        proceedToNextEmptyStage() {
            this.frontScroll(this.$refs.theme);
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
