<template>
    <div class="wrapper">
        <div>
            <h1>Pago</h1>
            <h3>TOTAL: ${{ asigment.budget }}</h3>
            <div id="paypal-button"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['asigment'],

    data: () => ({}),

    mounted() {
        const script = document.createElement('script')
        script.onload = () => this.setupPayPalButton()
        script.async = true
        script.src = 'https://www.paypalobjects.com/api/checkout.js'
        document.head.appendChild(script)
    },

    methods: {
        setupPayPalButton() {
            paypal.Button.render(
                {
                    // Configure environment
                    env: 'sandbox',
                    client: {
                        sandbox: 'demo_sandbox_client_id',
                        production: 'demo_production_client_id',
                    },
                    // Customize button (optional)
                    locale: 'es_ES',
                    style: {
                        size: 'large',
                        color: 'gold',
                        shape: 'pill',
                    },
                    commit: true, // Enable Pay Now checkout flow (optional)
                    payment: this.handlePayment.bind(this), // Set up a payment
                    onAuthorize: this.handleOnAuthorize.bind(this), // Execute the payment
                },
                '#paypal-button'
            )
        },

        handlePayment(data, actions) {
            const { budget } = this.asigment

            return actions.payment.create({
                transactions: [
                    {
                        amount: {
                            total: budget,
                            currency: 'USD',
                        },
                    },
                ],
            })
        },

        handleOnAuthorize(data, actions) {
            const { id } = this.asigment

            return actions.payment
                .execute()
                .then(() => (window.location.href = route('room', id)))
        },
    },
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

.wrapper {
    height: 100%;
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: center;
}
</style>
