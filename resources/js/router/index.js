
import { createWebHistory, createRouter } from "vue-router"
import Home from "../components/Home"

import Auth from "../components/Auth/Auth"
import Register from "../components/Auth/Register"
import Login from "../components/Auth/Login"

import Admin from "../components/Admin/Admin"
import AdminDashboard from "../components/Admin/Dashboard"
import AdminAddMode from "../components/Admin/AddMode"
import AdminAllModes from "../components/Admin/AllModes"

import Player from "../components/Player/Player"
import Dashboard from "../components/Player/Dashboard"


const routes = [
    {
        path: '/',
        component: Home,
        name: 'Home'
    },
    {
        path: '/auth/',
        component: Auth,
        children: [
            {
                path: 'register',
                component: Register,
                name: 'Register'
            },
            {
                path: '',
                component: Login,
                name: 'Login'
            },
        ]
    },
    {
        path: '/player/',
        component: Player,
        beforeEnter: (to, from, next) => {
            axios.get('/api/authentificated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        },
        children: [
            {
                path: '',
                component: Dashboard,
                name: 'Dashboard',

            },
        ]
    },

    {
        path: '/admin/',
        component: Admin,
        beforeEnter: (to, from, next) => {
            axios.get('/api/authentificated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        },
        children: [
            {
                path: '',
                component: AdminDashboard,
                name: 'AdminDashboard'
            },
            {
                path: 'all-modes',
                component: AdminAllModes,
                name: 'AdminAllModes'
            },
            {
                path: 'add-mode',
                component: AdminAddMode,
                name: 'AdminAddMode'
            },
        ]
    }

]


const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
