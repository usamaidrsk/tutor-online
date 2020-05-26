<template>
    <div>
        <section class="segment">
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
                            química, y te contactaremos con tutores
                            especializados para desarrollarlos.
                        </p>

                        <Button
                            class="segment__button"
                            :href="route('register', { type: 'student' })"
                            >Crea tu propuesta</Button
                        >
                    </div>
                </div>
            </div>
        </section>

        <section class="segment">
            <div class="row">
                <div class="col-xs-12 col-sm-6 first-xs last-sm">
                    <figure class="segment__image">
                        <img src="/storage/images/teacher.png" alt="" />
                    </figure>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="segment__container">
                        <h2 class="segment__title">¿Quieres enseñar?</h2>
                        <p class="segment__text">
                            Sé nuestro mejor tutor en matemáticas, física, y
                            química, se evaluará tu paciencia en la clase, el
                            escuchar al alumno, y el uso adecuado de las
                            tecnologías.
                        </p>

                        <div>
                            <Button
                                class="segment__button"
                                :href="route('register', { type: 'teacher' })"
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
        </section>

        <section class="contact">
            <header class="margin-bottom--two">
                <h1 class="margin-bottom--zero">Contactanos</h1>
                <p>
                    No dudes en contactarnos si tienes alguna duda o si tienes
                    algo que decirnos.
                </p>
            </header>

            <ul class="contact__info">
                <li>
                    <i class="icon icon-phone"></i>
                    <a href="tel:+51-920279242">+51-920279242</a>
                </li>

                <li>
                    <i class="icon icon-mail"></i>
                    <a href="mailto:admin@mathias20.com">admin@mathias20.com</a>
                </li>
            </ul>
        </section>
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

.contact {
    border-top: 1px solid color('gray', 50);
    padding-top: 2rem;
    margin-top: 2rem;
}

.contact__info {
    text-align: left;

    li {
    }

    .icon {
        vertical-align: middle;
        margin-right: 0.25rem;
        color: color('primary');
        font-size: 1.5rem;
    }
}
</style>
