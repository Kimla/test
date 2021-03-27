<template>
    <div class="spinner">
        <svg
            class="svg"
            width="65px"
            height="65px"
            viewBox="0 0 66 66"
            xmlns="http://www.w3.org/2000/svg"
        >
            <circle
                class="path"
                fill="none"
                stroke-width="6"
                stroke-linecap="round"
                cx="33"
                cy="33"
                r="30"
            />
        </svg>
    </div>
</template>

<script>
export default {};
</script>

<style lang="postcss" scoped>
.spinner {
    width: 6.5rem;
    height: 6.5rem;
    margin: 5px auto;
}
.svg {
    animation: rotator 1.4s linear infinite;
}

.path {
    stroke-dasharray: 187;
    stroke-dashoffset: 0;
    transform-origin: center;
    animation: dash 1.4s ease-in-out infinite;
    stroke: var(--primary);
}

@keyframes rotator {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(270deg);
    }
}

@keyframes dash {
    0% {
        stroke-dashoffset: 187;
    }
    50% {
        stroke-dashoffset: 46.75;
        transform: rotate(135deg);
    }
    100% {
        stroke-dashoffset: 187;
        transform: rotate(450deg);
    }
}
</style>
