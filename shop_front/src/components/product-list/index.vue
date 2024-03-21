<template>
  <div class="row">
    <div class="col-12">
      <div class="mt-4">
        <loading v-show="products.length === 0" />
      </div>
    </div>
    <product-card
        v-for="(product, index) in products"
        :key="index"
        v-show="products.length > 0"
        :product="product"
    >
    </product-card>
  </div>
</template>
<script>
import ProductCard from "@/components/product-list/product-card.vue";
import Loading from '@/components/loading';
  export default {
    name: 'ProductList',
    components: {
      ProductCard,
      Loading,
    },
    props: {
      products: {
        type: Array,
        required: true,
      }
    }
  }
</script>