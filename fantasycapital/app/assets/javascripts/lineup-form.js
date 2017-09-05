(function () {
    "use strict";
    /*globals $, Lineup, Main, init_colls */
    var lineup_players_view;


    function draftHandler (mybody) {

        var $draftEmitter  = $(".js-draft-emitter");
        var $draftReceiver = $(".js-draft-receiver");
        var $draftSearch   = $("#js-draft-search");
        var $sportFilter   = $("#filterSport");
        var $gameFilter    = $("#filter_player");

        if ( !$draftEmitter.length || !$draftReceiver.length || 
             !$sportFilter.length || !$draftSearch.length ||
             !$gameFilter) {
            return null;
        }
        // bootstrap appends an arrow automatically

        function getArrow() {
            // other click event is set up on different element, we need to wait till it's done
            window.setTimeout(function () {
                var $activeTable = $draftReceiver.find(".active table");
                var tabClass = $activeTable.find("span.sign").parent().attr("class");
                var clone = $activeTable.find("span.sign").clone();
                $draftEmitter.find("span.sign").remove();
                $draftEmitter.find("." + tabClass).append(clone);
            }, 10);
        }

        function setWidth() {
            window.setTimeout(function () {
                $draftReceiver.find(".tab-pane.active thead").removeClass("hide");
                $draftReceiver.find(".tab-pane.active th").each(function (index) {
                   var width = $(this).width();
                   $draftEmitter.find("th").eq(index).width(width);
                });
                $draftReceiver.find(".tab-pane.active thead").addClass("hide");
            }, 10);
        }

        function getGames() {
            var frag = document.createDocumentFragment();
            var option = document.createElement("option");
            option.value     = "";
            option.innerHTML = "ALL GAMES";
            frag.appendChild(option);
            var games = mybody.games_coll;
            games.each(function (game) {
                option = document.createElement("option");
                option.value     = game.teams_string();
                option.innerHTML = game.teams_string_and_date();
                frag.appendChild(option);
            });
            $("#filter_player").html(frag);
        }

        function filterBy(selector, className) {
            return function () {
                var term = $.trim(this.value).toUpperCase();
                // in each row
                $("#lineup-eligible-players-el tr").each(function () {
                    // get player name in each row
                    var name = $.trim($(this).find(selector).text()).toUpperCase();
                    // if term matches the name
                    if (name.match(term)) {
                        // class hidden needed so it won't interfere with type filtering
                        $(this).removeClass(className);
                    } else {
                        // hide
                        $(this).addClass(className);
                    }
                });
            }
        }
  
        var filterByPlayer = filterBy(".player", "hide-by-player");
        var filterByGame   = filterBy(".opp", "hide-by-game");

        getArrow();
        setWidth();
        getGames();

        $draftSearch.on("keyup", filterByPlayer);
        $gameFilter.on("change", filterByGame);
        
        $draftEmitter.find("table").addClass("sortable");

        $draftEmitter.unbind().on("click", "thead th", function () {

            var $activeTable = $draftReceiver.find(".active table");
            var className = $(this).attr("class");
            $activeTable.find("th." + className).click();
            getArrow();

        });

        $sportFilter.children("li").on("click", function (e) {
            e.preventDefault();
            // other click event handler is attached, it needs to be 
            // completed first before this code jumps in
            $(this).addClass("active").siblings("li").removeClass("active");

            var type = $.trim($(this).text());

            if (type === "ALL") {
                $("#lineup-eligible-players-el tr").removeClass("hide");
            } else {
                $("#lineup-eligible-players-el tr").each(function () {
                    var position = $.trim($(this).find(".position").text());
                    if (position !== type) {
                        // class hide should be here
                        $(this).addClass("hide");
                    } else {
                        $(this).removeClass("hide");
                    }
                });
            }
            // call the search player function with the input node as ~this~
            filterByPlayer.call($draftSearch[0]);
            filterByGame.call($gameFilter[0]);
            setWidth();

        });
        
    }

    function populateDraftRows(players_coll) {
        // populate the rows in the draft table
        lineup_players_view = new Main.Views.LineupPlayerView(
            {el: $("#lineup-eligible-players-el"), players_coll: players_coll}
        );

    }

    $(document).on("ready page:load", function () {
        if ($("body#lineups_new").length || $("body#lineups_edit").length) {
            //we are on new-lineup page or in a lineup-edit page.

            // call function defined in the Rails template. This populates the backbone collections
            ///  into the element specified here.
            var mybody = $("body")[0];
            init_colls(mybody);

            populateDraftRows(mybody.players_coll);

            // table's now populated. enable sort.

            // create player stats modal popup handler. Binds to appropriate rows.
            $(".player-stats").on("click", function () {

                var stats = $(this).attr("data-stats-url"),
                    player = $.trim($(this).text());
                if (player && stats) {
                   new window.AjaxModal4Container(stats).load();
                }
                
            });

            // create lineup object, (handles '+' for adding player to a lineup)
            new Lineup();

            // run bootstrap sortable. note 'reversed' used to make arrows show up the right way.
            $.bootstrapSortable(false, "reversed");

            // this code is used to fix the scroll issue inside the lineups page
            // table layout doesn't allow separete thead and tbody
            draftHandler(mybody);


        }


    });

})();

