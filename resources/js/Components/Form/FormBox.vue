<template>
    <form
        class="formBox flex items-start"
        @submit.prevent="$emit('submit')"
    >
        <Box class="main w-full">
            <template #top>
                <slot name="top" />
            </template>

            <slot />

            <template
                v-if="!showSide"
                #bottom
            >
                <button
                    v-if="deleteable"
                    type="button"
                    class="text-red-600 font-semibold hover:text-red-800"
                    @click="confirmingDeletion = true"
                >
                    Radera
                </button>

                <AppButton
                    type="submit"
                    :loading="loading"
                    :label="submitLabel"
                    class="ml-auto"
                />
            </template>
        </Box>

        <Box
            v-if="showSide"
            class="side flex-shrink-0"
        >
            <template #top>
                <div class="sideTop bg-gray-50">
                    <h1 class="text-2xl tracking-normal font-semibold">
                        {{ deleteable ? `Uppdatera ${type}` : `Lägg till ${type}` }}
                    </h1>
                </div>
            </template>

            <p class="flex justify-between">
                <b>Skapad:</b> {{ timestamps ? timestamps.created : 'Inte tillgänglig' }}
            </p>

            <p class="flex justify-between">
                <b>Uppdaterad:</b> {{ timestamps ? timestamps.updated : 'Inte tillgänglig' }}
            </p>

            <slot name="side" />

            <template #bottom>
                <button
                    v-if="deleteable"
                    type="button"
                    class="text-red-600 font-semibold hover:text-red-800"
                    @click="confirmingDeletion = true"
                >
                    Radera
                </button>

                <AppButton
                    type="submit"
                    :loading="loading"
                    :label="submitLabel"
                    class="ml-auto"
                />
            </template>
        </Box>

        <jet-confirmation-modal
            v-if="deleteable"
            :show="confirmingDeletion"
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
                    :class="{ 'opacity-25': loading }"
                    :disabled="loading"
                    @click.native="deleteConfirmed"
                >
                    Radera
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </form>
</template>

<script>
import AppButton from '@/Components/UI/AppButton';
import Box from '@/Components/UI/Box';
import JetConfirmationModal from '@/Jetstream/ConfirmationModal';
import JetDangerButton from '@/Jetstream/DangerButton';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';

export default {
    components: {
        AppButton,
        Box,
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton
    },

    props: {
        type: {
            type: String,
            default: 'post'
        },

        submitLabel: {
            type: String,
            required: true
        },

        timestamps: {
            type: Object,
            default: null
        },

        deleteable: {
            type: Boolean,
            default: false
        },

        loading: {
            type: Boolean,
            default: false
        },

        showSide: {
            type: Boolean,
            default: true
        }
    },

    data () {
        return {
            confirmingDeletion: false
        };
    },

    methods: {
        deleteConfirmed () {
            this.confirmingDeletion = false;

            this.$emit('delete');
        }
    }
};
</script>

<style lang="postcss" scoped>
.formBox {
    font-size: 1.5rem;

    @media (--smallTablet) {
        flex-wrap: wrap;
    }
}

.side {
    width: 32rem;
    margin-left: 3rem;
    position: sticky;
    top: 5rem;

    @media (--laptop) {
        width: 2.4rem;
    }

    @media (--largeTablet) {
        top: 15rem;
    }

    @media (--tablet) {
        width: 21rem;
        margin-left: 2rem;
    }

    @media (--smallTablet) {
        width: 100%;
        top: auto;
        position: relative;
        margin-top: 3rem;
        margin-left: 0;
    }
}

.sideTop {
    padding: 1.2rem 2rem;
    border-top-left-radius: var(--borderRadius);
    border-top-right-radius: var(--borderRadius);
    border-bottom: 1px solid var(--borderColor);

    @media (--tablet) {
        padding: 1rem 1.5rem;
    }
}

.side >>> .boxInner {
    padding: 2.5rem 2rem;

    @media (--tablet) {
        padding: 2rem 1.5rem;
    }
}

.side >>> .bottom {
    padding: 1rem 2rem;

    @media (--tablet) {
        padding: 1rem 1.5rem;
    }
}

.side >>> .appButton {
    min-width: 10rem;
    padding: 0.9rem 1.5rem;
    font-size: 1.3rem;
}
</style>
