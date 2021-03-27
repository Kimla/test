<template>
    <div
        :aria-disabled="disabled"
        class="radioButtons flex"
        role="radiogroup"
    >
        <SelectionControl
            v-for="(button, index) in buttons"
            :key="index"
            :class="{'isChecked': button.value === value, 'isDisabled': disabled}"
            :aria-label="button.label"
            :aria-checked="button.value === value"
            class="radioButton"
            role="radio"
            @click="clickHandler(button.value)"
        >
            <div class="icon"></div>
            <div class="label">
                button.label
            </div>
        </SelectionControl>
    </div>
</template>

<script>
import SelectionControl from './SelectionControl.vue';

export default {
    components: {
        SelectionControl
    },
    props: {
        value: {
            type: [Number, String, Boolean],
            default: null
        },
        buttons: {
            type: Array,
            required: true
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        clickHandler (value) {
            if (this.disabled || value === this.value) {
                return;
            }

            this.$emit('input', value);
        }
    }
};
</script>

<style lang="postcss" scoped>
.radioButtons {
    margin: -10px;
}

.radioButton {
    margin: 10px;
}

.icon {
    --iconSize: 8px;
    border-radius: 100%;
    &::after {
        width: var(--iconSize);
        height: var(--iconSize);
        margin-left: calc((var(--iconSize) / 2) * -1);
        margin-top: calc((var(--iconSize) / 2) * -1);
        border-radius: 100%;
        transform: scale(0);
        background-color: #fff;
    }
}

.isChecked .icon {
    background-color: var(--primary);
    border-color: var(--primary);
    &::after {
        transform: scale(1);
    }
}
</style>
