<template>
    <textarea
        :id="name"
        ref="input"
        :name="name"
        class="textArea"
        :value="value"
        @input="$emit('input', $event.target.value)"
    ></textarea>
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
.textArea {
    appearance: none;
    font-size: 16px;
    line-height: 1.44;
    color: #000;
    font-weight: 400;
    border-radius: 4px;
    border: 1px solid var(--borderColor);
    padding: 12px 12px;
    width: 100%;
    display: block;
    background-color: #fff;
    height: 200px;

    &[disabled] {
        pointer-events: none;
        opacity: 0.5;
    }

    &:focus {
        box-shadow: none;
    }

    @media (--mobile) {
        padding: 10px;
    }
}
</style>
