<template>
    <div class="flex">
        <button
            type="button"
            :class="{ 'isActive': value > 0 }"
            class="starButton"
            @click="$emit('input', 1)"
        >
            <img
                src="../../../images/star.svg"
                class="star"
                svg-inline
            >
        </button>

        <button
            type="button"
            :class="{ 'isActive': value > 1 }"
            class="starButton"
            @click="$emit('input', 2)"
        >
            <img
                src="../../../images/star.svg"
                class="star"
                svg-inline
            >
        </button>

        <button
            type="button"
            :class="{ 'isActive': value > 2 }"
            class="starButton"
            @click="$emit('input', 3)"
        >
            <img
                src="../../../images/star.svg"
                class="star"
                svg-inline
            >
        </button>

        <button
            type="button"
            :class="{ 'isActive': value > 3 }"
            class="starButton"
            @click="$emit('input', 4)"
        >
            <img
                src="../../../images/star.svg"
                class="star"
                svg-inline
            >
        </button>

        <button
            type="button"
            :class="{ 'isActive': value > 4 }"
            class="starButton"
            @click="$emit('input', 5)"
        >
            <img
                src="../../../images/star.svg"
                class="star"
                svg-inline
            >
        </button>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: Number,
            default: null
        }
    }
};
</script>

<style lang="postcss" scoped>
.star {
    transition: var(--normalTrans);
    stroke: #bdbdbd;
}

.starButton.isActive .star {
    fill: var(--primaryColor);
    stroke: var(--primaryColor);
}
</style>
