<template>
    <div
        :class="columnsClass"
        class="formColumns"
    >
        <div class="formColumns__inner flex items-center flex-wrap">
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        columns: {
            type: Number,
            default: 2
        }
    },

    computed: {
        columnsClass () {
            const classes = {
                2: 'twoColumns',
                3: 'threeColumns'
            };

            return classes[this.columns] || 'twoColumns';
        }
    }
};
</script>

<style lang="postcss" scoped>
.formColumns {
    margin-bottom: 25px;

    &:last-child {
        margin-bottom: 0;
    }
}

.formColumns >>> .formGroup {
    margin-bottom: 0;
}

.formColumns__inner {
    margin: -10px;
}

.formColumns__inner > * {
    padding: 10px;
}

.formColumns.twoColumns .formColumns__inner > * {
    width: 50%;

    @media (--mobile) {
        width: 100%;
    }
}

.formColumns.threeColumns .formColumns__inner > * {
    width: 33.33%;

    @media (--mobile) {
        width: 100%;
    }
}
</style>
