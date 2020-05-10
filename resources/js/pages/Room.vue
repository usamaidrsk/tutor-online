<template>
    <div>
        <div class="wrapper">
            <div v-if="distanceInTime" class="text--center">
                <h3 class="text--gray text--light margin-bottom--zero">
                    La clase empezará en:
                </h3>
                <h1>{{ distanceInWords }}</h1>
            </div>
            <div v-else class="text--center">
                <h2 class="margin-bottom--one">
                    Ya ha llegado la hora de la clase!
                </h2>
                <Button>Ir a la clase</Button>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-sm-6" v-if="!$auth.user">
                <div class="text--center">
                    <h4 class="margin-bottom--zero">{{ teacher.full_name }}</h4>
                    <figure class="image picture">
                        <img :src="teacher.picture" />
                    </figure>
                    <Stars :value="teacher.starts" />
                </div>
            </div>

            <div class="col-sm-6">
                <h5 class="margin-bottom--zero">Detalles:</h5>
                <p>{{ asigment.details }}</p>

                <h5 class="margin-top--two margin-bottom--zero">
                    Archivos adjuntos:
                </h5>

                <File
                    v-for="(file, index) in asigment.files"
                    :key="index"
                    :file="file"
                    readonly
                />
            </div>
        </div>
    </div>
</template>

<script>
import formatDistance from 'date-fns/formatDistance'
import { es } from 'date-fns/locale'

export default {
    props: ['asigment', 'teacher', 'room_token'],

    data: () => ({
        distanceInWords: null,
        distanceInTime: true,
    }),

    mounted() {
        const date = new Date(this.asigment.date)

        setInterval(() => {
            const now = Date.now()
            this.distanceInTime = Math.max(date - now, 0)
            this.distanceInWords = formatDistance(date, now, { locale: es })
        }, 1000)
    },

    methods: {},
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

.wrapper {
    height: 35vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

hr {
    height: 1px;
    background: color('gray', 50);
    margin: 3.5rem 0;
}

.picture {
    @include size(150px);

    margin: 0 auto;
    border-radius: 5px;
}
</style>
