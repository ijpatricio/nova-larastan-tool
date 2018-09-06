<template>
    <div class="row pt-4">

        <div class="card">
            <div class="card-header" style="background-color: rgba(119, 70, 236, 0.5)">
                <span class="ml-3">  Error on line: {{ message.line }} </span>
                <span class="ml-3"> Ignorable: {{ message.ignorable }} </span>
            </div>
            <div class="card-body">
                <p class="card-text pt-2"> {{ message.message }} </p>
                <div class="row">
                    <div class="col-12">
                        <pretty-code-component v-bind="{code, lineSpan}" ref="prettyCode"></pretty-code-component>
                    </div>
                </div>
            </div>
        </div>




    </div>
</template>

<script>
    import axios from 'axios'
    import PrettyCodeComponent from './PrettyCodeComponent'

    export default {

        components: {
            PrettyCodeComponent,
        },

        props: ['message','error'],

        data() {
            return {
                code: '',
                lineSpan: 1,
            }
        },

        created() {
            this.getFileContents()
        },

        methods: {
            getFileContents() {
                const params = {
                    fileName: this.error.filename,
                    errorLine: this.message.line,
                }

                axios.get('/ijpatricio/nova-larastan-tool/file-contents', { params })
                    .then( response => {
                        this.code       = response.data.data.content
                        this.lineSpan   = response.data.data.line_span

                        this.$refs.prettyCode.$refs.myCm.
                        codemirror.setOption('firstLineNumber', response.data.data.first_line)
                    })
            },
        }

    }
</script>

<style scoped>

</style>
