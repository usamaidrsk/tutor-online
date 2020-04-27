<template>
    <article class="card">
        <div class="card__container">
            <div class="card__body">
                <figure class="card__image">
                    <img :src="`/storage/${teacher.picture}`" />
                </figure>
                <h4 class="card__name">
                    {{ teacher.first_name }} {{ teacher.last_name }}
                </h4>
                <Stars class="card__stars" :value="3" />
            </div>
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
    width: 235px;
    margin: 0 auto;
    background: color('white');
    border: 1px solid color('gray', 100);
    border-radius: 5px;

    transition-property: transform box-shadow;
    transition-duration: 0.3s;
    transition-timing-function: ease-out;
    cursor: pointer;

    &:hover {
        transform: scale(1.1);
    }
}

.card__body {
    padding: 2rem 0 1rem;
    text-align: center;
}

.card__name {
    @include ellipsis;

    margin: 0;
    margin-top: 1rem;
    margin-bottom: get('halve', $spacers);
}

.card__image {
    @include size(160px);

    background: color('gray', 50);
    margin: 0 auto;
    border-radius: 5px;
    overflow: hidden;
}

.card__footer {
    display: block;
    border-top: 1px solid color('gray', 100);
    text-align: center;
    padding: get('halve', $spacers) 0;
}
</style>
