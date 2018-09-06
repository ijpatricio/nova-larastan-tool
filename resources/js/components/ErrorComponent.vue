<template>
    <div>
        <div class="row pt-4">
            <div class="col-12">
                <message-component
                        v-for="(message, index) in error.messages"
                        :key="index"
                        :message="message"
                        :error="error"
                ></message-component>
            </div>
        </div>

    </div>
</template>

<script>
    import MessageComponent from './MessageComponent'

    export default {

        components: {
            MessageComponent,
        },

        props: ['error'],

    }
</script>

<style scoped>

</style>
