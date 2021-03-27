<template>
    <div class="tableWrapper">
        <div class="tableHolder">
            <table class="table">
                <thead class="table__header">
                    <tr class="row">
                        <th
                            v-for="(header, index) in headers"
                            :key="index"
                            :class="[header.class]"
                            class="whitespace-nowrap"
                        >
                            {{ header.label }}
                        </th>

                        <th
                            v-if="deleteable || link"
                            class="text-right whitespace-nowrap"
                            style="width: 8rem"
                        ></th>
                    </tr>
                </thead>

                <tbody>
                    <component
                        :is="link ? 'inertia-link' : 'tr'"
                        v-for="(item, index) in items"
                        :key="index"
                        :class="{ 'isLink': link }"
                        class="row"
                        :href="link ? link(item.id) : null"
                        preserve-state
                        preserve-scroll
                    >
                        <td
                            v-for="header in headers"
                            :key="header.property"
                            :class="[header.class, header.columnClass]"
                            class="whitespace-nowrap"
                        >
                            <inertia-link
                                v-if="header.route"
                                :href="header.route(item.id)"
                                class="link"
                            >
                                {{ item[header.property] }}
                            </inertia-link>

                            <span v-else>
                                {{ item[header.property] }}
                            </span>
                        </td>

                        <td
                            v-if="deleteable || link"
                            class="buttons text-right whitespace-nowrap"
                        >
                            <img
                                v-if="link"
                                svg-inline
                                src="../../../images/chevron.svg"
                                alt=""
                                class="linkIcon"
                            >

                            <button
                                v-if="deleteable"
                                type="button"
                                class="tableButton deleteButton inline-flex items-center justify-center cursor-pointer"
                                @click="confirmingDeletion = item.id"
                            >
                                <img
                                    svg-inline
                                    src="../../../images/trash.svg"
                                    alt=""
                                    class="tableButtonIcon deleteIcon"
                                >
                            </button>
                        </td>
                    </component>
                </tbody>
            </table>
        </div>

        <jet-confirmation-modal
            v-if="deleteable"
            :show="!!confirmingDeletion"
            @close="confirmingDeletion = false"
        >
            <template #title>
                Radera {{ type }}
            </template>

            <template #content>
                Är du säker på att du vill radera den här posten
            </template>

            <template #footer>
                <jet-secondary-button
                    @click.native="confirmingDeletion = false"
                >
                    Avbryt
                </jet-secondary-button>

                <jet-danger-button
                    class="ml-4"
                    @click.native="deleteConfirmed()"
                >
                    Radera
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </div>
</template>

<script>
import JetConfirmationModal from '@/Jetstream/ConfirmationModal';
import JetDangerButton from '@/Jetstream/DangerButton';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';

export default {
    components: {
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton
    },

    props: {
        headers: {
            type: Array,
            required: true
        },

        items: {
            type: Array,
            required: true
        },

        deleteable: {
            type: Boolean,
            default: true
        },

        type: {
            type: String,
            required: true
        },

        link: {
            type: Function,
            default: null
        }
    },

    data () {
        return {
            confirmingDeletion: false
        };
    },

    methods: {
        deleteConfirmed () {
            this.$emit('delete', this.confirmingDeletion);

            this.confirmingDeletion = false;
        }
    }
};
</script>

<style lang="postcss" scoped>
.tableWrapper {
    position: relative;
    overflow: auto;
    box-shadow: var(--shadow);
    border-radius: var(--borderRadius);
}

.table {
    text-align: left;
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
}

.row {
    border-bottom: 1px solid var(--borderColor);
    display: table-row;
}

.row.isLink {
    cursor: pointer;
    transition: var(--normalTrans);

    &:hover {
        background-color: var(--primary100);
    }
}

.body .row:last-child {
    border-bottom: 0;
}

.table >>> td,
.table >>> th {
    padding: 1.5rem 2.2rem;
    font-size: 1.4rem;
}

.table >>> td {
    font-size: 1.5rem;
}

.table >>> .buttons {
    padding-top: 0;
    padding-bottom: 0;
    position: relative;
}

.table >>> .link:hover {
    color: var(--primary);
}

.tableButton {
    width: 3.4rem;
    height: 3.4rem;
    color: var(--grey600);
}

.tableButtonIcon {
    width: 2rem;
    height: 2rem;
}

.linkIcon {
    width: 2.4rem;
    height: 2.4rem;
    transform: rotate(-0.25turn);
    position: absolute;
    top: 50%;
    margin-top: -1.2rem;
    right: 2.2rem;
    color: var(--primary);
}
</style>
