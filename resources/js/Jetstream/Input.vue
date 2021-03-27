<template>
    <input
        ref="input"
        class="border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-100 focus:ring-opacity-50 rounded-md shadow-sm"
        :value="value"
        @input="$emit('input', $event.target.value)"
    >
</template>

<script>
export default {
    props: {
        value: {
            type: [String, Number],
            default: null
        }
    },

    methods: {
        focus () {
            this.$refs.input.focus();
        }
    }
};
</script>
