<template>
    <div>
        <span v-if="error" class="error" role="alert">{{ error }}</span>

        <form method="post" :action="route('payment.create')">
            <input type="hidden" name="_token" :value="CSRF_TOKEN" />

            <h1>Pago</h1>
            <h3>TOTAL: ${{ amount }}</h3>
            <Button type="submit">Pagar</Button>
        </form>
    </div>
</template>

<script>
export default {
    props: ['amount', 'error'],

    data: () => ({
        loading: true,
        error: null,
    }),

    methods: {
        async goToRoom() {
            try {
                const { id } = this.asigment
                const teacherId = this.currentTeacher.id
                const url = route('asigment.update')
                await this.$http.put(url, { teacher_id: teacherId })
                window.location.href = route('room', id)
            } catch (error) {
                console.error(error.response || error)
            }
        },
    },
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

//
</style>
