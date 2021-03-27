<template>
    <transition leave-active-class="duration-200">
        <div class="customerModal">
            <transition
                enter-active-class="ease-out duration-300"
                enter-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="ease-in duration-200"
                leave-class="opacity-100"
                leave-to-class="opacity-0"
                appear
            >
                <div
                    class="overlay ab100 bg-black bg-opacity-50"
                    @click="close"
                ></div>
            </transition>

            <transition
                enter-active-class="animateIn"
                enter-class="opacity-0 translate-x-full"
                enter-to-class="opacity-100 translate-x-0"
                leave-active-class="ease-in duration-200"
                leave-class="opacity-100 translate-x-0"
                leave-to-class="opacity-0 translate-x-full"
                appear
            >
                <div class="customerModal__inner transform transition-all">
                    <button
                        type="button"
                        class="closeButton flex items-center justify-center"
                        @click="close"
                    >
                        <img
                            src="../../../../images/x.svg"
                            class="closeButtonIcon"
                            svg-inline
                        >
                    </button>

                    <div class="mb-8">
                        <h4 class="mb-4">
                            Kontaktperson {{ customer.has_separate_owner ? '' : ' / Ägare' }}
                        </h4>

                        <p>
                            Namn: {{ customer.user.name }}
                        </p>

                        <p>
                            E-post: {{ customer.user.email }}
                        </p>

                        <p>
                            Tel: {{ customer.user.phone }}
                        </p>
                    </div>

                    <div
                        v-if="customer.has_separate_owner"
                        class="mb-8"
                    >
                        <h4 class="mb-4">
                            Ägare
                        </h4>

                        <p>
                            Namn: {{ customer.owner_name }}
                        </p>

                        <p>
                            E-post: {{ customer.owner_email }}
                        </p>

                        <p>
                            Tel: {{ customer.owner_phone }}
                        </p>
                    </div>

                    <div class="mb-8">
                        <h4 class="mb-4">
                            Företag
                        </h4>

                        <p>
                            Namn: {{ customer.company_name }}
                        </p>

                        <p>
                            Org nr: {{ customer.company_org_nr }}
                        </p>

                        <p>
                            Address: {{ customer.company_address }}, {{ customer.company_postcode }} {{ customer.company_city }}
                        </p>
                    </div>

                    <div class="mb-8">
                        <h4 class="mb-6">
                            Certifikat
                        </h4>

                        <div>
                            <div
                                v-for="certificate in customer.certifications"
                                :key="certificate.id"
                                class="certificate"
                            >
                                <a
                                    target="_blank"
                                    :href="certificate.url"
                                    class="certificateLink"
                                >
                                    {{ certificate.title }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="mb-4">
                            Odling
                        </h4>

                        <p>
                            Har tidigare odlat för Foodhills: {{ customer.has_previously_grown_for_foodhills ? 'Ja' : 'Nej' }}
                        </p>

                        <p>
                            Ekologiskt: {{ customer.organic_farming ? 'Ja' : 'Nej' }}
                        </p>
                    </div>

                    <h4 class="mb-6">
                        Fältdelar
                    </h4>

                    <div class="fieldParts">
                        <div
                            v-for="fieldPart in customer.field_parts"
                            :key="fieldPart.id"
                            class="fieldPart flex"
                        >
                            <div
                                v-if="fieldPart.map_image"
                                class="w-1/3"
                            >
                                <img
                                    :src="fieldPart.map_image.sizes.large.url"
                                >
                            </div>

                            <div class="w-2/3 pl-8">
                                <p>
                                    Storlek: {{ fieldPart.size }} ha
                                </p>

                                <p>
                                    Senaste ärtordling: {{ fieldPart.latest_cultivation }}
                                </p>

                                <p>
                                    Förfrukt: {{ fieldPart.pre_fruit }}
                                </p>

                                <p>
                                    Bevattning: {{ fieldPart.irrigation ? 'Ja' : 'Nej' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
import pickBy from 'lodash/pickBy';

export default {
    props: {
        customer: {
            type: Object,
            required: true
        },

        filters: {
            type: Object,
            default: null
        }
    },

    created () {
        const closeOnEscape = (e) => {
            if (e.key === 'Escape') {
                this.close();
            }
        };

        document.addEventListener('keydown', closeOnEscape);
        document.body.classList.add('overflow-hidden');

        this.$once('hook:destroyed', () => {
            document.removeEventListener('keydown', closeOnEscape);
            document.body.classList.remove('overflow-hidden');
        });
    },

    methods: {
        close () {
            let query = pickBy(this.filters);
            query = Object.keys(query).length ? query : {};

            this.$inertia.get(route('admin.customers.index'), query, {
                preserveScroll: true
            });
        }
    }
};
</script>

<style lang="postcss" scoped>
.animateIn {
    transition: var(--slowTrans);
}

.customerModal {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 200;
}

.customerModal__inner {
    height: 100%;
    position: absolute;
    top: 0;
    right: 0;
    width: 60rem;
    background-color: #fff;
    padding: 6rem 4rem;
    font-size: 1.5rem;
    overflow: auto;
}

.closeButton {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 5rem;
    height: 5rem;

    &:hover {
        color: var(--primary);
    }
}

.closeButtonIcon {
    width: 2.4rem;
    height: 2.4rem;
}

p {
    margin-bottom: 0.6rem;

    &:last-child {
        margin-bottom: 0;
    }
}

.fieldPart {
    padding: 2rem 0;
    border-bottom: 1px solid var(--borderColor);

    &:first-child {
        padding-top: 0;
    }

    &:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }
}

.certificate {
    margin-bottom: 0.8rem;

    &:last-child {
        margin-bottom: 0;
    }
}

.certificateLink {
    &:hover {
        color: var(--primary);
    }
}
</style>
