<template>
    <div>
        <header class="text--center col-xs-12 col-sm-6" style="margin: 0 auto;">
            <h1>Oops, algo esta mal</h1>
            <h3 class="text--light"></h3>
            <p>
                El correo <strong>{{ email }}</strong> esta ya esta en uso,
                posiblemente hayas sido tu, antes de continuar debes decidir que
                hacer.
            </p>
        </header>

        <div
            class="row col-xs-12 col-sm-8 justify-content-center margin-top--three"
            style="margin: 0 auto;"
        >
            <div
                v-for="(text, action, index) in options"
                :key="index"
                class="option col-xs-12 col-sm-6 margin-bottom--two"
            >
                <Radio :value="action" v-model="choosed" />
                <label class="option__label" @click="choosed = action">
                    <p>{{ text }}</p>
                </label>
            </div>

            <Button
                class="margin-top--two"
                :loading="loading"
                @click="$emit('answer', choosed)"
                block
                >Continuar</Button
            >
        </div>
    </div>
</template>

<script>
export default {
    props: {
        email: { type: String, required: true },
        options: { type: Object, required: true },
        loading: Boolean,
    },

    data: ({ options }) => ({ choosed: Object.keys(options)[0] }),
}
</script>

<style lang="scss" scoped>
.option {
    display: flex;
}

.option__label {
    cursor: pointer;
}
</style>
