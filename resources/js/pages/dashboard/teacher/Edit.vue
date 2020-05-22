<template>
    <form @submit.prevent="handleSubmit">
        <h1 class="text--center">Editar prerfil</h1>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="row">
                    <Input
                        class="col-xs-6"
                        v-model="form.first_name"
                        :value="teacher.first_name"
                        label="Nombres"
                        :error="errors.first('first_name')"
                    />

                    <Input
                        class="col-xs-6"
                        v-model="form.last_name"
                        label="Apellidos"
                        :error="errors.first('last_name')"
                    />
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <h6 class="margin--zero">Fecha de nacimiento</h6>

                <div class="row">
                    <div class="col-xs-3">
                        <Input
                            v-model="form.birthday[0]"
                            type="number"
                            required
                            min="1"
                            max="31"
                            placeholder="DD"
                        />
                    </div>
                    <div class="col-xs-3">
                        <Input
                            v-model="form.birthday[1]"
                            type="number"
                            required
                            min="1"
                            max="12"
                            placeholder="MM"
                        />
                    </div>
                    <div class="col-xs-6">
                        <Input
                            type="number"
                            required
                            max="999999"
                            min="1950"
                            v-model="form.birthday[2]"
                            placeholder="AAAA"
                        />
                    </div>
                </div>

                <span v-if="errors.has('birthday')" class="error" role="alert">
                    {{ errors.first('birthday') }}
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <h6 class="margin--zero">Nacionalidad</h6>

                <Select
                    v-model="form.country_id"
                    :options="countries"
                    :error="errors.first('country')"
                    required
                />
            </div>

            <div class="col-xs-12 col-sm-6">
                <!-- TODO: maybe add phone field here -->
            </div>
        </div>

        <div class="row">
            <h5 class="margin-top--two margin-bottom--zero col-xs-12">
                Dirección
            </h5>
            <div class="col-xs-12 col-sm-6">
                <Select
                    v-model="form.address.country_id"
                    label="país"
                    :options="countries"
                    :error="errors.first('address.country')"
                ></Select>
            </div>
            <div class="col-xs-12 col-sm-6">
                <Input
                    v-model="form.address.city"
                    label="cuidad"
                    :error="errors.first('address.city')"
                />
            </div>
        </div>

        <Input
            v-model="form.address.line"
            label="dirección"
            :error="errors.first('address.line')"
            textarea
        />

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <Input
                    v-model="form.address.zip_code"
                    label="código postal"
                    :error="errors.first('address.zip_code')"
                    type="number"
                />
            </div>
            <div class="col-xs-12 col-sm-6">
                <Input
                    v-model="form.address.state"
                    :error="errors.first('address.state')"
                    label="estado/provincia"
                />
            </div>
        </div>

        <h3 class="margin-top--three">
            Niveles de educación capacitado para enseñar
        </h3>

        <span v-if="errors.has('levels')" class="error" role="alert">
            {{ errors.first('levels') }}
        </span>

        <Checkbox
            v-for="(level, index) in levels"
            v-model="form.levels"
            :key="index"
            :value="level.id"
            :label="level.name"
        />

        <h3 class="margin-top--three">Tus especialidades</h3>

        <span v-if="errors.has('categories')" class="error" role="alert">
            {{ errors.first('categories') }}
        </span>

        <div class="row">
            <Checkbox
                class="col-xs-12 col-sm-6"
                v-for="(category, index) in categories"
                v-model="form.categories"
                :key="index"
                :value="category.id"
                :label="category.name"
            />
        </div>

        <div class="margin-top--two">
            <h3 class="margin-bottom--zero">Cuenta bancaria</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <Input
                        v-model="form.bank.entity"
                        class="bank-name-field"
                        label="Entidad financiera"
                    />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <Input
                        v-model="form.bank.account_number"
                        label="Número de cuenta bancaria"
                    />
                </div>
            </div>
        </div>

        <footer class="margin-top--three">
            <Button type="submit" :loading="loading">Guardar</Button>
        </footer>
    </form>
</template>

<script>
import handleFormError from '../../../utils/handleFormError'

export default {
    props: ['teacher', 'levels', 'categories', 'countries'],

    data: () => ({
        form: {
            birthday: [],
            address: {},
            levels: [],
            categories: [],
            bank: {},
        },

        loading: false,
        errors: new ErrorBag(),
    }),

    created() {
        const { teacher, form } = this

        form.first_name = teacher.first_name
        form.last_name = teacher.last_name

        const { bank } = teacher
        if (bank) {
            form.bank.entity = bank.entity
            form.bank.account_number = bank.account_number
        }

        const birthday = new Date(teacher.birthday)

        form.birthday = [
            birthday.getDate() + 1,
            birthday.getMonth() + 1,
            birthday.getFullYear(),
        ]

        form.country_id = teacher.country_id

        // Address
        const { address } = teacher
        form.address.country_id = address.country_id
        form.address.city = address.city
        form.address.line = address.line
        form.address.zip_code = address.zip_code
        form.address.state = address.state

        // Levels & Categories
        const { levels, categories } = teacher

        const mapper = ({ id }) => id
        form.levels = levels.map(mapper)
        form.categories = categories.map(mapper)
    },

    methods: {
        async handleSubmit() {
            if (this.loading) return

            this.loading = true
            this.errors.clear()

            try {
                const data = { ...this.form }

                data.bank.entity = (data.bank.entity || '').toUpperCase()

                const { birthday } = data

                data.birthday = new Date(
                    birthday[2], // Year
                    birthday[1] - 1, // Month, wich is 0 based
                    birthday[0] //Date
                )

                const url = route('dashboard.edit')
                await this.$http.put(url, data)
                window.location.href = route('dashboard.index')
            } catch (error) {
                const validationErrors = handleFormError(error)
                this.errors.set(validationErrors)
            } finally {
                this.loading = false
            }
        },
    },
}
</script>

<style lang="scss">
.bank-name-field input {
    text-transform: uppercase !important;
}
</style>
