class Main.Views.EntriesTabsView extends Backbone.View
    initialize: (args) ->
        self = @
        @$el = $(".capitalcontent");
        @template = $("#entries-tabs-template").html()
        @liveColl = args.liveCollection
        @upcoColl = args.upcomingCollection
        @compColl = args.completedCollection
        @render()
        @tableView = new Main.Views.LiveContestsView(@liveColl)
        @tableFiltersView = new Main.Views.TableFiltersView()
        @$el.find(".tabs-layout .tab").on("click", () ->
            $(@).addClass("active").siblings().removeClass("active")
            type = $(@).attr("data-type")

            delete self.tableView
            if type == "live"
                self.tableView = new Main.Views.LiveContestsView(self.liveColl)
            else if type == "upcoming"
                self.tableView = new Main.Views.UpcomingContestsView(self.upcoColl)
            else if type == "completed"
                self.tableView = new Main.Views.CompletedContestsView(self.compColl)
            $.bootstrapSortable()
        )
    render: () ->
        if @$el.length > 0 && @template
            @$el.html(_.template(@template, {
                liveColl: @liveColl,
                upcoColl: @upcoColl,
                compColl: @compColl
            }));