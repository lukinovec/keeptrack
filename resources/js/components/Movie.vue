<template>
  <div>
    <div class="col-sm-4 searchresults">
      <h4>{{ result.name }}</h4>
    </div>
    <div class="col-sm-1 poster">
      <img src="{{ result.img }}" width="40px" />
    </div>
    <div class="col-sm-3 director">
      <h4>{{ result.author }}</h4>
    </div>
    <div class="col-sm-2 rating">
      <h4>{{ result.rating }} / 10</h4>
    </div>
    <AddToList />
  </div>
</template>

<script>
import AddToList from "./AddToList.vue";
export default {
  mounted() {
    console.log("AddToList mounted.");
  },
  data() {
    result: {
      name: "";
      img: "";
      author: "";
      rating: "";
      status: "";
    }
  }
};
</script>
