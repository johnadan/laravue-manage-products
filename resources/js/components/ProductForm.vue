<template>
    <div>
      <h2>Create Product</h2>
      <div v-if="step === 1">
        <h3>Step 1: Product Details</h3>
        <form @submit.prevent="validateStep1">
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
            <!-- A textarea here acts as a placeholder for an HTML editor -->
            <textarea v-model="form.description" class="form-control" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Next</button>
        </form>
      </div>

      <div v-if="step === 2">
        <h3>Step 2: Upload Images</h3>
        <form @submit.prevent="validateStep2">
          <div class="mb-3">
            <label>Images:</label>
            <input type="file" multiple @change="handleFileUpload" class="form-control" />
          </div>
          <button type="button" @click="prevStep" class="btn btn-secondary me-2">Back</button>
          <button type="submit" class="btn btn-primary">Next</button>
        </form>
      </div>

      <div v-if="step === 3">
        <h3>Step 3: Set Date and Time</h3>
        <form @submit.prevent="submitProduct">
          <div class="mb-3">
            <label>Date and Time:</label>
            <input type="datetime-local" v-model="form.date_time" class="form-control" required />
          </div>
          <button type="button" @click="prevStep" class="btn btn-secondary me-2">Back</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
</template>

<script>
  export default {
    name: "ProductForm",
    data() {
      return {
        step: 1,
        form: {
          name: '',
          category: '',
          description: '',
          date_time: '',
          images: []
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
    methods: {
      validateStep1() {
        if(this.form.name && this.form.category && this.form.description) {
          this.step = 2;
        }
      },
      validateStep2() {
        if(this.form.images.length > 0) {
          this.step = 3;
        } else {
          alert("Please select at least one image.");
        }
      },
      prevStep() {
        if(this.step > 1) this.step--;
      },
      handleFileUpload(event) {
        this.form.images = event.target.files;
      },
      submitProduct() {
        let formData = new FormData();
        formData.append('name', this.form.name);
        formData.append('category', this.form.category);
        formData.append('description', this.form.description);
        formData.append('date_time', this.form.date_time);
        for (let i = 0; i < this.form.images.length; i++) {
          formData.append('images[]', this.form.images[i]);
        }

        fetch('/api/products', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          credentials: 'include',
          body: formData
        })
        // .then(response => response.json())
        .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
        })
        .then(() => {
          this.$router.push('/products');
        })
        .catch(error => console.error('Error:', error));
      }
    }
  }
</script>
