<template>
    <div>
        <h1 class="heading">
            Meddelanden
        </h1>

        <div v-if="messages && messages.length > 0">
            <Accordion
                v-for="message in messages"
                :key="message.id"
                :title="message.title"
            >
                <img
                    :src="message.image.sizes.large.url"
                    class="image mb-8 max-w-6xl"
                >

                <div
                    class="content"
                    v-html="message.content"
                ></div>
            </Accordion>
        </div>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import Accordion from '@/Components/UI/Accordion';

export default {
    components: {
        Accordion
    },

    layout: AppLayout,

    props: {
        messages: {
            type: Array,
            default: null
        }
    }
};
</script>

<style lang="postcss" scoped>
.heading {
    margin-bottom: 25px;

    @media (--mobile) {
        margin-bottom: 20px;
    }
}
</style>
