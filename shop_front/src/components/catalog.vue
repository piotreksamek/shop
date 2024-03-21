<template>
  <div>
    <div class="row">
      <div class="col-12">
        <h1>
          Products
        </h1>
      </div>
    </div>
    <product-list :products="products"></product-list>
    <div class="row">
      <legend-component :title="legend"></legend-component>
    </div>
  </div>
</template>

<script>
  import LegendComponent from "@/components/legend.vue";
  import axios from 'axios';
  import ProductList from "@/components/product-list/index.vue";
  export default {
    name: 'Catalog',
    components: {
      LegendComponent,
      ProductList
    },
    data() {
      return {
        products: [],
        legend: 'Shipping takes 10-12 weeks, and products probably won\'t workq'
      }
    },
    async created() {
      const response = await axios.get('http://0.0.0.0:8080/api/products');

      this.products = response.data.data.products
    }
  };
</script>
