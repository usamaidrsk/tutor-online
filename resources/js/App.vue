<template>
    <div id="app">
        <!-- Header -->
        <header class="navbar">
            <div class="navbar__container container">
                <div class="navbar__left">
                    <h1 class="navbar__logo">
                        <a :href="route('home')">Elearn </a>
                    </h1>
                </div>

                <div class="navbar__rigth">
                    <template v-if="isLogged">
                        <span class="navbar__wellcome"
                            >Hola, {{ user.first_name }}</span
                        >

                        <figure class="navbar__avatar image">
                            <img :src="user.picture" />
                        </figure>

                        <i
                            class="navbar__logout icon icon-logout"
                            @click="doLogout"
                            title="Salir"
                        ></i>
                    </template>
                    <template v-else>
                        <a
                            class="navbar__button"
                            :class="{
                                'navbar__button--is-active': isCurrent(
                                    'register'
                                ),
                            }"
                            :href="route('register')"
                            >Registrarse</a
                        >
                        <a
                            class="navbar__button"
                            :class="{
                                'navbar__button--is-active': isCurrent('login'),
                            }"
                            :href="route('login')"
                            >Iniciar</a
                        >
                    </template>
                </div>
            </div>
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
    data: ({ $auth }) => ({
        user: $auth.user,
        isLogged: !!$auth.user,
    }),

    methods: {
        async doLogout() {
            await this.$http.post('logout')
            window.location.href = route('home')
        },

        isCurrent: name => route().current() === route(name).name,
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
    padding-bottom: get('four', $spacers);
    flex-grow: 1;

    & > .container {
        margin-top: get('two', $spacers);
        @include breakpoint('md') {
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

.navbar__container {
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar__logo {
    margin: 0;
    font-size: 1.75rem;
    color: color('primary');
    text-transform: uppercase;
}

.navbar__rigth {
    display: flex;
    align-items: center;
}

.navbar__avatar {
    @include size(35px);

    background: color('gray', 50);
    border-radius: 50%;
    margin: 0 0.5rem;
}

.navbar__button {
    color: color('gray', 900);
    text-transform: uppercase;
    font-weight: get('regular', $font-weights);
    margin-right: 1.85rem;

    &::before {
        @include size(10px);

        content: ' ';
        display: block;
        float: left;
        border-radius: 50%;
        margin-top: 6px;
        margin-right: 7px;
        background: color('gray', 50);
    }

    &--is-active {
        &::before {
            background: color('primary');
        }
    }
}

.navbar__logout {
    font-size: 1.5rem;
    color: color('gray', 50);
    cursor: pointer;
}

.footer {
    height: 120px;
    background: color('white');
    border-top: 1px solid color('gray', 50);
}
</style>
