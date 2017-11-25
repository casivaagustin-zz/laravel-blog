<template>
  <div class="form-group">
      <label for="body">{{ label }}</label>
      <textarea id="body" class="form-control" v-on:input="updateValue" :class="clase"></textarea>
      <div class="invalid-feedback" v-show="conError">Required.</div>
    </div>
</template>

<script>
    export default {
      props: ['label', 'conError'],
      computed: {
        clase() {
          return {
            'is-invalid': this.conError,
          }
        }
      },
      methods: {
        updateValue: function(event) {
          this.$emit('textareaValue', event.target.value);
        }
      }
    }
</script>