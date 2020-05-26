<template>
    <div>
        <h1>Docentes</h1>

        <article
            :class="['details', `details--is-${currentTeacher.status}`]"
            v-if="shouldShowDetails"
        >
            <button class="details__x" @click="hideDetails">
                <i class="icon icon-x"></i>
            </button>

            <div class="details__body">
                <figure class="details__avatar image">
                    <img :src="currentTeacher.avatar" />
                </figure>

                <div class="margin-left--one">
                    <h2 class="margin-bottom--zero">
                        {{ currentTeacher.full_name }}
                    </h2>
                    <Stars :value="currentTeacher.stars" />

                    <ul class="margin-top--one text--gray">
                        <li>
                            <i class="icon icon-map"></i>
                            {{ currentTeacher.address.line }},
                            {{ currentTeacher.address.city }},
                            {{ currentTeacher.address.state }}
                        </li>
                        <li>
                            <i class="icon icon-phone"></i>
                            <span>{{ currentTeacher.phone }}</span>
                        </li>
                        <li>
                            <i class="icon icon-mail"></i>
                            <span>{{ currentTeacher.email }}</span>
                        </li>

                        <li>
                            <i class="icon icon-gift"></i>
                            <span>{{ currentTeacher.formatted_birthday }}</span>
                        </li>
                    </ul>
                </div>

                <div class="details__panel">
                    <header>
                        <h4>Estado</h4>
                        <p></p>
                    </header>

                    <Radio
                        v-model="currentTeacher.status"
                        class="margin-bottom--halve"
                        value="active"
                        label="Activo"
                    />

                    <Radio
                        v-model="currentTeacher.status"
                        value="inactive"
                        label="Inactivo"
                    />
                </div>
            </div>

            <Scores class="margin-top--one" :scores="currentTeacher.scores" />
        </article>

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="(teacher, index) in teachers"
                    :key="index"
                    @click="showDetails(teacher)"
                    :class="'is-' + teacher.status"
                >
                    <td>
                        <figure class="avatar image">
                            <img :src="teacher.avatar" />
                        </figure>
                    </td>
                    <td>{{ teacher.full_name }}</td>
                    <td>{{ teacher.email }}</td>
                    <td>{{ teacher.phone }}</td>
                    <td><Stars :value="teacher.starts" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['teachers'],

    data: () => ({
        currentTeacher: {},
        shouldShowDetails: false,
    }),

    computed: {
        status: () => ({
            fresh: 'nuevo',
            active: 'activo',
            inactive: 'inactivo',
        }),
    },

    watch: {
        currentTeacher: {
            deep: true,
            handler(newValue, oldValue) {
                if (newValue.id !== oldValue.id) return

                const { id, status } = newValue
                this.changeStatus(id, status)
            },
        },
    },

    methods: {
        showDetails(teacher) {
            this.currentTeacher = teacher
            this.shouldShowDetails = true
        },

        hideDetails() {
            this.currentTeacher = {}
            this.shouldShowDetails = false
        },

        async changeStatus(teacherId, status) {
            try {
                const url = route('teacher.status', teacherId)
                await this.$http.post(url, { status })
            } catch (error) {
                console.error(error.response || error)
            }
        },
    },
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

.avatar {
    @include size(40px);
    border-radius: 50%;
}

.details {
    position: relative;
    border: 1px solid color('gray', 50);
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 2rem;
}

.details__x {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 1.75rem;
    color: color('gray');
}

.details__body {
    display: flex;
}

.details__panel {
    border-left: 1px solid color('gray', 50);
    margin-left: 2rem;
    padding-left: 2rem;
}

.details__avatar {
    @include size(190px);
    border-radius: 5px;
}

table {
    width: 100%;
}

thead {
    border-bottom: 2px solid color('gray', 50);

    th {
        font-weight: get('bold', $font-weights);
        padding: 0.5rem 0.5rem;
        text-align: left;
    }
}

tbody tr {
    position: relative;
    cursor: pointer;

    &:hover {
        background: color('gray', 50, 0.15);
    }

    td {
        position: relative;
        border-bottom: 1px solid color('gray', 50);
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
    }
}

td:last-child:before {
    $size: 15px;

    content: '';
    position: absolute;
    top: 23px;
    right: 30px;

    background: transparent;
    @include size($size);

    border-radius: 50%;

    tr.is-fresh & {
        background: color('yellow');
    }

    tr.is-active & {
        background: color('green');
    }

    tr.is-inactive & {
        background: color('red');
    }
}
</style>
