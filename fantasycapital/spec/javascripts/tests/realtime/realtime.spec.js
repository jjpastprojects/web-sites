var fakechannelobj = {
    bind: function () {
        console.log("Called bind");
    }

}

window.Pusher = function (key) {
    return {
        subscribe: function () {
            console.log("Called subscribe");
            return fakechannelobj;
        }
    };
};

var stubdata = {"contest": {}, "entry": {"id": 1, "lineup_id": 1, "created_at": "2014-03-07 17:55:37", "updated_at": "2014-03-07 17:55:37", "contest_id": 10}, "users": [], "lineup": {"id": 1, "user_id": 1, "created_at": "2014-03-07 17:55:37", "updated_at": "2014-03-07 17:55:37", "sport": "NBA"},
    "lineup_spots": [
    {"player": {"id": 223, "team": "Timberwolves", "created_at": "2014-03-07 17:25:57", "updated_at": "2014-03-07 17:25:57", "sport_position_id": 1, "salary": 3000, "first_name": "A.J.", "last_name": "Price", "dob": "1986-10-07", "ext_player_id": "00278ead-9420-47ba-a8c6-18e5c61d1492"}, "sport_position": {"id": 1, "name": "PG", "sport": "NBA", "display_priority": 1, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": true}, "score": 0, "stats": {"points":0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 16}},
    {"player": {"id": 293, "team": "Nuggets", "created_at": "2014-03-07 17:25:59", "updated_at": "2014-03-07 17:25:59", "sport_position_id": 1, "salary": 4400, "first_name": "Aaron", "last_name": "Brooks", "dob": "1985-01-14", "ext_player_id": "b838cbad-0877-4189-ba3d-039962da7ebd"}, "sport_position": {"id": 1, "name": "PG", "sport": "NBA", "display_priority": 1, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": true}, "score": 5, "stats": {"points": 0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 32}},
    {"player": {"id": 245, "team": "Jazz", "created_at": "2014-03-07 17:25:57", "updated_at": "2014-03-07 17:25:57", "sport_position_id": 2, "salary": 7900, "first_name": "Alec", "last_name": "Burks", "dob": "1991-07-20", "ext_player_id": "73fcf334-2088-4862-b83b-66eae415cf87"}, "sport_position": {"id": 2, "name": "SG", "sport": "NBA", "display_priority": 2, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": true}, "score": 10, "stats": {"points": 0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 0}},
    {"player": {"id": 226, "team": "Timberwolves", "created_at": "2014-03-07 17:25:57", "updated_at": "2014-03-07 17:25:57", "sport_position_id": 2, "salary": 3000, "first_name": "Alexey", "last_name": "Shved", "dob": "1988-12-16", "ext_player_id": "5af8d05e-98e0-4d4a-87a3-8f2ce31173a7"}, "sport_position": {"id": 2, "name": "SG", "sport": "NBA", "display_priority": 2, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": true}, "score": 0, "stats": {"points": 0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 0}},
    {"player": {"id": 176, "team": "Cavaliers", "created_at": "2014-03-07 17:25:55", "updated_at": "2014-03-07 17:25:55", "sport_position_id": 3, "salary": 3000, "first_name": "Alonzo", "last_name": "Gee", "dob": "1987-05-29", "ext_player_id": "eee7ca97-fce8-4af4-94b5-f5b107c76b46"}, "sport_position": {"id": 3, "name": "SF", "sport": "NBA", "display_priority": 3, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": true}, "score": 0, "stats": {"points": 0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 0}},
    {"player": {"id": 108, "team": "Nets", "created_at": "2014-03-07 17:25:53", "updated_at": "2014-03-07 17:25:53", "sport_position_id": 3, "salary": 3000, "first_name": "Alan", "last_name": "Anderson", "dob": "1982-10-16", "ext_player_id": "1b260e56-45ff-4a14-9b4e-744553ef15bf"}, "sport_position": {"id": 3, "name": "SF", "sport": "NBA", "display_priority": 3, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": true}, "score": 0, "stats": {"points": 0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 0}},
    {"player": {"id": 85, "team": "Knicks", "created_at": "2014-03-07 17:25:52", "updated_at": "2014-03-07 17:25:52", "sport_position_id": 4, "salary": 6600, "first_name": "Amar'e", "last_name": "Stoudemire", "dob": "1982-11-16", "ext_player_id": "76b89403-aaea-4730-bb7e-e60f38c56c3e"}, "sport_position": {"id": 4, "name": "PF", "sport": "NBA", "display_priority": 4, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": true}, "score": 0, "stats": {"points": 0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 0}},
    {"player": {"id": 142, "team": "Raptors", "created_at": "2014-03-07 17:25:54", "updated_at": "2014-03-07 17:25:54", "sport_position_id": 4, "salary": 7300, "first_name": "Amir", "last_name": "Johnson", "dob": "1987-05-01", "ext_player_id": "b6b33dc2-65be-4fe0-b153-47145c693df2"}, "sport_position": {"id": 4, "name": "PF", "sport": "NBA", "display_priority": 4, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": true}, "score": 0, "stats": {"points": 0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 0}},
    {"player": {"id": 435, "team": "Kings", "created_at": "2014-03-07 17:26:04", "updated_at": "2014-03-07 17:26:04", "sport_position_id": 5, "salary": 3000, "first_name": "Aaron", "last_name": "Gray", "dob": "1984-12-07", "ext_player_id": "3a29a6a9-c588-48bf-8140-251bb59458c7"}, "sport_position": {"id": 5, "name": "C", "sport": "NBA", "display_priority": 5, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": true}, "score": 0, "stats": {"points": 0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 0}},
    {"player": {"id": 42, "team": "Hawks", "created_at": "2014-03-07 17:25:51", "updated_at": "2014-03-07 17:25:51", "sport_position_id": 5, "salary": 3000, "first_name": "Al", "last_name": "Horford", "dob": "1986-06-03", "ext_player_id": "cf3a87ec-c2f7-42e8-9698-6f8b2ba916a9"}, "sport_position": {"id": 6, "name": "UTIL", "sport": "NBA", "display_priority": 0, "created_at": "2014-03-01 18:28:43", "updated_at": "2014-03-01 18:28:43", "visible": false}, "score": 0, "stats": {"points": 0, "assists": 0, "steals": 0, "rebounds": 0, "blocks": 0, "turnovers": 0, "minutes": 0, "fp": 0}}
],
    "my": {"id": 1, "email": "nilsbunger@gmail.com", "created_at": "2014-02-28 04:34:51", "updated_at": "2014-03-07 17:52:20", "first_name": "Nils", "last_name": "Bunger", "balanced_customer_id": null, "balance": 0, "username": "nilsbunger", "country": "US", "state": "CA"}}

describe("Gamecenter", function () {
    // load backbone templates
    var gamecenter;
    beforeEach(function () {
        var orig_fixtures_path = jasmine.getFixtures().fixturesPath;
        jasmine.getFixtures().fixturesPath = '/app/assets/javascripts/backbone/templates';
        appendLoadFixtures("entry-summary-template.html");
        appendLoadFixtures("games-template.html");
        appendLoadFixtures("entry-template.html");

        jasmine.getFixtures().fixturesPath = orig_fixtures_path;
        appendLoadFixtures("backbone_fixture.html");
        console.log("Fixtures loaded");
        gamecenter = new GameCenterCls;

        //gamecenter.handleEntryData(stubdata); // do callback of first entry

    });
    // BUGBUG: PENDING for now until we hook up realtime updates to backbone.
    xit("has player list populated in memory", function () {
        var numplayers = Object.keys(gamecenter.players).length
            expect(numplayers).toBe(10);

    });

    // BUGBUG: PENDING for now until we hook up realtime updates to backbone.
    describe("when pushing a player that browser doesn't know about", function () {
       xit("will be a no-op", function () {
           gamecenter.handlePushedStats({players:[{id:9994, stat_name: "points", stat_value:320}]});
           expect(1).toBe(1);
       }) ;
    });

    describe("when pushing one player update", function () {
        // BUGBUG: PENDING for now until we hook up realtime updates to backbone.
        xit("will update only that one player", function () {
            var playeridx = 4;
            var playerid = stubdata.lineup_spots[playeridx].player.id;
            gamecenter.handlePushedStats({players:[{id:playerid, stat_name: "points", stat_value:320}]});
            var j=0;

            for (k in gamecenter.players) {
                var player = gamecenter.players[k];
                if (player.id === playerid) {
                    expect(player.stats['points']).toBe(320);
                } else {
                    expect(player.stats['points']).toBe(stubdata.lineup_spots[j].stats['points']);

                }
            }
            var k = Object.keys(gamecenter.players);


            expect(Object.keys(gamecenter.players).length).toBe(10);

            console.log("done");
        });
    });



});