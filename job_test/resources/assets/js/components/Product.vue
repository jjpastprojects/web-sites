<template>
        <div class="row">
          <div class="col-md-3 center">
            <input class="form-control" type="text" v-model="name" placeholder="name"/>
            <input class="form-control" type="number" v-model="quantity" placeholder="quantity"/>
            <input class="form-control" type="number" v-model="price"/ placeholder="price">
            <input class="form-control" type="submit" @click="saveProduct()" value="save" />
          </div>
        </div>
</template>

<script>
    export default {
        data() {
          return {
            name: "",
            price: "",
            quantity: ""
          }
        },
        methods: {
          saveProduct: function(){
            let product = {name : this.name, quantity : this.quantity, price : this.price};
            this.$http.post('/api/product', product )
            .then(() => {
              this.$dispatch('new-product', product)
              this.name = ''; this.quantity = '', this.price = '';
            });
          }
        }
    }
</script>
