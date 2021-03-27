<template>
    <div
        :class="{'isOpen': open}"
        class="accordion"
    >
        <div
            class="header flex items-center justify-between"
            @click="toggle()"
        >
            <h3 class="title flex items-center">
                {{ title }}
            </h3>

            <img
                src="../../../images/plus.svg"
                alt=""
                class="icon flex-shrink-0"
                svg-inline
            >
        </div>

        <SlideUpAndDown :open="open">
            <slot />
        </SlideUpAndDown>
    </div>
</template>

<script>
import SlideUpAndDown from './SlideUpAndDown';

export default {
    components: {
        SlideUpAndDown
    },

    props: {
        title: {
            type: String,
            required: true
        }
    },

    data: () => ({
        open: false
    }),

    methods: {
        toggle () {
            this.open = !this.open;
        }
    }
};
</script>

<style lang="postcss" scoped>
.accordion {
    border-bottom: 1px solid var(--borderColor);
    background-color: #fff;
}

.header {
    cursor: pointer;
    position: relative;
    padding: 2rem 3rem;
    transition: var(--slowTrans);

    &:hover {
        color: var(--secondaryColor);
    }
}

.title {
    margin-bottom: 0;
    padding-right: 2rem;
    color: var(--secondaryColor);
    width: 80rem;
    max-width: 100%;
}

.icon {
    width: 2.4rem;
    height: 2.4rem;
    transition: var(--slowTrans);
}

.accordion >>> .contentHolder {
    border-top: 1px solid var(--borderColor);
    padding: 3rem 3.2rem;
    color: var(--secondaryColor);
}

.accordion >>> .content {
    width: 76rem;
    max-width: 100%;
}

.accordion.isOpen {
    & .header {
        color: var(--secondaryColor);
    }
    & .icon {
        transform: rotate(0.125turn);
    }
}
</style>
