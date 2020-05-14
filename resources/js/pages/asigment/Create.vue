<template>
    <Conflict
        v-if="isDuplicated"
        :email="form.email"
        :options="options"
        :loading="loading"
        @answer="handleConflict"
    />

    <form v-else @submit.prevent="handleSubmit">
        <h1 class="text--center margin-bottom--three">Nueva propuesta</h1>

        <div class="row">
            <div class="col-sm-4 margin-bottom--one">
                <span
                    v-if="errors.has('level_id')"
                    class="text--red text--bold"
                    role="alert"
                >
                    {{ errors.first('level_id') }}
                </span>

                <h4>Nivel</h4>

                <Radio
                    v-for="(level, index) in levels"
                    :key="index"
                    v-model="form.level_id"
                    :value="level.id"
                    :label="level.name"
                />
            </div>

            <div class="col-sm-8">
                <span
                    v-if="errors.has('category_id')"
                    class="text--red text--bold"
                    role="alert"
                >
                    {{ errors.first('category_id') }}
                </span>

                <h4>Materia</h4>

                <div class="row">
                    <Radio
                        class="col-xs-6"
                        v-for="(category, index) in categories"
                        :key="index"
                        v-model="form.category_id"
                        :value="category.id"
                        :label="category.name"
                    />
                </div>
            </div>
        </div>

        <div>
            <h4 class="margin-bottom--zero">Detalles</h4>
            <p>
                Por favor, especificar cuales son los ejercicios a desarrollar.
            </p>

            <Input
                class="margin-top--one"
                v-model="form.details"
                :error="errors.first('details')"
                textarea
                rows="3"
                placeholder="Escribe aquí..."
            />
        </div>

        <div class="margin-top--two">
            <h4 class="margin-bottom--one">
                ¿Cuando te gustaría tener la clase?
            </h4>

            <span v-if="errors.has('date')" class="error" role="alert">
                {{ errors.first('date') }}
            </span>

            <div class="row">
                <Input
                    v-model="form.date"
                    class="col-xs-6 col-md-3"
                    label="Fecha"
                    required
                    type="date"
                />

                <Input
                    v-model="form.time"
                    class="col-xs-6 col-md-2"
                    label="Hora"
                    required
                    type="time"
                />
            </div>
        </div>

        <div class="margin-top--two">
            <h4 class="margin-bottom--halve">Adjuntar archivos</h4>
            <table class="margin-bottom--two">
                <tr>
                    <td class="padding-right--one">Número máximo:</td>
                    <td>{{ files.length }}/{{ MAX_FILE_NUM }}</td>
                </tr>
                <tr>
                    <td class="padding-right--one">Peso limite:</td>
                    <td>{{ maxFileSize }}</td>
                </tr>
                <tr>
                    <td class="padding-right--one">Formatos:</td>
                    <td>{{ allowedFileExtensions.toUpperCase() }}</td>
                </tr>
            </table>

            <span v-if="errors.has('files')" class="error" role="alert">{{
                errors.first('files')
            }}</span>

            <div class="row margin-top--one">
                <div class="col-xs-12 col-md-6">
                    <label class="box" for="files" ref="box">
                        <div class="box__container">
                            <input
                                class="box__input"
                                id="files"
                                type="file"
                                multiple
                                @change="handleFilesUpload"
                                :accept="allowedFileExtensions"
                            />

                            <i class="box__icon icon icon-upload"></i>

                            <label for="files" class="box__label"
                                ><strong>Elige un archivo</strong> o arrastralo
                                hasta aquí</label
                            >
                        </div>
                    </label>
                </div>
                <div class="col-xs-12 col-md-6">
                    <File
                        v-for="(file, index) in files"
                        :key="index"
                        :file="file"
                        @remove="removeFile(index)"
                    />
                </div>
            </div>
        </div>

        <footer class="col-xs-11 col-sm-6 margin-top--three">
            <h3>Presupuesto</h3>

            <span class="error" v-if="errors.has('budget')" role="alet">
                {{ errors.first('budget') }}
            </span>

            <div class="budget margin-top--one margin-bottom--three">
                <span class="budget__currency">$</span>
                <input
                    class="budget__field"
                    v-model="form.budget"
                    type="number"
                />
            </div>

            <Input
                v-model="form.email"
                :error="errors.first('email')"
                label="email"
                type="email"
            />

            <div>
                <!-- <h6 class="margin-bottom--zero">Teléfono</h6> -->

                <span
                    v-if="errors.has('phone_prefix') || errors.has('phone')"
                    class="error"
                    role="alert"
                    >{{
                        errors.first('phone_prefix') || errors.first('phone')
                    }}</span
                >

                <label for="" class="input__label">Telefono</label>
                <div class="d-flex">
                    <Input
                        style="width: 55px;"
                        placeholder="+00"
                        required
                        class="margin-right--one"
                        v-model="form.phone_prefix"
                    />
                    <Input
                        style="flex-grow: 1;"
                        v-model="form.phone"
                        type="tel"
                    />
                </div>
            </div>

            <Button
                class="margin-top--two"
                type="submit"
                :loading="loading"
                block
                >Enviar</Button
            >
        </footer>
    </form>
