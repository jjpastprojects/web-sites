class Main.Views.UpcomingContestsView extends Backbone.View
    initialize: (contests) ->
        @$el = $("#entries-list .fantasy-table-wrapper")
        @template = $("#upcoming-contests-template").html()
        @upcomingContests = contests
        @listenTo(@upcomingContests, "change", @render)
        @render()
    render: () ->
        if @$el && @template
            @$el.html(_.template(@template, { upcomingContests: @upcomingContests.toJSON() }))
            @countdown()
    countdown: () ->
        padding = (value) ->
            if value < 10 && value >= 0
                return "0" + value;
            return value.toString()
        @$el.find(".js-time-count").each ->
            $self = $(this)
            time = $self.attr("data-time")
            if time
                $self.countdown
                    date: time
                    render: (date) ->
                        min = padding(date.min)
                        sec = padding(date.sec)
                        hours = date.days * 24 + date.hours;
                        $self.html(hours + ":" + min + ":" + sec);

