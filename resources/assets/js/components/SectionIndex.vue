<template>
    <div class="posts">
        <div v-if="sections.length">
            <div v-for="section in sections" class="card mb-3 post">
                <div class="card-body">
                    <h3 class="card-title mb-1">{{ section.section }}</h3>
                </div>
            </div>
            <div class="pager" v-if="pager.last_page > 1">
                <span v-for="n in pager.last_page">
                    <router-link :to="{ name: 'SectionIndex', query: {page : n }}">{{ n }}</router-link>&nbsp;
                </span>
            </div>
        </div>
        <div v-else-if="loading == true" class="center-block">
            Cargando Secciones ...
        </div>
        <div v-else class="center-block">
            No hay secciones
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: true,
                sections: [],
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
            init: function(page) {
                if (typeof(page) === 'undefined') {
                    page = 1;
                }
                this.getTags(page);
            },
            getTags: function(page) {
                var url = '/api/section?page=' + page;
                this.loading = true;
                axios.get(url).then(response => {
                    this.sections = response.data.data
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
