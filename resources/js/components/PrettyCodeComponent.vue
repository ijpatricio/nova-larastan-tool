<template>
    <codemirror v-model="code"
                :options="cmOptions"
                ref="myCm"
                :first-line-number="450"
    >
    </codemirror>
</template>

<script>
    import { codemirror } from 'vue-codemirror'
    import 'codemirror/lib/codemirror.css'
    import 'codemirror/mode/php/php.js'
    import 'codemirror/theme/material.css'

    export default {

        components: {
            codemirror,
        },

        props: {
            code: {},
            firstLine: {},
            lineSpan: {},
            initialWidth: { default: 800 },
            initialHeight: { default: 210 },
        },

        data () {
            return {
                cmOptions: {
                    tabSize: 4,
                    mode: 'text/x-php',
                    theme: 'material',
                    lineNumbers: true,
                    line: true,
                    firstLineNumber: 1,
                    readOnly: true,
                }
            }
        },

        methods: {
        },

        computed: {
            codemirror() {
                return this.$refs.myCm.codemirror
            }
        },

        mounted() {
            this.$refs.myCm.codemirror.setSize(this.initialWidth, this.initialHeight)
            setTimeout(() => {
                this.$refs.myCm.codemirror.doc.addLineClass(this.lineSpan,'background','error-line-highlight')
            }, 500)
        }

    }
</script>

<style>
    .error-line-highlight {
        outline: 1px red solid !important;
        background: #714422;
    }
    .CodeMirror-line {
        text-align: left !important;
    }
</style>
