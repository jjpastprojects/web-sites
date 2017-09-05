# home contests view can be used in the home page to create a green flash animation if
# the number of contestants has changed
# it's currently inactive due to the fact that there's no realtime functionality
# on home page yet

class Main.Views.HomeContestsView extends Backbone.View
    initialize: (args) ->
        self = @
        @$el = $("#home-contests")
        @pusher = new Pusher(args.pusherkey)
        # these two lines need to be edited
        channel = this.pusher.subscribe('gamecenter')
        channel.bind('stats',  (data) -> self.pusherHandler(data) )
    pusherHandler: (data) ->
        # { contests: [ { id: 642, contestants: Math.floor(Math.random() * 11), max_num_of_contestants: 10 } ] }
        # window.homeContestsView.pusherHandler({ contests: [ { id: 642, contestants: Math.floor(Math.random() * 11), max_num_of_contestants: 10 } ] });
        self = @
        if data.contests && _.isArray(data.contests)
            _(data.contests).each( (contest) ->
                node = self.$el.find("tr#contest_" + contest.id)
                if node.length > 0
                    node.find("td.entries-per-contest").html(contest.contestants + "/" + contest.max_num_of_contestants)
                    node.find("td")
                        .css({"background-color": "#0eea6c"}).stop(true)
                        .animate({ "background-color": "#eef0f1"}, 2000)
        )