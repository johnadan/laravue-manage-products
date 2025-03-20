<template>
    <nav class="sidebar bg-dark text-white vh-100 p-3">
      <ul class="list-unstyled">
        <li class="mb-2"><router-link to="/" class="text-white text-decoration-none">Dashboard</router-link></li>
        <li class="mb-2"><router-link to="/products" class="text-white text-decoration-none">Products</router-link></li>
        <li class="mb-2"><router-link to="/products/create" class="text-white text-decoration-none">Create Product</router-link></li>
        <li class="mt-4">
            <button @click="logout" class="btn btn-outline-light w-100">Logout</button>
        </li>
      </ul>
    </nav>
</template>

<script>
    export default {
        name: "Sidebar",
        methods: {
            logout() {
                fetch('http://localhost:8001/logout', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                    },
                })
                // .then(response => response.json())
                // .then(() => {
                //     // After logging out, redirect to the login page.
                //     window.location.href = '/login';
                // })
                .then(response => {
                    if (response.ok) {
                    // Clear any local storage or Vue state if necessary
                        window.location.href = '/login'; // Redirect to login page
                    } else {
                        console.error('Logout failed');
                    }
                })
                .catch(error => console.error('Logout error:', error));
            }
        }
    };
</script>
