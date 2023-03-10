<script>
export default {
    props: ['shapes', 'modelValue'],
    emits: ['update:modelValue'],
    data() {
        return {
            selectedShape: null,
        }
    },
    methods: {
        shapeImage(image) {
            return '/images/shapes/' + image;
        },
        selectShape(id) {
            if (this.selectedShape === id) {
                this.selectedShape = null;
                this.$emit('shapeSelected', null)
                this.$emit('update:modelValue', null)
                return;
            }
            this.selectedShape = id;
            this.$emit('shapeSelected', id)
            this.$emit('update:modelValue', id)
        }
    }
}
</script>

<template>
    <div>
        <p class="text-cleomagenta">{{ $page.props.errors.shapeChoice }}</p>
        <section class="py-10">
            <div class="mx-auto grid max-w-6xl  grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
                 :class="$page.props.errors.shapeChoice ? 'border-red-200 border-4 rounded-md' : ''">
                <article @click="selectShape(element.id)" v-for="element in shapes" :key="element.id" :class="{'border-4 border-black': selectedShape === element.id}"
                         class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl">
                    <a href="#">
                        <div class="relative flex items-end overflow-hidden rounded-xl">
                            <img :src="shapeImage(element.image)" alt="Hotel Photo"/>
                        </div>

                        <div class="mt-1 p-2">
                            <h2 class="text-slate-700 text-lg">{{ element.name }}</h2>
                            <p class="mt-1 text-md text-slate-400">{{ element.description }}</p>
                        </div>
                    </a>
                </article>
            </div>
        </section>
    </div>
</template>
