<template>
    <div class="wrapper">
        <span v-if="error" class="error" role="alert">{{ error }}</span>

        <header>
            <h1 class="margin-bottom--one">Pago</h1>
        </header>

        <div class="total">
            <h4 class="total__label">TOTAL</h4>
            <h2 class="total__amount">{{ APP_CURRENCY_SYMBOL }}{{ amount }}</h2>
        </div>

        <form
            method="post"
            :action="route('payment.create')"
            @submit="loading = true"
        >
            <input type="hidden" name="_token" :value="CSRF_TOKEN" />

            <button class="paypal-button" type="submit" :disabled="loading">
                <i class="icon icon-paypal"></i>
                <span>PayPal</span>
            </button>
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

.wrapper {
    text-align: center;
}

.total {
    margin-top: 1.85rem;
    margin-bottom: 2rem;
}

.total__label,
.total__amount {
    margin: 0;
}

.total__label {
    font-weight: get('regular', $font-weights) !important;
}

.total__amount {
    font-weight: get('light', $font-weights) !important;
    font-size: 3.5rem !important;
}

.paypal-button {
    background: #005ea6; // Paypal's blue
    color: color('white');
    padding: 1rem 3.5rem 1rem 3rem;
    border-radius: 5px;
    font-size: 1.1rem;

    .icon {
        font-size: 1.5rem;
        vertical-align: top;
        margin-right: 8px;
    }
}
</style>
