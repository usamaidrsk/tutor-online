<template>
    <div>
        <h1 class="margin-bottom--three text--center">Docentes disponibles</h1>

        <div class="row">
            <div
                v-for="(teacher, index) in teachers"
                :key="index"
                class="col-xs-12 col-sm-6 col-md-4 margin-bottom--three"
            >
                <TeacherCard
                    :teacher="teacher"
                    @click.native="showModal(index)"
                />
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
                    <td>{{ asigment.created_at }}</td>
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
            @close="isModalVisible = false"
        />
    </div>
</template>

<script>
export default {
    props: {
        asigment: {
            required: true,
            type: Object,
        },
        teachers: {
            required: true,
            type: Array,
        },
    },

    data: () => ({
        currentTeacher: {},
        isModalVisible: false,
    }),

    methods: {
        showModal(index) {
            this.currentTeacher = this.teachers[index]
            this.isModalVisible = true
        },
    },
}
</script>

<style lang="scss" scoped>
hr {
    background: color('gray', 100);
    height: 1px;
    margin: get('two', $spacers);
}

.details {
    td:first-child {
        font-weight: get('bold', $font-weights);
        padding-right: get('one', $spacers);
    }
}
</style>
