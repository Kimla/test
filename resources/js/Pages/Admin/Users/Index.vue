<template>
    <div>
        <AboveTable
            heading="Användare"
            :create-link="route('admin.users.create')"
        />

        <Table
            type="användare"
            :headers="[
                {
                    label: 'Namn',
                    property: 'name',
                    route: id => route('admin.users.edit', id)
                },
                {
                    label: 'E-post',
                    property: 'email'
                },
                {
                    label: 'Skapad',
                    property: 'created_time_ago'
                }
            ]"
            :items="users"
            @delete="deleteUser"
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
        users: {
            type: Array,
            default: null
        }
    },

    methods: {
        deleteUser (id) {
            const form = this.$inertia.form();

            form.delete(route('admin.users.destroy', id), {
                errorBag: 'deleteUser',
                preserveScroll: true
            });
        }
    }
};
</script>
