<template>
    <div>
        <AboveTable
            heading="Meddelanden"
            :create-link="route('admin.messages.create')"
        />

        <Table
            type="meddelande"
            :headers="[
                {
                    label: 'Titel',
                    property: 'title',
                    route: id => route('admin.messages.edit', id)
                },
                {
                    label: 'Skapad',
                    property: 'created_time_ago'
                }
            ]"
            :items="messages"
            @delete="deleteMessage"
        />
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import AboveTable from '@/Components/Table/AboveTable';
import Table from '@/Components/Table/Table';

export default {
    components: {
        AboveTable,
        Table
    },

    layout: AppLayout,

    props: {
        messages: {
            type: Array,
            default: null
        }
    },

    methods: {
        deleteMessage (id) {
            const form = this.$inertia.form();

            form.delete(route('admin.messages.destroy', id), {
                errorBag: 'deleteMessage',
                preserveScroll: true
            });
        }
    }
};
</script>
