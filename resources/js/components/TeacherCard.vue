<template>
    <article class="card">
        <div class="card__container">
            <header class="card__header">
                <h3 class="card__name">
                    {{ teacher.first_name }} {{ teacher.last_name }}
                </h3>
                <figure class="card__image">
                    <img :src="`/storage/${teacher.picture}`" />
                </figure>
            </header>
            <footer class="card__footer"></footer>
        </div>
    </article>
</template>

<script>
export default {
    props: {
        teacher: {
            required: true,
            type: Object,
        },
    },
}
</script>

<style lang="scss" scoped>
.card {
    width: 280px;
    border: 1px solid color('gray', 100);
    border-radius: 10px;
    margin-bottom: get('two', $spacers);
    margin-right: get('two', $spacers);

    transition-property: transform box-shadow;
    transition-duration: 0.3s;
    transition-timing-function: ease-out;
    cursor: pointer;

    &:hover {
        @include elevation(5);

        transform: scale(1.1);
    }
}

.card__header {
    padding: get('one', $spacers) get('two', $spacers);
}

.card__footer {
    display: block;
    border-top: 1px solid color('gray', 100);
    height: 50px;
}

.card__name {
    margin: 0;
    margin-bottom: get('halve', $spacers);
}

.card__image {
    @include size(180px);
    border-radius: 10px;
    overflow: hidden;
}
</style>
