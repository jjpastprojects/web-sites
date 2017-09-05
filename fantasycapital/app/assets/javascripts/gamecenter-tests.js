"use strict";
/*globals _, Backbone, gamecenter */

var GameCenterTests = _.extend({}, Backbone.Events);
GameCenterTests.on("players", function () {
  // change the ids of the players to fire it
  gamecenter.handlePushedStats({
    "players": [
      {
        "id": 174,
        "rtstats": "0P 1R 0A 1S 0B 0T",
        "currfps": Math.floor((Math.random() * 100))
      },
      {
        "id": 290,
        "rtstats": "3P 1R 1A 1S 0B 1T",
        "currfps": Math.floor((Math.random() * 100))
      },
      {
        "id": 273,
        "rtstats": "2P 3R 0A 0S 0B 0T",
        "currfps": Math.floor((Math.random() * 100))
      }
    ]
  });

});

GameCenterTests.on("entries", function () {

  function pushEntry(id) {
    gamecenter.handlePushedStats({
      "entries": [
        {
          "id": id,
          "fps": Math.floor((Math.random() * 100))
        }
      ]
    });
  }

  for (var i = 0, ilen = 100; i < ilen; i += 1) {
    pushEntry(i + 1);
  }

});

GameCenterTests.on("games", function () {



    var timeleft = Math.floor((Math.random() * 100));

    var games = [];

    // change games with id from 100 to 150, you might need to adjust
    // it manually, the game id will get bigger and bigger
    // check the data-games-id on tr tag to find out what
    // game ids do you have on current page
    for (var i = 158, ilen = 200; i < ilen; i += 1) {
      games.push({
        "id": i,
        "pretty_play_state": timeleft + " MIN LEFT",
        "game_remaining": timeleft,
        "home_team_score": Math.floor((Math.random() * 100)),
        "away_team_score": Math.floor((Math.random() * 100))
      });
    }

    gamecenter.handlePushedStats({
      "games": games
    });

    return true;
});
// fire off in console to see the flash
// GameCenterTests.trigger("players");
// GameCenterTests.trigger("entries");
// GameCenterTests.trigger("games");
