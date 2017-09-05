
# View of an entry summary row at the top of gamecenter (ie where all users' entries are listed).

class Main.Views.EntrySummarysView extends Backbone.View
  debug: true
  page: 0
  initialize: (args) ->
    @template = $("#entry-summary-template").html()
    @entries_coll = args.entries_coll
    @players_coll = args.players_coll
    @listenTo(@entries_coll, 'reset', @render)
    @listenTo(@entries_coll, 'change', @changeEntrySummary)
    @listenTo(@entries_coll, 'sort', @handleSort)   # collection was just re-sorted.

    # this is a big hammer -- any player change will cause entry summary redraw. But maybe it's ok?
    # it'll be ok if the players won't change too often
    @listenTo(@players_coll, 'change', @changeEntrySummary)

    @render()

  # receive a sort message. it passes a collection, which we have to ditch for rendering.
  handleSort: (coll) ->
    @render()

  changeEntrySummary: () ->
    # this is just here so we have a place we can easily breakpoint for debugging
    @render()

  render: (offset) ->
    offset = offset || 0
    rendered = ""
    position = 1;
    accumulator = 0;
    @entries_coll.each( (entry, index) ->
        entry.set("summary_position", position)
        if offset <= index && offset + 10 > index
          rendered += _.template(this.template, {
            entry: entry, 
            user_img: window.user_img_placeholder, 
            position: entry.get("summary_position")
          })
        #current and next entry
        curr = entry
        next = @entries_coll.at(index + 1)
        # if this and next element are defined, 
        # curr should have more fantasy points than next,
        # increment position if they're not equal
        # next should never have more fps than first
        # if it does, then the endpoint gave the data in wrong order
        # which should never happen
        if curr && next && parseFloat(curr.get_total_score()) > parseFloat(next.get_total_score())
          position += 1;
          position += accumulator
          accumulator = 0
        else
          accumulator += 1;
      , this )
    $(@el).html(rendered)
    return this

  # maxPage will specify how far can the pagination go
  # it's a number from 0 to N
  maxPage: () ->
    Math.floor(@entries_coll.length / 10)
  #paginate 10 users at a time, rerender the view
  # true or false is returned for the nextPage and prevPage methods
  # to make them cleaner
  paginate: (num) ->
    if num >= 0 && num <= @maxPage()
      if @debug
        console.log(num)
        console.log((@maxPage()))
      @render(num * 10, 10)
      return true
    return false

  # DRY for nextPage and prevPage
  changePage: (direction) ->
    if direction == "next"
      value = 1
    else
      direction = "prev"
      value = -1
    if @debug
      console.log "Trying to render " + direction + " page";
    if @paginate(@page + value)
      @page += value
      if @debug
        console.log direction + " page was rendered successfully";
      return true
    if @debug
        console.log direction + " page is not available";
    return false
  # check if next page is available, if yes then increment the internal page value
  nextPage: () ->
    @changePage("next")
  # check if prev page is available, if yes then decrement the internal page value
  prevPage: () ->
    @changePage("prev")