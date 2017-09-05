SportPosition.where(sport: "MLB", name: "P", display_priority: 1).first_or_create
SportPosition.where(sport: "MLB", name: "C", display_priority: 2).first_or_create
SportPosition.where(sport: "MLB", name: "1B", display_priority: 3).first_or_create
SportPosition.where(sport: "MLB", name: "2B", display_priority: 4).first_or_create
SportPosition.where(sport: "MLB", name: "3B", display_priority: 5).first_or_create
SportPosition.where(sport: "MLB", name: "SS", display_priority: 6).first_or_create
SportPosition.where(sport: "MLB", name: "OF", display_priority: 7).first_or_create
SportPosition.where(sport: "MLB", name: "UTIL", display_priority: 0, visible: false).first_or_create

SportPosition.where(sport: "MLB", name: "INVALID", display_priority: 0, visible: false).first_or_create

LineupSpotProto.where(sport: "MLB", sport_position_name: "P", spot: 0).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "P", spot: 1).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "C", spot: 2).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "1B", spot: 3).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "2B", spot: 4).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "3B", spot: 5).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "SS", spot: 6).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "OF", spot: 7).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "OF", spot: 8).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "OF", spot: 9).first_or_create
LineupSpotProto.where(sport: "MLB", sport_position_name: "UTIL", spot: 10).first_or_create
