class Main.Models.PlayerScore extends Backbone.Model

  initialize: () ->
    0

  scorestring: () ->
    mygame = @currgame()
    return "None" if !mygame
    return mygame.score_string()

class Main.Collections.PlayerScoresCollection extends Backbone.Collection
  model: Main.Models.PlayerScore
