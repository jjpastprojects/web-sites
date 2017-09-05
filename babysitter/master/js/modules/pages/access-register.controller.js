/**=========================================================
 * Module: access-register.js
 * Demo for register account api
 =========================================================*/

(function () {
  'use strict';

  angular
    .module('app.pages')
    .controller('RegisterFormController', RegisterFormController);

  RegisterFormController.$inject = ['$http', '$state','AuthService'];

  function RegisterFormController($http, $state, AuthService) {
    var vm = this;

    activate();

    ////////////////

    function activate() {
      // bind here all data from the form
      vm.account = {};
      // place the message if something goes wrong
      vm.authMsg = '';

      vm.register = function () {
        vm.authMsg = '';

        if (vm.registerForm.$valid) {

          AuthService.register({
            email: vm.account.email,
            password: vm.account.password,
            terms: vm.account.agreed,
            name: vm.account.name
          }, function (response) {
            if (!response.Error) {
              $state.go('app.dashboard');
            }
            else {
              vm.authMsg = response.Error;
            }
          });
        } else {
          // set as dirty if the user click directly to login so we show the validation messages
          /*jshint -W106*/
          vm.registerForm.account_email.$dirty = true;
          vm.registerForm.account_password.$dirty = true;
          vm.registerForm.account_agreed.$dirty = true;
        }
      };
    }
  }
})();