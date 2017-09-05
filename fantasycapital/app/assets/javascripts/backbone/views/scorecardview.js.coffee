class Main.Views.ScorecardView extends Backbone.View
    initialize: (args) ->
        @exists = true
        @template = $("#scorecard-template").html()
        @entry        = args.entry
        @entries_coll = args.entries_coll
        @entry_el     = args.entry_el
        @render()
    render: () ->
        if @exists
            $(@el).html(_.template(@template, {}))
            @entryView = new Main.Views.EntryView({
                entry: @entry, 
                entries_coll: @entries_coll,
                scorecardView: @
            })
            @playersView = new Main.Views.PlayersView({
                collection: window.players_coll,
                entry: @entry,
                scorecardView: @,
                entryView: @entryView
            })
    clear: () ->
        @exists = false