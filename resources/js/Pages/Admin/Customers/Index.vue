<template>
    <div>
        <AboveTable
            heading="Odlare"
        >
            <select
                v-model="form.role"
                class="mt-4 form-select"
                style="width: 12rem"
            >
                <option :value="null">
                    Filtera
                </option>
                <option value="new">
                    Ny
                </option>
                <option value="grower">
                    Odlare
                </option>
            </select>

            <input
                v-model="form.search"
                class="ml-4"
                type="search"
                placeholder="Sök..."
            >
        </AboveTable>

        <Table
            type="odlare"
            :link="(id) => route('admin.customers.show', {
                customer: id,
                ...filters
            })"
            :filter="filters"
            :headers="[
                {
                    label: 'Namn',
                    property: 'name',
                },
                {
                    label: 'Företag',
                    property: 'company'
                },
                {
                    label: 'Org.nr',
                    property: 'company_org_nr'
                },
                {
                    label: 'E-post',
                    property: 'email'
                },
                {
                    label: 'Roll',
                    property: 'role'
                },
                {
                    label: 'Uppdaterad',
                    property: 'updated_time_ago',
                }
            ]"
            :items="customers.data"
            :deleteable="false"
        />

        <Pagination
            class="mt-6"
            :links="customers.links"
        />
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import AboveTable from '@/Components/Table/AboveTable';
import Table from '@/Components/Table/Table';
import Pagination from '@/Components/Table/Pagination';
import throttle from 'lodash/throttle';
import pickBy from 'lodash/pickBy';

export default {
    components: {
        AboveTable,
        Table,
        Pagination
    },

    layout: AppLayout,

    props: {
        customers: {
            type: Object,
            default: null
        },

        filters: {
            type: Object,
            default: null
        }
    },

    data () {
        return {
            form: {
                role: this.filters?.role || null,
                search: this.filters?.search || ''
            }
        };
    },

    watch: {
        form: {
            handler: throttle(function () {
                const query = pickBy(this.form);
                this.$inertia.replace(this.route('admin.customers.index', Object.keys(query).length ? query : {}));
            }, 150),
            deep: true
        }
    },

    methods: {
        deleteCustomer (id) {
            const form = this.$inertia.form();

            form.delete(route('admin.customers.destroy', id), {
                errorBag: 'deleteCustomer',
                preserveScroll: true
            });
        }
    }
};
</script>
