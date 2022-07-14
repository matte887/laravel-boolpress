<template>
  <div>
    <h2 class="text-center my-3">Lista Ricette</h2>
    <p>
      Qui troverete tutte le nostre ricette. Non sono molte, ma sono tutte
      buone!
    </p>
    <p>Totale post: {{ totalPosts }}.</p>
    <div>
      <span class="mr-3">Post per pagina:</span>
      <select
        class="custom-select w-auto"
        @change="getPosts(1)"
        v-model="postPerPage"
      >
        <option value="3">3</option>
        <option value="6">6</option>
        <option value="9">9</option>
      </select>
    </div>
    <div class="row row-cols-3">
      <div class="col" v-for="post in posts" :key="post.id">
        <PostCard :post="post"/>
      </div>
    </div>
    <nav aria-label="...">
      <ul class="pagination">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <a
            class="page-link"
            href="#"
            @click="getPosts(currentPage - 1)"
            tabindex="-1"
            >Previous</a
          >
        </li>
        <li
          v-for="n in lastPage"
          :key="n"
          class="page-item"
          :class="{ active: n === currentPage }"
        >
          <a class="page-link" href="#" @click="getPosts(n)"
            >{{ n }}<span class="sr-only">(current)</span></a
          >
        </li>
        <li
          class="page-item"
          :class="currentPage === lastPage ? 'disabled' : ''"
        >
          <!-- Modalità alternativa -->
          <!-- <li class="page-item" :class="{ disabled: currentPage === lastPage }"></li> -->
          <a class="page-link" href="#" @click="getPosts(currentPage + 1)"
            >Next</a
          >
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import Axios from "axios";
import PostCard from "./PostCard.vue";

export default {
  name: "Posts",
  components: {
    PostCard
  },
  data() {
    return {
      posts: [],
      currentPage: 1,
      lastPage: 0,
      totalPosts: 0,
      postPerPage: 9,
    };
  },
  created() {
    this.getPosts(1);
  },
  methods: {
    getPosts(pageNumber) {
      Axios.get("/api/posts", {
        params: {
          page: pageNumber,
          posts_per_page: this.postPerPage,
        },
      }).then((resp) => {
        this.posts = resp.data.results.data;
        this.currentPage = resp.data.results.current_page;
        this.lastPage = resp.data.results.last_page;
        this.totalPosts = resp.data.results.total;
      });
    }
  },
};
</script>

<style>
</style>