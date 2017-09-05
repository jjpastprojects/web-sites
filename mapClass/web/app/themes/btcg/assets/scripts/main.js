(function($) {

  var BTCG = {
    // All pages
    'common': {
      init: function() {

      },
      finalize: function() {

        // Hamburger icon
        $('.menu-icon').on('click', function(e) {
          var activeClass = 'is-active';
          var $nav = $('.main-navigation');
          if ( $(this).hasClass(activeClass) ) {
            $(this).removeClass(activeClass);
            $nav.removeClass(activeClass);
          } else {
            $(this).addClass(activeClass);
            $nav.addClass(activeClass);
          }
          e.preventDefault();
        });
      }
    },
    // Home page
    'home': {
      init: function() {

        // Zip code search
        $('#class-search-range').select2({
          minimumResultsForSearch: Infinity
        });

        // News Carousel
        $('#news-slider').slick();

      },
      finalize: function() {

      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = BTCG;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery);
