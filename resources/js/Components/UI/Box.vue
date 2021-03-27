<template>
    <div
        :class="{ noBoxShadow: !boxShadow, noPadding: !padding }"
        class="box"
    >
        <slot name="top" />

        <div class="boxInner">
            <slot />
        </div>

        <div
            v-if="$slots.bottom"
            class="bottom bg-gray-50 flex justify-between"
        >
            <slot name="bottom" />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        boxShadow: {
            type: Boolean,
            default: true
        },

        padding: {
            type: Boolean,
            default: true
        }
    }
};
</script>

<style lang="postcss" scoped>
.box {
    box-shadow: var(--shadow);
    border-radius: var(--borderRadius);
    background-color: #fff;

    &.noBoxShadow {
        box-shadow: none;
    }
}

.boxInner {
    padding: 3rem 4rem 4rem;
}

.noPadding .boxInner {
    padding: 0;
}

.bottom {
    padding: 1.2rem 4rem;
    border-bottom-left-radius: var(--borderRadius);
    border-bottom-right-radius: var(--borderRadius);
    border-top: 1px solid var(--borderColor);
}
</style>
