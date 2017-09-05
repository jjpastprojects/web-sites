SportPosition.where(sport: "NBA", name: "PG", display_priority: 1).first_or_create
SportPosition.where(sport: "NBA", name: "SG", display_priority: 2).first_or_create
SportPosition.where(sport: "NBA", name: "SF", display_priority: 3).first_or_create
SportPosition.where(sport: "NBA", name: "PF", display_priority: 4).first_or_create
SportPosition.where(sport: "NBA", name: "C", display_priority: 5).first_or_create
SportPosition.where(sport: "NBA", name: "UTIL", display_priority: 0, visible: false).first_or_create

LineupSpotProto.where(sport: "NBA", sport_position_name: "PG", spot: 0).first_or_create
LineupSpotProto.where(sport: "NBA", sport_position_name: "PG", spot: 1).first_or_create
LineupSpotProto.where(sport: "NBA", sport_position_name: "SG", spot: 2).first_or_create
LineupSpotProto.where(sport: "NBA", sport_position_name: "SG", spot: 3).first_or_create
LineupSpotProto.where(sport: "NBA", sport_position_name: "SF", spot: 4).first_or_create
LineupSpotProto.where(sport: "NBA", sport_position_name: "SF", spot: 5).first_or_create
LineupSpotProto.where(sport: "NBA", sport_position_name: "PF", spot: 6).first_or_create
LineupSpotProto.where(sport: "NBA", sport_position_name: "PF", spot: 7).first_or_create
LineupSpotProto.where(sport: "NBA", sport_position_name: "C", spot: 8).first_or_create
LineupSpotProto.where(sport: "NBA", sport_position_name: "UTIL", spot: 9).first_or_create
