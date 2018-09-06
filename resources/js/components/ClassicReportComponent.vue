<template>
    <div class="pt-8">
        <card class="pt-8" v-for="(error, index) in report.files" :key="index">
            <div class="card">
                <div class="card-header bg-primary h-8">
                    <span class="p-6 text-lg text-30">
                        {{ error.filename }} ## {{ error.errors }} error(s).
                    </span>
                </div>
                <div class="card-body p-5">
                    <error-component :error="error"></error-component>
                </div>

            </div>
        </card>
    </div>
</template>

<script>
    import ErrorComponent from './ErrorComponent'

    export default {

        components: {
            ErrorComponent
        },

        props: [ 'report' ],

    }
</script>

<style scoped>

</style>
