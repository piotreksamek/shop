<template>
  <div :class="[$style.component, 'p-3', 'mb-5']">
    <div v-if="!collapsedQ">
      <h5 class="text-center">
        Categories
      </h5>
      <ul class="nav flex-column mb4">
        <li class="nav-item">
          <a
              class="nav-link"
              href="/Vue2/public"
          >All Products</a>
        </li>
        <li v-for="(category, index) in categories" :key="index" class="nav-item">
          <RouterLink :to="'/category/' + category.link" class="nav-link">{{category.name}}</RouterLink>
<!--          <a-->
<!--              class="nav-link"-->
<!--              :href="'/category/' + category.link"-->
<!--          >{{ category.name }}</a>-->
        </li>
      </ul>
      <hr>
    </div>

    <div class="d-flex justify-content-end">
      <button
          class="btn btn-secondary btn-sm"
          v-text="collapsedQ ? '>>' : '<< Collapse'"
          @click="toggleCollapsed"
      >
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: 'Sidebar',
  props: {
    collapsedQ: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      categories: [
      ],
    };
  },
  computed: {
    // currentCateog
  },
  async created() {
    const response = await axios.get('http://0.0.0.0:8080/api/categories');

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