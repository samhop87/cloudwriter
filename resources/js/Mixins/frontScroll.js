export default {
    methods: {
        frontScroll: function (el) {
            if (el) {
                setTimeout(() => {
                    el.scrollIntoView({ behavior: 'smooth' });
                }, 0);
            }
        }
    }
}
