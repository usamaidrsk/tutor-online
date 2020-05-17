<template>
    <div class="hero row">
        <div class="hero__left col-xs-12 col-sm-6">
            <img class="hero__image" src="/storage/images/student.png" alt="" />

            <h2 class="hero__header">¿Eres estudiante?</h2>
            <p class="hero__text">
                ¿Tienes problemas con una materia? Sube tus ejercicios de
                matemáticas, física o química y te contactaremos con los mejores
                docentes en la materia.
            </p>

            <Button class="hero__button" :href="route('asigment.create')" block
                >Crea tu propuesta</Button
            >
        </div>
        <div class="hero__right col-xs-12 col-sm-6">
            <img class="hero__image" src="/storage/images/teacher.png" alt="" />

            <h2 class="hero__header">¿Eres docente?</h2>
            <p class="hero__text">
                Sé el mejor docente en tu materia, se evalua el desempeño en
                base a tu paciencia, la escucha al alumno y el uso de adecuado
                de las tecnologías.
            </p>

            <Button class="hero__button" :href="route('register')" block
                >Unete a nosotros</Button
            >

            <p class="hero__separator">o</p>

            <Button class="hero__button" :href="route('login')" block outline
                >Inicia sesión</Button
            >
        </div>
    </div>
</template>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

.hero {
    min-height: 100vh;
}

.hero__left,
.hero__right {
    text-align: center;
    padding-top: 2.5rem;
    padding-bottom: 2.5rem;
    @include breakpoint('sm') {
        padding: 0 2.5rem;
    }
}

.hero__left {
    $border-style: 1px solid color('gray', 50);
    border-bottom: $border-style;

    @include breakpoint('sm') {
        border: 0;
        border-right: $border-style;
    }
}

.hero__image {
    max-height: 300px;
    max-width: 100%;
    width: auto;
    margin-bottom: 1rem;
}

.hero__header {
    margin-bottom: 0.5rem;
}

.hero__text {
    min-height: 100px;
    margin-bottom: 1rem;
}

.hero__separator {
    display: block;
    margin: 0.5rem 0;
    color: color('gray');
}
</style>
