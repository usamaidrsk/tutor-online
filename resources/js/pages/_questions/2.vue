<template>
    <form class="questions" @submit.prevent="handleSubmit">
        <h1 class="margin-bottom--three">Infomación de contacto</h1>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <h5 class="margin-bottom--zero">Teléfono</h5>

                <Input
                    v-model="form.phone"
                    :error="errors.first('phone')"
                    type="tel"
                />
            </div>
        </div>

        <div class="row">
            <h5 class="margin-top--two margin-bottom--zero col-xs-12">
                Dirección
            </h5>
            <div class="col-xs-12 col-sm-6">
                <Select
                    v-model="form.address.country"
                    label="país"
                    :options="countries"
                ></Select>
            </div>
            <div class="col-xs-12 col-sm-6">
                <Input v-model="form.address.city" label="cuidad" />
            </div>
        </div>

        <Input v-model="form.address.line" label="dirección" textarea />

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <Input
                    v-model="form.address.zip_code"
                    label="código postal"
                    type="number"
                />
            </div>
            <div class="col-xs-12 col-sm-6">
                <Input v-model="form.address.state" label="estado/provincia" />
            </div>
        </div>

        <div class="margin-top--two">
            <Button :href="route('questions', 1)" flat>Atras</Button>
            <Button type="submit" :loading="loading">Siguiente</Button>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        old: Object,
        countries: { type: Array, required: true },

        errors: ErrorBag,
        loading: Boolean,
    },

    data() {
        const { old } = this
        old['address'] = old['address'] || {}

        return {
            form: {
                phone: old['phone'] || '',
                address: {
                    country: old['address']['country'] || '',
                    city: old['address']['city'] || '',
                    line: old['address']['line'] || '',
                    zip_code: old['address']['zip_code'] || '',
                    state: old['address']['state'] || '',
                },
            },
        }
    },

    methods: {
        handleSubmit() {
            this.$emit('submit', this.form)
        },
    },
}
</script>
