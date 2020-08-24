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
  </div>
</template>

<script>
export default {
  name: "SearchBar",
  data() {
    return {
      title: "",
      searchtype: "movie",
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
      this.searchtype === "movie"
        ? this.$router.push("/results/imdb")
        : this.$router.push("/results/goodreads");
    },
  },
};
</script>

<style>
</style>