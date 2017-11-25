<template>
    <div class="form-group">
      <label for="input">{{ label }}:</label>
      <input type="text" id="input" class="form-control" v-on:input="updateValue" :class="clase" />
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
          this.$emit('inputValue', event.target.value);
        }
      }
    }
</script>