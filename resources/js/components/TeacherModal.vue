<template>
    <div v-show="$data._isVisible">
        <div class="modal">
            <div class="modal__container">
                <button class="modal__x" @click="doClose">
                    <i class="icon icon-x"></i>
                </button>

                <div class="modal__body row">
                    <figure class="modal__image">
                        <img :src="`/storage/${teacher.picture}`" alt="" />
                    </figure>

                    <div class="modal__content">
                        <h2 class="modal__title">
                            {{ teacher.first_name }} {{ teacher.last_name }}
                        </h2>

                        <Stars :value="4" />
                    </div>
                </div>

                <div class="rates row">
                    <div class="col-xs-6 col-sm-4 rates__rate">
                        <span class="rate__value">3.2</span>
                        <p class="rate__label">Paciencia el la enseñanza</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 rates__rate">
                        <span class="rate__value">4.8</span>
                        <p class="rate__label">Escucha al alumno</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 rates__rate">
                        <span class="rate__value">3.5</span>
                        <p class="rate__label">
                            Uso adecuado de la tecnologia
                        </p>
                    </div>
                </div>

                <Button class="modal__button" block>Contratar</Button>
            </div>
        </div>

        <span class="overlay" @click="doClose"></span>
    </div>
</template>

<script>
export default {
    props: {
        teacher: {
            required: true,
            type: Object,
        },

        isVisible: Boolean,
    },

    data: ({ isVisible }) => ({ _isVisible: isVisible }),

    watch: {
        isVisible(value) {
            value ? this.doShow() : this.doClose()
        },
    },

    methods: {
        doShow() {
            this.$data._isVisible = true
            document.body.style.overflowY = 'hidden'
            this.$emit('show')
        },

        doClose() {
            this.$data._isVisible = false
            document.body.style.overflowY = 'auto'
            this.$emit('close')
        },
    },
}
</script>

<style lang="scss" scoped>
.modal,
.overlay {
    @include position(fixed, 0, 0);
    @include size(100vw, 100vh);
}

.modal {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    z-index: get('modal', $z-layers);
    pointer-events: none;
    overflow: auto;
}

.modal__container {
    max-width: 90vw;
    position: relative;
    border-radius: 10px;
    background: color('white');
    pointer-events: all;
    padding: 2rem 1rem 1rem;

    @include breakpoint('sm') {
        padding: 2rem 2.5rem;
    }
}

.modal__x {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 1.75rem;
    color: color('gray', 400);
}

.modal__body {
    display: flex;
    flex-flow: column;
    justify-content: center;
    align-items: center;

    @include breakpoint('sm') {
        flex-flow: row;
        justify-content: flex-start;
        align-items: flex-start;
    }
}

.modal__content {
    text-align: center;
    @include breakpoint('sm') {
        text-align: left;
    }
}

.modal__image {
    @include size(180px);

    border-radius: 10px;
    margin-right: 2rem;
    margin-bottom: 0.75rem;
    overflow: hidden;
    background: color('gray', 50);

    @include breakpoint('md') {
        @include size(220px);
    }
}

.modal__title {
    margin-bottom: 0;
}

.rates {
    margin-top: 2rem;
    justify-content: center;
}

.rates__rate {
    text-align: center;
    padding: 0.5rem 0;

    $border-style: 1px solid color('gray', 50);

    &:first-child {
        border-right: $border-style;
    }

    @include breakpoint('sm') {
        padding-left: 2rem;
        padding-right: 2rem;

        border-right: $border-style;
        &:last-child {
            border: 0;
        }
    }
}

.rate__value {
    font-size: 1.85rem;
    font-weight: get('bold', $font-weights);

    @include breakpoint('sm') {
        font-size: 2.5rem;
    }
}

.modal__button {
    margin-top: 2rem;
}

.overlay {
    background: color('black', 500, 0.5);
    z-index: get('overlay', $z-layers);
}
</style>
