<template>
  <div>
    <b-navbar toggleable="lg" variant="dark">

      <b-navbar-nav>
        <b-button variant="dark">
          <router-link to="/" class="nav-link text-white">Homepage</router-link>
        </b-button>

        <b-button variant="dark">
          <router-link to="/products" class="nav-link text-white">Products</router-link>
        </b-button>
      </b-navbar-nav>

      <b-navbar-nav>
        <b-nav-item>
          <b-button>
            <router-link to="/" class="nav-link text-white"><i class="bi bi-cart"></i></router-link>
          </b-button>
        </b-nav-item>

        <b-nav-item>
          <b-button variant="dark">
            <router-link to="#" class="nav-link text-white">Login</router-link>
          </b-button>
        </b-nav-item>
      </b-navbar-nav>

    </b-navbar>
  </div>
</template>
