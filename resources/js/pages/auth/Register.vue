<template>
    <div class="registe">
        <form class="register__form" @submit.prevent="handleSubmit">
            <header class="text--center margin-bottom--two">
                <h1 class="margin-bottom--quarter">
                    Unete a nuestra plataforma
                </h1>
                <p>
                    <span>¿Ya eres miembro?</span>
                    <a class="link" :href="route('login')">Iniciar sesión</a>
                </p>
            </header>

            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <Input
                        v-model="form.first_name"
                        label="nombres"
                        required
                        autocomplete="name"
                        autofocus
                        :error="errors.first('first_name')"
                    />
                </div>
                <div class="col-xs-12 col-sm-6">
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

            <Button
                class="margin-top--two"
                type="submit"
                block
                :loading="loading"
                >registrarse</Button
            >

            <div class="margin-top--one">
                <p for="terms" class="text--small">
                    <span>Al registrarte aceptas los</span>
                    <a class="link" :href="route('terms')" target="_blank"
                        >Términos y Condiciones</a
                    >
                    <span>y las</span>
                    <a
                        class="link"
                        :href="route('privacy-policy')"
                        target="_blank"
                        >Políticas de Privacidad</a
                    >
                </p>
            </div>
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
                window.location.href = route('questions', 1)
            } catch (error) {
                this.loading = false
                console.error(error)
                if (error.response) {
                    console.error(error.response)
                    window.scrollTo({ top: 0, behavior: 'smooth' })
                    this.errors.set(error.response.data.errors)
                }
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
</style>
