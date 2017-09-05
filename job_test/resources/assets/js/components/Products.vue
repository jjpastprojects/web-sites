<template>
       <product></product>
        <table class="table">
          <tr>
            <td>name</td>
            <td>quantity</td>
            <td>price</td>
          </tr>
          <tr v-for="product in products">
            <td>{{ product.name }} </td>
            <td>{{ product.quantity}} </td>
            <td>{{ product.price}} </td>
          </tr>
       </table>
</template>

<script>
    Vue.component('product', require('./Product.vue'));
    export default {
        data() {
          return {
            products: [] 
          }
        },
        ready() {
          this.$http.get('/api/products').then((response) => {
            this.products = JSON.parse(response.body);
          });
        },
        events: {
          'new-product': function(product){
            this.products.push(product);
          }
        }
    }
</script>
