<template>
    <MessageForm
        @submit="createMessage"
    />
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import MessageForm from './MessageForm';

export default {
    components: {
        MessageForm
    },

    layout: AppLayout,

    methods: {
        createMessage (form) {
            form.post(route('admin.messages.store'), {
                errorBag: 'createMessage',
                preserveScroll: true
            });
        }
    }
};
</script>
