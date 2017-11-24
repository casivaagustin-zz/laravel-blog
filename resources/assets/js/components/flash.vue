<template>
     <div class="alert" v-bind:class="classNames">
        <ul>
            <li v-for="(item, key) in messages.items" :key="key">{{ item }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
      props: ['messages'],
      computed: {
        classNames: function() {
          return {
              'alert-success': this.messages.type === 'ok' ?  true : false,
              'alert-danger': this.messages.type === 'error' ?  true : false,
          }
        }
      }
    }
</script>