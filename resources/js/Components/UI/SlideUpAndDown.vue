<template>
    <transition
        @enter="slideDown"
        @leave="slideUp"
    >
        <div
            v-show="open"
            class="slideUpAndDown overflow-hidden"
        >
            <div class="contentHolder">
                <slot></slot>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        open: {
            type: Boolean,
            default: false
        },

        transition: {
            type: Number,
            default: 350
        }
    },

    methods: {
        slideDown (el, done) {
            el.style.transition = `${this.transition}ms`;
            el.style.height = 0;

            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    el.style.height = `${el.firstChild.offsetHeight}px`;
                });
            });

            setTimeout(() => {
                el.style.height = '';
                done();
            }, this.transition);
        },

        slideUp (el, done) {
            el.style.height = `${el.firstChild.offsetHeight}px`;

            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    el.style.height = 0;
                });
            });

            setTimeout(() => {
                done();
            }, this.transition);
        }
    }
};
</script>
