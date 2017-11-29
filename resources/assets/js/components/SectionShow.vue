<template>
    <div class="sections">
        <div v-if="section">
            <strong>Sección:</strong>
            <span class="section">
                {{ section.section }}
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['section'],
    }
</script>
