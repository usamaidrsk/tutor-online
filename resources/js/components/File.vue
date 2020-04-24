<template>
    <div class="file" :class="[`file--is-${type}`]">
        <div class="file__container">
            <div>
                <span class="file__icon"></span>
            </div>

            <p class="file__name">
                {{ file.name }}
            </p>

            <div class="file__controls">
                <span class="file__size"> {{ formatSize(file.size) }} </span>
                <i
                    v-if="!readonly"
                    class="icon icon-x"
                    @click="$emit('remove')"
                    title="Remover"
                ></i>
                <i
                    v-else
                    class="icon icon-download"
                    @click="$emit('download')"
                    title="Descargar"
                ></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        file: {
            type: File,
            required: true,
        },

        readonly: Boolean,
    },

    methods: {
        formatSize(bytes) {
            let unit = 'KB'
            let formatted = bytes / 1024

            if (formatted >= 700) {
                formatted /= 1024
                unit = 'MB'
            }

            return formatted.toFixed(1) + unit
        },
    },

    computed: {
        type() {
            const { type } = this.file

            if (type.includes('image')) return 'image'
            if (type.includes('pdf')) return 'pdf'
        },
    },
}
</script>

<style lang="scss" scoped>
.file:not(:last-child) {
    border-bottom: 1px solid color('gray', 100);
}

.file__container {
    padding: get('one', $spacers) get('one', $spacers);
}

.file__container,
.file__controls {
    display: flex;
    align-items: center;
}

.file__icon {
    @include size(50px);

    position: relative;
    display: block;
    border-radius: 5px;

    .file--is-image & {
        background: #ffc816;
    }

    .file--is-pdf & {
        background: #f00;
        color: color('white');
        font-size: 0.9rem;
        font-weight: get('bold', $font-weights);

        &::before {
            content: 'PDF';
            @include centered;
        }
    }
}

.file__name {
    @include ellipsis;

    max-width: 100%;
    padding: 0 get('one', $spacers);
    flex-grow: 1;
}

.file__size {
    color: color('gray', 300);
    padding: 0 get('one', $spacers);
}

.icon {
    font-size: get('large', $font-sizes);
    cursor: pointer;
}

.icon-x {
    color: color('red');
}
</style>
