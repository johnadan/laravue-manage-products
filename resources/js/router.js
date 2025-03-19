import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from './components/Dashboard.vue';
import ProductList from './components/ProductList.vue';
import ProductForm from './components/ProductForm.vue';
import ProductEdit from './components/ProductEdit.vue';

const routes = [
  { path: '/', name: 'Dashboard', component: Dashboard },
  { path: '/products', name: 'ProductList', component: ProductList },
  { path: '/products/create', name: 'ProductCreate', component: ProductForm },
  { path: '/products/edit/:id', name: 'ProductEdit', component: ProductEdit, props: true }
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
