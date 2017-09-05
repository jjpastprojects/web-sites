(function () {
  'use strict';
  angular.module('pugrug.login', [])
    .controller('LoginController', ['$scope', '$http', '$location',
      function ($scope, $http, $location) {


        $scope.login = function () {
          $sessionStorage.impersonated = null;

          $http.post('../emlogis/rest/sessions', {
            tenantId: $scope.tenantId,
            login: $scope.userName,
            password: CryptoJS.SHA256($scope.password + "." + $scope.tenantId).toString()
          })
            .success(function(data) {
              applicationContext.setUsername(data.userName);

              data.tenantId = $scope.tenantId;
              authService.loginConfirmed(data);

              // reset login info
              $scope.tenantId = '';
              $scope.userName = '';
              $scope.password = '';

              if (authService.hasPermissionIn(['Availability_RequestMgmt', 'Shift_RequestMgmt'])) {
                appFunc.badgeRefresh(true); // Manager = true;
              }
              else if (authService.hasPermissionIn(['Availability_Request', 'Shift_Request'])) {
                appFunc.badgeRefresh(false); // Manager = false;
              }
            })
            .error(function(err) {
              var msg = err.info || "Failed to login. Please check your credentials.";
              applicationContext.setNotificationMsgWithValues(msg, 'danger', true);
              // TODO: Check how exception will come
              if (err.exception === "ForceChangeOnFirstLogonException" || err.exception === "PendingPasswordChangeException") {
                $scope.showForm = $scope.forms[2];
              }
            });
        };

        $scope.requestPasswordReset = function() {
          $http.post('../emlogis/rest/sessions/ops/resetpassword', {
            tenantId: $scope.tenantId,
            login: $scope.userName
          })
            .success(function(data) {
              var message = data.info || "Instructions have been sent to the emai " + data.emailAddress;
              applicationContext.setNotificationMsgWithValues(message, 'success', true);
              $location.path('/');
            })
            .error(function(err) {
              var msg = err.info || err;
              applicationContext.setNotificationMsgWithValues(msg, 'danger', true);
            });
        };

        $scope.changePassword = function() {
          $http.post('../emlogis/rest/sessions/ops/chgpassword ', {
            tenantId: $scope.tenantId,
            login: $scope.userName,
            oldPassword: CryptoJS.SHA256($scope.oldPassword + "." + $scope.tenantId).toString(),
            newPassword: $scope.newPassword
          })
            .success(function() {
              applicationContext.setNotificationMsgWithValues("Password changed", 'success', true);
              $scope.password = $scope.newPassword;
              $scope.login();
            })
            .error(function(err) {
              var msg = err.info || err;
              applicationContext.setNotificationMsgWithValues(msg, 'danger', true);
            });
        };

        $scope.passwordsMatch = function() {
          return $scope.newPassword && $scope.newPassword === $scope.repeatPassword;
        };



      }]);
})();