</template>

<script>
import handleFormError from '../../utils/handleFormError'

const OPTIONS = {
    RECOVER:
        'Recuperar la propuesta antigüa descartando la recién creada propuesta',
    OVERWRITE: 'Crear una nueva propuesta y olvidar la antigüa',
}

export default {
    components: { Conflict: require('./_create/Conflict').default },

    props: [
        'levels',
        'categories',
        'ALLOWED_FILE_EXTENSIONS',
        'MAX_FILE_SIZE',
        'MAX_FILE_NUM',
    ],

    data: () => ({
        form: {
            // level_id: undefined,
            // category_id: undefined,
            details: null,
            email: '',
            phone_prefix: '',
            phone: '',
            date: null,
            time: null,
            budget: 5,
        },

        files: [],
        formData: null,
        isDuplicated: false,
        loading: false,
        errors: new ErrorBag(),
    }),

    mounted() {
        const { box, fileInput } = this.$refs

        box.ondragover = box.ondragenter = e => {
            e.preventDefault()
            e.stopPropagation()
        }

        box.ondrop = e => {
            e.preventDefault()
            this.addFiles(e.dataTransfer.files)
        }
    },

    computed: {
        allowedFileExtensions() {
            return this.ALLOWED_FILE_EXTENSIONS.map(key => '.' + key).join(', ')
        },

        maxFileSize() {
            const size = this.MAX_FILE_SIZE / 1024
            if (size < 700) return size + 'KB'
            else return size / 1024 + 'MB'
        },

        options: () => OPTIONS,
    },

    methods: {
        async handleSubmit() {
            if (this.loading) return

            this.loading = true
            this.errors.clear()

            const { form } = this
            const data = new FormData()

            const date = new Date(form.date)
            const time = form.time
            const [hours, minutes] = time.split(':').map(Number)

            date.setDate(date.getDate() + 1)
            date.setHours(hours, minutes, 0, 0)
            date.setMinutes(date.getMinutes() - date.getTimezoneOffset())

            Object.keys(form).forEach(key => data.append(key, form[key]))
            data.set('date', date.toISOString())

            this.files.forEach((file, index) =>
                data.append(`files[${index}]`, file)
            )

            this.formData = data

            try {
                const url = route('asigment.store')
                await this.$http.post(url, data)

                window.location.href = route('asigment.index', { 'is-new': 1 })
            } catch (error) {
                const validationErrors = handleFormError(error)
                this.errors.set(validationErrors)

                if (this.errors.keys.length) return

                const message = error.response && error.response.data.message
                if (!message) return false

                this.isDuplicated = /duplicate entry/.test(message)
            } finally {
                this.loading = false
            }
        },

        async handleConflict(action) {
            if (this.loading) return

            let data

            if (action === 'OVERWRITE') {
                data = this.formData
            } else {
                const email = this.formData.get('email')
                data = new FormData()
                data.set('email', email)
            }

            try {
                this.loading = true
                const url = route('asigment.conflict', action)
                await this.$http.post(url, data)
                window.location.href = route('asigment.index')
            } catch (error) {
                console.error(error.response || error)
            } finally {
                this.loading = false
            }
        },

        handleFilesUpload(e) {
            this.addFiles(e.target.files)
            e.target.file = null
        },

        addFiles(files) {
            const diff = this.MAX_FILE_NUM - this.files.length

            if (diff < 0) return

            files = [].slice.call(files, 0, diff)

            files = files.filter(file => {
                if (file.size > this.MAX_FILE_SIZE) return false

                const { name } = file
                const ext = name.slice(name.lastIndexOf('.') + 1)
                return this.ALLOWED_FILE_EXTENSIONS.indexOf(ext) > -1
            })

            this.files.push(...files)
        },

        removeFile(index) {
            this.files.splice(index, 1)
        },
    },
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

form,
footer {
    margin: 0 auto;
}

form {
    @include breakpoint('md') {
        width: 85%;
    }
    @include breakpoint('lg') {
        width: 80%;
    }
}

.box {
    height: 270px;
    display: block;
    color: color('gray', 600);
    background: color('gray', 50, 0.1);
    border: 3px dashed color('gray', 100);
    padding: 10px;
    border-radius: 6px;
    cursor: pointer;
}

.box__input {
    @include hide-visually;
}

.box__container {
    display: flex;
    height: 100%;
    flex-flow: column;
    align-items: center;
    text-align: center;
    color: color('gray');
}

.box__icon {
    color: color('gray', 100);
    display: block;
    font-size: 6rem;
}

.box__label {
    cursor: pointer;
}

.budget {
    display: flex;
    font-size: get('large', $font-sizes) * 2.5;
    text-align: center;
    font-weight: get('bold', $font-weights);
    border-bottom: 1px solid color('gray', 300);
    color: color('black');
}

.budget__field {
    width: 100%;
    padding-left: 1rem;
    color: inherit;
    font-weight: inherit;
}
</style>
