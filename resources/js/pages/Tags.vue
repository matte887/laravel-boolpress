<template>
  <div class="container my-5">
    <h2>Lista tags</h2>
    <ul>
      <li v-for="tag in tags" :key="tag.id">
        <router-link :to="{ name: 'single-tag', params: { slug: tag.slug } }">{{ tag.name }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Tags",
  data() {
    return {
      tags: [],
    };
  },
  created() {
    this.getTagsList();
  },
  methods: {
    getTagsList() {
      axios.get("/api/tags").then((resp) => {
        // console.log(resp.data.tags);
        this.tags = resp.data.tags;
      });
    },
  },
};
</script>

<style>
</style>