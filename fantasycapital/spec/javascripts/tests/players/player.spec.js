"use strict";
/*globals $, describe, it, expect, Player */

describe("Tests for a Player", function () {
    
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

    it("Player should be a function", function () {
        expect(typeof PlayerStats).toBe("function");
    });

    it("Player should have salary set to 0 by default, and id, name, opp, fppg, position have to be empty", function () {
        expect(PlayerStats.prototype.id).toBe("");
        expect(PlayerStats.prototype.name).toBe("");
        expect(PlayerStats.prototype.salary).toBe(0);
        expect(PlayerStats.prototype.opp).toBe("");
        expect(PlayerStats.prototype.fppg).toBe("");
        expect(PlayerStats.prototype.position).toBe("");
    });


    it("Player should have id, name, salary, opp, fppg and position set", function () {

        var player = createPlayer({
            id: "XAB1",
            name: "Micheal Jordan",
            salary: 20000,
            opp: "XAB2",
            fppg: "XAB3",
            position: "SF"
        });

        expect(player.id).toBe("XAB1");
        expect(player.name).toBe("Micheal Jordan");
        expect(player.salary).toBe(20000);
        expect(player.opp).toBe("XAB2");
        expect(player.fppg).toBe("XAB3");
        expect(player.position).toBe("SF");

    });

    it("You should be able to create many players", function () {

        var player1 = createPlayer({
            id: "XAB1",
            name: "Micheal Jordan",
            salary: 20000,
            opp: "XAB2",
            fppg: "XAB3",
            position: "SF"
        });

        var player2 = createPlayer({
            id: "YAB1",
            name: "Micheal Bordan",
            salary: 30000,
            opp: "YAB2",
            fppg: "YAB3",
            position: "SE"
        });

        expect(player1.id).toBe("XAB1");
        expect(player1.name).toBe("Micheal Jordan");
        expect(player1.salary).toBe(20000);
        expect(player1.opp).toBe("XAB2");
        expect(player1.fppg).toBe("XAB3");
        expect(player1.position).toBe("SF");

        expect(player2.id).toBe("YAB1");
        expect(player2.name).toBe("Micheal Bordan");
        expect(player2.salary).toBe(30000);
        expect(player2.opp).toBe("YAB2");
        expect(player2.fppg).toBe("YAB3");
        expect(player2.position).toBe("SE");

    });

});