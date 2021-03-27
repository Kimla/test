<template>
    <div class="repeater">
        <draggable
            :list="rows"
            handle=".moveButton"
            ghost-class="ghost"
        >
            <transition-group tag="div">
                <RepeaterRow
                    v-for="row in rows"
                    :key="row.id"
                    @removeRow="removeRow(row)"
                >
                    <template #default>
                        <slot :row="row" />
                    </template>
                </RepeaterRow>
            </transition-group>
        </draggable>
        <div class="buttonHolder flex flex-wrap justify-end">
            <AppButton
                :label="addLabel"
                :small="true"
                @click="addRow"
            >
                <template #icon>
                    <img
                        svg-inline
                        src="../../../images/plus.svg"
                        class="icon"
                    >
                </template>
            </AppButton>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';
import AppButton from '../UI/AppButton.vue';
import RepeaterRow from './RepeaterRow.vue';

export default {
    components: {
        draggable,
        AppButton,
        RepeaterRow
    },
    props: {
        rows: {
            type: Array,
            required: true
        },
        addLabel: {
            type: String,
            default: 'Lägg till rad'
        }
    },
    methods: {
        addRow () {
            this.$emit('addRow', { id: Date.now() });
        },
        removeRow (row) {
            const index = this.rows.indexOf(row);
            if (index !== -1) {
                this.$emit('removeRow', index);
            }
        }
    }
};
</script>

<style lang="postcss" scoped>
.repeater,
.repeaterRow {
    border: 1px solid var(--borderColor);
    padding: 25px;
    border-radius: var(--borderRadius);
    @media (--smallDesktop) {
        padding: 20px;
    }
    @media (--laptop) {
        padding: 14px;
    }

    @media (--mobile) {
        padding: 5px;
    }
}

.repeaterRow {
    @media (--laptop) {
        padding: 25px 20px;
    }

    @media (--mobile) {
        padding: 25px 10px 15px;
    }
}

.repeater >>> .repeater,
.repeaterRow >>> .repeaterRow {
    padding: 15px;

    @media (--mobile) {
        padding: 40px 5px 10px;
    }
}

.repeaterRow >>> .repeaterRow {
    margin-bottom: 10px;

    @media (--mobile) {
        margin-bottom: 6px;
    }

    &:last-child {
        margin-bottom: 15px;

        @media (--mobile) {
            margin-bottom: 10px;
        }
    }
}

.repeater {
    background-color: var(--grey100);
}
</style>
