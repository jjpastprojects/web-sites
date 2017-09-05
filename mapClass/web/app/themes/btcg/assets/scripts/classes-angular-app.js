;(function($, _, L, angular, Moment) {

  'use strict';

  // Classes Search App declaration
  var app = angular.module(
    'braintrust', [
      'selectize'
    ])
    .run([
      '$rootScope',
      function ($rootScope) {

      }]
    );

  app.controller('ClassesCtrl', [
    '$rootScope',
    '$scope',
    '$http',
    '$filter',
    function ($rootScope, $scope, $http, $filter) {

      const ctrl = this;
      const divIcon = L.divIcon({
        className: 'market-marker',
        iconSize: new L.Point(28, 28)
      });

      let markers = null;
      let map = null;
      let marker_groups = [];
      let marketMarkers = [];
      let uniqueVisibleMarketIds = [];

      ctrl.categories = [];
      ctrl.locations = [];
      ctrl.allCategory = true;
      ctrl.option = {};

      const popupContent = (city) => {
        return `<div class="marker-popup__container">
          <h3>${city}</h3>
          <p>See upcoming classes in ${city} in the list below.</p>
        </div>`;
      };

      //display location markers on the map
      ctrl.addMarketMarkers = function(markets) {

        _.each(markets, function(ele) {
          const { lat, lng, id, city } = ele;
          const obj = L.marker(
              [lat, lng],
              {id, icon: divIcon}
            ).bindPopup(popupContent(city));
          marketMarkers.push({id, obj});
        });

      };

      ctrl.selectizeConfig = {
        placeholder: 'Choose a location',
        sortField: 'text',
        maxItems: 1
      };

      // Fetch Classes
      ctrl.fetchClasses = function() {
        return $http.get('/wp/wp-admin/admin-ajax.php?action=upcoming_classes');
      };

      // update all of individual checkbox
      ctrl.selectAllCategoryOption = function() {

        if (ctrl.allCategory === true) {
          _.each(ctrl.categories, function(value) {
            value.selected = true;
          });
        }
        else {
          _.each(ctrl.categories, function(value, key) {
            value.selected = false;
          });
        }

        ctrl.filterClasses();
        ctrl.updateMarketsFromCategories();
      };

      // update ['all'] checkbox option
      ctrl.updateAllCategoryOption = function(key) {

        var falseEle = null;

        _.each(ctrl.categories, function(value) {

          if (falseEle !== null) {
            return;
          }

          if (value.selected !== true) {
            falseEle = key;
          }
        });

        if (falseEle) {
          ctrl.allCategory = false;
        }
        else {
          ctrl.allCategory = true;
        }

        ctrl.filterClasses();
        ctrl.updateMarketsFromCategories();

      };

      // update the market markers on the map from categories.
      ctrl.updateMarketsFromCategories = function() {

        // filter by categories;
        ctrl.filterClasses();

        var availableMarketIds = _.pluck(ctrl.filteredClasses, 'market_id');
        uniqueVisibleMarketIds = _.uniq(availableMarketIds);

        _.each(marketMarkers, function(marker) {
          if ( _.contains(uniqueVisibleMarketIds, marker.id) ) {
            if (!map.hasLayer(marker.obj)) {
              marker.obj.addTo(map);
              marker.obj.on('click', function(e){

                var id = e.target.options.id;
                ctrl.filterClasses(id);
                ctrl.option.market = id.toString();

                if(!$scope.$$phase) {
                  $scope.$apply();
                }

              });
            }
          }
          else {
            if ( map.hasLayer(marker.obj) ) {
              map.removeLayer(marker.obj);
            }
          }
        });

      };

      // filter classes based on selected categories
      ctrl.filterClasses = function(marketId) {

        ctrl.filteredClasses = [];

        _.each(ctrl.obj.classes, function(ele) {

          const { category_id, id, end, market_id, start } = ele;
          const { sdate, edate } = ctrl.option;

          const exists = _.findWhere(ctrl.categories, {id: category_id, selected: true});
          if (!exists) return;

          // check for market
          if (marketId && market_id !== marketId) return;

          if (sdate) {
            var sDate = moment(sdate, 'M/D/YY').format('YYYY-MM-DD hh:mm:ss');
            if (sDate > start) return;
          }

          if (edate) {
            var eDate = moment(edate, 'M/D/YY').format('YYYY-MM-DD hh:mm:ss');
            if (eDate < end) return;
          }

          ele.formattedStart = moment(start).format('MMM Do');
          ele.formattedEnd = moment(end).format('MMM Do');

          ctrl.filteredClasses.push(ele);

        });

        if(!$scope.$$phase) {
          $scope.$apply();
        }
      };

      ctrl.selectMarket = function() {
        if (ctrl.option.market) {
          ctrl.filterClasses(parseInt(ctrl.option.market));
        }
        else {
          ctrl.filterClasses();
        }

        //update marker on the map
        _.each(marketMarkers, function(marker) {
          if (marker.id === parseInt(ctrl.option.market)) {
            marker.obj.openPopup();
            console.log(marker);
          }
        });

        if(!$scope.$$phase) {
          $scope.$apply();
        }

      };

      ctrl.initMap = function() {

        // Map tiles: MapQuest
        var map_tiles = L.tileLayer('https://otile{s}-s.mqcdn.com/tiles/1.0.0/{type}/{z}/{x}/{y}.{ext}', {
          type: 'map',
          ext: 'jpg',
          subdomains: '1234'
        });

        // Default map settings
        var default_zoom = 4;
        var max_zoom = 8;
        var min_zoom = 4;
        var map_center = [38, -97];
        var bounds = L.latLngBounds(
          L.latLng(15, -145),
          L.latLng(55, -30)
        );

        // Set Leaflet's default image path
        L.Icon.Default.imagePath = 'https://s3.amazonaws.com/btcg/leaflet';

        // --------
        // Init das map
        // --------
        map = L.map('classesMap', {
            attributionControl: false,
            center: map_center,
            minZoom: min_zoom,
            maxZoom: max_zoom,
            maxBounds: bounds,
            zoom: default_zoom,
            zoomControl: false
          })
          .addLayer(map_tiles);

        // Misc map settings
        map.scrollWheelZoom.disable();
        map.boxZoom.disable();
        map.keyboard.disable();


        ctrl.fetchClasses()
          .then(function(res) {

            ctrl.obj = res.data[0];

            _.each(ctrl.obj.categories, function(value) {
              ctrl.categories.push( {
                id: value.id,
                name: value.name,
                selected: true
              });
            });

            _.each(ctrl.obj.markets, function(value) {
              ctrl.locations.push( {
                value: value.id,
                text: `${value.city}, ${value.state}`
              });
            });

            ctrl.locations = _.sortBy(ctrl.locations, 'text');

            ctrl.addMarketMarkers(res.data[0].markets);

            // Display all on page load
            ctrl.filterClasses();
            ctrl.updateMarketsFromCategories();

          });

      };

      ctrl.initMap();
    }

  ]);

  //
  // Datepicker - Date range filter
  //
  $('.datepicker').datepicker({
    format: 'm/d/yy',
    autoclose: true,
    clearBtn: true
  });

  //
  // Selectize - Location select
  //
  // $('#select-location').selectize({
  //   create: true,
  //   sortField: 'text'
  // });

})(window.jQuery, window._, window.L, window.angular, window.moment);

