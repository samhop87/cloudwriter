export default {
    methods: {
        toastNote: function (message, type) {
            this.$toast.open({
                message: message,
                type: type,
                duration: 3000,
                dismissible: true
            })
        }
    }
}
