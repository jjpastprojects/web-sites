# ext_game_id, home_team_id, away_team_id

fakegames = [
['FAKE-1562c93a-10ed-4346-b982-f73b4c10fb94', '583ec825-fb46-11e1-82cb-f4ce4684ea4c', '583ec773-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-15934c3a-cc82-4057-a313-2188db1edb1a', '583ecc9a-fb46-11e1-82cb-f4ce4684ea4c', '583ed056-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-d6c43df2-37c5-40e7-b12f-ec2c3fe3b6ed', '583ecda6-fb46-11e1-82cb-f4ce4684ea4c', '583eca88-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-db449bd5-33da-4bd5-9aac-13c9f56ead28', '583ec97e-fb46-11e1-82cb-f4ce4684ea4c', '583eca2f-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-869bb60b-b00f-40dd-8523-10e824d38ef2', '583ece50-fb46-11e1-82cb-f4ce4684ea4c', '583ecdfb-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-713067dd-82cd-4c80-beeb-10e53d869a02', '583ecd4f-fb46-11e1-82cb-f4ce4684ea4c', '583ecae2-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-86a69970-8047-461c-b844-0bcf967ebc26', '583ec8d4-fb46-11e1-82cb-f4ce4684ea4c', '583ec9d6-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-28174a5a-0cec-4b3c-8bc0-826910911f47', '583ecb8f-fb46-11e1-82cb-f4ce4684ea4c', '583ed102-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-c7bd7c1a-d065-4dfb-9973-53717b6bbe98', '583ec5fd-fb46-11e1-82cb-f4ce4684ea4c', '583ed0ac-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-17902077-a4f1-4da8-817d-c849462b05e3', '583ec70e-fb46-11e1-82cb-f4ce4684ea4c', '583ecefd-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-657ac7bd-8291-4ea9-98e7-00a2fc3da8d8', '583ec87d-fb46-11e1-82cb-f4ce4684ea4c', '583ec7cd-fb46-11e1-82cb-f4ce4684ea4c'],
['FAKE-c06fe2aa-2c8a-42bd-870e-8151fe111cf9', '583eccfa-fb46-11e1-82cb-f4ce4684ea4c', '583ecfa8-fb46-11e1-82cb-f4ce4684ea4c'],
]

# remove previous simulated games to clean up any screwed up data
GameScore.where(playdate:Date.new(2050,12,31)).destroy_all

fakegames.each do |fg| 
    GameScore.where(ext_game_id: fg[0]).first_or_create do |game| 
        game.status = 'scheduled'
        game.playdate = Date.new(2050,12,31)
        game.home_team = Team.find_by(ext_team_id: fg[1])
        game.away_team = Team.find_by(ext_team_id: fg[2])
        game.scheduledstart = Time.new(2050,12,31)
    end
end
