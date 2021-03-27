<template>
    <MessageForm
        :message="message"
        @submit="updateMessage"
        @delete="deleteMessage"
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

    props: {
        message: {
            type: Object,
            required: true
        }
    },

    methods: {
        updateMessage (form) {
            form.put(route('admin.messages.update', this.message.id), {
                errorBag: 'updateMessage',
                preserveScroll: true
            });
        },

        deleteMessage (form) {
            form.delete(route('admin.messages.destroy', this.message.id), {
                errorBag: 'deleteMessage',
                preserveScroll: true
            });
        }
    }
};
</script>
