(function () {
    "use strict";
    /*globals $, describe, it, expect, Lineup, Entry, Player */


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

    describe("Tests for a Lineup", function () {
       

        it("Lineup should be a function", function () {
            expect(typeof Lineup).toBe("function");
        });

        it("Lineup should have salary cap set to 0 by default, and entries to be an empty array", function () {
            expect(Lineup.prototype.salary_cap).toBe(0);
            expect(Lineup.prototype.entries).toEqual([]);
        });

        it("You should be able to add entries to the lineup", function () {

            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var lineup = new Lineup(65000);
            expect(lineup.getNumberOfEntries()).toBe(0);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);
            expect(lineup.getSalaryCap()).toBe(65000);
            expect(lineup.getNumberOfEntries()).toBe(3);

        });

        it("You should be able to remove all entries from the lineup", function () {

            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var lineup = new Lineup(65000);
            expect(lineup.getNumberOfEntries()).toBe(0);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);
            expect(lineup.getSalaryCap()).toBe(65000);
            expect(lineup.getNumberOfEntries()).toBe(3);
            lineup.clearEntries();
            expect(lineup.getNumberOfEntries()).toBe(0);

        });

        it("You should be able to check sum of salaries", function () {

            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 6000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            var player2 = createPlayer({
                id: "YBB1",
                name: "Micheal B",
                salary: 2000,
                opp: "YBB2",
                fppg: "YBB3",
                position: "SM"
            });

            var player3 = createPlayer({
                id: "ZCB1",
                name: "Micheal C",
                salary: 15000,
                opp: "ZCB2",
                fppg: "ZCB3",
                position: "SG"
            });

            entry1.addPlayer(player1);
            entry2.addPlayer(player2);
            entry3.addPlayer(player3);

            var lineup = new Lineup(65000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);
            expect(lineup.consumedSalary()).toBe(23000);

        });

        it("You should be able to check if you can add player safely so you don't exceed the limit", function () {

            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");
            var entry4 = createEntry("POS4", "SX", "UNIQUE_ID_4");
            var entry5 = createEntry("POS5", "SQ", "UNIQUE_ID_5");

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 5000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            var player2 = createPlayer({
                id: "YBB1",
                name: "Micheal B",
                salary: 6000,
                opp: "YBB2",
                fppg: "YBB3",
                position: "SM"
            });

            var player3 = createPlayer({
                id: "ZCB1",
                name: "Micheal C",
                salary: 7000,
                opp: "ZCB2",
                fppg: "ZCB3",
                position: "SG"
            });

            var player4 = createPlayer({
                id: "HCB1",
                name: "Micheal Q",
                salary: 7000,
                opp: "HCB2",
                fppg: "HCB3",
                position: "SA"
            });

            var player5 = createPlayer({
                id: "VCB1",
                name: "Silver Goldman",
                salary: 999999,
                opp: "VCB2",
                fppg: "VCB3",
                position: "SQ"
            });

            entry1.addPlayer(player1);
            entry2.addPlayer(player2);
            entry3.addPlayer(player3);
            entry4.addPlayer(player4);
            entry5.addPlayer(player5);

            var lineup = new Lineup(65000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);
            expect(lineup.canAddPlayer(player4)).toBe(true);
            lineup.addEntry(entry4);
            expect(lineup.canAddPlayer(player5)).toBe(false);

        });

        it("You should be able to remove all players from the lineup", function () {
            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 6000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            var player2 = createPlayer({
                id: "YBB1",
                name: "Micheal B",
                salary: 2000,
                opp: "YBB2",
                fppg: "YBB3",
                position: "SM"
            });

            var player3 = createPlayer({
                id: "ZCB1",
                name: "Micheal C",
                salary: 15000,
                opp: "ZCB2",
                fppg: "ZCB3",
                position: "SG"
            });

            entry1.addPlayer(player1);
            entry2.addPlayer(player2);
            entry3.addPlayer(player3);

            var lineup = new Lineup(65000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);
            expect(lineup.consumedSalary()).toBe(23000);
            lineup.clear();
            expect(lineup.consumedSalary()).toBe(0);
            expect(lineup.getNumberOfEntries()).toBe(3);
        });

        it("You should be able to count how much money you've still got", function () {
            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 6000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            entry1.addPlayer(player1);


            var lineup = new Lineup(65000);
            lineup.addEntry(entry1);
            expect(lineup.getSalaryCap()).toBe(65000);
            expect(lineup.consumedSalary()).toBe(6000);
            expect(lineup.amountLeft()).toBe(59000);


        });

        it("The setSalaryCap should set salary_cap to 0 if passed value is incorrect", function () {
            var lineup = new Lineup(100000);
            expect(lineup.salary_cap).toBe(100000);
            lineup.setSalaryCap(10000);
            expect(lineup.salary_cap).toBe(10000);
            lineup.setSalaryCap(-2000);
            expect(lineup.salary_cap).toBe(0);
            lineup.setSalaryCap(10000);
            expect(lineup.salary_cap).toBe(10000);
            lineup.setSalaryCap(NaN);
            expect(lineup.salary_cap).toBe(0);
        });

        it("You should be able to find out how many spots are still empty", function () {
            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var lineup = new Lineup(100000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);
            expect(lineup.spotsLeft()).toBe(3);

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 6000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            entry1.addPlayer(player1);
            expect(lineup.spotsLeft()).toBe(2);

            var player2 = createPlayer({
                id: "YBB1",
                name: "Micheal B",
                salary: 2000,
                opp: "YBB2",
                fppg: "YBB3",
                position: "SM"
            });

            entry2.addPlayer(player2);
            expect(lineup.spotsLeft()).toBe(1);

            var player3 = createPlayer({
                id: "ZCB1",
                name: "Micheal C",
                salary: 15000,
                opp: "ZCB2",
                fppg: "ZCB3",
                position: "SG"
            });

            entry3.addPlayer(player3);
            expect(lineup.spotsLeft()).toBe(0);

            lineup.clear();
            expect(lineup.spotsLeft()).toBe(3);

        });

        it("You should be able to count all players in the lineup", function () {
            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var lineup = new Lineup(100000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);
            expect(lineup.spotsLeft()).toBe(3);

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 6000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            entry1.addPlayer(player1);
            expect(lineup.spotsTaken()).toBe(1);

            var player2 = createPlayer({
                id: "YBB1",
                name: "Micheal B",
                salary: 2000,
                opp: "YBB2",
                fppg: "YBB3",
                position: "SM"
            });

            entry2.addPlayer(player2);
            expect(lineup.spotsTaken()).toBe(2);

            var player3 = createPlayer({
                id: "ZCB1",
                name: "Micheal C",
                salary: 15000,
                opp: "ZCB2",
                fppg: "ZCB3",
                position: "SG"
            });

            entry3.addPlayer(player3);
            expect(lineup.spotsTaken()).toBe(3);

            lineup.clear();
            expect(lineup.spotsTaken()).toBe(0);
        });

        it("You should be able to find out what's the average remaining salary in the lineup", function () {
          
            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 6000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            var player2 = createPlayer({
                id: "YBB1",
                name: "Micheal B",
                salary: 2000,
                opp: "YBB2",
                fppg: "YBB3",
                position: "SM"
            });

            var player3 = createPlayer({
                id: "ZCB1",
                name: "Micheal C",
                salary: 13000,
                opp: "ZCB2",
                fppg: "ZCB3",
                position: "SG"
            });

            entry1.addPlayer(player1);
            entry2.addPlayer(player2);
            entry3.addPlayer(player3);

            var lineup = new Lineup(65000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);

            expect(lineup.averagePlayerSalary()).toBe(7000);
            expect(lineup.averageRemainingPlayerSalary()).toBe(0);

        });

        it("You should be able to find out what's the minimum salary in the lineup", function () {
          
            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 2000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            var player3 = createPlayer({
                id: "ZCB1",
                name: "Micheal C",
                salary: 13000,
                opp: "ZCB2",
                fppg: "ZCB3",
                position: "SG"
            });

            entry1.addPlayer(player1);
            entry3.addPlayer(player3);

            var lineup = new Lineup(65000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);

            expect(lineup.getMinPlayerSalary()).toBe(2000);

        });

        it("You should be able to find out what's the maximum salary in the lineup", function () {
          
            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 6000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            var player2 = createPlayer({
                id: "YBB1",
                name: "Micheal B",
                salary: 2000,
                opp: "YBB2",
                fppg: "YBB3",
                position: "SM"
            });


            entry1.addPlayer(player1);
            entry2.addPlayer(player2);

            var lineup = new Lineup(65000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);

            expect(lineup.getMaxPlayerSalary()).toBe(6000);

        });

        it("You should be able to get list of all salaries of players", function () {
            var entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            var entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            var entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            var player1 = createPlayer({
                id: "XAB1",
                name: "Micheal A",
                salary: 6000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            var player2 = createPlayer({
                id: "YBB1",
                name: "Micheal B",
                salary: 2000,
                opp: "YBB2",
                fppg: "YBB3",
                position: "SM"
            });


            entry1.addPlayer(player1);
            entry2.addPlayer(player2);

            var lineup = new Lineup(65000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);

            var salaries = lineup.getAllSalaries();
            expect(salaries[0]).toBe(6000);
            expect(salaries[1]).toBe(2000);
            expect(salaries[2]).toBe(undefined);
        });

    });

    describe("Tests for sorting Entries in a Lineup", function () {

        var entry1, entry2, entry3, player1, player2, player3, lineup;
        // set up the sorting tests
        beforeEach(function() {
            entry1 = createEntry("POS1", "SF", "UNIQUE_ID_1");
            entry2 = createEntry("POS2", "SM", "UNIQUE_ID_2");
            entry3 = createEntry("POS3", "SG", "UNIQUE_ID_3");

            player1 = createPlayer({
                id: "XAB1",
                name: "Micheal Waa",
                salary: 6000,
                opp: "XAB2",
                fppg: "XAB3",
                position: "SF"
            });

            player2 = createPlayer({
                id: "YBB1",
                name: "Micheal Gaa",
                salary: 2000,
                opp: "YBB2",
                fppg: "YBB3",
                position: "SM"
            });

            player3 = createPlayer({
                id: "ZCB1",
                name: "Micheal Daa",
                salary: 13000,
                opp: "ZCB2",
                fppg: "ZCB3",
                position: "SG"
            });

            entry1.addPlayer(player1);
            entry2.addPlayer(player2);
            entry3.addPlayer(player3);

            lineup = new Lineup(65000);
            lineup.addEntry(entry1);
            lineup.addEntry(entry2);
            lineup.addEntry(entry3);

            expect(lineup.getAllEntries()[0].player.name).toBe("Micheal Waa");
            expect(lineup.getAllEntries()[1].player.name).toBe("Micheal Gaa");
            expect(lineup.getAllEntries()[2].player.name).toBe("Micheal Daa");
            expect(lineup.getAllEntries()[0].player.salary).toBe(6000);
            expect(lineup.getAllEntries()[1].player.salary).toBe(2000);
            expect(lineup.getAllEntries()[2].player.salary).toBe(13000);

        });

        it("You should be able to sort the entries by salary", function () {
            lineup.sortBySalary();
            expect(lineup.getAllEntries()[0].player.salary).toBe(2000);
            expect(lineup.getAllEntries()[1].player.salary).toBe(6000);
            expect(lineup.getAllEntries()[2].player.salary).toBe(13000);

        });

        it("You should be able to sort the entries by salary (descending)", function () {
            lineup.sortBySalary("desc");
            expect(lineup.getAllEntries()[0].player.salary).toBe(13000);
            expect(lineup.getAllEntries()[1].player.salary).toBe(6000);
            expect(lineup.getAllEntries()[2].player.salary).toBe(2000);

        });

        it("You should be able to sort the entries by salary (ascending)", function () {
            lineup.sortBySalary("asc");
            expect(lineup.getAllEntries()[0].player.salary).toBe(2000);
            expect(lineup.getAllEntries()[1].player.salary).toBe(6000);
            expect(lineup.getAllEntries()[2].player.salary).toBe(13000);

        });


        it("You should be able to sort the entries by name", function () {
            lineup.sortByName();
            expect(lineup.getAllEntries()[0].player.name).toBe("Micheal Daa");
            expect(lineup.getAllEntries()[1].player.name).toBe("Micheal Gaa");
            expect(lineup.getAllEntries()[2].player.name).toBe("Micheal Waa");
        });

        it("You should be able to sort the entries by name (descending)", function () {
            lineup.sortByName("desc");
            expect(lineup.getAllEntries()[0].player.name).toBe("Micheal Waa");
            expect(lineup.getAllEntries()[1].player.name).toBe("Micheal Gaa");
            expect(lineup.getAllEntries()[2].player.name).toBe("Micheal Daa");
        });

        it("You should be able to sort the entries by name (ascending)", function () {
            lineup.sortByName("asc");
            expect(lineup.getAllEntries()[0].player.name).toBe("Micheal Daa");
            expect(lineup.getAllEntries()[1].player.name).toBe("Micheal Gaa");
            expect(lineup.getAllEntries()[2].player.name).toBe("Micheal Waa");
        });

        it("You should be able to sort the entries by other fields too", function () {
            lineup.sortBy("position");
            expect(lineup.getAllEntries()[0].player.position).toBe("SF");
            expect(lineup.getAllEntries()[1].player.position).toBe("SG");
            expect(lineup.getAllEntries()[2].player.position).toBe("SM");
            lineup.sortBy("position", "desc");
            expect(lineup.getAllEntries()[0].player.position).toBe("SM");
            expect(lineup.getAllEntries()[1].player.position).toBe("SG");
            expect(lineup.getAllEntries()[2].player.position).toBe("SF");
            lineup.sortBy("position", "asc");
            expect(lineup.getAllEntries()[0].player.position).toBe("SF");
            expect(lineup.getAllEntries()[1].player.position).toBe("SG");
            expect(lineup.getAllEntries()[2].player.position).toBe("SM");
            lineup.sortBy("id");
            expect(lineup.getAllEntries()[0].player.id).toBe("XAB1");
            expect(lineup.getAllEntries()[1].player.id).toBe("YBB1");
            expect(lineup.getAllEntries()[2].player.id).toBe("ZCB1");
            // other fields with strings as values should be sorted the same
            // the fields should be filled in
        });

    });

}).call(this);