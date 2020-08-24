import Dashboard from './components/Dashboard';
import SearchBar from './components/SearchBar';
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
            name: 'SearchBar',
            path: '/searchbar',
            component: SearchBar
        },
        {
            name: 'FoundResults',
            path: '/results/:type',
            component: FoundResults
        }
    ]
}