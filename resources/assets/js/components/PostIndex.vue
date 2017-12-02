<template>
    <div class="posts">
        <div v-if="loading == true" class="center-block">
            Cargando Posts ...
        </div>
        <div v-else-if="posts.length">
            <div v-for="post in posts" class="card mb-3 post">
                <div class="card-body" :id="post.id">
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
            <div class="pager" v-if="pager.last_page > 1">
                <span v-for="n in pager.last_page">
                    <router-link :to="{ name: 'PostIndex', query: { page : n } }">{{ n }}</router-link>
                    &nbsp;
                </span>
            </div>
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
        props: ['page'],
        components: {
            SectionShow,
            TagsShow,
            FechaShow
        },
        data() {
            return {
                loading: true,
                posts: [],
                pager: null
            }
        },
        created: function() {
            this.init();
        },
        watch: {
            '$route'(to, from) {
              this.init(to.query.page);
            },
        },
        methods: {
            init: function(page) {
                if (typeof(page) === 'undefined') {
                    page = 1;
                }
                this.getTags(page);
            },
            getTags: function(page) {
                var url = '/api/posts?page=' + page;
                this.loading = true;
                axios.get(url).then(response => {
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
