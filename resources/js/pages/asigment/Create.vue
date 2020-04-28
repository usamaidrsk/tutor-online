<template>
    <form @submit.prevent="handleSubmit">
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

        <footer class="margin-top--three">
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
export default {
    props: {
        levels: { type: Array, required: true },
        categories: { type: Array, required: true },

        ALLOWED_FILE_EXTENSIONS: Array,
        MAX_FILE_SIZE: Number,
        MAX_FILE_NUM: Number,
    },

    data: () => ({
        form: {
            // level_id: undefined,
            // category_id: undefined,
            details: null,
            email: '',
            budget: 5,
        },

        files: [],
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
    },

    methods: {
        async handleSubmit() {
            if (this.loading) return

            this.loading = true
            this.errors.clear()

            const { form } = this
            const data = new FormData()

            Object.keys(form).forEach(key => data.append(key, form[key]))

            this.files.forEach((file, index) =>
                data.append(`files[${index}]`, file)
            )

            try {
                const url = route('asigment.store')
                const response = await this.$http.post(url, data)
                const { id } = response.data

                window.location.href = route('asigment.show', id)
            } catch (error) {
                if (error.response) {
                    console.error(error.response)
                    window.scrollTo({ top: 0, behavior: 'smooth' })
                    const { errors } = error.response.data
                    this.errors.set(errors || {})
                }
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
form {
    margin: 0 auto;
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

footer {
    margin: 0 auto;

    @include breakpoint('md') {
        width: 90%;
    }

    @include breakpoint('lg') {
        width: 50%;
    }
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
