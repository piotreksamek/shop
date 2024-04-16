<template>
  <div class="row">
    <div class="col-12">
      <div class="mt-4">
        <loading v-show="products.length === 0" />
      </div>
    </div>
    <product-card
        v-for="(product, index) in products"
        :key="products"
        v-show="products.length > 0"
        :product="product"
        class="m-2"
    >
    </product-card>
  </div>
</template>
<script>
import ProductCard from "@/components/product/product-list/product-card.vue";
import Loading from '@/components/product/loading.vue';

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