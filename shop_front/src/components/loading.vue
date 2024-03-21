<template>
  <h4 :class="$style.component">

  </h4>
</template>
<script>
  export default {
    name: 'Loading',
  }
</script>
<style module>
.component {
  background: url('../assets/images/loading.gif') no-repeat left center;
  padding: 0 0 50px 50px;
}
</style>