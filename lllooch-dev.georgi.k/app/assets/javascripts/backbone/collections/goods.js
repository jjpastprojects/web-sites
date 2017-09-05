//=require backbone/models/good

var GoodsCollection = Backbone.Collection.extend({
    model: GoodModel,
    url:   function () {
        return fetchUrl;
    }
});