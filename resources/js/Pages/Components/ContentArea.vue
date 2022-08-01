<template>
    <div contenteditable
         ref="content_editor"
         class="h-screen p-4 border-cleomagenta border-2"
         v-html="importContent"
         @input="handleInput"
         @keydown="handleKeydown"/>
</template>

<script>
export default {
    props: {
        importContent: {
            type: String,
            required: false
        }
    },
    mounted() {
        // this.$el.innerHTML = this.importContent
    },
    methods: {
        handleInput(e) {
            const {firstChild} = e.target

            if (firstChild && firstChild.nodeType === 3) {
                document.execCommand('formatBlock', false, '<p>')
            } else if (this.$refs.content_editor.innerHTML === '<br>') {
                this.$refs.content_editor.innerHTML = ''
            }

            this.$emit('magic', e.target.innerHTML)
        },
        handleDelayedInput(e) {
            this.$nextTick(() => this.handleInput(e))
        },
        handleKeydown() {
            console.log('handleKeydown')
        }
    },
    // We need to ensure we update the innerHTML when it changes,
    // without resetting the cursor.
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
