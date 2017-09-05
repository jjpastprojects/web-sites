//= require backbone/collections/posts
//= require backbone/views/post

PostsEmptyView = Backbone.Marionette.ItemView.extend({
    template:  function() { return $('[data-view=posts-empty]') }
});

PostsView = Backbone.Marionette.CompositeView.extend({
    template: "[data-view=posts]",
    itemView: PostView,
    emptyView: PostsEmptyView,
    itemViewContainer: "[data-type=posts]",
    onRender: function() {
        this.$('[data-blog=post]').each(function() {
            $(this).css({
                visibility: 'hidden'
            });
        });

        var self = this,
            show = function() {

            self.$('[data-blog=post]').each(function() {
                $(this).css({
                    visibility: ''
                }).hide().fadeIn();
            });
        };

        blogLoadingOut(show);
    }
});

