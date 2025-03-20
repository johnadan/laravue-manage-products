<template>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
              <form @submit.prevent="login">
                <div class="mb-3">
                  <label for="login" class="form-label">Username or Email</label>
                  <input type="text" class="form-control" id="login" v-model="form.login" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" v-model="form.password" required>
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="remember" v-model="form.remember">
                  <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div v-if="error" class="mt-3 alert alert-danger">{{ error }}</div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
function getCookie(name) {
    let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) return decodeURIComponent(match[2]);
    return null;
}

  export default {
    name: 'Login',
    data() {
      return {
        form: {
          login: '',
          password: '',
          remember: false,
        },
        error: ''
      }
    },
    methods: {
      login() {
        // Step 1: Get the CSRF cookie from Sanctum
        // fetch('/sanctum/csrf-cookie', {
        // // fetch('http://localhost:8001/sanctum/csrf-cookie', {
        //   credentials: 'include'
        // })
        fetch('http://localhost:8001/sanctum/csrf-cookie', {
            credentials: 'include'
        })
        .then(() => {
          // Step 2: Perform the login request
          return fetch('http://localhost:8001/login', {
        //   return fetch('/login', {
            method: 'POST',
            credentials: 'include',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
            },
            // body: JSON.stringify(this.form)
            body: JSON.stringify({
                login: this.form.login,       // username or email
                password: this.form.password,   // password
                remember: this.form.remember    // true/false
            })
          });
        })
        .then(response => {
          if (!response.ok) {
            return response.json().then(data => { throw data });
          }
          if (response.status === 204) {
            return {};
            }
          return response.json();
        })
        // .then(() => {
        //   // On success, redirect to the dashboard
        //   this.$router.push('/');
        // })
        .then(data => {
            console.log('Logged in:', data);
            // Redirect to dashboard upon successful login
            this.$router.push('/');
        })
        // .catch(err => {
        .catch(error => {
          console.error('Login error:', error);
          this.error = error.message || 'Login failed. Please check your credentials.';
        });
      }
    }
  }
</script>
