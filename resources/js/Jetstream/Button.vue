<template>
    <button
        :type="type"
        class="jetButton inline-flex items-center px-6 py-4 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
    >
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: 'submit'
        }
    }
};
</script>

<style lang="postcss" scoped>
.jetButton {
    background-color: var(--primaryColor);
}
</style>
