class Main.Models.CompletedContest extends Backbone.Model
    defaults:
        prize: 0
    initialize: () ->
        # console.log("completed contest, hurray!")


class Main.Collections.CompletedContestsCollection extends Backbone.Collection
  model: Main.Models.CompletedContest
  initialize: () ->
    # console.log("Completed Contests Collection initialized")