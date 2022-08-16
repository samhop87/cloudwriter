<template>
    <div contenteditable
         ref="content_editor"
         class="h-screen p-4 border-cleomagenta border-2"
         v-html="importContent"
         @input="handleInput"
    />
</template>

<script>
import _ from "lodash";

export default {
    props: {
        importContent: {
            type: String,
            required: false
        }
    },
    methods: {
        handleInput: _.debounce(function (e) {
            const {firstChild} = e.target

            if (firstChild && firstChild.nodeType === 3) {
                document.execCommand('formatBlock', false, '<p>')
            } else if (this.$refs.content_editor.innerHTML === '<br>') {
                this.$refs.content_editor.innerHTML = ''
            }

            this.$emit('magic', e.target.innerHTML)
        }, 1000)
    },
    watch: {
        value(newValue) {
            if (this.$refs.content_editor.innerHTML !== newValue) {
                this.$refs.content_editor.innerHTML = newValue
                this.file.content_changed = true
            }
        },
    },
}
</script>
