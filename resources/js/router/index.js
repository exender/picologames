
import { createWebHistory, createRouter } from "vue-router"
import Home from "../components/Home"

import Auth from "../components/Auth/Auth"
import Register from "../components/Auth/Register"
import Login from "../components/Auth/Login"

import Admin from "../components/Admin/Admin"
import AdminDashboard from "../components/Admin/Dashboard"

import AdminAddMode from "../components/Admin/AddMode"
import AdminAllModes from "../components/Admin/AllModes"
import AdminEditMode from "../components/Admin/EditMode"

import AdminAddPiloco from "../components/Admin/AddPiloco"
import AdminAllPilocos from "../components/Admin/AllPilocos"
import AdminEditPiloco from "../components/Admin/EditPiloco"

import Player from "../components/Player/Player"
import Dashboard from "../components/Player/Dashboard"
import CreateRoom from "../components/Player/CreateRoom"
import PlayGameMode from "../components/Player/PlayGameMode"
import PlayGamePicolo from "../components/Player/PlayGamePicolo"


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
            {
                path: 'create-room',
                component: CreateRoom,
                name: 'CreateRoom',

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
            {
                path: 'play-game-mode',
                component: PlayGameMode,
                name: 'PlayGameMode',

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
            {
                path: 'play-game-picolo/:room&:gameId&:difficultyId',
                component: PlayGamePicolo,
                name: 'PlayGamePicolo',
                props: true

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
            {
                path: 'edit-mode/:id',
                component: AdminEditMode,
                name: 'AdminEditMode',
            },
            {
                path: 'all-pilocos',
                component: AdminAllPilocos,
                name: 'AdminAllPilocos'
            },
            {
                path: 'add-piloco',
                component: AdminAddPiloco,
                name: 'AdminAddPiloco'
            },
            {
                path: 'edit-piloco/:id',
                component: AdminEditPiloco,
                name: 'AdminEditPiloco',
            },
        ]
    }

]


const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
