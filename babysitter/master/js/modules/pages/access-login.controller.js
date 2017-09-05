/**=========================================================
 * Module: access-login.js
 * Demo for login api
 =========================================================*/

(function () {
  'use strict';

  angular
    .module('app.pages')
    .controller('LoginFormController', LoginFormController);

  LoginFormController.$inject = ['$http', '$state', '$location', 'AuthService', 'config'];

  function LoginFormController($http, $state, $location, AuthService, config) {

    var vm = this;

    //oauth.io initialization with key
    OAuth.initialize('LgpEmTYyAfA2MEQ3gPju2x9ajUQ');

    activate();

    ////////////////

    function activate() {
      // bind here all data from the form
      vm.account = {};
      // place the message if something goes wrong
      vm.authMsg = '';

      vm.login = function () {
        vm.authMsg = '';

        if (vm.loginForm.$valid) {
          AuthService.login({
            email: vm.account.email,
            password: vm.account.password
          }, function (user) {
            if (user.Error)
              vm.authMsg = 'Incorrect credentials';
            else
              $state.go('app.dashboard');

          });
        } else {
          // set as dirty if the user click directly to login so we show the validation messages
          /*jshint -W106*/
          vm.loginForm.account_email.$dirty = true;
          vm.loginForm.account_password.$dirty = true;
        }
      };

      //oauth.io facebook authentication
      vm.authFacebook= function () {
        OAuth.popup('facebook')
          .done(function(result) {
            //use result.access_token in your API request
            //or use result.get|post|put|del|patch|me methods (see below)

            //get facebook id from access_token
            result.get('/me')
              .done(function (response) {

                var obj = {access_token: result.access_token, user: response};

                $http.post(baseURL  + 'auth/customFacebook', obj)
                  .success(function (returndata, status, headers, config) {
                    $state.go('app.dashboard');
                  })
                  .error(function (err, status, headers, config) {
                    alert('System has some errors.');
                  });

                //window.location='http://api.mykomae.com/auth/facebook';
              })
              .fail(function (err) {
                alert('Facebook information can not be retrieved');
              });


          })
          .fail(function (err) {

            alert('Facebook login failed');
            //handle error with err
            console.log(err);
          });
      };


      //oauth.io google authentication
      vm.authGoogle= function () {
        OAuth.popup('google')
          .done(function(result) {
              //use result.access_token in your API request
              //or use result.get|post|put|del|patch|me methods (see below)

            $http.get(' https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=' + result.access_token)
              .then(function(res) {
                console.log(res);
              });

            result.get('/userinfo/email')
              .done(function (response) {

                var obj = {access_token: result.access_token, user: response};

                $http.post(baseURL  + 'auth/customGoogle', obj)
                  .success(function (returndata, status, headers, config) {
                    $state.go('app.dashboard');
                  })
                  .error(function (err, status, headers, config) {
                    alert('System has some errors.');
                  });

                //window.location='http://api.mykomae.com/auth/facebook';
              })
              .fail(function (err) {
                alert('Google information can not be retrieved');
              });


          })
          .fail(function (err) {
            //handle error with err
            alert('Google login failed');
            console.log(err);
          });


      };
    }


  }
})();