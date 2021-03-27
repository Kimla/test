<template>
    <div
        class="selectionControl"
        @click="$emit('click')"
    >
        <slot />
    </div>
</template>

<style lang="postcss" scoped>
.selectionControl {
    display: flex;
    align-items: center;
    cursor: pointer;
    outline: 0;

    &.isDisabled {
        cursor: default;
        opacity: 0.6;
    }
}
.label {
    font-size: 16px;
    padding-left: 10px;
    text-align: left;
}

.icon {
    position: relative;
    width: 22px;
    min-width: 22px;
    height: 22px;
    background-color: #fff;
    border: 1px solid var(--borderColor);
    transition: var(--normalTrans);
    &::after {
        content: "";
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
    }
}
</style>
