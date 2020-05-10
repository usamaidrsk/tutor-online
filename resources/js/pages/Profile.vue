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

        <div class="rooms margin-top--two">
            <h2 class="text--center margin-bottom--zero">Proximas clases</h2>
            <h4
                v-if="!rooms.length"
                class="text--center text--gray text--light"
            >
                No hay clases planificadas
            </h4>

            <div v-else class="row justify-content-center margin-top--two">
                <a
                    class="room col-xs-12 col-sm-6"
                    v-for="(room, index) in rooms"
                    :key="index"
                    :href="route('room', room.token)"
                >
                    <h4 class="room__date">
                        {{ formatDistance(room.asigment.date) }}
                    </h4>

                    <table>
                        <tr>
                            <td>Nivel:</td>
                            <td>{{ room.asigment.level.name }}</td>
                        </tr>
                        <tr>
                            <td>Categoria:</td>
                            <td>{{ room.asigment.category.name }}</td>
                        </tr>
                        <tr>
                            <td>Archivos:</td>
                            <td>{{ room.asigment.total_files }}</td>
                        </tr>
                        <tr>
                            <td>Detalles:</td>
                            <td class="room__details">
                                {{ room.asigment.details }}
                            </td>
                        </tr>
                    </table>
                </a>
            </div>
        </div>

        <div class="invitations margin-top--two">
            <h2 class="text--center margin-bottom--zero">
                Invitaciones pendientes
            </h2>
            <h4
                v-if="!invitations.length"
                class="text--center text--gray text--light"
            >
                Por los momentos no hay nada pendiente
            </h4>

            <div v-else class="row justify-content-center margin-top--two">
                <a
                    class="col-xs-12 col-sm-6"
                    v-for="({ asigment }, index) in invitations"
                    :key="index"
                    :href="route('invitation.show', asigment.id)"
                >
                    <div class="invitation">
                        <span class="invitation__budget">
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
                            {{ asigment.formated_created_at }}</span
                        >
                    </div>
                </a>
            </div>
        </div>

        <div class="margin-top--two">
            <div class="margin-bottom--one text--center">
                <h2 class="margin-bottom--one">Tu horario</h2>
                <p>
                    Estas son las horas que tienes disponibles para dar classes,
                    puedes cambiarlas en cualquier momento.
                </p>

                <Button
                    class="margin-top--two"
                    @click="
                        canEditSchedule
                            ? saveSchedule()
                            : (canEditSchedule = true)
                    "
                    :outline="!canEditSchedule"
                    :loading="loading"
                    >{{ canEditSchedule ? 'Guardar' : 'Editar' }}</Button
                >

                <span v-if="success" class="success" role="alert"
                    >Cambios guardados correctamente.</span
                >
                <span v-if="error" class="error" role="alert">{{ error }}</span>
            </div>

            <Schedule v-model="editableSchedule" :readonly="!canEditSchedule" />
        </div>

        <div class="margin-top--three">
            <h2 class="text--center">Tus puntajes</h2>
            <Scores :scores="scores" />
        </div>
    </div>
</template>

<script>
import formatDistance from 'date-fns/formatDistance'
import { es } from 'date-fns/locale'

export default {
    props: ['teacher', 'invitations', 'rooms'],

    data: ({ teacher }) => ({
        ...teacher,
        editableSchedule: null,
        canEditSchedule: false,

        loading: false,
        success: false,
        error: null,
    }),

    created() {
        const { schedule } = this
        const timeToNumber = time => Number(time.slice(0, time.indexOf(':')))

        const grouped = schedule.reduce((array, row) => {
            const { day_of_week, start, end } = row
            array[day_of_week] = array[day_of_week] || []
            const range = [start, end].map(timeToNumber)
            array[day_of_week].push(range)
            return array
        }, {})

        this.editableSchedule = grouped
    },

    methods: {
        formatDistance: date =>
            formatDistance(new Date(date), Date.now(), {
                locale: es,
                addSuffix: true,
            }),

        async saveSchedule() {
            if (this.loading) return

            this.loading = true
            this.success = false
            this.error = null

            try {
                const { id } = this
                const url = route('teacher.schedule', id)
                const data = { schedule: this.editableSchedule }
                await this.$http.put(url, data)

                this.success = true
                this.canEditSchedule = false
                setTimeout(() => (this.success = false), 3000)
            } catch (error) {
                console.error(error.response || error)
                this.error =
                    'Hubo un error al guardar los cambios, intentelo mas tarde.'
            } finally {
                this.loading = false
            }
        },
    },
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

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

.invitations,
.rooms {
    min-height: 45vh;
}

.invitation,
.room {
    display: block;
    padding: 1.5rem;
    padding-top: 1rem;
    margin-bottom: 1rem;
    border: 1px solid color('gray', 100);
    border-radius: 10px;
}

.invitation__details,
.room__details {
    @include ellipsis;
}

.invitation,
.room {
    table td:first-child {
        font-weight: get('bold', $font-weights);
        padding-right: 0.5rem;
    }
}

.invitation {
    position: relative;
}

.invitation__budget {
    font-weight: get('regular', $font-weights);
    font-size: 2.25rem;
    margin-bottom: 2rem;
}

.invitation__date {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    color: color('gray', 400);
}

// Rooms

.room {
    //
}

.room__date {
    // text-align: center;
    text-transform: capitalize;
}
</style>
