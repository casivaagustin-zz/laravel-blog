<template>
    <div class="form-group">
      <label for="select">{{ label }}</label>
        <select id="select" class="form-control" v-on:change="updateValue" :class="clase">
          <option value=""></option>
          <option v-for="option in opciones" v-bind:value="option.value">
            {{ option.text }}
          </option>
        </select>
        <div class="invalid-feedback" v-show="conError">Required.</div>
    </div>
</template>

<script>
    export default {
      props: ['label', 'opciones', 'conError'],
      computed: {
        clase() {
          return {
            'is-invalid': this.conError,
          }
        }
      },
      methods: {
        updateValue: function(event) {
          const text = this.opciones.filter( i => i.value == event.target.value );
          let selected = {
            value: event.target.value,
            text: '',
          };
          if (text.length > 0) {
            selected.text = text[0].text;
          }

          this.$emit('selectValue', selected);
        }
      }
    }
</script>