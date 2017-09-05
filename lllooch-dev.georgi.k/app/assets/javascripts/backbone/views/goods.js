//= require backbone/collections/goods
//= require backbone/views/good

GoodsEmptyView = Backbone.Marionette.ItemView.extend({
    template: function() { return $('[data-view=goods-empty]') }
});

GoodsView = Backbone.Marionette.CompositeView.extend({
    template: '[data-view=goods]',
    itemView: GoodView,
    emptyView: GoodsEmptyView,
    itemViewContainer: '[data-type=goods]',
    onRender: function() {
        var cols = this.$('.showroom-col');
        loadingOut();

        this.$('.showroom-item').each(function(i) {
            $(cols.get(Math.floor(i/2))).append($(this));
            $(this).css({
                visibility: 'hidden'
            })
        });

        cols.each(function() {
            if (!$(this).children().size()) $(this).remove();
        });

        $('[data-action=showroom]').each(function() {
            if ($(this).data('showroom'))
            {
                $(this).data('showroom').refresh();
                $(this).data('showroom').setStep(0);
            }
            else
            {
                new Showroom($(this));
            }
        });

        this.$('.showroom-item').each(function(i) {
            $(this).hide().css({
                visibility: 'visible'
            }).fadeIn();
        })
    }
});

