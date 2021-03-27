<template>
    <UserForm
        :user="user"
        @submit="updateUser"
        @delete="deleteUser"
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

    props: {
        user: {
            type: Object,
            required: true
        }
    },

    methods: {
        updateUser (form) {
            form.put(route('admin.users.update', this.user.id), {
                errorBag: 'updateUser',
                preserveScroll: true
            });
        },

        deleteUser (form) {
            form.delete(route('admin.users.destroy', this.user.id), {
                errorBag: 'deleteUser',
                preserveScroll: true
            });
        }
    }
};
</script>
