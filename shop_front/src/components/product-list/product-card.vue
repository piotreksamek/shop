<template>
  <div class="col-xs-12 col-6 mb-2 pb-2">
    <div>
      <div>
        <img
            :alt="product.name"
            :src="product.image"
            class="d-block mb-2"
        >
        <h3 class="font-weight-bold mb-2 px-2">
          {{ product.name }}
        </h3>
      </div>
      <div class="p-2 my-3 d-md-flex justify-content-between">
        <p class="p-0 d-inline">
          <strong>${{ price }}</strong>
        </p>
        <button
            class="btn btn-info btn-sm"
        >
          View Product
        </button>
      </div>
    </div>
    <hr>
    <div class="px-2 pb-2">
      <small>brought to you by {{ product.brand }}</small>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'ProductCard',
    computed: {
      price() {
        return (this.product.price / 100).toLocaleString('en-US', { minimumFractionDigits: 2});
      },
    },
    props: {
      product: {
        type: Object,
        required: true,
      }
    }
  }
</script>
