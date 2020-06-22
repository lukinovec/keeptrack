/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

export let store = {
    debug: true,
    state: {
        message: 'Hello!',
        searchtype: 'movies',
        search: '',
        users_movies: [],
        results: {
            // placeholder/scaffolding
            result: {
                id: '',
                name: '',
                year: '',
                img: '',
                author: '',
                rating: '',
                status: ''
            }
        },
    },
    // Change state
    mutateSearch(newValue) {
        this.state.search = newValue;
    },
    setMessageAction(newValue) {
        if (this.debug) console.log('setMessageAction triggered with', newValue)
        this.state.message = newValue
    },
    clearMessageAction() {
        if (this.debug) console.log('clearMessageAction triggered')
        this.state.message = ''
    }
}

const app = new Vue({
    el: '#app',
    data: store.state,
    watch: {
        search: "getMovies"
    },
    methods: {
        isInList: function (siteid) {
            let result = "";
            this.users_movies.forEach(mov => {
                if (siteid == mov.id) {
                    result = mov.status;
                } else {
                    result = undefined;
                }
            });
            return result;
        },

        getMovies: function () {
            const users_movies = this.users_movies;
            const isInList = this.isInList;
            axios
                .post("search", { 'userinput': this.search, 'searchtype': this.searchtype })
                .then((response) => {
                    console.log(response);
                    if (this.searchtype == "movies") {
                        this.results = response.data["details"];
                        response.data["usermovies"].forEach(function (i) {
                            users_movies.push({ id: i.imdbID, status: i.status })
                        });
                        this.results = this.results.map(item => item.data);
                    } else if (this.searchtype == "books") {
                        this.results = response.data;
                        this.results.forEach(result => {
                            result.rating = result.average_rating;
                            result.siteid = result.id["0"];
                            result.year = result.original_publication_year["0"];
                            result.author = result.best_book.author.name;
                        });
                    }
                    this.results.forEach(result => this.results.result = isInList(result.id));
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    },

});
