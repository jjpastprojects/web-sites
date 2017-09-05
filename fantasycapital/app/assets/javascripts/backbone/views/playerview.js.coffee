class Main.Views.PlayerView extends Backbone.View
    initialize: (args) ->
        self = @
        @el = $(args.scorecardView.el).find(".scorecardBody")
        @position = args.position
        @percent  = args.percent
        @template = $("#player-template").html()
        _(@).bindAll("animate")
        @model.bind("change", @animate)
        @listenTo(window.games_coll, 'change', @gamepicker)

        @render_handler = _.throttle(() ->
            @sub = @el.find("tr[data-player-id=\"" + @model.get("id") + "\"]")
            content = _.template(@template, {
                model: @model, 
                position: @position,
                percent: @percent
            })
            if (!@sub.length)
                @el.append(content)
            else
                @sub.replaceWith(content)
            @anim_node = @el.find("tr[data-player-id=\"" + @model.get("id") + "\"]")
            if self.pending_animation
                @anim_node.css({"background-color": "#0eea6c"}).stop(true).animate({ "background-color": "#eef0f1"}, 2000)
                self.pending_animation = false
        , 2000)

    render: () ->
        @render_handler()
    gamepicker: (game) ->
        if game.get("id") == @model.getGameID()
            @render()
    animate: () ->
        @pending_animation = true
        @render_handler()
class Main.Views.PlayersView extends Backbone.View
    initialize: (args) ->
        @playerViews = {}
        @entry = args.entry
        @scorecardView = args.scorecardView
        @entryView = args.entryView
        @el = $(@scorecardView.el).find(".scorecardBody")
        @el.html("")
        @addAll()
    addAll: () ->
        self = @
        playersAndPositions = @entry.player_pos()
        playersAndPositions.forEach( (item) ->
            self.addOne(item)
        )
    addOne: (item) ->
        positions = ["ALL", "PG", "SG", "SF", "PF", "C", "UTIL"]
        playerView = new Main.Views.PlayerView({
            model: item[0]
            position: positions[item[1]]
            percent: @entryView.percent_owned()[item[0].get("id")]
            scorecardView: @scorecardView
        })
        @playerViews[item[0].get("id")] = playerView
        playerView.render()