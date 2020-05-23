<template>
    <form @submit.prevent="handleSubmit">
        <h1>Renovar contraseña</h1>

        <Input
            label="email"
            v-model="form.email"
            required
            autocomplete="email"
            autofocus
            :error="errors.first('email')"
        />

        <Input
            label="nueva contraseña"
            v-model="form.password"
            type="password"
            required
            autocomplete="new-password"
            :error="errors.first('password')"
        />

        <Input
            label="nueva contraseña"
            v-model="form.password_confirmation"
            type="password"
            required
            autocomplete="new-password"
            :error="errors.first('password')"
        />

        <Button type="submit" :loading="loading">Cambiar contaseña</Button>
    </form>
</template>

<script>
export default {
    props: {
        token: {
            type: String,
            required: true,
        },

        email: {
            type: String,
            required: true,
        },
    },

    data: self => ({
        form: {
            email: self.email || '',
            password: '',
            password_confirmation: '',
        },
        errors: new ErrorBag(),
        loading: false,
    }),

    methods: {
        async handleSubmit() {
            if (this.loading) return

            this.loading = true
            this.errors.clear()

            try {
                const data = this.form
                await this.$http.post(route('password.reset'), data)
                window.location.href = route('dashboard.index')
            } catch (error) {
                if (error.response) {
                    console.error(error.response)
                    const { errors } = error.response.data
                    this.errors.set(errors)
                }
            } finally {
                this.loading = false
            }
        },
    },
}
</script>
