<template>
    <div class="wrapper">
        <Menu :items="navItems" :active-item="tab" />

        <main>
            <component :is="tab || 'teachers'" v-bind="data"></component>
        </main>
    </div>
</template>

<script>
export default {
    components: {
        Menu: require('./_menu').default,
        teachers: require('./_tabs/_teachers').default,
        payments: require('./_tabs/_payments').default,
    },

    props: ['tab', 'data'],

    computed: {
        navItems: () => [
            {
                label: 'Docentes',
                name: 'teachers',
                href: route('dashboard.index', { tab: 'teachers' }),
            },
            {
                label: 'Pagos',
                name: 'payments',
                href: route('dashboard.index', { tab: 'payments' }),
            },
        ],
    },
}
</script>

<style lang="scss" scoped>
.wrapper {
    min-height: 100vh;
    display: flex;
}

main {
    padding: 2rem 5rem;
    flex-grow: 1;
    max-height: 100vh;
    overflow: auto;
}
</style>
