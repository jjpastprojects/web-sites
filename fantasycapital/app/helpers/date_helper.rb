# This requires some jQuery initialization inside the bootstrap run_file. But
# to get this working all you need to do is render dates via these helpers and it
# should all work as expected.
module DateHelper

  def countdown_tag(date)
    iso = date ? date.utc.iso8601 : ''
    raw "<span class=\"countdown\" data-date=\"#{iso}\"></span>"
  end

  def local_date_tag(date)
    iso = date ? date.utc.iso8601 : ''
    raw "<span data-time=\"#{iso}\"></span>"
  end
end
