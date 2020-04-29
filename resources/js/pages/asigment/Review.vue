<template>
    <div>
        <header class="text--center margin-bottom--three">
            <h1 class="margin-bottom--zero">
                Invitación para enseñar en tiempo real
            </h1>
            <h3 class="text--light">
                Muestra tus habilidades desarrollando ejercicios
            </h3>
        </header>

        <div class="container">
            <div class="margin-bottom--two">
                <span class="budget">${{ asigment.budget }}</span>
                <div class="time">
                    <i class="icon icon-clock"></i>
                    <span>{{ asigment.created_at }}</span>
                </div>
            </div>

            <div class="margin-top--two">
                <h5 class="margin-bottom--halve">Detalles</h5>
                <p class="">{{ asigment.details }}</p>
            </div>

            <div class="margin-top--two">
                <File
                    v-for="(file, index) in asigment.files"
                    :key="index"
                    :file="file"
                    readonly
                />
            </div>

            <div class="margin-top--three">
                <Button @click="handleAnswer('yes')" :loading="loading" block
                    >Estoy interesado</Button
                >

                <Button
                    color="gray"
                    flat
                    block
                    @click="handleAnswer('no')"
                    :loading="loading"
                    >Descartar</Button
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['asigment'],

    data: () => ({ loading: false }),

    methods: {
        async handleAnswer(answer) {
            if (this.loading) return

            this.loading = true

            try {
                const { id } = this.asigment
                const url = route('asigment.update', { id, answer })
                await this.$http.put(url)

                window.location.href = route('profile')
            } catch (error) {
                console.error(error.response)
            } finally {
                this.loading = false
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.time {
    color: color('gray');
    font-size: get('large', $font-sizes);
}

.budget {
    font-size: 2.85rem;
}
</style>
