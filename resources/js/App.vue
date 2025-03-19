<template>
  <div id="app" class="d-flex">
    <Sidebar />
    <div class="content-wrapper flex-fill p-3">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Sidebar from './components/Sidebar.vue';

export default {
  components: { Sidebar }
};
</script>

<style>
/* Basic styles to mimic AdminLTE’s layout */
</style>
