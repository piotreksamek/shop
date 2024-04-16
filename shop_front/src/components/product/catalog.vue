<template>
  <div>
    <div class="row">
      <div class="col-12">
        <h1>
          Products
        </h1>
      </div>
    </div>
    <div>
      <product-list :products="products"></product-list>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import ProductList from "@/components/product/product-list/product-list.vue";

export default {
  name: 'Catalog',
  components: {
    ProductList
  },
  data() {
    return {
      products: [],
    }
  },
  watch: {
    '$route.query': {
      immediate: true,
      handler() {
        this.fetchProducts();
      }
    }
  },
  async created() {
    await this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      const params = {};

      if (this.$route.query.category) {
        params.category = this.$route.query.category;
      }

      try {
        const response = await axios.get('http://0.0.0.0:8080/api/products', {
          params,
        });
        this.products = response.data.data.products;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    }
  }
};
</script>
