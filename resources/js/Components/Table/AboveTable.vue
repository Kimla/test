<template>
    <div class="aboveTable flex items-end justify-between">
        <div>
            <h1 class="heading">
                {{ heading }}
            </h1>

            <slot />
        </div>

        <div class="buttonHolder">
            <AppButton
                v-if="createLink"
                :url="createLink"
                label="Lägg till"
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
import AppButton from '../UI/AppButton';

export default {
    components: {
        AppButton
    },

    props: {
        heading: {
            type: String,
            default: null
        },

        createLink: {
            type: String,
            default: null
        }
    }
};
</script>

<style lang="postcss" scoped>
.aboveTable {
    margin-bottom: 2.2rem;
    min-height: 4.7rem;
}
</style>
