<template>
    <div>
        <header class="text--center margin-bottom--three">
            <h1 class="margin-bottom--zero">
                Invitación para enseñar en tiempo real
            </h1>
            <h3 class="text--light">
                Muestra tus habilidades desarrollando ejercicios
            </h3>
        </header>

        <div class="container">
            <div class="margin-bottom--two">
                <span class="budget">${{ asigment.budget }}</span>
                <div class="time">
                    <i class="icon icon-clock"></i>
                    <span>{{ asigment.created_at }}</span>
                </div>
            </div>

            <div class="margin-top--two">
                <h5 class="margin-bottom--halve">Detalles</h5>
                <p class="">{{ asigment.details }}</p>
            </div>

            <div class="margin-top--two">
                <File
                    v-for="(file, index) in asigment.files"
                    :key="index"
                    :file="file"
                    readonly
                />
            </div>

            <div class="margin-top--three">
                <Button block>Estoy interesado</Button>
                <Button color="gray" flat block>Descartar</Button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        asigment: {
            type: Object,
            required: true,
        },
    },

    data: () => ({}),
}
</script>

<style lang="scss" scoped>
.time {
    color: color('gray');
    font-size: get('large', $font-sizes);
}

.budget {
    font-size: 2.85rem;
}
</style>
