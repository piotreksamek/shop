<template>
  <div class="container-fluid">
    <div class="row">
      <aside :class="{'col-xs-12 col-1': sidebarCollapsed, 'col-xs-12 col-3': !sidebarCollapsed}"
             :style="{transition: 'width 0.5s'}">
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
import Catalog from '@/components/product/catalog.vue';
import Sidebar from '@/components/product/categories.vue';

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
  methods: {
    toggleSidebarCollapsed() {
      this.sidebarCollapsed = !this.sidebarCollapsed;
    }
  }
}
</script>
