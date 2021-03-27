<template>
    <aside class="sidebar">
        <nav class="nav">
            <div class="logoHolder">
                <inertia-link
                    :href="route('dashboard')"
                    class="block h-full"
                >
                    <ApplicationLogo class="block w-full h-full" />
                </inertia-link>
            </div>

            <ul
                v-if="!isAdmin"
                class="links"
            >
                <SidebarLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    <template #icon>
                        <img
                            src="../../../images/home.svg"
                            class="icon"
                            svg-inline
                        >
                    </template>

                    Hem
                </SidebarLink>

                <SidebarLink
                    :href="route('messages')"
                    :active="route().current('messages')"
                >
                    <template #icon>
                        <img
                            src="../../../images/message.svg"
                            class="icon"
                            svg-inline
                        >
                    </template>

                    Meddelanden
                </SidebarLink>

                <SidebarLink
                    :href="route('profile')"
                    :active="route().current('profile')"
                >
                    <template #icon>
                        <img
                            src="../../../images/user.svg"
                            class="icon"
                            svg-inline
                        >
                    </template>

                    Mitt konto
                </SidebarLink>
            </ul>

            <ul
                v-if="isAdmin"
                class="links"
            >
                <SidebarLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    <template #icon>
                        <img
                            src="../../../images/home.svg"
                            class="icon"
                            svg-inline
                        >
                    </template>

                    Hem
                </SidebarLink>

                <SidebarLink
                    :href="route('admin.customers.index')"
                    :active="route().current('admin.customers.*')"
                >
                    <template #icon>
                        <img
                            src="../../../images/growers.svg"
                            class="icon"
                            svg-inline
                        >
                    </template>

                    Odlare
                </SidebarLink>

                <SidebarLink
                    :href="route('admin.messages.index')"
                    :active="route().current('admin.messages.*')"
                >
                    <template #icon>
                        <img
                            src="../../../images/message.svg"
                            class="icon"
                            svg-inline
                        >
                    </template>

                    Meddelanden
                </SidebarLink>

                <SidebarLink
                    :href="route('admin.users.index')"
                    :active="route().current('admin.users.*')"
                >
                    <template #icon>
                        <img
                            src="../../../images/users.svg"
                            class="icon"
                            svg-inline
                        >
                    </template>

                    Användare
                </SidebarLink>

                <SidebarLink
                    :href="route('profile')"
                    :active="route().current('profile')"
                >
                    <template #icon>
                        <img
                            src="../../../images/user.svg"
                            class="icon"
                            svg-inline
                        >
                    </template>

                    Mitt konto
                </SidebarLink>
            </ul>
        </nav>

        <div class="user">
            <h2 class="userHeading h4">
                Inloggad som
            </h2>

            <p class="userName h4">
                {{ name }}
                <br>
                {{ email }}
            </p>

            <button
                type="button"
                class="logoutButton inline-flex items-center"
                @click="logout"
            >
                <img
                    src="../../../images/log-out.svg"
                    class="logoutButtonIcon flex-shrink-0"
                    svg-inline
                >

                Logga ut
            </button>
        </div>
    </aside>
</template>

<script>
import ApplicationLogo from '@/Jetstream/ApplicationLogo';
import SidebarLink from './SidebarLink';

export default {
    components: {
        ApplicationLogo,
        SidebarLink
    },

    computed: {
        isAdmin () {
            return this.$page.props.authed?.admin;
        },

        name () {
            return this.$page.props.authed.name;
        },

        email () {
            return this.$page.props.authed.email;
        }
    },

    mounted () {
        const stopPropagation = (e) => {
            e.stopPropagation();
        };

        const close = () => {
            this.$emit('close');
        };

        this.$once('hook:destroyed', () => {
            this.$el.removeEventListener('click', stopPropagation);
            document.removeEventListener('click', close);
        });

        this.$el.addEventListener('click', stopPropagation);
        document.addEventListener('click', close);
    },

    methods: {
        logout () {
            this.$inertia.post(route('logout'));
        }
    }
};
</script>

<style lang="postcss" scoped>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    background-color: #fff;
    padding: 3rem 3rem 4rem;
    overflow: auto;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    &.isOpen {
        transform: translateX(0);
    }
}

.logoHolder {
    width: 10.6rem;
    height: 11.43rem;
    max-width: 100%;
    margin: 0 auto;
}

.links {
    padding: 7rem 0 6rem;
}

.user {
    margin-top: 3rem;
}

.userHeading {
    margin-bottom: 0.4rem;
    font-size: 1.5rem;
    font-weight: 600;
}

.userName {
    margin-bottom: 1.2rem;
    font-weight: 400;
    font-size: 1.5rem;
}

.logoutButton {
    font-size: 1.5rem;
    line-height: 1;

    &:hover {
        color: var(--primaryColor);
    }
}

.logoutButtonIcon {
    width: 2rem;
    height: 2rem;
    margin-right: 1.2rem;
}
</style>
