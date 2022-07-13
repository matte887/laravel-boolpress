<template>
  <div class="container">
    <h2 class="text-center my-3">Lista Ricette</h2>
    <p>Totale post: {{ totalPosts }}.</p>
    <div class="row row-cols-3">
      <div class="col" v-for="post in posts" :key="post.id">
        <div class="card my-3">
          <!-- <img class="card-img-top" src="..." alt="Card image cap" /> -->
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">
              {{ trimText(post.content, 50) }}
            </p>
          </div>
          <!-- <ul class="list-group list-group-flush">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Vestibulum at eros</li>
          </ul>
          <div class="card-body">
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div> -->
        </div>
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

export default {
  name: "Posts",
  data() {
    return {
      posts: [],
      currentPage: 1,
      lastPage: 0,
      totalPosts: 0,
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
        },
      }).then((resp) => {
        this.posts = resp.data.results.data;
        this.currentPage = resp.data.results.current_page;
        this.lastPage = resp.data.results.last_page;
        this.totalPosts = resp.data.results.total;
      });
    },
    trimText(text, maxCharNum) {
      if (text.length > maxCharNum) {
        return text.substring(0, maxCharNum) + "...";
      }
      return text;
    },
  },
};
</script>

<style>
</style>