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

                <Stars :value="stars" />

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

        <div class="margin-top--one">
            <h2 class="text--center">Tus puntajes</h2>
            <Scores :scores="scores" />
        </div>

        <div class="invitations margin-top--three">
            <h2 class="text--center margin-bottom--zero">
                Invitaciones pendientes
            </h2>
            <h4
                v-if="!invitations.length"
                class="text--center text--gray text--light"
            >
                Por los momentos no hay nada pendiente
            </h4>

            <div v-else class="margin-top--three">
                <a
                    v-for="({ asigment }, index) in invitations"
                    :key="index"
                    :href="route('asigment.review', asigment.id)"
                >
                    <div class="invitation">
                        <span class="invitaion__budget">
                            ${{ asigment.budget }}
                        </span>

                        <table>
                            <tr>
                                <td>Nivel:</td>
                                <td>{{ asigment.level.name }}</td>
                            </tr>
                            <tr>
                                <td>Categoria:</td>
                                <td>{{ asigment.category.name }}</td>
                            </tr>
                            <tr>
                                <td>Archivos:</td>
                                <td>{{ asigment.total_files }}</td>
                            </tr>
                            <tr>
                                <td>Detalles:</td>
                                <td>
                                    {{ asigment.details }}
                                </td>
                            </tr>
                        </table>

                        <span class="invitation__date">
                            <i class="icon icon-clock"></i>
                            {{ asigment.created_at }}</span
                        >
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['teacher', 'invitations'],

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
        @include size(255px);
    }
}

.info {
    .icon {
        font-size: 1.25rem;
    }
}

.invitations {
    min-height: 45vh;
}

.invitation {
    position: relative;
    display: block;
    padding: 1.5rem;
    padding-top: 1rem;
    margin-bottom: 1rem;
    border: 1px solid color('gray', 100);
    border-radius: 10px;
}

.invitaion__budget {
    font-weight: get('regular', $font-weights);
    font-size: 2.25rem;
    margin-bottom: 2rem;
}

.invitation__details {
    @include ellipsis;
}

.invitation table td:first-child {
    font-weight: get('bold', $font-weights);
    padding-right: 0.5rem;
}

.invitation__date {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    color: color('gray', 400);
}
</style>
