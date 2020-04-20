<template>
    <div class="registe">
        <form class="register__form" @submit.prevent="handleSubmit">
            <header class="text--center margin-bottom--two">
                <h1 class="margin-bottom--quarter">
                    Unete a nuestra plataforma
                </h1>
                <p>
                    <span>¿Ya eres miembro?</span>
                    <a :href="route('login')">Iniciar sesión</a>
                </p>
            </header>

            <div class="row name-fields">
                <div class="column">
                    <Input
                        v-model="form.first_name"
                        label="nombres"
                        required
                        autocomplete="name"
                        autofocus
                        :error="errors.first('first_name')"
                    />
                </div>
                <div class="column">
                    <Input
                        v-model="form.last_name"
                        label="apellidos"
                        :error="errors.first('last_name')"
                        required
                    />
                </div>
            </div>

            <Input
                v-model="form.email"
                label="email"
                type="email"
                autocomplete="email"
                :error="errors.first('email')"
                required
            />
            <Input
                v-model="form.password"
                label="contraseña"
                placeholder="6+ caracteres"
                type="password"
                autocomplete="new-password"
                :error="errors.first('password')"
                required
            />

            <div class="terms-disclaimer margin-top--two">
                <Checkbox
                    id="terms"
                    :value="false"
                    v-model="form.acceptTerms"
                />

                <!-- TODO: redirect to real  -->
                <label for="terms" class="text--small padding-top--quarter">
                    <span> Acepto los </span>
                    <a :href="route('home')" target="_blank"
                        >Terminos y Condiciones</a
                    >
                    <span>y las</span>
                    <a :href="route('home')" target="_blank"
                        >Politicas de Privacidad</a
                    >
                </label>
            </div>

            <Button
                class="margin-top--two"
                type="submit"
                block
                :loading="loading"
                >registrarse</Button
            >
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                accepTerms: false,
            },
            loading: false,
            error: null,
            errors: new ErrorBag(),
        }
    },
    methods: {
        async handleSubmit() {
            if (this.loading) return

            try {
                this.loading = true
                await this.$http.post('register', this.form)
                window.location.href = route('post-register')
            } catch (error) {
                this.loading = false
                this.errors.setErrors(error.response.data.errors)
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.register__form {
    width: 490px;
    max-width: 100%;
    margin: 0 auto;
}

.name-fields {
    margin-bottom: -10px;
    & > .column {
        width: 50%;
    }
}

.terms-disclaimer {
    display: flex;
}
</style>
