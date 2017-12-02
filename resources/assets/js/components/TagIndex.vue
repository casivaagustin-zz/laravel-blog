<template>
    <div class="posts">
        <div v-if="tags.length">
            <div v-for="tag in tags" class="card mb-3 post">
                <div class="card-body">
                    <h3 class="card-title mb-1">{{ tag.tag }}</h3>
                </div>
            </div>
            <div class="pager" v-show="pager.last_page > 1">
                <span v-for="n in pager.last_page">
                    <router-link :to="{ name: 'TagIndex', query: { page : n }}">{{ n }}</router-link>&nbsp;
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
    export default {
        data() {
            return {
                loading: true,
                tags: [],
                pager: null
            }
        },
        created: function() {
            this.init();
        },
        watch: {
            '$route'(to, from) {
              this.init(to.query.page);
            }
        },
        methods: {
            init: function(page) {;

                if (typeof(this.page) === 'undefined') {
                    page = 1;
                }
                this.getTags(page);
            },
            getTags: function(page) {
                var url = '/api/tags?page=' + page;
                this.loading = true;
                axios.get(url).then(response => {
                    console.log(response);
                    this.tags = response.data.data
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
