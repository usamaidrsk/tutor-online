<template>
    <form class="questions" @submit.prevent="handleSubmit">
        <h1 class="text--center">Foto de perfil</h1>

        <label class="imageinput" :class="{ 'imageinput--is-filled': image }">
            <i class="icon icon-user"></i>
            <img v-show="image" :src="image" />
            <input
                type="file"
                @change="handleImage"
                :accept="allowedExtension"
            />
        </label>

        <ul class="text--gray text--center">
            <li>Máximo: {{ maxSizeToKbs }}</li>
            <li>Formatos: JPG, JPEG o PNG</li>
            <li>Tamaño recomendado: 216px x 216px</li>
        </ul>

        <span v-if="error" class="error text--center" role="alert">{{
            error
        }}</span>

        <div class="text--center margin-top--two">
            <Button class="margin--auto" type="submit" block :loading="loading"
                >Finalizar</Button
            >
            <Button
                :href="route('questions', 3)"
                class="margin--zero"
                color="gray"
                flat
                block
                >Atras</Button
            >
        </div>
    </form>
</template>

<script>
export default {
    props: {
        old: Object,
        ALLOWED_PICTURE_EXTENSIONS: Array,
        MAX_PICTURE_SIZE: Number,
        loading: Boolean,
        errors: ErrorBag,
    },

    data: () => ({
        form: { picture: null },
        image: null,
        error: '',
    }),

    computed: {
        maxSizeToKbs() {
            return this.MAX_PICTURE_SIZE / 1024 + 'KB'
        },

        allowedExtension() {
            return this.ALLOWED_PICTURE_EXTENSIONS.map(key => '.' + key).join(
                ','
            )
        },
    },

    methods: {
        handleSubmit() {
            if (!this.form.picture) {
                this.error = 'Por favor elige una foto para tu perfil'
                return
            }

            const data = new FormData()
            data.append('picture', this.form.picture)

            this.$emit('submit', data)
        },

        handleImage({ target: { files } }) {
            this.error = null
            this.image = null

            const [image] = files

            if (!image) return

            if (image.size > this.MAX_PICTURE_SIZE) {
                this.error = `La imagen no debe pesar mas de ${this.maxSizeToKbs}`
                return
            }

            const reader = new FileReader()
            reader.onload = e => (this.image = e.target.result)
            reader.readAsDataURL(image)

            this.form.picture = image
        },
    },
}
</script>

<style lang="scss" scoped>
form {
    width: 280px !important;
    max-width: 100%;
    margin: 0 auto;
}

.imageinput {
    @include size(200px);

    max-width: 100%;
    display: block;
    position: relative;
    margin: 30px auto;
    border-radius: 10px;
    border: 2px dashed color('gray', 100);
    cursor: pointer;

    input {
        @include hide-visually;
    }

    img {
        @include size(100%);
        @include position(absolute, 0, 0);

        object-fit: cover;
    }

    &--is-filled {
        border: 0;
        overflow: hidden;
    }

    .icon {
        @include centered;

        color: color('gray', 100);
        font-size: 10rem;
    }
}
</style>
