//= require backbone/views/goods

Catalog = new Backbone.Marionette.Application();
var element, goods, loading;

Catalog.addRegions({
    mainRegion: '[data-region=goods]'
});

CatalogRouter = Backbone.Router.extend({
    routes: {
        "*actions": "category"
    }
});

goodsCollection = new GoodsCollection();
goodsView = new GoodsView({
    collection: goodsCollection
});

var columize = function (collection) {
    var wrap = $('<div>').addClass('showroom-col');
    goods.append(collection.wrap(wrap));
}

var loadingIn = function (callback) {
    if (element.hasClass('inited') && loading.height() == 0 ) {
        loading.hide().fadeIn(function () {
            callback();
        });
    }
    else {
        callback();
    }
}

var loadingOut = function () {
    if (element.hasClass('inited')) {
        loading.show().fadeOut(function () {
            element.removeClass('loading');
            loading.css({
                display: ''
            })
        });
    }
    else {
        element.addClass('inited');
    }
}

var fetch = function (collection) {
    goodsCollection.fetch({
        data: {
            collection: collection ? collection : 'main'
        },
        type: "POST",
        remove: true,
        success: function () {
            goodsView.render();
        },
        error: function (model, xhr, options) {
            console.error(xhr);
        }
    });
}

Catalog.addInitializer(function (options) {
    var catalogRouter = new CatalogRouter();

    catalogRouter.on(
        'route:category',
        function (collection) {
            loadingIn(function () {
                fetch(collection)
            });

        }
    );

    Catalog.mainRegion.show(goodsView);
});

$(document).on('ready page:load', function() {
    element = $('[data-showroom=slide]');
    goods = $('[data-region=goods]');
    loading = $('[data-showroom=loading]');

    Catalog.start();
    Backbone.history.start();
});
