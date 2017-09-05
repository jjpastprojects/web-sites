/**=========================================================
 * Module: auth.service.js
 * API Authentication Service
 =========================================================*/
(function () {
  'use strict';

  angular
    .module('app.utils')
    .service('AuthService', AuthService);

  AuthService.$inject = ['$http', '$localStorage','config'];


  function AuthService($http, $localStorage, config) {

    return {
      login: function (payload, done) {

        $http.post(config.apiBaseUrl + 'auth/login', payload)
          .success(function (returndata, status, headers, config) {
            done(returndata);
          })
          .error(function (err, status, headers, config) {
            done(err);
          });
      },
      register: function (payload, done) {

        $http.post(config.apiBaseUrl + 'auth/register', payload)
          .success(function (returndata, status, headers, config) {
            done(returndata);
          })
          .error(function (err, status, headers, config) {
            done(err);
          });
      },

    };
  }

})();