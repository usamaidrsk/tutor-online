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
            <h4 class="margin-bottom--zero">Adjuntar archivos</h4>

            <span v-if="errors.has('files')" class="error" role="alert">{{
                errors.first('files')
            }}</span>

            <div class="row margin-top--one">
                <div class="col-xs-12 col-md-6">
                    <label class="box" for="files" ref="box">
                        <i class="icon icon-files"></i>
                        <input
                            class="box__input"
                            id="files"
                            name="files"
                            type="file"
                            multiple
                            @change="handleFilesUpload"
                            :accept="allowedFileExtensions"
                        />

                        <label for="files"
                            ><strong>Elige un archivo</strong> o arrastralo
                            hasta aquí</label
                        >

                        <ul>
                            <li>Limite: {{ maxFileSize }}</li>
                            <li>
                                Formatos:
                                {{ allowedFileExtensions.toUpperCase() }}
                            </li>
                        </ul>
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

            <div class="budget margin-top--one margin-bottom--three">
                <span class="budget__currency">$</span>
                <input
                    class="budget__field"
                    v-model="form.budget"
                    type="number"
                />

                <span v-if="errors.has('budget')" role="alet">
                    {{ errors.first('budget') }}
                </span>
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
            level_id: null,
            category_id: null,
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

            const { files } = e.dataTransfer
            this.files.push(
                ...[].slice.call(files, 0).filter(({ name }) => {
                    return (
                        this.ALLOWED_FILE_EXTENSIONS.indexOf(
                            name.slice(name.lastIndexOf('.') + 1)
                        ) > -1
                    )
                })
            )
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

            this.loading = false
            this.errors.clear()

            try {
                const { form } = this
                const data = new FormData()

                Object.keys(form).forEach(key => data.append(key, form[key]))

                this.files.forEach((file, index) =>
                    data.append(`files[${index}]`, file)
                )

                await this.$http.post(route('store-asigment'), data)

                console.log('success')
            } catch (error) {
                console.error(error)
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
            const { files } = e.target
            this.files.push(...[].slice.call(files, 0))
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
    @include breakpoint('tablet') {
        width: 85%;
    }
    @include breakpoint('desktop') {
        width: 80%;
    }
}

.box {
    height: 270px;
    display: block;
    position: relative;
    color: color('gray', 600);
    border: 3px dashed color('gray', 100);
    padding: 10px;
    border-radius: 5px;
    text-align: center;

    label strong {
        color: color('primary');
        cursor: pointer;
    }

    ul {
        width: 100%;
        position: absolute;
        bottom: get('one', $spacers);
    }

    .box__input {
        @include hide-visually;
    }

    .icon {
        color: color('primary');
        display: block;
        font-size: 6rem;
    }
}

footer {
    margin: 0 auto;

    @include breakpoint('tablet') {
        width: 90%;
    }

    @include breakpoint('desktop') {
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

.budget__currency {
    //
}

.budget__field {
    width: 100%;
    padding-left: 1rem;
    color: inherit;
    font-weight: inherit;
}
</style>