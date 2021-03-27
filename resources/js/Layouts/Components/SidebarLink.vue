<template>
    <li class="sidebarLinkItem">
        <inertia-link
            :href="href"
            :class="{ 'isActive': active }"
            class="sidebarLink flex items-center"
        >
            <div
                v-if="$slots.icon"
                class="iconHolder flex-shrink-0"
            >
                <slot name="icon"></slot>
            </div>

            <slot />
        </inertia-link>
    </li>
</template>

<script>
export default {
    props: {
        href: {
            type: String,
            required: true
        },

        active: {
            type: Boolean,
            default: false
        }
    }
};
</script>

<style lang="postcss" scoped>
.sidebarLinkItem {
    margin-bottom: 1.8rem;
}

.sidebarLink {
    display: flex;
    font-size: 1.6rem;
    font-weight: 600;

    &:hover,
    &.isActive {
        color: var(--primaryColor);
    }
}

.iconHolder {
    width: 2.4rem;
    height: 2.4rem;
    margin-right: 1.4rem;
}

.icon {
    width: 100%;
    height: 100%;
}
</style>
