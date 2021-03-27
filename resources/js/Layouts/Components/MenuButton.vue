<template>
    <div
        :class="{ 'isOpen': open }"
        class="menuButton"
    >
        <div class="menuButton__hamburger">
            <span class="menuButton__line"></span>
            <span class="menuButton__line"></span>
            <span class="menuButton__line"></span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        open: {
            type: Boolean,
            required: true
        }
    }
};
</script>

<style lang="postcss" scoped>
.menuButton {
    display: none;
    cursor: pointer;
    @media (--largeTablet) {
        display: block;
    }
}

.menuButton__hamburger {
    position: relative;
    width: 28px;
    height: 18px;
}

.menuButton__line {
    position: absolute;
    width: 100%;
    height: 2px;
    background-color: var(--primaryTextColor);
    left: 0;
    top: 0;
    transition: var(--normalTrans);
}

.menuButton__line:nth-child(2) {
    top: 50%;
    margin-top: -1px;
}

.menuButton__line:nth-child(3) {
    top: 100%;
    margin-top: -2px;
}

.menuButton.isOpen {
    & .menuButton__line:nth-child(1) {
        transform: rotate(45deg);
        margin-top: 8px;
        transition-delay: 0.1s;
    }
    & .menuButton__line:nth-child(2) {
        transform: rotate(-45deg);
        transition-delay: 0.1s;
    }
    & .menuButton__line:nth-child(3) {
        transform: translateY(-10px);
        opacity: 0;
    }
}

</style>
