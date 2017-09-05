(function () {
  'use strict';
  
  var app = angular.module('pugrug');
  
  app.directive("menu", function() {
    return {
      restrict: "E",
      template: "<div ng-class='{ show: visible, left: alignment === \"left\", right: alignment === \"right\" }' ng-transclude></div>",
      transclude: true,
      scope: {
        visible: "=",
        alignment: "@"
      }
    };
  });

  app.directive("menuItem", function() {
    return {
      restrict: "E",
      template: "<div ng-click='navigate()' ng-transclude></div>",
      transclude: true,
      scope: {
        hash: "@"
      },
      link: function($scope) {
        $scope.navigate = function() {
          window.location.hash = $scope.hash;
        }
      }
    }
  });
})();
