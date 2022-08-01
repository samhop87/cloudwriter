export default {
    methods: {
        frontScroll: function (el) {
            if (el) {
                this.$nextTick(() => {
                    el.scrollIntoView({behavior: 'smooth'});
                })
            }
        }
    }
}
