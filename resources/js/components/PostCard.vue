<template>
  <div class="card my-3">
    <!-- Attenzione! la src qui sotto funziona solo perché nel controller abbiamo creato il path completo -->
    <img v-if="post.cover" class="card-img-top" :src="post.cover" alt="post-cover" />
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
          </ul> -->
    <div class="card-body">
      <router-link
        :to="{ name: 'single-post', params: { slug: post.slug } }"
        class="card-link"
        >Leggi ricetta</router-link
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "PostCard",
  props: {
    post: Object,
  },
  methods: {
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