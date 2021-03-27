<template>
    <div v-show="message">
        <p class="text-lg text-red-600 font-semibold">
            {{ message }}
        </p>
    </div>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            default: null
        }
    }
};
</script>
