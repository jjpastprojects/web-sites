/**
 * Created by Georgi K on 04/10/15.
 */
//Map Controller on map page

angular.module('artmap').controller('MapCtrl',
  [
    '$scope',
    '$rootScope',
    '$location',
    '$stateParams',
    '$state',
    '$http',
    'appContext',
    'appFunc',
    function ($scope, $rootScope, $location, $stateParams, $state, $http, appContext, appFunc) {

      $scope.map = {center: {latitude: 2, longitude: 2}, zoom: 6, bounds: {}};
      $scope.bounds =  {
        sw: {
          latitude: 0,
          longitude: 0
        },
        ne: {
          latitude: 4,
          longitude: 4
        }
      };

    }
  ]
);

