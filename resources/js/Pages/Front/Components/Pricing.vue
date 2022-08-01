<template>
    <div ref="top">
        pricing
    </div>
</template>

<script>
import Layout from '@/Pages/Front/Home.vue'
import frontScroll from "@/Mixins/frontScroll";

export default {
    mixins: [frontScroll],
    layout: Layout,
    props: {
        user: Object,
    },
    mounted() {
        this.frontScroll(this.$refs.top)
    }
}
</script>
