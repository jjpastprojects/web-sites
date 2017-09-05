class Main.Models.LiveContest extends Backbone.Model
    defaults:
        prize: 0
    initialize: () ->
        # console.log("live contest, hurray!")


class Main.Collections.LiveContestsCollection extends Backbone.Collection
  model: Main.Models.LiveContest
  initialize: () ->
    # console.log("Live Contests Collection initialized")