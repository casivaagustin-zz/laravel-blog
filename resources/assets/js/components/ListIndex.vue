<template>
    <div class="posts">
        <div v-if="posts.length">
            <div class="col-md-6">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <td>ID</td>
                            <td>Titulo</td>
                        </thead>
                        <tr v-for="post in posts">
                            <td>
                                {{ post.id }}
                            </td>
                            <td v-on:click="openPost(post)">
                                {{ post.title }}
                            </td>
                        </tr>
                    </table>
                    <div class="pager">
                        <span v-for="n in pager.last_page">
                            <a class="btn btn-default" v-on:click="getPosts(n);">{{ n }}</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div v-if="selected_post">
                    <div class="card-body">
                        <h1 class="card-title mb-1">
                            {{ selected_post.title }}
                        </h1>
                        <div class="body">
                            {{ selected_post.body }}
                        </div>

                        <FechaShow :fecha="selected_post.created_at"></FechaShow>
                        <SectionShow :section="selected_post.section"></SectionShow>
                        <TagsShow :tags="selected_post.tags"></TagsShow>
                    </div>
                </div>
            </div>
        </div>
        <div v-else-if="loading == true" class="center-block">
            Cargando Posts ...
        </div>
        <div v-else class="center-block">
            No hay post
        </div>
    </div>
</template>

<style>
    table {
        background-color: #fff;
        border-radius: 10px;
    }
</style>

<script>

    import SectionShow from './SectionShow';
    import TagsShow from './TagsShow.vue';
    import FechaShow from './FechaShow.vue';

    export default {
        components: {
            SectionShow,
            TagsShow,
            FechaShow
        },
        props: ['page'],
        data() {
            return {
                "loading": true,
                "posts": [],
                "pager": null,
                "selected_post": null
            }
        },
        created: function() {
            this.init();
        },
        watch: {
            'page': function(old, newData) {
              this.init();
            }
        },
        methods: {
            init: function() {
                var page = 1;

                if (typeof(this.page) !== 'unidefined') {
                    page = this.page;
                }
                this.getPosts(page);
            },
            getPosts: function(page) {
                var url = '/api/posts?page=' + page;
                this.loading = true;
                axios.get(url).then(response => {
                    console.log(response);
                    this.posts = response.data.data
                    this.pager = response.data;
                    this.loading = false;
                }).catch((error) => {
                    console.error(error);
                    this.loading = false;
                });
            },
            openPost: function(post) {
                console.log(post);
                this.selected_post = post;
            }
        }
    }
</script>
