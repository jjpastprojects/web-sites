"use strict";
/*globals describe, it, beforeEach, expect, Backbone, Main, FIXTURES */

describe("Testing Backbone model - Main.Models.Player - without team", function () {

    var player;

    beforeEach(function () {
        player = new Main.Models.Player({
            first_name: "Marcin",
            last_name: "Gortat",
            salary: 8000
        });
    });

    it("You should be able to create a new player and get his name", function () {
        expect(player.name()).toBe("Marcin Gortat");
    });
    it("If no game is specified you should get None back from the methods", function () {
        expect(player.getTeam()).toBe("None");
        expect(player.scorestring()).toBe("None");
        expect(player.teamsstring()).toBe("None");
        expect(player.getHomeTeam()).toBe("None");
        expect(player.getAwayTeam()).toBe("None");
    });
    it("the salarystring method should return formatted string", function () {
        expect(player.get("salary")).toBe(8000);
        expect(player.salarystring()).toBe("$8,000");
    });
    it("null should be returned if there's no team or team id available", function () {
        expect(player.getTeamID()).toBe(null);
        expect(player.team()).toBe(null);
    });



});

describe("Testing Backbone model - Main.Models.Player - with team and other collections", function () {

    var player1, player2,
        players_collection,
        teams_collection,
        games_collection,
        sportpositions_collection,
        contest;

    beforeEach(function () {

        player1 = new Main.Models.Player({
            first_name: "Marcin",
            last_name: "Gortat",
            salary: 8000,
            team_id: 2
        });
        player2 = new Main.Models.Player({
            first_name: "Michael",
            last_name: "Jordan",
            salary: 99999,
            team_id: 9
        });
        
        teams_collection = new Backbone.Collection();
        teams_collection.reset(FIXTURES.Backbone.teams);

        contest = new Backbone.Model(FIXTURES.Backbone.contest);

        games_collection = new Main.Collections.GamesCollection([], {
            teams_coll: teams_collection
        });
        games_collection.reset(FIXTURES.Backbone.games);

        sportpositions_collection = new Backbone.Collection();
        sportpositions_collection.reset (FIXTURES.Backbone.position);

        players_collection = new Main.Collections.PlayersCollection([player1, player2], {
            teams_coll: teams_collection,
            games_coll: games_collection,
            sportpositions_coll: sportpositions_collection,
            contest: contest
        });


    });

    it("You should be able to create new players and get their name", function () {
        expect(player1.name()).toBe("Marcin Gortat");
        expect(player2.name()).toBe("Michael Jordan");
    });

    it("Correct team should be returned", function () {
        expect(player1.team()).toBe(teams_collection.get(player1.get("team_id")));
        expect(player2.team()).toBe(teams_collection.get(player2.get("team_id")));
    });

    it("You should be able to get the details of the player's team", function () {
        expect(player1.team().get("created_at")).toBe("2014-03-20 19:08:14");
        expect(player1.team().get("ext_team_id")).toBe("583ecfff-fb46-11e1-82cb-f4ce4684ea4c");
        expect(player1.team().get("id")).toBe(2);
        expect(player1.team().get("name")).toBe("Oklahoma City Thunder");
        expect(player1.team().get("teamalias")).toBe("OKC");
        expect(player1.team().get("updated_at")).toBe("2014-03-20 19:08:14");

        expect(player2.team().get("created_at")).toBe("2014-03-20 19:08:15");
        expect(player2.team().get("ext_team_id")).toBe("583ecda6-fb46-11e1-82cb-f4ce4684ea4c");
        expect(player2.team().get("id")).toBe(9);
        expect(player2.team().get("name")).toBe("Toronto Raptors");
        expect(player2.team().get("teamalias")).toBe("TOR");
        expect(player2.team().get("updated_at")).toBe("2014-03-20 19:08:15");
    });
    it("The id should be returned if the team id available", function () {
        expect(player1.getTeamID()).toBe(2);
        expect(player2.getTeamID()).toBe(9);
    });

    it("Game should be available for the player", function () {
        // check the fixtures object to find out what are the values
        expect(player1.currgame().get("id")).toBe(59);
        expect(player2.currgame().get("id")).toBe(58);
    });

    it("The player should be able to find out what's his team alias via the game collection", function () {
        expect(player1.getTeam()).toBe("OKC");
        expect(player2.getTeam()).toBe("TOR");
    });

    it("You should be able to know who's playing", function () {
        expect(player1.scorestring()).toBe("OKC @ BOD");
        expect(player2.scorestring()).toBe("WCH @ TOR");
    });

    it("You should be able to get the teamstring in home - away format", function () {
        expect(player1.teamsstring()).toBe("BOD@OKC");
        expect(player2.teamsstring()).toBe("TOR@WCH");
    });

    it("You should be able to get the home team", function () {
        expect(player1.getHomeTeam()).toBe("BOD");
        expect(player2.getHomeTeam()).toBe("TOR");
    });
    
    it("You should be able to get the away team", function () {
        expect(player1.getAwayTeam()).toBe("OKC");
        expect(player2.getAwayTeam()).toBe("WCH");
    });
});