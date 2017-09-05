/**
 * Created by Georgi K on 01/10/15.
 */
// This Controller is header navigation bar controller

angular.module('artmap').controller('HeaderCtrl',
  [
    '$scope',
    '$rootScope',
    '$location',
    '$stateParams',
    '$state',
    '$http',
    '$sessionStorage',
    '$modal',
    'appContext',
    'appFunc',
    function ($scope, $rootScope, $location, $stateParams, $state, $http, $sessionStorage,
              $modal, appContext, appFunc) {

      $scope.location = $location;
      $scope.searchEntity = "Employee";
      $scope.searchEntityLabel = "Search";
      $scope.searchQuery = "";

      $scope.onLoginPage = function () {
        return $location.path() === "/";
      };

      $scope.taskLabel = 'Tasks';
      $scope.accountMgmtTaskLabel = 'Account Mgmt';

      // Navbar should be collapsed by default
      $scope.navbarCollapsed = true;

      /**
       * badge notification settings
       */
      $scope.currentAccountInfo = $sessionStorage.info && JSON.parse($sessionStorage.info);


      $scope.setSearchEntity = function (entity, label) {
        $scope.searchEntity = entity;
        $scope.searchEntityLabel = label;
      };

      $scope.fireSearch = function () {
        var x = 1;
        var currentstate = $state.current;
        var to = 'search.query';
        $state.go(to, {entity: $scope.searchEntity, q: $scope.searchQuery});
      };



    }
  ]
);

