<template>
    <div class="tags">
        <div v-if="tags.length">
            <strong>Tags: </strong>
            <span v-for="tag in tags" class="tags">
                <span class="tag">
                    {{ tag.tag }}
                </span>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tags'],
    }
</script>
