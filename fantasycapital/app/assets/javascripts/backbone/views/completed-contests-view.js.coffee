class Main.Views.CompletedContestsView extends Backbone.View
    initialize: (contests) ->
        @$el = $("#entries-list .fantasy-table-wrapper")
        @template = $("#completed-contests-template").html()
        @completedContests = contests
        @listenTo(@completedContests, "change", @render)
        @render()
    render: () ->
        if @el && @template
            @$el.html(_.template(@template, { completedContests: @completedContests.toJSON() }))