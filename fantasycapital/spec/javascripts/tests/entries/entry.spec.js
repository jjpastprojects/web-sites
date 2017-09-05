"use strict";
/*globals $, describe, it, expect, Entry, Player, console */

function createEntry (position, spot, id) {
    var node = document.createElement("li");
    node.setAttribute("data-sport-position-name", position);
    node.setAttribute("data-spot", spot);
    node.setAttribute("data-player-id", id);
    return new Entry($(node));
}

 function createPlayer (cfg) {
    var node = document.createElement("li");
    node.setAttribute("data-player-id", cfg.id);
    node.setAttribute("data-player-name", cfg.name);
    node.setAttribute("data-player-salary", cfg.salary);
    node.setAttribute("data-player-opp", cfg.opp);
    node.setAttribute("data-player-fppg", cfg.fppg);
    node.setAttribute("data-player-position", cfg.position);
    return new PlayerStats($(node));
}

describe("Tests for an Entry", function () {
    


    it("Entry should be a function", function () {
        expect(typeof Entry).toBe("function");
    });

    it("Entry shouldn't have position, player and spot by default", function () {
        expect(Entry.prototype.position).toBe("");
        expect(Entry.prototype.player).toBe("");
        expect(Entry.prototype.spot).toBe("");
    });

    it("Entry should have a render method in it's prototype", function () {
        expect(typeof Entry.prototype.render).toBe("function");
    });

    it("Entry should return null if player added via the addPlayer method is not an instance of a Player constructor", function () {
        var entry = createEntry("SPORT1", "SF", "null");

        entry.addPlayer({
            name: "Some player",
            id: "Bob"
        });
        expect( entry.addPlayer() ).toBe(null);
        
    });

    it("Entry should receive a dom node which has sport-position-name, spot and played-id data attributes set", function () {

        var entry = createEntry("SPORT1", "SF", "null");
        expect(entry.position).toBe("SPORT1");
        expect(entry.spot).toBe("SF");
        expect(entry.player).toBe("");
        expect(entry.playerExists()).toBe(false);

    });

    it("You should be able to add a player to an entry", function () {

        var entry = createEntry("SPORT1", "SF", "null");
        expect(entry.playerExists()).toBe(false);

        var player = createPlayer({
            id: "XAB1",
            name: "Micheal Jordan",
            salary: 20000,
            opp: "XAB2",
            fppg: "200",
            position: "SF"
        });

        entry.addPlayer(player);
        expect(entry.playerExists()).toBe(true);

    });

    it("You should be able to remove a player from an entry", function () {

        var entry = createEntry("SPORT1", "SF", "null");
        expect(entry.playerExists()).toBe(false);

        var player = createPlayer({
            id: "XAB1",
            name: "Micheal Jordan",
            salary: 20000,
            opp: "XAB2",
            fppg: "200",
            position: "SF"
        });

        entry.addPlayer(player);
        expect(entry.playerExists()).toBe(true);


        entry.removePlayer();
        expect(entry.playerExists()).toBe(false);

    });

    it("Entry should have a render method", function () {
        var entry = createEntry("SPORT1", "SF", "null");
        expect(typeof entry.render).toBe("function");
    });

    it("Entry render method should change content of td elements inside a tr element that's used for this entry", function () {
        var entry = createEntry("SPORT1", "SF", "null");
        var player = createPlayer({
            id: "XAB1",
            name: "Micheal Jordan",
            salary: 20000,
            opp: "TEAM1@TEAM2",
            fppg: "200",
            position: "SF",
            homeTeam: "TEAM1",
            opponentTeam: "TEAM2"
        });
        entry.addPlayer(player);
        // it would be best to have rails endpoint which will provide
        // the html templates for the mockups
        // this way this test could check if those elements exist
        var content = "<div id=\"mockup\" style=\"display:none;\">" +
            "<table>" +
                "<tbody>" +
                    "<tr class=\"lineup-spot\" data-spot=\"" + entry.spot +  "\">" +
                        "<td class=\"player\">" +
                            "<span></span><p><input></p>" +
                        "</td>" +
                        "<td class=\"opp\">" +
                            "<span></span>" +
                        "</td>" +
                        "<td class=\"salary\">" +
                            "<span></span>" +
                        "</td>" +
                        "<td class=\"fppg\">" +
                            "<span></span>" +
                        "</td>" +
                    "</tr>" +
                "</tbody>" +
            "</table>" +
        "</div>";
        $("body").append(content);
        entry.render();
        expect( $("#mockup .lineup-spot").attr("data-spot") ).toBe("SF");
        expect( $("#mockup td.player input").val() ).toBe("XAB1");
        expect( $("#mockup td.player span").html() ).toBe("Micheal Jordan");
        expect( $("#mockup td.salary span").html() ).toBe("$20,000");
        $("#mockup").remove();
        
    });

});
