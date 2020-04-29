<template>
    <div>
        <div class="wrapper">
            <div>
                <figure class="picture image">
                    <img :src="picture" alt="" />
                </figure>
            </div>

            <div>
                <h2 class="margin-bottom--zero">{{ full_name }}</h2>


                <ul class="info margin-top--one text--gray">
                    <li>
                        <i class="icon icon-map"></i>
                        {{ address.line }}, {{ address.city }},
                        {{ address.state }}
                    </li>
                    <li>
                        <i class="icon icon-phone"></i>
                        <span>{{ phone }}</span>
                    </li>
                    <li>
                        <i class="icon icon-mail"></i>
                        {{ email }}
                    </li>

                    <li>
                        <i class="icon icon-gift"></i>
                        {{ birthday }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        teacher: {
            type: Object,
            required: true,
        },
    },

    data: ({ teacher }) => ({ ...teacher }),
}
</script>

<style lang="scss" scoped>
.wrapper {
    display: flex;
    flex-flow: column;

    @include breakpoint('sm') {
        flex-flow: row;
    }
}

.picture {
    @include size(216px);
    border-radius: 10px;
    margin-right: 1rem;
    margin-bottom: 0.5rem;

    @include breakpoint('sm') {
        @include size(320px);
    }
}

.info {
    .icon {
        font-size: 1.25rem;
    }
}
</style>
