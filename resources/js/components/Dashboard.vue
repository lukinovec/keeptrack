<template>
  <div>
    <input
      @input="getTitle"
      class="border border-black"
      :value="title"
      type="text"
      placeholder="Search"
    />
    <label for="searchtype">Search type</label>
    <select @change="getType" name="searchtype" id="searchtype">
      <option value="movie">TV / Movie</option>
      <option value="book">Book</option>
    </select>
    <button @click="submitSearch">Submit</button>
    <div class="results">
      <div v-for="result in searchResults" :key="result.imdbID" class="result">
        <img :src="result.Poster" alt="poster" />
        <h1>{{ result.Title }}</h1>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "",
      searchtype: "movie",
      debug: "nothing",
    };
  },
  methods: {
    getType(e) {
      this.searchtype = e.target.value;
    },

    getTitle(e) {
      this.title = e.target.value;
    },

    submitSearch() {
      this.$store.dispatch("makeSearch", {
        title: this.title,
        type: this.searchtype,
      });
    },
  },
  computed: {
    searchResults() {
      return this.$store.state.searchResults;
    },
  },
};
</script>

<style>
</style>