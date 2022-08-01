export default {
    methods: {
        invalid: function (errors) {
            let container = []
            for (const error in errors) {
                // populate the invalid array to display messages.
                container.push(error)
            }
            return container
        }
    }
}
