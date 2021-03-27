<template>
    <component
        :is="typeOfElement()"
        :class="{
            isLoading: loading,
            isDisabled: disabled,
            noMinWidth: !minWidth,
            isSmall: small
        }"
        v-bind="setUrlAttr()"
        class="appButton"
        @click="$emit('click')"
    >
        <div class="flex items-center h-full">
            <div class="inner w-full">
                <slot name="icon"></slot>
                <div class="label font-semibold tracking-wider">
                    {{ label }}
                </div>
            </div>
        </div>

        <div class="loading">
            <img
                svg-inline
                class="loadingIcon"
                src="../../../images/spinner.svg"
                alt=""
            >
        </div>
    </component>
</template>

<script>
export default {
    props: {
        label: {
            type: String,
            required: true
        },
        loading: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        href: {
            type: String,
            default: null
        },
        url: {
            type: String,
            default: null
        },
        target: {
            type: String,
            default: null
        },
        buttonType: {
            type: String,
            default: 'button'
        },
        minWidth: {
            type: Boolean,
            default: true
        },
        small: {
            type: Boolean,
            default: false
        }
    },

    methods: {
        setUrlAttr () {
            if (!this.url && !this.href) {
                return { type: this.buttonType };
            }

            return {
                href: this.url || this.href,
                target: this.target
            };
        },

        typeOfElement () {
            if (!this.url && !this.href) {
                return 'button';
            }

            if (this.href) {
                return 'a';
            }

            return 'inertia-link';
        }
    }
};
</script>

<style lang="postcss" scoped>
.appButton {
    background-color: var(--primaryColor);
    padding: 1.1rem 2.2rem;
    min-width: 14rem;
    display: inline-block;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-radius: var(--borderRadius);
    transition: var(--normalTrans);
    font-size: 1.4rem;
    text-transform: uppercase;

    &.isDisabled {
        cursor: default;
        opacity: 0.6;
        pointer-events: none;
    }

    &.noMinWidth {
        min-width: 0;
    }
}

.appButton:hover {
    background-color: var(--primary800);
}

.inner {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
}

.label {
    color: #fff;
    transition: var(--normalTrans);
}

.appButton >>> .icon {
    width: 2rem;
    height: 2rem;
    margin-right: 1.2rem;
    display: flex;
    flex-shrink: 0;
    color: #fff;
}

.loading {
    width: 2rem;
    height: 2rem;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -1rem;
    margin-top: -1rem;
    opacity: 0;
}

.loadingIcon {
    width: 100%;
    height: 100%;
    color: #fff;
}

.isLoading {
    pointer-events: none;
    & .inner {
        opacity: 0;
    }
    & .loading {
        opacity: 1;
    }
    & .loadingIcon {
        animation-name: rotate;
        animation-duration: 0.8s;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }
}

.isSmall {
    padding: 10px 20px;
    min-width: 0;

    & .icon {
        width: 18px;
        height: 18px;
        @media (--laptop) {
            width: 16px;
            height: 16px;
        }
    }

    & .smallTitle {
        font-size: 13px;
        letter-spacing: 2px;
        @media (--laptop) {
            font-size: 12px;
        }
    }
}

.isOutlined {
    background-color: transparent;
    border: 1px solid var(--borderColor);

    &::before {
        display: none;
    }

    & .label {
        color: var(--primaryTextColor);
    }

    &:hover {
        background-color: var(--grey200);
        border-color: var(--grey200);
    }
}
.isDanger {
    background-color: var(--danger);

    &:hover {
        background-color: var(--danger700);
    }
}
</style>
