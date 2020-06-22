<template>
  <div>
    <div class="searches">
      <div class="row p-5">
        <div class="col-sm-4">Title</div>
        <div class="col-sm-1"></div>
        <div class="col-sm-3">Directed by</div>
        <div class="col-sm-2">IMDb Rating</div>
      </div>
      <hr class="line" />
    </div>
    <div class="m-5">
      <div :result="result" :key="`${index}`" v-for="(result, index) in results" class="movie">
        <Movie />
      </div>
    </div>
  </div>
</template>

<script>
import Movie from "./Movie.vue";
import { store } from "../app.js";
export default {
  components: {
    Movie
  },
  data: function() {
    return {
      results: store.state.results
    };
  }
};
</script>

<style>
</style>