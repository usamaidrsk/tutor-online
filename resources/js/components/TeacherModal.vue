<template>
    <div v-show="$data._isVisible">
        <div class="modal">
            <div class="modal__body">
                <div class="modal__container">
                    <h4 class="modal__title">
                        {{ teacher.first_name }} {{ teacher.last_name }}
                    </h4>
                    <Button block>Contratar</Button>
                </div>
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
}

.modal__body {
    @include size(80%, 60%);

    border-radius: 10px;
    padding: get('two', $spacers);
    background: color('white');
    pointer-events: all;
}

.overlay {
    background: color('black', 500, 0.5);
    z-index: get('overlay', $z-layers);
}
</style>
