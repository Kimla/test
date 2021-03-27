<template>
    <div
        v-click-outside="() => (open = false)"
        :class="{ isOpen: open, isDisabled: disabled }"
        class="appSelect"
        @click="toggle()"
    >
        <div class="selected flex items-center inputField">
            <span
                class="label"
                v-html="activeItem.label"
            ></span>
            <img
                svg-inline
                src="../../../images/chevron.svg"
                class="icon"
            >
        </div>
        <ul class="dropdown">
            <li
                v-for="item in items"
                :key="item.value"
                :class="{ isSelected: item.value === activeItem.value }"
                class="item"
                @click="changeActive(item)"
                v-html="item.label"
            ></li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        items: {
            type: Array,
            required: true
        },
        value: {
            type: [Number, String, Boolean],
            default: null
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    data: () => ({
        open: false
    }),
    computed: {
        activeItem () {
            return (
                this.items.find(item => item.value === this.value) ||
                this.items[0]
            );
        }
    },
    created () {
        if (process.client) {
            document.addEventListener('keydown', this.keyListener);
        }
    },
    beforeDestroy () {
        document.removeEventListener('keydown', this.keyListener);
    },
    methods: {
        keyListener (event) {
            if (!this.open) return;

            if (event.keyCode === 27) {
                this.open = false;
            }
        },
        changeActive (item) {
            this.$emit('input', item.value);
        },
        toggle () {
            if (this.disabled) return;

            this.open = !this.open;
        }
    }
};
</script>

<style lang="postcss" scoped>
.appSelect {
    --arrowSize: 24px;
}

.appSelect {
    cursor: pointer;
    position: relative;
    font-size: 16px;
    line-height: normal;
    color: #000;

    @media (--laptop) {
        font-size: 15px;
    }

    &.isOpen .selected {
        border-color: var(--primary);
    }

    &.isOpen .selected .icon {
        transform: rotate(180deg);
    }

    &.isOpen .dropdown {
        transform: scaleY(1);
        opacity: 1;
        z-index: 2;
    }

    &.isDisabled {
        pointer-events: none;
        opacity: 0.5;
    }
}

.selected {
    display: flex;
    border-radius: 4px;
    border: 1px solid var(--borderColor);
    padding: 14px 12px;
    padding-right: calc(24px + var(--arrowSize));

    @media (--laptop) {
        height: 51px;
    }
}

.icon {
    position: absolute;
    color: var(--primary);
    right: 12px;
    top: 50%;
    width: var(--arrowSize);
    height: var(--arrowSize);
    margin-top: calc(var(--arrowSize) / -2);
    transition: var(--normalTrans);
}

.dropdown {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    width: 100%;
    list-style: none;
    transform: scaleY(0);
    transition: var(--normalTrans);
    transform-origin: top;
    overflow: auto;
    max-height: 320px;
    background-color: #ffffff;
    box-shadow: var(--shadow);
    opacity: 0;

    &::-webkit-scrollbar {
        width: 8px;
    }

    &::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px #dddddd;
        border-radius: 0;
    }

    &::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.25);
        border-radius: 100px;
    }
}

.item {
    display: flex;
    align-items: center;
    border-bottom: 1px solid var(--borderColor);
    transition: var(--normalTrans);
    padding: 12px;

    &:hover {
        background-color: var(--grey100);
    }

    &.isSelected {
        background-color: var(--primary100);
        color: var(--primary);
    }

    &:last-child {
        border: 0;
    }
}
</style>
