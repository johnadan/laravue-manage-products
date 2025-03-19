<template>
    <div>
      <h2>Product List</h2>
      <div class="mb-3">
        <input v-model="keyword" placeholder="Search..." class="form-control d-inline w-auto me-2"/>
        <select v-model="filterCategory" class="form-select d-inline w-auto me-2">
          <option value="">All Categories</option>
          <option v-for="option in categories" :key="option" :value="option">{{ option }}</option>
        </select>
        <button @click="fetchProducts" class="btn btn-primary">Search</button>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Date and Time</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="products.data.length === 0">
                <td colspan="6" class="text-center">No Products found</td>
            </tr>
          <tr v-for="product in products.data" :key="product.id">
            <td>
            <!-- Check if product has an image -->
            <img
                v-if="product.images && product.images.length > 0"
                :src="`/storage/${product.images[0].image_path}`"
                alt="Product Image"
                style="max-height: 50px;"
            />
            </td>
            <td>{{ product.name }}</td>
            <td>{{ product.category }}</td>
            <td v-html="product.description"></td>
            <td>{{ product.date_time }}</td>
            <td>
              <router-link :to="`/products/edit/${product.id}`" class="btn btn-sm btn-warning me-1">Edit</router-link>
              <button @click="deleteProduct(product.id)" class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-between">
        <button v-if="products.prev_page_url" @click="changePage(products.current_page - 1)" class="btn btn-secondary">Prev</button>
        <button v-if="products.next_page_url" @click="changePage(products.current_page + 1)" class="btn btn-secondary">Next</button>
      </div>
    </div>
</template>

<script>
  export default {
    name: "ProductList",
    data() {
      return {
        products: { data: [] },
        keyword: '',
        filterCategory: '',
        categories: [
          'apparel/fashion',
          'electronics/gadgets',
          'beauty/care',
          'school/office supplies',
          'furniture/appliances'
        ]
      }
    },
    methods: {
      fetchProducts(page = 1) {
        let params = new URLSearchParams();
        if (this.keyword) params.append('keyword', this.keyword);
        if (this.filterCategory) params.append('category', this.filterCategory);
        params.append('page', page);

        // fetch(`/api/products?${params.toString()}`)
        fetch(`/api/products?${params.toString()}`, {
            headers: {
                'Accept': 'application/json',
            },
            credentials: 'include'
        })
          .then(response => response.json())
          .then(data => { this.products = data; });
      },
      changePage(page) {
        this.fetchProducts(page);
      },
      deleteProduct(id) {
        if (confirm("Are you sure you want to delete this product?")) {
          fetch(`/api/products/${id}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Accept': 'application/json'
            },
            credentials: 'include'
          }).then(response => {
            if(response.ok) this.fetchProducts();
          });
        }
      }
    },
    mounted() {
      this.fetchProducts();
    }
  }
</script>
