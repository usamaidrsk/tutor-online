<template>
    <article class="card">
        <div class="card__body">
            <figure class="card__image">
                <img :src="teacher.picture" />
            </figure>
            <Stars class="card__stars" :value="3" />
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
    text-align: center;
    transition-property: transform box-shadow;
    transition-duration: 0.3s;
    transition-timing-function: ease-out;

    &:hover {
        transform: scale(1.1);
    }
}

.card__body {
    display: inline-block;
    padding: 1rem;
    padding-bottom: 0.5rem;
    background: color('white');
    border-radius: 5px;
    border: 1px solid color('gray', 50);
    cursor: pointer;
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
