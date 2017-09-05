module LineupSpotsHelper
  def player_field_or_nbsp(lineup, field_name)
    lineup.player.try(field_name.to_sym) || "&nbsp;".html_safe
  end

end
