import Dashboard from './components/Dashboard';
import LoginComponent from './components/auth/LoginComponent';
import FoundResults from './components/FoundResults';

export default {
    mode: 'history',
    routes: [
        {
            name: 'Dashboard',
            path: '/',
            component: Dashboard,
        },
        {
            name: 'FoundResults',
            path: '/results/:type',
            component: FoundResults
        },
        {
            name: 'LoginComponent',
            path: '/login',
            component: LoginComponent
        }
    ]
}