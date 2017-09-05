var komae = angular.module('komaeapi', []);

komae.controller('KomaeController', ['$scope', '$http', function ($scope, $http) {

    $scope.showError = false;
    $scope.loginFlag = true;
    $scope.signupFlag = false;
    $scope.forgotFlag = false;
    
    $scope.toggleFlag = function (flag) {
        $scope.user = {};
        $scope.apiResponse = "";
        $scope.apiResponseError = "";
        
        switch (flag) {
        case 'login':
            $scope.loginFlag = true;
            $scope.signupFlag = false;
            $scope.forgotFlag = false;
            break;
        case 'signup':
            $scope.loginFlag = false;
            $scope.signupFlag = true;
            $scope.forgotFlag = false;
            break;
        case 'forgot':
            $scope.forgotFlag = true;
        default:
            $scope.loginFlag = true;
            $scope.signupFlag = false;
        } //end switch
    };

    $scope.login = function () {
        $scope.apiResponse = "";
        $scope.apiResponseError = "";
        
        var user = {};
        user.email = $scope.user.email;
        user.password = $scope.user.password;
        
        $http.post("/auth/login", user)
            .success(function (data, status) {
            
            if(data)
               $scope.apiResponse = JSON.stringify( data );
            })
            .error(function(err){
                $scope.apiResponseError = err;
            });
    };

    $scope.signup = function () {
        $scope.apiResponse = "";
        $scope.apiResponseError = "";
        
         $http.post("/auth/register", $scope.user)
             .success(function(data, status){
                $scope.apiResponse = data;
         })
             .error(function(err){
                $scope.apiResponseError = err;
         });
    };

    $scope.forgot = function() {
        $scope.apiResponse = "";
        $scope.apiResponseError = "";
        
        var user = { email: $scope.user.forgotEmail };
        
         $http.post("/auth/forgot", user)
             .success(function(data, status){
             $scope.forgotFlag = "";
            $scope.apiResponse = data;
         })
             .error(function(err){
                $scope.apiResponseError = err;
         });
    };

}]);