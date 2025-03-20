<template>
  <div id="app" class="d-flex">
    <!-- <Sidebar />
    <div class="content-wrapper flex-fill p-3">
      <router-view></router-view>
    </div> -->
    <!-- Render Sidebar only if the current route is not 'Login' -->
    <Sidebar v-if="showSidebar" />
    <div class="content-wrapper flex-fill p-3">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Sidebar from './components/Sidebar.vue';

export default {
//   components: { Sidebar }
  name: "App",
  components: { Sidebar },
  computed: {
    showSidebar() {
      // Hide sidebar if the current route's name is 'Login'
      return this.$route.name !== 'Login';
    }
  }
};
</script>

<style>
/* Basic styles to mimic AdminLTE’s layout */
</style>
