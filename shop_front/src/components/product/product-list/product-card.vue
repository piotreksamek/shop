<template>
  <div class="col-xs-12 col-3 mb-2 pb-2 card">
    <div>
      <img
          :alt="product.name"
          :src="getImage()"
          class="d-block mt-2 mw-100"
          style="height: 200px; width: 100%; object-fit: cover;"
      >
      <h3 class="font-weight-bold mb-2 mt-2 px-2">
        {{ product.name }}
      </h3>
      <div class="p-2 my-3">
        <p class="p-0">
          <strong>{{ price }} {{ currency }}</strong>
        </p>
      </div>
    </div>
    <div class="position-absolute bottom-0 end-0 mb-3 me-3">
      <button
          class="btn btn-info btn-sm mt-5"
      >
        <i class="bi bi-cart"></i>
      </button>
    </div>
  </div>
</template>
<script>

export default {
  name: 'ProductCard',
  computed: {
    price() {
      return (this.product.grossValue.value / 100).toLocaleString('en-US', {minimumFractionDigits: 2});
    },
    currency() {
      return (this.product.grossValue.currency);
    }
  },
  methods: {
    getImage() {
      return 'http://0.0.0.0:8080/uploads/' + this.product.image
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
