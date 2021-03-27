<template>
    <UserForm
        @submit="createUser"
    />
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import UserForm from './UserForm';

export default {
    components: {
        UserForm
    },

    layout: AppLayout,

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
