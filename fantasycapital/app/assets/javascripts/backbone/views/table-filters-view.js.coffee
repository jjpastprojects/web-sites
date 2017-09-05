class Main.Views.TableFiltersView extends Backbone.View
    initialize: () ->
        @$el = $(".table-filters-view")
        console.log(@$el)
        if @$el.length > 0
            console.log("ATTACHED")
            @attachToggleHandler()
            @attachCheckboxHandler()
    attachToggleHandler: () ->
        self = @
        @$el.find("#home-filter-games").on("click", () ->
            self.toggleFilters()
        )
    attachCheckboxHandler: () ->
        @$el.find(".checkbox-toggle").on("click", () ->
            $(@).toggleClass("active")
            val = $(@).attr("data-value")
            $(@).attr("data-value", val == "false" ? "true" : "false")
        )
    toggleFilters: () ->
        @$el.find("#home-filter-games").toggleClass("active");
        @$el.find("#home-filter-options").toggleClass("hide");