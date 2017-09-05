var FIXTURES = FIXTURES || {};

FIXTURES.contests = {
  "liveContests": [
    {
      "id": 52,
      "sport": "NBA",
      "start_at": "2003-03-17T20:44:04.984Z",
      "end_at": "2004-03-17T20:44:04.984Z",
      "entry_fee": "$1.0",
      "prize": "$9.5",
      "place": 814,
      "results_path": "/entries/1",
      "final_pos": 5,
      "num_entries": 10
    }
  ],
  "upcomingContests": [
    {
      "id": 53,
      "sport": "NBA",
      "complete": "2014-03-16 04:00:00",
      "entry_fee": "$1.0",
      "end_at": "2004-03-17T20:44:04.984Z",
      "contest_start": "2015-03-17T20:44:04.984Z",
      "prize": "$9.5",
      "place": 814,
      "entry_size": 100,
      "entries_count": 3,
      "max_entries": 10,
      "results_path": "/entries/1",
      "edit_path": "/entries/1/edit",
      "view_path": "/entries/1/view"
    }
  ],
  "completedContests": [
    {
      "id": 55,
      "sport": "NBA",
      "complete": "2014-03-16 04:00:00",
      "entry_fee": "$1.0",
      "prize": "$9.5",
      "place": 814,
      "won": "$0",
      "results_path": "/entries/1"
    }
  ]
};

FIXTURES.Backbone = {
  contest: {
    "id": 217,
    "title": null,
    "sport": "NBA",
    "contest_type": "50/50",
    "prize": "9.0",
    "entry_fee": "1.0",
    "contest_start": "2014-03-25 23:00:00",
    "created_at": "2014-03-21 18:48:08",
    "updated_at": "2014-03-21 18:48:08",
    "max_entries": 10,
    "contest_end": null,
    "entries_count": 3,
    "contestdate": "2014-03-25"
  },
  teams: [
    {
      "created_at": "2014-03-20 19:08:14",
      "ext_team_id": "583ecfff-fb46-11e1-82cb-f4ce4684ea4c",
      "id": 2,
      "name": "Oklahoma City Thunder",
      "teamalias": "OKC",
      "updated_at": "2014-03-20 19:08:14"
    },
    {
      "created_at": "2014-03-20 19:08:15",
      "ext_team_id": "583ecda6-fb46-11e1-82cb-f4ce4684ea4c",
      "id": 9,
      "name": "Toronto Raptors",
      "teamalias": "TOR",
      "updated_at": "2014-03-20 19:08:15"
    },
    {
      "created_at": "2014-03-21 19:08:15",
      "ext_team_id": "aaaaada6-fb46-11e1-82cb-f4ce4684ea4c",
      "id": 29,
      "name": "Blue Dolphins",
      "teamalias": "BOD",
      "updated_at": "2014-03-20 19:08:15"
    },
    {
      "created_at": "2014-02-20 19:08:15",
      "ext_team_id": "qqqqqda6-fb46-11e1-82cb-f4ce4684ea4c",
      "id": 17,
      "name": "White Chickens",
      "teamalias": "WCH",
      "updated_at": "2014-03-20 19:28:15"
    }
  ],
  games: [
    {
      "id": 58,
      "playdate": "2014-03-25",
      "ext_game_id": "5dc34ab6-9a5f-43f3-811d-1a1a9bb8377c",
      "scheduledstart": "2014-03-28 23:00:00",
      "home_team_id": 9,
      "away_team_id": 17,
      "home_team_score": null,
      "away_team_score": null,
      "status": "scheduled",
      "clock": null,
      "period": null,
      "created_at": "2014-03-26 18:39:09",
      "updated_at": "2014-03-26 18:39:09",
      "pretty_play_state": "SCHEDULED",
      "minutes_remaining": 48
    },
    {
      "id": 59,
      "playdate": "2014-03-25",
      "ext_game_id": "aef9b42c-3e93-4da6-81a1-7f79181dbd27",
      "scheduledstart": "2014-03-28 23:00:00",
      "home_team_id": 29,
      "away_team_id": 2,
      "home_team_score": null,
      "away_team_score": null,
      "status": "scheduled",
      "clock": null,
      "period": null,
      "created_at": "2014-03-26 18:39:09",
      "updated_at": "2014-03-26 18:39:09",
      "pretty_play_state": "SCHEDULED",
      "minutes_remaining": 48
    },
    {
      "id": 60,
      "playdate": "2014-03-25",
      "ext_game_id": "41a5aab3-1332-4f66-bf44-2679bc787307",
      "scheduledstart": "2014-03-28 23:00:00",
      "home_team_id": 6,
      "away_team_id": 12,
      "home_team_score": null,
      "away_team_score": null,
      "status": "scheduled",
      "clock": null,
      "period": null,
      "created_at": "2014-03-26 18:39:09",
      "updated_at": "2014-03-26 18:39:09",
      "pretty_play_state": "SCHEDULED",
      "minutes_remaining": 48
    },
    {
      "id": 61,
      "playdate": "2014-03-25",
      "ext_game_id": "d5ec0b42-b67f-473c-80c7-48a1c9494e71",
      "scheduledstart": "2014-03-28 23:30:00",
      "home_team_id": 5,
      "away_team_id": 3,
      "home_team_score": null,
      "away_team_score": null,
      "status": "scheduled",
      "clock": null,
      "period": null,
      "created_at": "2014-03-26 18:39:09",
      "updated_at": "2014-03-26 18:39:09",
      "pretty_play_state": "SCHEDULED",
      "minutes_remaining": 48
    }
  ],
  positions: [
    {
      "id": 1,
      "name": "PG",
      "sport": "NBA",
      "display_priority": 1,
      "created_at": "2014-03-05 19:24:38",
      "updated_at": "2014-03-05 19:24:38",
      "visible": true
    },
    {
      "id": 2,
      "name": "SG",
      "sport": "NBA",
      "display_priority": 2,
      "created_at": "2014-03-05 19:24:38",
      "updated_at": "2014-03-05 19:24:38",
      "visible": true
    },
    {
      "id": 3,
      "name": "SF",
      "sport": "NBA",
      "display_priority": 3,
      "created_at": "2014-03-05 19:24:38",
      "updated_at": "2014-03-05 19:24:38",
      "visible": true
    },
    {
      "id": 4,
      "name": "PF",
      "sport": "NBA",
      "display_priority": 4,
      "created_at": "2014-03-05 19:24:38",
      "updated_at": "2014-03-05 19:24:38",
      "visible": true
    },
    {
      "id": 5,
      "name": "C",
      "sport": "NBA",
      "display_priority": 5,
      "created_at": "2014-03-05 19:24:38",
      "updated_at": "2014-03-05 19:24:38",
      "visible": true
    },
    {
      "id": 6,
      "name": "UTIL",
      "sport": "NBA",
      "display_priority": 0,
      "created_at": "2014-03-05 19:24:38",
      "updated_at": "2014-03-05 19:24:38",
      "visible": false
    }
  ]
};
