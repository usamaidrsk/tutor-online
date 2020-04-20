<template>
    <div>
        <form @submit.prevent="next">
            <!-- #1 Step ----------------------------------------------------->

            <div v-if="step === 0">
                <header class="margin-bottom--two">
                    <h1 class="margin-bottom--quarter">Queremos conocerte</h1>
                    <p>
                        Antes de empezar, necesitamos saber algunas cosas sobre
                        ti
                    </p>
                </header>
                <div class="row margin-top--two">
                    <div class="col-xs-12 col-sm-7 col-lg-5">
                        <h6 class="margin--zero">Nacionalidad</h6>

                        <Select
                            v-model="form.country_id"
                            :options="countriesToOptions"
                            required
                        />
                    </div>

                    <div class="col-xs-12 col-sm-7 col-lg-6">
                        <h6 class="margin--zero">Fecha de nacimiento</h6>

                        <div class="row">
                            <div class="col-xs-3">
                                <Input
                                    v-model="form.birthday[0]"
                                    type="number"
                                    min="1"
                                    max="31"
                                    placeholder="DD"
                                />
                            </div>
                            <div class="col-xs-3">
                                <Input
                                    v-model="form.birthday[1]"
                                    type="number"
                                    min="1"
                                    max="12"
                                    placeholder="MM"
                                />
                            </div>
                            <div class="col-xs-6">
                                <Input
                                    type="number"
                                    max="999999"
                                    min="1950"
                                    v-model="form.birthday[2]"
                                    placeholder="YYYY"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="margin-top--three">
                    ¿A que nivel de educación estas capacitado para enseñar?
                </h3>

                <div class="row">
                    <Checkbox
                        class="col-xs-12 col-sm-6"
                        v-for="(category, index) in categories"
                        v-model="form.category_ids"
                        :key="index"
                        :value="category.id"
                        :label="category.name"
                    />
                </div>

                <h3 class="margin-top--three">
                    ¿Cuales son tus especialidades?
                </h3>

                <Checkbox
                    v-for="(level, index) in levels"
                    v-model="form.level_ids"
                    :key="index"
                    :value="level.id"
                    :label="level.name"
                />
            </div>

            <!-- #2 Step ----------------------------------------------------->

            <div v-if="step === 1">
                <h1>Infomación de contacto</h1>

                <h5 class="margin-bottom--zero">Número de teléfono</h5>
                <Input v-model="form.phone" class="phone-field" type="tel" />

                <h3 class="margin-top--three margin-bottom--halve">
                    Dirección
                </h3>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <Select
                            v-model="form.address.country_id"
                            label="país"
                            :options="countriesToOptions"
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
                        <Input
                            v-model="form.address.state"
                            label="estado/provincia"
                        />
                    </div>
                </div>
            </div>

            <!-- #3 Step ----------------------------------------------------->

            <div v-if="step === 2" class="text--center">
                <h2>Foto de perfil</h2>

                <label class="imageinput">
                    <figure v-show="image">
                        <img :src="image" />
                    </figure>
                    <input
                        type="file"
                        @change="handleImage"
                        accept=".jpg, .jpeg, .png"
                    />
                </label>

                <ul>
                    <li>Máximo: 5MB</li>
                    <li>Formatos: JPG, JPEG o PNG</li>
                    <li>Tamaño recomendado: 216px x 216px</li>
                </ul>
            </div>

            <div
                class="margin-top--three"
                :class="{ 'text--center': isLastStep }"
            >
                <Button v-if="step > 0" @click="prev" flat>Atras</Button>
                <Button @click="next">{{
                    !isLastStep ? 'Siguiente' : 'Finalizar'
                }}</Button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        countries: { required: true, type: Array },
        categories: { required: true, type: Array },
        levels: { required: true, type: Array },
    },

    data: () => ({
        form: {
            birthday: ['', '', ''],
            country_id: 0,
            level_ids: [],
            category_ids: [],
            phone: '',
            address: {
                country_id: 0,
                city: '',
                line: '',
                zip_code: '',
                state: '',
            },
            profile: null,
        },

        image: null,

        step: 2,
        totalSteps: 3,
    }),

    methods: {
        prev() {
            if (this.step > 0) --this.step
        },

        next() {
            switch (this.step) {
                case 0:
                    // validate first step...
                    break
                case 1:
                    //
                    break
            }

            if (this.step < this.totalSteps - 1) ++this.step
            else this.handleSubmit()
        },

        async handleSubmit() {
            //
        },

        handleImage({ target: { files } }) {
            this.error = null
            const [image] = files

            if (!image) return

            const reader = new FileReader()
            reader.onload = e => (this.image = e.target.result)
            reader.readAsDataURL(image)

            this.form.profile = image
        },
    },

    computed: {
        isLastStep() {
            return this.step === this.totalSteps - 1
        },

        countriesToOptions() {
            return this.countries.map(({ id, name }) => ({
                value: id,
                label: name,
            }))
        },
    },
}
</script>

<style lang="scss" scoped>
form {
    margin: 0 auto;
    @include breakpoint('tablet') {
        width: 85%;
    }
    @include breakpoint('desktop') {
        width: 75%;
    }
}

.imageinput {
    @include size(200px);
    display: block;
    position: relative;
    border: 2px dashed color('gray', 100);
    margin: 30px auto;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;

    input {
        @include hide-visually;
    }

    img {
        @include size(100%);
        @include position(absolute, 0, 0);
        object-fit: cover;
    }
}
</style>
