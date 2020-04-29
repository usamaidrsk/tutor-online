<template>
    <div>
        <div class="row">
            <div class="col-sm-4">
                <img :src="`/storage/${picture}`" alt="" />
                <figure class="picture image">
                </figure>
            </div>

            <div class="col-sm-8">
                <h2 class="margin-bottom--zero">{{ full_name }}</h2>

                <ul class="text--gray">
                    <li>
                        <i class="icon icon-map"></i>
                        <!-- {{ address }} -->
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
    </div>
</template>

<script>
export default {
    props: {
        teacher: {
            type: Object,
            required: true,
        },
    },

    data: ({ teacher }) => ({ ...teacher }),
}
</script>
