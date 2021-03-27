<template>
    <div
        :class="{ error }"
        class="formGroup"
    >
        <label
            v-if="label"
            :for="name"
            class="label"
        >
            {{ label }}
        </label>

        <div class="formGroup__inner">
            <slot />
        </div>

        <jet-input-error
            :message="error"
            class="mt-2"
        />
    </div>
</template>

<script>
import JetInputError from '@/Jetstream/InputError';

export default {
    components: {
        JetInputError
    },

    props: {
        label: {
            type: String,
            default: null
        },

        name: {
            type: String,
            default: null
        },

        error: {
            type: String,
            default: null
        }
    }
};
</script>

<style lang="postcss" scoped>
.formGroup {
    margin-bottom: 2rem;

    &:last-child {
        margin-bottom: 0;
    }
}

.label {
    display: inline-block;
    margin-bottom: 0.8rem;
    font-weight: 600;
    font-size: 1.5rem;
}
</style>
