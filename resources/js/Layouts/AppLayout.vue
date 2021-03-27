<template>
    <div class="app">
        <div class="flex min-h-screen">
            <Sidebar
                :class="{ 'isOpen': menuOpen }"
                @close="closeMenu"
            />

            <main class="app__inner relative">
                <jet-banner />

                <div class="main h-full">
                    <slot></slot>
                </div>
            </main>

            <portal-target
                name="modal"
                multiple
            />
        </div>

        <Component
            v-bind="$page.props"
            :is="$root.modalComponent"
            v-if="$root.modalComponent"
        />
    </div>
</template>

<script>
import JetBanner from '@/Jetstream/Banner';
import Sidebar from './Components/Sidebar';

export default {
    components: {
        JetBanner,
        Sidebar
    },

    data () {
        return {
            menuOpen: false,
            menuIsAnimating: false
        };
    },

    methods: {
        toggleMenu () {
            if (this.menuIsAnimating) {
                return;
            }

            this.menuIsAnimating = true;

            this.menuOpen = !this.menuOpen;

            setTimeout(() => {
                this.menuIsAnimating = false;
            }, 100);
        },

        closeMenu () {
            if (this.menuIsAnimating) {
                return;
            }

            this.menuOpen = false;
        }
    }
};
</script>

<style scoped>
.app {
    --sidebarWidth: 21rem;
}

.sidebar {
    width: var(--sidebarWidth);
}

.app__inner {
    width: calc(100% - var(--sidebarWidth));
    margin-left: var(--sidebarWidth);
    padding: 2rem;
}

.main {
    background-color: var(--lightGrey);
    border-radius: 1rem;
    padding: 3rem 4rem;
}
</style>
