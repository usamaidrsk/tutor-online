<template>
    <div class="login">
        <form class="login__form" @submit.prevent="handleSubmit">
            <h1 class="text--center margin-bottom--three">Iniciar sesión</h1>

            <span v-show="error" class="login__error" role="alert">
                <strong>{{ error }}</strong>
            </span>

            <app-input
                label="Email"
                v-model="form.email"
                type="email"
                required
                autocomplete="email"
                autofocus
            ></app-input>

            <app-input
                label="Contraseña"
                v-model="form.password"
                type="password"
                required
                autocomplete="current-password"
            ></app-input>

            <app-checkbox
                :value="false"
                v-model="form.remenber"
                class="margin-bottom--halve"
                label="Recordarme"
            ></app-checkbox>

            <p class="text--right text--small margin-bottom--halve">
                <a :href="$route('password.request')"
                    >¿Olvidaste tu contraseña?</a
                >
            </p>

            <app-button type="submit" block :loading="loading">
                <span>Iniciar</span>
            </app-button>

            <p class="text--center margin-top--two">
                <span>¿Aún no eres miembro? </span>
                <a :href="$route('register')">Registrate</a>
            </p>
        </form>
    </div>
</template>

<script>
export default {
    data: () => ({
        form: {
            email: null,
            password: null,
            remember: false,
        },
        error: null,
        loading: false,
    }),

    methods: {
        async handleSubmit() {
        },
    },
}
</script>

<style lang="scss" scoped>
.login__form {
    width: 420px;
    max-width: 100%;
    margin: 0 auto;
}

.login__error {
    padding: get('one', $spacers);
    margin-top: get('two', $spacers) * -1;
    margin-bottom: get('two', $spacers);
    border: 1px solid color('red');
    color: color('red');
    border-radius: 4px;
    display: block;
    text-align: center;
}
</style>
