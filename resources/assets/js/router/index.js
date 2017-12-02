import Vue from 'vue';
import Router from 'vue-router';

import PostIndex from '../components/PostIndex';
import PostView from '../components/PostView';
import PostForm from '../components/PostCreate';
import SectionIndex from '../components/SectionIndex';
import TagIndex from '../components/TagIndex';

Vue.use(Router);

export default new Router({
   routes: [
       {
           path: '/',
           name: 'home',
           component: PostIndex,
       },
       {
           path: '/post',
           name: 'PostIndex',
           props: true,
           component: PostIndex,
           children: [
               {
                   path: 'create',
                   name: 'PostForm',
                   component: PostForm
               },
               {
                   path: 'show/:id',
                   name: 'PostView',
                   props: true ,
                   component: PostView
               }
           ],
       },
       {
           path: '/sections',
           name: 'SectionIndex',
           props: true,
           component: SectionIndex
       },
       {
           path: '/tags',
           name: 'TagIndex',
           props: true,
           component: TagIndex
       },
   ]
});
