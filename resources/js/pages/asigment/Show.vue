<template>
    <div>
        <template v-if="teachers.length">
            <h1 class="margin-bottom--three text--center">
                Docentes disponibles
            </h1>

            <div class="row justify-content-center">
                <div
                    v-for="(teacher, index) in teachers"
                    :key="index"
                    class="col-xs-6 col-sm-3 col-md-3 margin-bottom--three"
                >
                    <TeacherCard
                        :teacher="teacher"
                        @click.native="showModal(index)"
                    />
                </div>
            </div>
        </template>

        <div v-else class="placeholder">
            <div>
                <h1 class="margin-bottom--zero">No hay docentes disponibles</h1>
                <p>
                    Por los momentos ningún docente a respondido a tu propuesta,
                    ten paciencia.
                </p>
            </div>
        </div>

        <hr />

        <div class="container">
            <h2>Tu propuesta</h2>
            <table class="details">
                <tr>
                    <td>Materia:</td>
                    <td>{{ asigment.category.name }}</td>
                </tr>
                <tr>
                    <td>Nivel:</td>
                    <td>{{ asigment.level.name }}</td>
                </tr>
                <tr>
                    <td>Presupuesto:</td>
                    <td>${{ asigment.budget }}</td>
                </tr>
                <tr>
                    <td>Fecha:</td>
                    <td>{{ asigment.formated_date }}</td>
                </tr>
                <tr>
                    <td>Detalles:</td>
                    <td>{{ asigment.details }}</td>
                </tr>
            </table>

            <h4 class="margin-top--one">Archivos</h4>

            <div>
                <File
                    v-for="(file, index) in asigment.files"
                    :key="index"
                    :file="file"
                    readonly
                />
            </div>
        </div>

        <TeacherModal
            :teacher="currentTeacher"
            :is-visible="isModalVisible"
            @click="handleModalClick"
            @close="isModalVisible = false"
        />
    </div>
</template>

<script>
export default {
    props: ['asigment', 'teachers'],

    data: () => ({
        currentTeacher: {},
        isModalVisible: false,
    }),

    methods: {
        async handleModalClick() {
            const { id } = this.currentTeacher
            window.location.href = route('payment.index', { teacher_id: id })
        },

        showModal(index) {
            this.currentTeacher = this.teachers[index]
            this.isModalVisible = true
        },
    },
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

hr {
    background: color('gray', 100);
    height: 1px;
    margin: get('two', $spacers);
}

.placeholder {
    height: 50vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.details {
    td:first-child {
        font-weight: get('bold', $font-weights);
        padding-right: get('one', $spacers);
    }
}
</style>
