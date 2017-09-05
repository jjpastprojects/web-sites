# encoding: UTF-8
# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended that you check this file into your version control system.


ActiveRecord::Schema.define(version: 20140506200436) do


  # These are extensions that must be enabled in order to support this database
  enable_extension "plpgsql"

  create_table "accounts", force: true do |t|
    t.integer  "user_id"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "stripe_customer_id"
    t.integer  "balance_in_cents",   default: 0
    t.integer  "lock_version",       default: 0
  end

  add_index "accounts", ["user_id"], name: "index_accounts_on_user_id", using: :btree

  create_table "active_admin_comments", force: true do |t|
    t.string   "namespace"
    t.text     "body"
    t.string   "resource_id",   null: false
    t.string   "resource_type", null: false
    t.integer  "author_id"
    t.string   "author_type"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "active_admin_comments", ["author_type", "author_id"], name: "index_active_admin_comments_on_author_type_and_author_id", using: :btree
  add_index "active_admin_comments", ["namespace"], name: "index_active_admin_comments_on_namespace", using: :btree
  add_index "active_admin_comments", ["resource_type", "resource_id"], name: "index_active_admin_comments_on_resource_type_and_resource_id", using: :btree

  create_table "bank_accounts", force: true do |t|
    t.string   "name"
    t.string   "stripe_id"
    t.string   "last_4"
    t.integer  "user_id"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "recipient_id"
    t.boolean  "is_default"
  end

  create_table "contests", force: true do |t|
    t.string   "title"
    t.string   "sport"
    t.string   "contest_type"
    t.decimal  "entry_fee"
    t.datetime "contest_start"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "max_entries"
    t.integer  "entries_count", default: 0
    t.date     "contestdate"
    t.float    "rake",          default: 0.1
  end

  add_index "contests", ["contest_start"], name: "index_contests_on_contest_start", using: :btree

  create_table "credit_cards", force: true do |t|
    t.string   "stripe_id"
    t.boolean  "is_default"
    t.string   "card_brand"
    t.string   "last_4"
    t.integer  "user_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "entries", force: true do |t|
    t.integer  "lineup_id"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "contest_id"
    t.decimal  "final_score"
    t.integer  "final_pos"
  end

  add_index "entries", ["contest_id"], name: "index_entries_on_contest_id", using: :btree
  add_index "entries", ["lineup_id", "contest_id"], name: "index_entries_on_lineup_id_and_contest_id", using: :btree
  add_index "entries", ["lineup_id"], name: "index_entries_on_lineup_id", using: :btree

  create_table "game_scores", force: true do |t|
    t.date     "playdate"
    t.string   "ext_game_id"
    t.datetime "scheduledstart"
    t.integer  "home_team_id"
    t.integer  "away_team_id"
    t.integer  "home_team_score"
    t.integer  "away_team_score"
    t.string   "status"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "sport",           default: "NBA"
    t.integer  "progress",        default: 0
    t.integer  "gamelength"
  end

  add_index "game_scores", ["away_team_id"], name: "index_game_scores_on_away_team_id", using: :btree
  add_index "game_scores", ["home_team_id"], name: "index_game_scores_on_home_team_id", using: :btree

  create_table "lineup_spot_protos", force: true do |t|
    t.string   "sport"
    t.string   "sport_position_name"
    t.integer  "spot"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "lineup_spots", force: true do |t|
    t.integer  "sport_position_id"
    t.integer  "lineup_id"
    t.integer  "player_id"
    t.integer  "spot"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "lineup_spots", ["lineup_id"], name: "index_lineup_spots_on_lineup_id", using: :btree
  add_index "lineup_spots", ["player_id"], name: "index_lineup_spots_on_player_id", using: :btree
  add_index "lineup_spots", ["sport_position_id"], name: "index_lineup_spots_on_sport_position_id", using: :btree

  create_table "lineups", force: true do |t|
    t.integer  "user_id"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "sport"
  end

  add_index "lineups", ["user_id"], name: "index_lineups_on_user_id", using: :btree

  create_table "player_contests", force: true do |t|
    t.integer  "player_id"
    t.integer  "contest_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "player_contests", ["contest_id"], name: "index_player_contests_on_contest_id", using: :btree
  add_index "player_contests", ["player_id"], name: "index_player_contests_on_player_id", using: :btree

  create_table "player_real_time_scores", force: true do |t|
    t.string   "name"
    t.decimal  "value"
    t.integer  "player_id"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "game_score_id"
  end

  add_index "player_real_time_scores", ["game_score_id"], name: "index_player_real_time_scores_on_game_score_id", using: :btree
  add_index "player_real_time_scores", ["player_id"], name: "index_player_real_time_scores_on_player_id", using: :btree

  create_table "player_stats", force: true do |t|
    t.integer  "player_id"
    t.string   "stat_name"
    t.string   "stat_value"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "dimension"
    t.string   "time_span"
    t.integer  "display_priority"
  end

  add_index "player_stats", ["player_id"], name: "index_player_stats_on_player_id", using: :btree

  create_table "players", force: true do |t|
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "sport_position_id"
    t.integer  "salary"
    t.string   "first_name"
    t.string   "last_name"
    t.date     "dob"
    t.string   "ext_player_id"
    t.integer  "team_id"
  end

  create_table "projection_game_playeds", force: true do |t|
    t.integer  "player_id"
    t.integer  "game_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "projection_game_playeds", ["game_id"], name: "index_projection_game_playeds_on_game_id", using: :btree
  add_index "projection_game_playeds", ["player_id"], name: "index_projection_game_playeds_on_player_id", using: :btree

  create_table "projection_games", force: true do |t|
    t.datetime "start_date"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "ext_game_id"
    t.integer  "home_team_id"
    t.integer  "away_team_id"
    t.string   "sport",        default: "NBA"
  end

  add_index "projection_games", ["away_team_id"], name: "index_projection_games_on_away_team_id", using: :btree
  add_index "projection_games", ["home_team_id"], name: "index_projection_games_on_home_team_id", using: :btree

  create_table "projection_players", force: true do |t|
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "team_id"
    t.boolean  "is_current"
    t.string   "position"
    t.string   "ext_player_id"
  end

  add_index "projection_players", ["team_id"], name: "index_projection_players_on_team_id", using: :btree

  create_table "projection_proj_by_stat_crits", force: true do |t|
    t.integer  "projection_by_stat_id"
    t.decimal  "fp"
    t.decimal  "weighted_fp"
    t.string   "criteria"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "projection_proj_by_stat_crits", ["projection_by_stat_id", "criteria"], name: "i_projection_proj_by_stat_crits", unique: true, using: :btree
  add_index "projection_proj_by_stat_crits", ["projection_by_stat_id"], name: "index_projection_proj_by_stat_crits_on_projection_by_stat_id", using: :btree

  create_table "projection_projection_breakdowns", force: true do |t|
    t.integer  "proj_by_stat_crit_id"
    t.integer  "stat_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "projection_projection_breakdowns", ["proj_by_stat_crit_id"], name: "index_projection_projection_breakdowns_on_proj_by_stat_crit_id", using: :btree
  add_index "projection_projection_breakdowns", ["stat_id"], name: "index_projection_projection_breakdowns_on_stat_id", using: :btree

  create_table "projection_projection_by_stats", force: true do |t|
    t.string   "stat_name"
    t.decimal  "fp"
    t.decimal  "weighted_fp"
    t.integer  "projection_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "projection_projection_by_stats", ["projection_id", "stat_name"], name: "projection_by_stat_projection_and_stat_name", unique: true, using: :btree
  add_index "projection_projection_by_stats", ["projection_id"], name: "index_projection_projection_by_stats_on_projection_id", using: :btree

  create_table "projection_projections", force: true do |t|
    t.integer  "scheduled_game_id"
    t.integer  "player_id"
    t.decimal  "fp"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "projection_projections", ["player_id"], name: "index_projection_projections_on_player_id", using: :btree
  add_index "projection_projections", ["scheduled_game_id"], name: "index_projection_projections_on_scheduled_game_id", using: :btree

  create_table "projection_scheduled_games", force: true do |t|
    t.integer  "home_team_id"
    t.integer  "away_team_id"
    t.datetime "start_date"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "ext_game_id"
    t.string   "sport",        default: "NBA"
  end

  add_index "projection_scheduled_games", ["away_team_id"], name: "index_projection_scheduled_games_on_away_team_id", using: :btree
  add_index "projection_scheduled_games", ["home_team_id"], name: "index_projection_scheduled_games_on_home_team_id", using: :btree

  create_table "projection_stats", force: true do |t|
    t.string   "stat_name"
    t.decimal  "stat_value"
    t.integer  "player_id"
    t.integer  "game_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "projection_stats", ["game_id"], name: "index_projection_stats_on_game_id", using: :btree
  add_index "projection_stats", ["player_id", "game_id", "stat_name"], name: "index_projection_stats_on_player_id_and_game_id_and_stat_name", using: :btree
  add_index "projection_stats", ["player_id"], name: "index_projection_stats_on_player_id", using: :btree

  create_table "projection_teams", force: true do |t|
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.boolean  "is_current"
    t.string   "ext_team_id"
  end

  create_table "sessions", force: true do |t|
    t.string   "session_id", null: false
    t.text     "data"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "sessions", ["session_id"], name: "index_sessions_on_session_id", unique: true, using: :btree
  add_index "sessions", ["updated_at"], name: "index_sessions_on_updated_at", using: :btree

  create_table "sport_positions", force: true do |t|
    t.string   "name"
    t.string   "sport"
    t.integer  "display_priority"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.boolean  "visible",          default: true
  end

  add_index "sport_positions", ["name", "sport"], name: "index_sport_positions_on_name_and_sport", unique: true, using: :btree

  create_table "teams", force: true do |t|
    t.string   "name"
    t.string   "teamalias"
    t.string   "ext_team_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "transactions", force: true do |t|
    t.integer  "amount_in_cents"
    t.integer  "transaction_type"
    t.integer  "user_id"
    t.integer  "parent_transaction_id"
    t.integer  "payment_engine_type"
    t.string   "payment_engine_id"
    t.text     "notes"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "entry_id"
  end

  create_table "users", force: true do |t|
    t.string   "email",                  default: "",    null: false
    t.string   "encrypted_password",     default: "",    null: false
    t.string   "reset_password_token"
    t.datetime "reset_password_sent_at"
    t.datetime "remember_created_at"
    t.integer  "sign_in_count",          default: 0,     null: false
    t.datetime "current_sign_in_at"
    t.datetime "last_sign_in_at"
    t.string   "current_sign_in_ip"
    t.string   "last_sign_in_ip"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "first_name"
    t.string   "last_name"
    t.string   "balanced_customer_id"
    t.integer  "balance",                default: 0
    t.string   "username"
    t.string   "country"
    t.string   "state"
    t.boolean  "admin",                  default: false
    t.boolean  "ban"
    t.string   "auth_token"
  end

  add_index "users", ["email"], name: "index_users_on_email", unique: true, using: :btree
  add_index "users", ["reset_password_token"], name: "index_users_on_reset_password_token", unique: true, using: :btree

  create_table "versions", force: true do |t|
    t.string   "item_type",  null: false
    t.integer  "item_id",    null: false
    t.string   "event",      null: false
    t.string   "whodunnit"
    t.text     "object"
    t.datetime "created_at"
  end

  add_index "versions", ["item_type", "item_id"], name: "index_versions_on_item_type_and_item_id", using: :btree

  create_table "waiting_lists", force: true do |t|
    t.string   "email"
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "invited_by_token"
    t.string   "invitation_token"
    t.integer  "status",           default: 1
    t.integer  "user_id"
    t.string   "message"
  end

  add_index "waiting_lists", ["invitation_token"], name: "index_waiting_lists_on_invitation_token", using: :btree
  add_index "waiting_lists", ["invited_by_token"], name: "index_waiting_lists_on_invited_by_token", using: :btree
  add_index "waiting_lists", ["status"], name: "index_waiting_lists_on_status", using: :btree

end
