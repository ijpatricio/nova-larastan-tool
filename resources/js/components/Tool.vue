<template>
    <div>
        <heading class="mb-6">Nova Larastan Tool</heading>

        <div class="mb-4" v-if="larastanFound === false">
            <div class="bg-danger text-white font-bold rounded-t px-4 py-2">
                Whooops!
            </div>
            <div class="border border-t-0 border-red-light rounded-b bg-red-lightest px-4 py-3 text-red-dark">
                <p>
                    Couldn't find Larastan installed. Proceed to
                    <a href="https://github.com/nunomaduro/larastan" target="_blank">
                    Larastan Github repository
                    </a>
                    for further installation details.
                </p>
            </div>
        </div>

        <button v-else @click="codeAnalyse" class="mb-3 btn btn-default btn-primary">
            <v-icon name="spinner" pulse v-show="loading"></v-icon>
            {{ buttonMessage }}
        </button>

        <div v-if="reportRanTimes > 0">
            <classic-report-component :report="report"></classic-report-component>
        </div>

        <div v-if="catchResponse !== null">
            <backend-error :catch-response="catchResponse"></backend-error>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
import ClassicReportComponent from './ClassicReportComponent'
import 'vue-awesome/icons/spinner'
import Icon from 'vue-awesome/components/Icon'
import BackendError from "./BackendError"

export default {

    components: {
        BackendError,
        ClassicReportComponent,
        'v-icon': Icon,
    },

    data: () => ({
        loading: false,
        larastanFound: false,
        reportRanTimes: 0,
        report: {
            errors: [],
            files: [],
            totals: {}
        },
        catchResponse: null,
    }),

    computed: {
        buttonMessage() {
            if (this.reportRanTimes > 0 ) {
                return 'Analyse again'
            }
            return 'Analyse code'
        },
    },

    mounted() {
        this.larastanCheck()
    },

    methods: {
        larastanCheck() {
            axios.get('/ijpatricio/nova-larastan-tool/larastan-check')
                .then(response => {
                    if (response.data.success) {
                        this.larastanFound = true
                        this.$toasted.show('Larastan installation found.', { type: 'success' })
                    } else {
                        this.$toasted.show('Couldn\'t find Larastan installed.', { type: 'error' })
                    }
                })
        },
        codeAnalyse() {
            this.loading = true
            axios.get('/ijpatricio/nova-larastan-tool/analysis-report')
                .then(response => {
                    Object.assign(this.report, response.data.data)
                    this.$forceUpdate()
                    this.$toasted.show('The results are in!', { type: 'success' })
                    this.reportRanTimes++
                    this.loading = false
                    this.catchResponse = null
                })
                .catch(error => {
                    this.catchResponse = error.response.data
                    this.loading = false
                    this.$toasted.show('Backend error.', { type: 'error' })
                })
        },
    },
}
</script>

<style>
    /* Scoped Styles */
</style>
