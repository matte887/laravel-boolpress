<template>
  <div class="container">
    <div class="my-5" v-if="post">
      <h2>{{ post.title }}</h2>
      <p>Categoria: {{ getCategory }}</p>
      <div>
        <p>Tags:</p>
        <ul>
          <li v-for="(tag, id) in post.tags" :key="id">
            <router-link :to="{ name: 'single-tag', params: { slug: tag.slug } }">{{ tag.name }}</router-link>
          </li>
        </ul>
      </div>
      <img v-if="post.cover" :src="post.cover" alt="post-cover">
      <p>{{ post.content }}</p>
    </div>
    <div class="my-5" v-else>
      <h2>Loading...</h2>
    </div>
  </div>
</template>

<script>
export default {
  name: "SinglePost",
  data() {
    return {
      post: null,
    };
  },
  created() {
    this.getPostData();
  },
  computed: {
    getCategory() {
      return this.post.category
        ? this.post.category.name
        : "nessuna categoria selezionata.";
    },
  },
  methods: {
    getPostData() {
      // console.log(this.$route.params.slug);
      axios.get(`/api/post/${this.$route.params.slug}`).then((resp) => {
        // console.log(resp.data.results);
        this.post = resp.data.results;
      });
    },
  },
};
</script>

<style>
</style>