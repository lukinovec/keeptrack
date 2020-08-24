/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import VueRouter from 'vue-router';
import Vuex from 'vuex'
import routes from './routes';
import axios from 'axios';
import _ from 'lodash';
import SearchBar from './components/SearchBar.vue';
import NavBar from './components/NavBar.vue';
import LoginComponent from './components/auth/LoginComponent.vue';
import xml2json from './xmlToJSON';

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.component('search-bar', SearchBar);

let router = new VueRouter(routes);

const store = new Vuex.Store({
    state: {
        searchResults: {},
        user: null
    },
    mutations: {
        // Auth
        setUserData(state, userData) {
            state.user = userData
            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
        },

        clearUserData() {
            localStorage.removeItem('user')
            location.reload()
        },

        // Search
        gotResults(state, payload) {
            state.searchResults = [...payload]
        },
    },

    actions: {
        // Auth
        async login({ commit }, credentials) {
            const { data } = await axios
                .post('/login', credentials);
            commit('setUserData', data);
        },

        logout({ commit }) {
            commit('clearUserData')
        },

        // Search
        makeSearch: _.throttle(({ commit }, payload) => {
            // Search for a movie or a show
            if (payload.type === "movie") {
                axios.post(`https://www.omdbapi.com/?apikey=22d5a333&s=${payload.title}`)
                    .then(response => {
                        // Shows often have directors in the writer field for some reason, this is the treatment:
                        response.data["Search"].forEach(result => {
                            result["Director"] === "N/A" ? result["Director"] = result["Writer"] : ""
                        });
                        response.data["Search"].searchtype = "movie";
                        commit('gotResults', response.data["Search"])
                    })
                    .catch(err => console.log(err))
                // Search for a book
            } else if (payload.type === "book") {
                // Process the title so it's readable for the GoodReads API
                let result = [];
                for (let i = 0; i < payload.title.length; i++) {
                    payload.title[i] === " " ? result.push("+") : result.push(payload.title[i]);
                    i === (payload.title.length - 1) ? payload.title = result.join("") : "";
                }
                // Post the search
                axios.post(`http://cors-anywhere.herokuapp.com/https://www.goodreads.com/search/index.xml?key=FD5YvIsvRnGRKmSPcZxt6g&q=${payload.title}`)
                    .then(response => {
                        response = JSON.parse(xml2json(response.data, "  "));
                        response.GoodreadsResponse.search.results.work.searchtype = "book";
                        commit('gotResults', response.GoodreadsResponse.search.results.work);
                    })
                    .catch(err => console.log(err))
            }
        }, 1500)
    },

    getters: {
        isLogged: state => !!state.user
    }
});

const app = new Vue({
    components: {
        SearchBar,
        NavBar
    },
    el: '#app',
    router,
    store
});
