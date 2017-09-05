/**
 * Created by georgi k on 27/09/15.
 */
'use strict';

// Main App declaration

//angular.module('appMaps', ['uiGmapgoogle-maps'])
//  .controller('mainCtrl', function($scope) {
//    $scope.map = {center: {latitude: 2, longitude: 2}, zoom: 6, bounds: {}};
//    $scope.bounds =  {
//      sw: {
//        latitude: 0,
//        longitude: 0
//      },
//      ne: {
//        latitude: 4,
//        longitude: 4
//      }
//    };
//  });

var app = angular.module(
  'artmap',
  [
    'ui.bootstrap', 'ui.router', 'ngStorage', 'uiGmapgoogle-maps', 'artmap.commonservices'
  ])
  .config(
    [
      '$stateProvider',
      '$urlRouterProvider',
      '$locationProvider',
      '$httpProvider',
      function ($stateProvider, $urlRouterProvider, $locationProvider,
        $httpProvider,event) {

          $urlRouterProvider.otherwise('/');

          // Default Url
          $stateProvider
            .state('home', {
              url: '/',
              templateUrl :'assets/partials/layouts/home.tpl.html',
              controller: function(appContext) {
                appContext.setModuleName('home');
              }
            });
      }])
  .run([
    '$rootScope',
    '$state',
    '$location',
    '$q',
    '$modal',
    '$sessionStorage',
    'appContext',
    'appFunc',
    '$interpolate',
    function ($rootScope, $state, $location, $q, $modal, $sessionStorage, appContext,
      appFunc, $interpolate) {

    }]
);

app.controller('AppCtrl', [
  '$rootScope',
  '$scope',
  '$location',
  '$state',
  '$http',
  '$sessionStorage',
  'appFunc',
  'appContext',
  function ($rootScope, $scope, $location, $state, $http, $sessionStorage,
            appFunc, appContext) {

    var app = this;
    app.module = appContext.getModule();

  }
]);

