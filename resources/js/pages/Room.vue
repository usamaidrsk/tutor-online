<template>
    <div>
        <!-- <div id="video-chat"></div> -->

        <div class="wrapper">
            <div class="text--center">
                <h3 class="text--gray text--light margin-bottom--zero">
                    La clase empezará en:
                </h3>
                <h1>{{ asigment.date }}</h1>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-6">
                <div class="text--center">
                    <h4 class="margin-bottom--zero">{{ teacher.full_name }}</h4>
                    <figure class="image picture">
                        <img :src="teacher.picture" />
                    </figure>
                    <Stars :value="teacher.starts" />
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="margin-bottom--zero">Detalles:</h5>
                <p>{{ asigment.details }}</p>

                <h5 class="margin-top--two margin-bottom--zero">
                    Archivos adjuntos:
                </h5>
                <File
                    v-for="(file, index) in asigment.files"
                    :key="index"
                    :file="file"
                    readonly
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['roomName', 'displayName', 'asigment', 'teacher'],

    methods: {
        importJitsi() {
            return new Promise(resolve => {
                const script = document.createElement('script')
                script.onload = () => resolve()
                script.src = 'https://meet.jit.si/external_api.js'
                script.async = true
                document.head.appendChild(script)
            })
        },

        async startVideoChat() {
            await this.importJitsi()

            try {
                const domain = 'meet.jit.si'
                const options = {
                    roomName: this.roomName,
                    parentNode: this.$el.querySelector('#video-chat'),
                    userInfo: { displayName: this.displayName },
                    devices: {
                        audioInput: '<deviceLabel>',
                        audioOutput: '<deviceLabel>',
                        videoInput: '<deviceLabel>',
                    },
                }

                const api = new JitsiMeetExternalAPI(domain, options)

                api.addEventListener('videoConferenceJoined', () => {
                    //
                })
            } catch (error) {
                console.error('Failed to setup Jitsi API:', error)
            }
        },
    },
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

#video-chat {
    width: 100%;
    height: 100vh;
}

.wrapper {
    height: 50vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

hr {
    height: 1px;
    background: color('gray', 50);
    margin: 3.5rem 0;
}

.picture {
    @include size(150px);

    margin: 0 auto;
    border-radius: 5px;
}
</style>
