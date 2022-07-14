<template>
  <div class="container">
    <h2>Pagina singolo tag</h2>
    <div class="row row-cols-3">
      <div class="col" v-for="post in posts" :key="post.id">
        <PostCard :post="post" />
      </div>
    </div>
  </div>
</template>

<script>
import PostCard from "../components/PostCard.vue";
export default {
  name: "SingleTag",
  data() {
    return {
      posts: null,
    };
  },
  components: {
    PostCard,
  },
  created() {
    this.getTagPosts();
  },
  methods: {
    getTagPosts() {
      axios.get(`/api/tag/${this.$route.params.slug}`).then((resp) => {
        // console.log(resp.data.tags_posts.posts);
        this.posts = resp.data.tags_posts.posts;
      });
    },
  },
};
</script>

<style>
</style>