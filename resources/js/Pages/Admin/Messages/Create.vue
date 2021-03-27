<template>
    <MessageForm
        @submit="createMessage"
    />
</template>

<script>
import MessageForm from './MessageForm';

export default {
    components: {
        MessageForm
    },

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
