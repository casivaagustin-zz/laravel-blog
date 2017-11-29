<template>
    <div class="posts">
        <div v-if="posts.length">
            <div v-for="post in posts" class="card mb-3 post">
                <div class="card-body">
                    <h3 class="card-title mb-1">
                        <router-link :to="{ name: 'PostView', params: { id: post.id }}">
                            {{ post.title }}
                        </router-link>
                    </h3>

                    <FechaShow :fecha="post.created_at"></FechaShow>
                    <SectionShow :section="post.section"></SectionShow>
                    <TagsShow :tags="post.tags"></TagsShow>
                </div>
            </div>
            <div class="pager">
                <span v-for="n in pager.last_page">
                    <router-link :to="{ name: 'PostIndexPaged', params: {'page' : n }}">{{ n }}</router-link>&nbsp;
                </span>
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
                "pager": null
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
            }
        }
    }
</script>
