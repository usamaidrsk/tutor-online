<template>
    <div class="questions">
        <component
            :is="'step-' + step"
            v-bind="props"
            :loading="loading"
            :errors="errors"
            @submit="handleSubmit"
        ></component>
    </div>
</template>

<script>
import Step1 from './_questions/1'
import Step2 from './_questions/2'
import Step3 from './_questions/3'
import Step4 from './_questions/4'

export default {
    components: {
        'step-1': Step1,
        'step-2': Step2,
        'step-3': Step3,
        'step-4': Step4,
    },

    props: {
        step: {
            type: Number,
            required: true,
        },
        TOTAL_STEPS: {
            type: Number,
            required: true,
        },
        props: {
            type: Object,
            required: true,
        },
    },

    data: () => ({ loading: false, errors: new ErrorBag() }),

    methods: {
        async handleSubmit(data) {
            if (this.loading) return

            this.loading = true
            this.errors.clear()

            try {
                const url = route('questions', this.step)
                await this.$http.post(url, data)
                window.location.href =
                    this.step < this.TOTAL_STEPS
                        ? route('questions', this.step + 1)
                        : route('profile.index')
            } catch (error) {
                console.log(error.response)
                if (error.response) {
                    window.scrollTo({ top: 0, behavior: 'smooth' })
                    const { errors } = error.response.data
                    this.errors.set(errors || {})
                }
            } finally {
                this.loading = false
            }
        },
    },
}
</script>

<style lang="scss" scoped>
@import '~@/sass/_globals.scss';

.questions {
    margin: 0 auto;

    @include breakpoint('md') {
        width: 85%;
    }
    @include breakpoint('lg') {
        width: 80%;
    }
}
</style>
