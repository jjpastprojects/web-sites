class Main.Models.UpcomingContest extends Backbone.Model
    defaults:
        prize: 0
    initialize: () ->
        # console.log("upcoming contest, hurray!")


class Main.Collections.UpcomingContestsCollection extends Backbone.Collection
  model: Main.Models.UpcomingContest
  initialize: () ->
    # console.log("Upcoming Contests Collection initialized")