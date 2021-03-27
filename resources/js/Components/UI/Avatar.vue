<template>
    <span class="avatar flex items-center justify-center flex-shrink-0">
        {{ initials }}
    </span>
</template>

<script>
export default {
    computed: {
        initials () {
            const name = this.$page.props.authed.name;

            return name?.split(' ').map((letters) => letters[0]).slice(0, 2).join('');
        }
    }
};
</script>

<style>

</style>
