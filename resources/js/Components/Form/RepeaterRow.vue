<template>
    <div class="repeaterRow">
        <div class="buttons flex absolute">
            <button
                type="button"
                class="button moveButton"
            >
                <img
                    svg-inline
                    src="../../../images/drag.svg"
                    alt=""
                    class="icon"
                >
            </button>

            <button
                type="button"
                class="button deleteButton"
                @click="$emit('removeRow')"
            >
                <img
                    svg-inline
                    src="../../../images/trash.svg"
                    alt=""
                    class="icon"
                >
            </button>
        </div>
        <slot />
    </div>
</template>

<style lang="postcss" scoped>
.repeaterRow {
    position: relative;
    background-color: #fff;
    margin-bottom: 25px;
    @media (--laptop) {
        margin-bottom: 15px;
    }
    @media (--mobile) {
        margin-bottom: 8px;
    }
    &.ghost {
        opacity: 0.5;
    }
}

.repeaterRow >>> .label:not(.smallTitle) {
    font-size: 15px;
    @media (--laptop) {
        font-size: 14px;
    }
}

.buttons {
    right: 25px;
    top: 11px;

    @media (--laptop) {
        right: 20px;
    }

    @media (--mobile) {
        right: 10px;
        top: 5px;
    }
}

.button {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 30px;
    height: 30px;
    border: 1px solid var(--borderColor);
    background-color: #fff;
    border-radius: var(--borderRadius);
    margin-right: 12px;
    &:last-child {
        margin-right: 0;
    }

    @media (--mobile) {
        width: 24px;
        height: 24px;
        margin-right: 8px;
    }
}

.deleteButton:hover {
    background-color: var(--primaryColor);
    border-color: var(--primaryColor);
    color: #fff;
}

.moveButton {
    cursor: move;
}

.icon {
    width: 14px;
    height: 14px;

    @media (--mobile) {
        width: 12px;
        height: 12px;
    }
}

.repeaterRow:hover .deleteButton {
    opacity: 1;
}
</style>
