<template>
  <div>
    <div class="col-sm-2 addto dropdown">
      <div aria-labelledby="dropdownMenuButton" class="dropdown-menu">
        <a status="Plan To Watch" class="dropdown-item">Plan To Watch</a>
        <a status="Currently Watching" class="dropdown-item">Currently Watching</a>
        <a status="Completed" class="dropdown-item">Completed</a>
      </div>
      <button
        type="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        class="btn dropdown-toggle btn-success"
      >Completed</button>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
