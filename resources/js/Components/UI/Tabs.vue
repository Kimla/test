<template>
    <div class="tabs flex">
        <button
            v-for="tab in tabs"
            :key="tab.value"
            :class="{ isActive: active === tab.value }"
            class="tab relative"
            type="button"
            @click="changeTab(tab.value)"
        >
            <div class="background ab100"></div>

            <div class="inner flex items-center justify-center">
                <span class="label whitespace-nowrap">{{ __(tab.label) }}</span>
            </div>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        tabs: {
            type: Array,
            required: true
        },

        active: {
            type: String,
            required: true
        }
    },

    methods: {
        changeTab (tab) {
            if (this.active === tab) return;

            this.$emit('changed', tab);
        }
    }
};
</script>

<style lang="postcss" scoped>
.tabs {
    border-bottom: 1px solid var(--borderColor);

    @media (--mobile) {
        overflow-x: auto;
        overflow-y: hidden;
    }
}

.tab {
    padding: 2rem 3rem;
}

.inner {
    position: relative;
}

.tab:hover,
.isActive {
    color: var(--primary);
}

.background {
    transition: var(--normalTrans);

    &::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -1px;
        width: 100%;
        height: 2px;
        background-color: var(--primary);
        transition: var(--normalTrans);
        opacity: 0;
    }
}

.isActive .background {
    background-color: var(--primary100);

    &::after {
        opacity: 1;
    }
}
</style>
