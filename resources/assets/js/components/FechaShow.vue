<template>
    <div class="date">
        <div v-if="fecha">
            <strong>Fecha:</strong> {{ formattedDate }}
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        props: ['fecha'],
        computed: {
            // a computed getter
            formattedDate: function () {
                return moment(this.fecha).format('DD-MM-YYYY hh:mm');
            }
        }
    }
</script>
