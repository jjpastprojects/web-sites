//=require backbone/models/post

var PostsCollection = Backbone.Collection.extend({
    model: PostModel,
    url: function () {
        return fetchUrl;
    }
});