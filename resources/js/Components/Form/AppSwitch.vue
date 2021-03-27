<template>
    <span
        :aria-checked="toggled.toString()"
        class="appSwitch"
        role="checkbox"
        tabindex="0"
        @click="toggle"
        @keydown.space.prevent="toggle"
    ></span>
</template>

<script>
export default {
    model: {
        prop: 'toggled',
        event: 'toggle'
    },

    props: {
        toggled: {
            type: Boolean,
            required: true
        }
    },

    methods: {
        toggle () {
            this.$emit('toggle', !this.toggled);
        }
    }
};
</script>

<style lang="postcss" scoped>
.appSwitch {
    position: relative;
    display: block;
    flex-shrink: 0;
    border-radius: 9999px;
    cursor: pointer;
    height: 1.5rem;
    width: 3rem;
}

.appSwitch:focus {
    outline: 0;
}

.appSwitch::before {
    content: '';
    display: inline-block;
    border-radius: 9999px;
    width: 100%;
    height: 100%;
    background-color: #ebebeb;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: var(--normalTrans);
}

.appSwitch[aria-checked='true']::before {
    background-color: #10b981;
}

.appSwitch::after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 1.5rem;
    height: 1.5rem;
    background-color: #fff;
    border-radius: 9999px;
    border-width: 1px;
    border-color: var(--borderColor);
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    transition: var(--normalTrans);
    transform: translateX(0);
}

.appSwitch[aria-checked='true']::after {
    transform: translateX(1.6rem);
}
</style>
