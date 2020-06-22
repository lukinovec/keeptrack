<template>
  <div>
    <div class="col-sm-4 searchresults">
      <h4>{{ movie.name }}</h4>
    </div>
    <div class="col-sm-1 poster">
      <img :src="movie.img" width="40px" />
    </div>
    <div class="col-sm-3 director">
      <h4>{{ movie.author }}</h4>
    </div>
    <div class="col-sm-2 rating">
      <h4>{{ movie.rating }} / 10</h4>
    </div>
    <AddToList />
  </div>
</template>

<script>
import AddToList from "./AddToList.vue";
export default {
  components: {
    AddToList
  },
  props: ["result"],
  data: function() {
    return {
      movie: this.result
    };
  }
};
</script>
