<template>
    <input
        :id="name"
        ref="input"
        :name="name"
        class="inputField"
        :value="value"
        @input="$emit('input', $event.target.value)"
    >
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true
        },

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

<style lang="postcss" scoped>
.inputField {
    appearance: none;
    font-size: 16px;
    line-height: 1.44;
    color: #000;
    font-weight: 400;
    border-radius: 4px;
    border: 1px solid var(--borderColor);
    padding: 1rem 1.2rem;
    width: 100%;
    display: block;
    background-color: #fff;

    &[disabled] {
        pointer-events: none;
        opacity: 0.5;
    }

    &:focus {
        box-shadow: none;
        border-color: var(--primary100);
    }

    @media (--laptop) {
        padding: 10px;
    }
}
</style>
