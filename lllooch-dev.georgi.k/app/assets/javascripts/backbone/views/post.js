//=require backbone/models/post

PostView = Backbone.Marionette.ItemView.extend({
    template:  "[data-view=post]",
    tagName: 'li'
});