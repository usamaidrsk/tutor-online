<template>
    <div>
        <span v-if="error" class="error" role="alert">{{ error }}</span>

        <form
            method="post"
            :action="route('payment.create')"
            @submit="loading = true"
        >
            <input type="hidden" name="_token" :value="CSRF_TOKEN" />

            <h1>Pago</h1>
            <h3>TOTAL: ${{ amount }}</h3>
            <Button type="submit" :loading="loading">Pagar</Button>
        </form>
    </div>
</template>

<script>
export default {
    props: ['amount', 'error'],

    data: () => ({ loading: false }),
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

//
</style>
