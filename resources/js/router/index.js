import { createRouter, createWebHistory } from 'vue-router';

import HomeIndex from '../components/home/Index.vue'
import NotFound from '../components/NotFound.vue'

import Login from '../components/auth/Login.vue'
import Register from '../components/auth/Register.vue'

import TaskStatus from '../components/pages/status/Index.vue';
import NewTaskStatus from '../components/pages/status/Create.vue';
import EditTaskStatus from '../components/pages/status/Edit.vue';

import NewTask from '../components/pages/tasks/Create.vue'


const routes = [

    //auth routes
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: {
            requiresAuth: false,
        }
    },

    {
        path: '/',
        name: 'Home',
        component: HomeIndex,
        meta: {
            requiresAuth: true,
        }
    },


    {
        path: '/task/new',
        name: 'NewTask',
        component: NewTask,
        meta: {
            requiresAuth: true,
        }
    },

    //status
    {
        path: '/task-status',
        name: 'TaskStatus',
        component: TaskStatus,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/task-status/:id',
        name: 'EditTaskStatus',
        component: EditTaskStatus,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/task-status/new',
        name: 'NewTaskStatus',
        component: NewTaskStatus,
        meta: {
            requiresAuth: true,
        }
    },

    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound,
        meta: {
            requiresAuth: false,
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from) => {
    if(to.meta.requiresAuth && !localStorage.getItem('token')) {
        return {name: 'Login'}
    }
})

export default router
