//= require backbone/views/posts

Blog = new Backbone.Marionette.Application();
var element, posts, loading, postsCollection, postsView;

Blog.addRegions({
    mainRegion: "[data-region=posts]"
});

BlogRouter = Backbone.Router.extend({
    routes: {
        "*actions": "category"
    }
});

postsCollection = new PostsCollection();

postsView = new PostsView({
    collection: postsCollection
});

var blogLoadingIn = function (callback) {
    if (element.hasClass('inited') && loading.height() == 0 ) {
        loading.hide().fadeIn(function () {
            callback();
        });
    }
    else {
        callback();
    }
}

var blogLoadingOut = function (callback) {
    if (element.hasClass('inited')) {
        loading.show().fadeOut(function () {
            element.removeClass('loading');
            loading.css({
                display: ''
            })
        });
        callback();
    }
    else {
        element.addClass('inited');
    }
}

var fetch = function (collection) {
    postsCollection.fetch({
        data: {
            collection: collection ? collection : 'all'
        },
        type: "POST",
        remove: true,
        success: function() {
            postsView.render();
        },
        error: function (model, xhr, options) {
            console.error(xhr);
        }
    });
}

Blog.addInitializer(function (options) {
    var blogRouter = new BlogRouter();

    blogRouter.on(
        'route:category',
        function (collection) {
            blogLoadingIn(function () {
                fetch(collection)
            });
        }
    );

    Blog.mainRegion.show(postsView);
});

$(document).on('ready page:load', function() {
    element = $('[data-type=blogs]');
    posts   = $('[data-region=posts]');
    loading = $('[data-blog=loading]');

    Blog.start();
    Backbone.history.start();
});
