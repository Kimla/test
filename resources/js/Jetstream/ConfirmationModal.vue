<template>
    <modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="bg-white p-10 pb-8">
            <div class="sm:flex sm:items-start">
                <div
                    class="flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-full bg-red-100"
                >
                    <svg
                        class="h-10 w-10 text-red-600"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        />
                    </svg>
                </div>

                <div class="ml-6">
                    <h3>
                        <slot name="title"></slot>
                    </h3>

                    <div class="mt-3 text-2xl">
                        <slot name="content"></slot>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-100 text-right">
            <slot name="footer">
            </slot>
        </div>
    </modal>
</template>

<script>
import Modal from './Modal';

export default {
    components: {
        Modal
    },

    props: {
        show: {
            type: Boolean,
            default: false
        },

        maxWidth: {
            type: String,
            default: '3xl'
        },

        closeable: {
            type: Boolean,
            default: true
        }
    },

    methods: {
        close () {
            this.$emit('close');
        }
    }
};
</script>
