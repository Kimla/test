<template>
    <div class="banner fixed">
        <div
            v-if="show && message"
            :key="id"
            :class="{
                'bg-green-500': style == 'success',
                'bg-red-500': style == 'danger'
            }"
            class="banner__inner"
        >
            <div class="flex items-center justify-between flex-wrap py-2">
                <div class="w-0 flex-1 flex items-center min-w-0">
                    <span
                        class="flex p-2 rounded-lg"
                        :class="{
                            'bg-green-600': style == 'success',
                            'bg-red-600': style == 'danger'
                        }"
                    >
                        <svg
                            v-if="style == 'success'"
                            class="h-6 w-6 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                        <svg
                            v-if="style == 'danger'"
                            class="h-6 w-6 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                            />
                        </svg>
                    </span>

                    <p class="ml-6 font-semibold text-xl text-white truncate">
                        {{ message }}
                    </p>
                </div>

                <div class="flex-shrink-0 sm:ml-3">
                    <button
                        type="button"
                        class="-mr-1 flex p-3 rounded-md focus:outline-none sm:-mr-2 transition ease-in-out duration-150"
                        :class="{
                            'hover:bg-green-600 focus:bg-green-600':
                                style == 'success',
                            'hover:bg-red-600 focus:bg-red-600':
                                style == 'danger'
                        }"
                        aria-label="Dismiss"
                        @click.prevent="close()"
                    >
                        <svg
                            class="h-8 w-8 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            show: true,
            timer: null
        };
    },

    computed: {
        style () {
            return this.$page.props.banner?.style || 'success';
        },

        message () {
            return this.$page.props.banner?.message || '';
        },

        timeout () {
            return this.$page.props.banner?.timeout || 8000;
        },

        id () {
            return this.$page.props.banner?.id || null;
        }
    },

    watch: {
        id () {
            this.clearTimer();

            this.show = true;

            this.timer = setTimeout(() => {
                this.show = false;
            }, this.timeout);
        }
    },

    methods: {
        close () {
            this.clearTimer();

            this.show = false;
        },

        clearTimer () {
            if (!this.timer) {
                return;
            }

            clearTimeout(this.timer);
            this.timer = null;
        }
    }
};
</script>

<style lang="postcss" scoped>
.banner {
    z-index: 80;
    top: 3rem;
    left: 50%;
    margin-left: -16rem;
    width: 32rem;
}

.banner__inner {
    transition: var(--slowerTrans);
    animation: animateInBanner 0.3s ease-in-out 0s 1 normal forwards;
    padding: 0 2rem;
    border-radius: var(--borderRadius);
    box-shadow: var(--shadow);
}

@keyframes animateInBanner {
    0% {
        opacity: 0;
        transform: scale(0)
    }
    100% {
        opacity: 1;
        transform: scale(1)
    }
}
</style>
