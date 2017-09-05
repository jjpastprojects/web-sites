'use strict';
/**
 * Global Constants
 * @type {string}
 */


// Main App declaration
// It loads library defined modules such as grid, translate, session and custom modules
var app = angular.module(
    'pugrug',
    [
        'ui.bootstrap', 'ui.router', 'pugrug.login'
    ])
        .config(
            [
                '$stateProvider',
                '$urlRouterProvider',
                '$locationProvider',
                '$httpProvider',               
                function ($stateProvider, $urlRouterProvider, $locationProvider,
                          $httpProvider) {


                  // Default Url
                  $urlRouterProvider.otherwise('/');

                  $stateProvider
                    .state('login', {
                      url: "/",
                      templateUrl: "modules/login/login.html",
                      controller: 'LoginController'
                    });


                }])
        .run([
            '$rootScope',
            '$state',
            '$location',
            '$q',
            function ($rootScope, $state, $location, $q) {

              // side bar menu keyboard
              document.addEventListener("keyup", function(e) {
                if (e.keyCode === 27)
                  $rootScope.$broadcast("escapePressed", e.target);
              });

              document.addEventListener("click", function(e) {
                $rootScope.$broadcast("documentClicked", e.target);
              });


            }]
        )
    ;

app.controller('AppCtrl', [
    '$rootScope',
    '$scope',
    '$location',
    '$state',
    '$http',
    function ($rootScope, $scope, $location, $state, $http) {

      $scope.visible = false;

      $scope.showLeft = function(e) {

        $scope.visible = true;
        e.stopPropagation();
      };

      $rootScope.$on("documentClicked", _close);
      $rootScope.$on("escapePressed", _close);

      function _close() {

        $scope.$apply(function() {
          $scope.closeSideBar();
        });
      }

      $scope.closeSideBar = function() {
        $scope.visible = false;
      };



    }

]);
