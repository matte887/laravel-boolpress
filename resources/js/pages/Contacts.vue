<template>
  <div class="container my-5">
    <h2>Contattaci</h2>

    <div v-if="success" class="alerto alert-success">Messaggio inviato con successo</div>
    <form>
      <div class="form-group">
        <label for="email">Email address</label>
        <input
          type="email"
          class="form-control"
          id="email"
          v-model="email"
        />
        <div v_if="errors.email">
            <p v-for="(errorMessage, index) in errors.email" :key="index" class="text-danger">{{ errorMessage }}</p>
        </div>
      </div>
      <div class="form-group">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" v-model="name">
        <div v_if="errors.name">
            <p v-for="(errorMessage, index) in errors.name" :key="index" class="text-danger">{{ errorMessage }}</p>
        </div>
      </div>
      <div class="form-group">
        <label for="message">Messaggio</label>
        <textarea
          class="form-control"
          id="message"
          rows="5"
          v-model="message"
        ></textarea>
        <div v-if="loading">Invio in corso...</div>
        <div v_if="errors.message">
            <p v-for="(errorMessage, index) in errors.message" :key="index" class="text-danger">{{ errorMessage }}</p>
        </div>
      </div>

      <button  @click.prevent="sendContactRequest" type="submit" class="btn btn-primary" :disabled="loading">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "Contacts",
  data() {
    return {
        email: "",
        name: "",
        message: "",
        success: false,
        errors: {},
        loading: false
    }
  },
  methods: {
    sendContactRequest() {
        this.errors = {};
        this.loading = true;
        // nell'axios post i parametri vanno dentro la graffa senza "params"
        axios.post('/api/leads', {
            email: this.email,
            name: this.name,
            message: this.message
        })
        .then(resp=>{
            if(resp.data.success) {
                this.success = true;
                this.email = "";
                this.name = "";
                this.message = "";
            } else {
                this.success = false;
                this.errors = resp.data.errors;
            }
            this.loading = false;
        })
    }
  }


};
</script>

<style>
</style>