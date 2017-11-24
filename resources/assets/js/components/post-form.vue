<template>
  <div>
    <FlashesWidget v-show="showFlash" :messages="msgs" />
    <form class="form">
      <h3>Nuevo Post</h3>
      <InputWidget label="Titulo" v-on:inputValue="setTitle"/>

      <TextareaWidget label="Cuerpo" v-on:textareaValue="setBody" />

      <SelectWidget :opciones="sections" label="Secciones" v-on:selectValue="setSeccion" />
      <div class="actions">
        <a href="/spa" class="btn btn-secondary">Cancel</a>
        <input class="btn btn-primary" v-on:click="createPost" value="Guardar"/>
      </div>
    </form>
  </div>
</template>

<script>
    import InputWidget from './form-fields/input';
    import TextareaWidget from './form-fields/textarea';
    import SelectWidget from './form-fields/select';
    import FlashesWidget from './flash';

    export default {
      components: {
        FlashesWidget,
        InputWidget,
        SelectWidget,
        TextareaWidget,
      },
      data() {
        return {
          showFlash: false,
          msgs:{
            type: 'ok',
            items: [],
          },
          sections:[],
          post: {
            title: '',
            body: '',
            section: '',
            tags: [],
          },
        }
      },
      created: function(){
        this.getSections();
      },
      methods: {
        getSections: function() {
          this.showFlash = false;
          axios.get('/api/section').then(response => {
            this.sections = response.data.data.map( i => ({ text: i.section, value: i.id}));
          }).catch((error) => {
            console.error(error);
          });
        },
        setTitle: function(value) {
          this.post.title = value;
        },
        setBody: function(value) {
          this.post.body = value;
        },
        setSeccion: function(value) {
          this.post.section = value.text;
        },
        createPost: function () {
          const url = '/api/posts';
          axios.post(url, this.post).then(response => {
            this.msgs = {
              type: 'ok',
              items:['Post ' + response.data.title + ' guardado.'],
            };
            this.showFlash = true;
          }).catch((error) => {
            this.msgs = {
              type: 'error',
              items:['Error guardando el Post!'].concat(error.response.data),
            };
            this.showFlash = true;
            console.info(error.response);
            console.info(error.message);
          });
        }
      }
    }
</script>
