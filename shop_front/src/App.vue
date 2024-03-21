<script>
import Navigation from '@/layouts/nav.vue'
export default {
  name: 'App',
  components: {
    Navigation
  }
}
</script>

<template>
  <Navigation />
  <div class="m-5">
    <RouterView></RouterView>
  </div>
</template>
