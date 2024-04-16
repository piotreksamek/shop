const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    proxy: {
      '/api': {
        target: 'http://0.0.0.0:8080', // Adres URL backendu
        changeOrigin: true,
        pathRewrite: {
          '^/api': '' // Usuń prefix "/api" z adresu URL
        }
      }
    }
  }
})
