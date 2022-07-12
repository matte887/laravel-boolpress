<template>
  <div class="container">
    <h2 class="text-center my-3">Lista Ricette</h2>
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
  </div>
</template>

<script>
import Axios from "axios";

export default {
  name: "Posts",
  data() {
    return {
      posts: [],
    };
  },
  created() {
    this.getPosts();
  },
  methods: {
    getPosts() {
      Axios.get("/api/posts").then((resp) => {
        this.posts = resp.data.results;
      });
    },
    trimText(text, maxCharNum) {
        if (text.length > maxCharNum) {
            return text.substring(0, maxCharNum) + '...';
        }
        return text;
    }
  },
};
</script>

<style>
</style>