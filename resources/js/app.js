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

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(Vuex);


let router = new VueRouter(routes);

const store = new Vuex.Store({
    state: {
        searchResults: {},
    },
    mutations: {
        gotResults(state, payload) {
            state.searchResults = [...payload]
        },
    },
    actions: {
        makeSearch: _.throttle(({ commit }, payload) => {
            // Search for a movie or a show
            if (payload.type === "movie") {
                axios.post(`https://www.omdbapi.com/?apikey=22d5a333&s=${payload.title}`)
                    .then(response => {
                        // Shows often have directors in the writer field for some reason, this is the treatment:
                        response.data["Search"].forEach(result => {
                            result["Director"] === "N/A" ? result["Director"] = result["Writer"] : ""
                        });
                        commit('gotResults', response.data["Search"])
                    })
                    .catch(err => console.log(err))
            }
        }, 1500)
    }
});

const app = new Vue({
    el: '#app',
    router,
    store
});
