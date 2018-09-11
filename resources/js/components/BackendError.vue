<template>
    <div>
        <div class="px-4 py-3 ">
            <span> <v-icon name="bullhorn" scale="3" class="alert"></v-icon></span>
        </div>

        <div class="px-4 py-3 ">
            <strong class="font-bold">Holy smokes!</strong>
            <span>Something seriously bad happened.</span>
        </div>

        <div class="px-4 py-1 ">
            <strong class="font-bold">Exception:</strong>
            <span>{{ catchResponse.exception }}</span>
        </div>

        <div class="px-4 py-1 ">
            <strong class="font-bold">File:</strong>
            <span>{{ catchResponse.file }}</span>
        </div>

        <div class="px-4 py-1 ">
            <strong class="font-bold">Line:</strong>
            <span>{{ catchResponse.line }}</span>
        </div>

        <div class="px-4 py-1 ">
            <strong class="font-bold">Message:</strong>
            <span>{{ catchResponse.message }}</span>
        </div>
    </div>
</template>

<script>
    import 'vue-awesome/icons/bullhorn'
    import Icon from 'vue-awesome/components/Icon'

    export default {
        components: {
            'v-icon': Icon,
        },

        props: ['catchResponse'],
    }
</script>
