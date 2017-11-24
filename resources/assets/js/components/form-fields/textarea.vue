<template>
  <div class="form-group">
      <label for="body">{{ label }}</label>
      <textarea id="body" class="form-control" v-on:input="updateValue"></textarea>
    </div>
</template>

<script>
    export default {
      props: ['label'],
      methods: {
        updateValue: function(event) {
          this.$emit('textareaValue', event.target.value);
        }
      }
    }
</script>