<template>
    <div>
        <div id="jitsi"></div>
    </div>
</template>

<script>
export default {
    props: ['roomName', 'displayName', 'asigment', 'teacher'],

    mounted() {
        const script = document.createElement('script')
        script.onload = () => this.setup()
        script.src = 'https://meet.jit.si/external_api.js'
        script.async = true
        document.head.appendChild(script)
    },

    methods: {
        setup() {
            try {
                const domain = 'meet.jit.si'
                const options = {
                    roomName: this.roomName,
                    parentNode: this.$el.querySelector('#jitsi'),
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
#jitsi {
    width: 100%;
    height: 100vh;
}
</style>
