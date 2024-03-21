<template>
  <div class="container-fluid">
    <div class="row">
      <aside class="col-xs-12 col-3">
        <sidebar
            :collapsedQ="sidebarCollapsed"
            @toggle-collapsed="toggleSidebarCollapsed"
        ></sidebar>
      </aside>
      <div class="col-xs-12 col-9">
        <catalog></catalog>
      </div>
    </div>
  </div>
</template>

<script>
import Catalog from '@/components/catalog.vue';
import Sidebar from '@/components/sidebar.vue';

export default {
  name: 'Products',
  components: {
    Catalog,
    Sidebar
  },
  data() {
    return {
      sidebarCollapsed: false,
    }
  },
  computed: {
  },
  methods: {
    toggleSidebarCollapsed() {
      this.sidebarCollapsed = !this.sidebarCollapsed;
    }
  }
}

</script>
