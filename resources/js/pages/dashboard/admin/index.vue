<template>
    <div class="wrapper">
        <Menu :items="navItems" v-model="currentTab" />

        <main>
            <component :is="currentTab"></component>
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

    data: () => ({
        currentTab: 'teachers',
    }),

    computed: {
        navItems: () => [
            { label: 'Docentes', name: 'teachers' },
            { label: 'Pagos', name: 'payments' },
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
    padding: 2rem 3rem;
}
</style>
