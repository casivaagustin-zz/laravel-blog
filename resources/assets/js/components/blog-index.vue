<template>
    <div class="posts">
        <div v-if="posts.length">
            <div v-for="post in posts" class="card mb-3 post">
                <div class="card-body">
                    <h3 class="card-title mb-1">
                        {{ post.title }}
                    </h3>
                    <div class="date mb-1">
                        <strong>Fecha:</strong> {{ post.created_at }}
                    </div>
                    <div class="footer">
                    </div>
                </div>
            </div>
            <div class="pager">
                <span v-for="n in pager.last_page">
                    <a v-on:click="getPosts(n)">{{ n }}</a>&nbsp;
                </span>
            </div>
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
                "posts": [],
                "pager": null
            }
        },
        created: function(){
            this.getPosts(1);
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            getPosts: function(page) {
                var url = '/api/posts?page=' + page;
                axios.get(url).then(response => {
                    console.log(response);
                    this.posts = response.data.data
                    this.pager = response.data;
                }).catch((error) => {
                    console.error(error);
                });
            }
        }
    }
</script>
