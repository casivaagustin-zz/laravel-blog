<template>
    <div class="posts">
        <div v-if="post != null">
            <FlashesWidget v-if="msgs != null && msgs.items.length > 0" :messages="msgs"></FlashesWidget>
            <div class="card-body">
                <h1 class="card-title mb-1">
                    {{ post.title }}
                </h1>
                <div class="body">
                    {{ post.body }}
                </div>

                <FechaShow :fecha="post.created_at"></FechaShow>
                <SectionShow :section="post.section"></SectionShow>
                <TagsShow :tags="post.tags"></TagsShow>

                <div class="footer">
                    <a v-on:click="goBack" class="btn btn-default">Back</a>
                    <a class="btn btn-success" v-on:click="editPost">Edit</a>
                </div>
            </div>
            <div v-if="edit == true">
                <form class="form">
                    <div class="form-group">
                        <label for="input">Titulo:</label>
                        <input type="text" id="input" class="form-control" v-model="post.title" />
                    </div>
                    <div class="form-group">
                        <label for="input">Body:</label>
                        <textarea id="form_body" class="form-control" v-model="post.body">
                        </textarea>
                    </div>

                    <div class="actions">
                        <router-link to="/" class="btn btn-default">Cancel</router-link>
                        <a class="btn btn-warning" v-on:click="deletePost">Delete</a>
                        <a class="btn btn-success" v-on:click="savePost">Save</a>
                    </div>
                </form>
            </div>
        </div>
        <div v-else>
            Cargando ...
        </div>
    </div>
</template>

<script>
    import FlashesWidget from './flash';
    import SectionShow from './SectionShow';
    import TagsShow from './TagsShow.vue';
    import FechaShow from './FechaShow.vue';


    export default {
        components: {
            FlashesWidget,
            SectionShow,
            TagsShow,
            FechaShow
        },
        props: ['id'],
        data() {
            return {
                "loading": true,
                "post": null,
                'edit': false,
                "msgs": null
            }
        },
        created: function(){
            this.getPost(this.id);
            this.loading = true;
        },
        methods: {
            editPost: function() {
              this.edit = !this.edit;
              this.msgs = null;
            },
            savePost: function() {
                const url = '/api/posts/' + this.post.id;

                axios.put(url, this.post).then(response => {
                    this.msgs = {
                        type: 'ok',
                        items: ['Post actualizado'],
                    };
                    this.edit = false;
                }).catch((error) => {
                    this.msgs = {
                        type: 'error',
                        items: ['Error Guardando'],
                    };
                    console.info(error.message);
                    this.edit = false;
                });
            },
            deletePost: function() {
                if (confirm('Are you sure?')) {
                    const url = '/api/posts/' + this.post.id;

                    axios.delete(url).then(response => {
                        this.$router.push('/');
                    }).catch((error) => {
                        this.msgs = {
                            type: 'error',
                            items: ['Error Borrando'],
                        };
                        console.info(error.message);
                    });
                }
            },
            getPost: function(id) {
                var url = '/api/posts/' + id;
                this.loading = true;
                axios.get(url).then(response => {
                    this.post = response.data;
                    this.loading = false;
                }).catch((error) => {
                    console.error(error);
                    this.loading = false;
                });
            },
            goBack: function() {
                window.history.back();
            }
        }
    }
</script>
