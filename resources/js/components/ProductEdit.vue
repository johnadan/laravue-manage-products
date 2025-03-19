<template>
    <div>
      <h2>Edit Product</h2>
      <form @submit.prevent="updateProduct">
        <div class="mb-3">
          <label>Name:</label>
          <input type="text" v-model="form.name" class="form-control" required />
        </div>
        <div class="mb-3">
          <label>Category:</label>
          <select v-model="form.category" class="form-select" required>
            <option disabled value="">Please select one</option>
            <option v-for="option in categories" :key="option" :value="option">{{ option }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Description:</label>
          <textarea v-model="form.description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
          <label>Date and Time:</label>
          <input type="datetime-local" v-model="form.date_time" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-success">Update</button>
      </form>
    </div>
</template>

<script>
  export default {
    name: "ProductEdit",
    data() {
      return {
        form: {
          name: '',
          category: '',
          description: '',
          date_time: ''
        },
        categories: [
          'apparel/fashion',
          'electronics/gadgets',
          'beauty/care',
          'school/office supplies',
          'furniture/appliances'
        ]
      }
    },
    mounted() {
      this.fetchProduct();
    },
    methods: {
      fetchProduct() {
        // fetch(`/api/products/${this.$route.params.id}`)
        fetch(`/api/products/${this.$route.params.id}`, {
            credentials: 'include'
        })
          .then(response => response.json())
          .then(data => { this.form = data; });
      },
      updateProduct() {
        fetch(`/api/products/${this.$route.params.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          credentials: 'include',
          body: JSON.stringify(this.form)
        })
        .then(response => response.json())
        .then(() => {
          this.$router.push('/products');
        })
        .catch(error => console.error('Error:', error));
      }
    }
  }
</script>
