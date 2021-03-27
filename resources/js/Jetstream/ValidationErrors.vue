<template>
    <div v-if="hasErrors">
        <div class="font-sembold text-red-600">
            {{ __('Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li
                v-for="(error, key) in errors"
                :key="key"
            >
                {{ __(error) }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    computed: {
        errors () {
            return this.$page.props.errors;
        },

        hasErrors () {
            return Object.keys(this.errors).length > 0;
        }
    }
};
</script>
