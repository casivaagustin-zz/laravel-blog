import Vue from 'vue';
import Router from 'vue-router';

import PostIndex from '../components/PostIndex';
import PostView from '../components/PostView';
import PostForm from '../components/PostCreate';
import ListIndex from '../components/ListIndex';

Vue.use(Router);

export default new Router({
   routes: [
       {
           path: '/',
           name: 'PostIndex',
           component: PostIndex
       },
       {
           path: '/list',
           name: 'ListIndex',
           component: ListIndex
       },
       {
           path: '/:page',
           name: 'PostIndexPaged',
           props: true,
           component: PostIndex
       },
       {
           path: '/post/create',
           name: 'PostForm',
           component: PostForm
       },
       {
           path: '/post/:id',
           name: 'PostView',
           props: true,
           component: PostView
       }
   ]
});
