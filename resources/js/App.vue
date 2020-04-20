<template>
    <div id="app">
        <!-- Header -->
        <header class="navbar">
            <Button v-if="$auth.user" @click="doLogout" flat>Salir</Button>
        </header>

        <!-- Main -->
        <main>
            <div class="container">
                <slot></slot>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer"></footer>
    </div>
</template>

<script>
export default {
    methods: {
        async doLogout() {
            await this.$http.post('logout')
            window.location.href = route('home')
        },
    },
}
</script>

<style lang="scss" scoped>
$navbar-heigth: 55px;

#app {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
}

main {
    padding-top: $navbar-heigth;
    flex-grow: 1;

    & > .container {
        margin-top: get('two', $spacers);
        @include breakpoint('desktop') {
            margin-top: get('three', $spacers);
        }
    }
}

.navbar {
    @include size(100%, $navbar-heigth);
    @include position(fixed, 0, 0);

    background: color('white');
    border-bottom: 1px solid color('gray', 50);
    z-index: get('navbar', $z-layers);
}

.footer {
    height: 120px;
    background: color('white');
    border-top: 1px solid color('gray', 50);
}
</style>
