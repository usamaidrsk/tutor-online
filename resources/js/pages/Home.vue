<template>
    <div>
        <div class="segment">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <figure class="segment__image">
                        <img src="/storage/images/student.png" alt="" />
                    </figure>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="segment__container">
                        <h2 class="segment__title">¿Eres estudiante?</h2>
                        <p class="segment__text">
                            Sube tus ejercicios de matemáticas, física o
                            química, y te contactaremos con docentes
                            especializados para desarrollarlos.
                        </p>

                        <Button
                            class="segment__button"
                            :href="route('asigment.create')"
                            >Crea tu propuesta</Button
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="segment">
            <div class="row">
                <div class="col-xs-12 col-sm-6 first-xs last-sm">
                    <figure class="segment__image">
                        <img src="/storage/images/teacher.png" alt="" />
                    </figure>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="segment__container">
                        <h2 class="segment__title">¿Eres docente?</h2>
                        <p class="segment__text">
                            Sé el mejor docente en tu materia, se evalúa tu
                            desempeño por tu paciencia en la clase, el escuchar
                            al alumno, y el uso adecuado de las tecnología.
                        </p>

                        <div>
                            <Button
                                class="segment__button"
                                :href="route('register')"
                                >Unete a nosotros</Button
                            >

                            <span class="separator">o</span>

                            <Button
                                class="segment__button"
                                :href="route('login')"
                                outline
                                >Inicia sesión</Button
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

.segment {
    margin-bottom: 3rem;
}

.segment__image {
    width: 90%;
    max-width: 100%;
    height: auto;
    position: relative;
    margin: 0 auto;
    border-radius: 66% 34% 63% 37% / 60% 29% 71% 40%;
    margin-bottom: 1rem;
    overflow: hidden;

    img {
        @include size(100%, auto);
        @include max-size(100%);
    }

    @include breakpoint('sm') {
        @include size(400px, 300px);
        border-radius: 25% 75% 37% 63% / 46% 24% 76% 54%;

        img {
            @include size(auto, 100%);
            @include max-size(100%);
        }
    }
}

.segment__container {
    height: 100%;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin: 0 auto;

    @include breakpoint('md') {
        padding: 0 2rem;
    }
}

.segment__title {
    margin-bottom: 0.5rem;
}

.segment__text {
    margin-bottom: 1.5rem;
}

.separator {
    display: block;
    margin: 0 0.5rem;
    color: color('gray');

    @include breakpoint('md') {
        display: inline;
    }
}
</style>
