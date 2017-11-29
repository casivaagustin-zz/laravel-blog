<template>
  <div>
    <FlashesWidget v-show="showFlash" :messages="msgs" />
    <form class="form">
      <h3>Nuevo Post</h3>
      <InputWidget label="Titulo" v-on:inputValue="setTitle" :conError="errores.title"/>

      <TextareaWidget label="Cuerpo" v-on:textareaValue="setBody" :conError="errores.body" />

      <SelectWidget :opciones="sections" label="Secciones" v-on:selectValue="setSeccion" :conError="errores.section" />
      <div class="actions">
        <router-link to="/" class="btn btn-secondary">Cancel</router-link>
        <input class="btn btn-primary" v-on:click="createPost" value="Guardar"/>
        <input class="btn btn-info" v-on:click="showFlash = false" value="Reset"/>
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
          errores: {
            title: false,
            body: false,
            section: false,
          },
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
            this.sections = response.data.data.map( i => ({
              text: i.section,
              value: i.id
            }));
          }).catch((error) => {
            console.error(error);
          });
        },
        setTitle: function(value) {
          console.log('titulo', value, this.post)
          this.post.title = value;
        },
        setBody: function(value) {
          this.post.body = value;
        },
        setSeccion: function(value) {
          console.log('seccion', value, this.post)
          this.post.section = value.text;
        },
        createPost: function () {
          const url = '/api/posts';
          this.errores = {
            title: false,
            body: false,
            section: false,
          };
          axios.post(url, this.post).then(response => {
            this.msgs = {
              type: 'ok',
              items:['Post ' + response.data.title + ' guardado.'],
            };
            this.showFlash = true;
          }).catch((error) => {
            const respuesta = error.response.data;
            ['title', 'body', 'section'].forEach((i) => {
                this.errores[i] = false;
                if (respuesta.indexOf('The '+ i +' field is required.') >= 0) {
                  this.errores[i] = true;
                }
              });
            this.msgs = {
              type: 'error',
              items:['Error guardando el Post!'].concat(respuesta),
            };
            this.showFlash = true;
            console.info(error.response);
            console.info(error.message);
          });
        }
      }
    }
</script>
