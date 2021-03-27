<template>
    <UserForm
        @submit="createUser"
    />
</template>

<script>
import UserForm from './UserForm';

export default {
    components: {
        UserForm
    },

    methods: {
        createUser (form) {
            form.post(route('admin.users.store'), {
                errorBag: 'createUser',
                preserveScroll: true
            });
        }
    }
};
</script>
