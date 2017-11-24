<template>
    <div class="form-group">
      <label for="input">{{ label }}:</label>
      <input type="text" id="input" class="form-control" v-on:input="updateValue"/>
    </div>
</template>

<script>
    export default {
      props: ['label'],
      methods: {
        updateValue: function(event) {
          this.$emit('inputValue', event.target.value);
        }
      }
    }
</script>