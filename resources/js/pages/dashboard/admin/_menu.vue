<template>
    <aside class="menu">
        <header class="menu__header">
            <h2 class="menu__title">{{ APP_NAME }}</h2>
        </header>

        <nav class="menu__nav">
            <ul>
                <li
                    :class="{
                        nav__item: true,
                        'nav__item--is-active': name === value,
                    }"
                    v-for="({ label, name }, index) in items"
                    :key="index"
                    @click="handleClick(name)"
                >
                    {{ label }}
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script>
export default {
    props: {
        items: {
            type: Array,
            required: true,
        },

        value: null,
    },

    methods: {
        handleClick(name) {
            this.$emit('input', name)
        },
    },
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

.menu {
    padding: 2rem 0;
    width: 245px;
    border-right: 1px solid color('gray', 50);
}

.menu__header {
    padding: 0 1.25rem;
}

.menu__title {
    color: color('primary');
}

.nav__item {
    text-transform: uppercase;
    font-weight: get('bold', $font-weights);
    border: 0 solid transparent;
    border-left-width: 4px;
    padding: 1.25rem;
    cursor: pointer;

    &--is-active {
        border-color: color('primary');
        background: color('gray', 50, 0.15);
        color: color('primary');
        cursor: default;
    }
}
</style>
