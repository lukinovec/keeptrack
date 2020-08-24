<template>
  <div>
    <div v-for="result in searchResults" :result="result" :key="result.imdbID" class="result">
      <div v-if="searchType === 'movie'">
        <img :src="result.Poster" alt="poster" />
        <h1>{{ result.Title }}</h1>
      </div>
      <div v-else>{{ result }}</div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    searchType() {
      return this.$route.params.searchtype;
    },
    searchResults() {
      return this.$store.state.searchResults;
    },
  },
};
</script>

<style>
</style>