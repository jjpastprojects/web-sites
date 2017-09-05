"use strict";
/*globals describe, it, beforeEach, expect, Main, FIXTURES */

describe("Testing Backbone model - Main.Models.Game - without games and teams collection", function () {
    var game;

    beforeEach(function () {
        game = new Main.Models.Game(FIXTURES.Backbone.games[0]);
    });

    it("return null if teams_collection was not passed to the games collection constructor", function () {
        expect(game.home_team_alias()).toBe(null);
        expect(game.away_team_alias()).toBe(null);
        expect(game.away_team_alias(2)).toBe(null);
        expect(game.away_team_alias(9)).toBe(null);
    });

    it("return empty string it teams_collection was not specified", function () {
        expect(game.teams_string()).toBe("");
    });

});

describe("Testing Backbone model - Main.Models.Game - with games and teams collection", function () {
    var game, teams_collection, games_collection;

    beforeEach(function () {

        game = new Main.Models.Game(FIXTURES.Backbone.games[0]);

        teams_collection = new Backbone.Collection();
        teams_collection.reset(FIXTURES.Backbone.teams);
        games_collection = new Main.Collections.GamesCollection([game], {
            teams_coll: teams_collection
        });

    });

    it("you should be able to get home and away team aliases", function () {
        expect(game.home_team_alias()).toBe("TOR");
        expect(game.away_team_alias()).toBe("WCH");
    });

    it("you should be able to get other team aliases", function () {
        // see fixtures for the aliases
        expect(game.get_team_alias(2)).toBe("OKC");
        expect(game.get_team_alias(9)).toBe("TOR");
        expect(game.get_team_alias(17)).toBe("WCH");
        expect(game.get_team_alias(29)).toBe("BOD");
    });

    it("you should be possible to get the teams string", function () {
        expect(game.teams_string()).toBe("TOR@WCH");
    });

    it("you should be able to get the score string", function () {
        expect(game.score_string()).toBe("WCH @ TOR");
    });

});