<template>
  <div class="container">
    <h1>Ciao, sono il front office</h1>
    <WorkInProgress />
  </div>
</template>

<script>
import WorkInProgress from "../components/WorkInProgress.vue";

export default {
  name: "app",
  components: {
    WorkInProgress
  }
};
</script>

<style>
</style>