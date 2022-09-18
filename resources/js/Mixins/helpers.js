export default {
    methods: {
        cloneObject: function (object) {
            return JSON.parse(JSON.stringify(object))
        }
    }
}
