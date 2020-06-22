<template>
  <div>
    <form class="form-inline my-2 my-lg-0" id="navBarSearchForm">
      <input
        class="form-control mr-sm-2"
        type="search"
        placeholder="Search"
        id="searchinput"
        aria-label="Search"
        v-model="searchinput"
      />
      <select class="form-control mr-1" id="form-select">
        <option id="movies">Movies & Shows</option>
        <option id="books">Books</option>
      </select>
    </form>
  </div>
</template>

<script>
import { store } from "../app.js";
export default {
  data: function() {
    return {
      searchinput: ""
    };
  },

  watch: {
    searchinput: "updateSearch"
  },

  methods: {
    updateSearch: function() {
      this.searchinput.length > 2
        ? store.mutateSearch(this.searchinput)
        : console.log("Minimum 3 characters required to search");
    }
  }
};
</script>

<style>
</style>