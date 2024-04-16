<template>
  <div :class="[$style.component, 'p-3', 'mb-5']"
       :style="{ width: collapsedQ ? '85px' : '250px', transition: 'width 0.5s' }">
    <div v-if="!collapsedQ">
      <h5 class="text-center">
        Categories
      </h5>
      <div class="col-12">
        <div class="mt-4">
          <loading v-show="categories.length === 0" />
        </div>
      </div>
      <ul class="nav flex-column mb4">
        <li class="nav-item">
          <a
              class="nav-link"
              href="/products"
          >All Products</a>
        </li>
        <li v-for="(category, index) in categories" :key="index" class="nav-item">
          <RouterLink :to="'/products?category=' + category.name" class="nav-link">{{ category.name }}</RouterLink>
        </li>
      </ul>
      <hr>
    </div>

    <div class="d-flex justify-content-end">
      <button
          class="btn btn-secondary btn-sm"
          v-text="collapsedQ ? 'Show' : 'Close'"
          @click="toggleCollapsed"
      >
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import Loading from '@/components/product/loading.vue';

export default {
  components: {
    Loading
  },
  name: 'Sidebar',
  props: {
    collapsedQ: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      categories: [],
    };
  },
  async created() {
    const response = await axios.get('http://0.0.0.0:8080/api/categories', {});

    let categories = response.data.data.categories;

    categories.sort((a, b) => b.priority - a.priority)

    this.categories = response.data.data.categories
  },
  methods: {
    toggleCollapsed() {
      this.$emit('toggle-collapsed');
    },
  }
}
</script>

<style module>
.component {
  border: 1px solid #efefee;
  box-shadow: 0 0 7px 4px #efefee;
  border-radius: 5px;

  ul {
    li a:hover {
      background: $blue-component-link-hover;
    }
  }
}
</style>