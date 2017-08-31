function GlobalService() {
    var vars = {
        is_authenticated: false,
        verify_phone: "",
        ApiUrl: "http://52.91.49.165:8000",
        //ApiUrl: "http://localhost:8000",
        Account: {
            user: null,     /**
                            * user = { "city":"a6", distance:8, email:"a6@a.com",
                            *   id:6, is_verified:false, last_verified:null,
                            *   passcode:"", password:"gSRln1NBtad62LhMsvgBaQ==",
                            *   phone:"(444) 444-4444",
                            *   username:"a6",
                            *   verify_phone:"",
                            *   zipcode:"32822" 
                            * }
                            */
            type: null,
            token: null
        },
    }
    return vars;
}

/**
*   Authentication
*   @namespace thnkster.authentication.services
*/

function Authentication($cookies, $http, GlobalService, $location, GlobalService) {

    /**
    *   @name Authentication
    *   @desc the Factory to be returned
    */ 
    var Authentication = {
        getAuthenticatedAccount: getAuthenticatedAccount,
        isAuthenticated: isAuthenticated,
        login: login,
        logout: logout,
        register: register,
        register_employer: register_employer,
        setAuthenticatedAccount: setAuthenticatedAccount,
        unauthenticate: unauthenticate,
        generate_passcode: generate_passcode,
        verify_passcode: verify_passcode,
        hireintake_done: hireintake_done,
    };

    return Authentication;

    ///////////////////////
    function hireintake_done(ssn) {
        console.log("auth new hire intake");

        type = GlobalService.Account.type;
        user = GlobalService.Account.user;

        // user = { "city":"a1", distance:8, email:"a1@a.com",
        //             id:8, is_verified:false, last_verified:null,
        //             passcode:"", password:"7xCGe+1ATTmVnEcn8R21Nw==",
        //             phone:"(444) 444-4444",
        //             username:"a1",
        //             verify_phone:"",
        //             zipcode:"32822"
        //         }


        return $http.post(GlobalService.ApiUrl + "/account/employee/newhireintake/", {
            username: user['username'],
            password: user['password'],
            ssn: ssn,
        }).then(onSuccessFn, onErrorFn);

        function onSuccessFn(data, status, headers, config) {
            console.log("success! please enter the code!");
            console.log(data.data);
            GlobalService.Account.token = GlobalService.Account.user['password'];
            $location.url('/settings/register_wizard/step_one');
        }

        function onErrorFn(data, status, headers, config) {
            // resend code
            console.log("verify failure");
        }
    }

    function generate_passcode(phone) {
        console.log("auth phone verify");

        type = GlobalService.Account.type;
        user = GlobalService.Account.user;

        // user = { "city":"a1", distance:8, email:"a1@a.com",
        //             id:8, is_verified:false, last_verified:null,
        //             passcode:"", password:"7xCGe+1ATTmVnEcn8R21Nw==",
        //             phone:"(444) 444-4444",
        //             username:"a1",
        //             verify_phone:"",
        //             zipcode:"32822"
        //         }
        // type = 'employee';

        // user = {
        //         "ac_name":"acn",
        //         "b_fax":"bfa",
        //         "bm_addr":"bma",
        //         "c_phone":"(222) 222-2222",
        //         "city":"sddfsd",
        //         "distance":"100",
        //         "email":"b2@a.com",
        //         "fb_name":"fbn",
        //         "id":"3",
        //         "is_verified":false,
        //         "last_verified":null,
        //         "o_phone":"(333) 333-3333",
        //         "passcode":"",
        //         "password":"DF06kVR4NKZ5lKRkk3EvNg==",
        //         "ss_no":"fssn",
        //         "state":"Bangladesh",
        //         "username":"fbn",
        //         "verify_phone":"",
        //         "w_phone":"(555) 555-5555",
        //         "zipcode":"32222"
        //     };
        // type = 'employer';

        if (type == "employee") {
            url = '/account/employee/generate_passcode/';
        }
        else if (type == "employer") {
            url = '/account/employer/generate_passcode/';
        } else {
            $location.url('/');
        }

        console.log("username:" + user['username'] + ", password:" + user['password'] + ", phone:" + phone);
        console.log(GlobalService.ApiUrl + url);
        return $http.post(GlobalService.ApiUrl + url, {
            username: user['username'],
            password: user['password'],
            phone: phone,
        }).then(onSuccessFn, onErrorFn);

        function onSuccessFn(data, status, headers, config) {
            console.log("success! please enter the code!");
            console.log(data.data);
            $location.url('/signup/verify_code');
        }

        function onErrorFn(data, status, headers, config) {
            // resend code
            console.log("phone verify failure");
        }
    }


    function verify_passcode(code) {
        console.log("auth code verify");

        type = GlobalService.Account.type;
        user = GlobalService.Account.user;

        if (type == "employee") {
            url = '/account/employee/verify_passcode/';
        }
        else if (type == "employer") {
            url = '/account/employer/verify_passcode/';
        } else {
            $location.url('/');
        }

        console.log("username:" + user['username'] + ", password:" + user['password'] + ", code:" + code);
        console.log(GlobalService.ApiUrl + url);
        return $http.post(GlobalService.ApiUrl + url, {
            username: user['username'],
            password: user['password'],
            code: code,
        }).then(onSuccessFn, onErrorFn);

        function onSuccessFn(data, status, headers, config) {
            console.log("success!");
            console.log(data.data);
            
            console.log(GlobalService.Account.user);

            GlobalService.Account.user['is_verified'] = true;
            GlobalService.Account.token = GlobalService.Account.user['password'];
            
            if (type == 'employee') {
                $location.url('/signup/new_hire_intake');
            }else if (type == 'employer') {
                $location.url('/dashboards/dashboard');
            }
            
        }

        function onErrorFn(data, status, headers, config) {
            // resend code
            console.log("code verify failure");
        }
    }

    /**
    *   @name logout
    *   @desc Try to log the user out
    *   @returns {Promise}
    *   @memberOf thinkster.authentication.services.Authentication
    */
    function logout() {
        // return $http.post(GlobalService.ApiUrl + '/api/v1/auth/logout/')
        //     .then(logoutSuccessFn, logoutErrorFn);

        // /**
        // *   @name logoutSuccessFn
        // *   @desc Unauthenticate and redirect to index with page reload
        // */
        // function logoutSuccessFn(data, status, headers, config) {
        //     Authentication.unauthenticate();
        //     console.log(data.data);
        //     $location.url('/');
        // }

        // /**
        // *   @name logoutErrorFn
        // *   @desc Log "Epic failure!" to the console
        // */
        // function logoutErrorFn(data, status, headers, config) {
        //     console.error('Epic failure!');
        //     $location.url('/');
        // }
        Authentication.token = null;
        Authentication.user = null;
        Authentication.type = null;
        $location.url('/');
    }

    /**
    *   @name register
    *   @desc Try to register a new user
    *   @param {string} username The username entered by the user
    *   @param {string} password The password entered by the user
    *   @param {string} email The email entered by the user
    *   @returns {Promise}
    *   @memberOf thinkster.authentication.services.Authentication
    */
    function register(email, password, username, phone, city, zipcode, distance) {
        console.log("username:" + username + ", password:" + password + ", email:" + email + ", phone:" + phone + ", zipcode:" + zipcode + ", distance:" + distance);
        
        return $http.post(GlobalService.ApiUrl + '/account/employee/register/', {
            username: username,
            password: password,
            email: email,
            phone: phone,
            city: city,
            zipcode: zipcode,
            distance: distance
        }).then(registerSuccessFn, registerErrorFn);

        /**
        *   @name registerSuccessFn
        *   @desc Log the new user in
        */
        function registerSuccessFn(data, status, headers, config) {
            console.log(data.data);

            GlobalService.Account.user = data.data;
            GlobalService.Account.token = null;
            GlobalService.Account.type = "employee";

            $location.url('/signup/verify_phone');
        }

        /**
        *   @name registerErrorFn
        *   @desc Log "Epic failure!" to the console
        */
        function registerErrorFn(data, status, headers, config) {
            console.log("auth register failure");
            
            GlobalService.Account.user = null;
            GlobalService.Account.token = null;
            GlobalService.Account.type = null;
        }
    }

    function register_employer(email, password, fb_name, ac_name, ss_no, bm_addr, city, state, zipcode, distance, o_phone, c_phone, w_phone, b_fax) {

        console.log("email:" + email + ", pwd:" + password + ", fbname:" + fb_name + ", acname:" + ac_name + ", ssno:" + ss_no + ", bmaddr:" + bm_addr + ", city:" + city + ", state:" + state + ", zipcode:" + zipcode + ", distance:" + distance + ", ophone:" + o_phone + ", cphone:" + c_phone + ", wphone:" + w_phone + ", bfax:" + b_fax);

        return $http.post(GlobalService.ApiUrl + '/account/employer/register/', {
            username: fb_name,
            password: password,
            email: email,
            fb_name: fb_name,
            ac_name: ac_name, 
            ss_no: ss_no, 
            bm_addr: bm_addr, 
            city: city, 
            state: state, 
            zipcode: zipcode, 
            distance: distance,
            o_phone: o_phone, 
            c_phone: c_phone, 
            w_phone: w_phone, 
            b_fax: b_fax
        }).then(registerSuccessFn, registerErrorFn);

        /**
        *   @name registerSuccessFn
        *   @desc Log the new user in
        */
        function registerSuccessFn(data, status, headers, config) {
            console.log(data.data);

            GlobalService.Account.user = data.data;
            GlobalService.Account.type = "employer";
            GlobalService.Account.token = null;

            // $location.url('/signup/employer/payment_reference');
            $location.url('/signup/verify_phone');
        }

        /**
        *   @name registerErrorFn
        *   @desc Log "Epic failure!" to the console
        */
        function registerErrorFn(data, status, headers, config) {
            console.log("auth register failure");

            GlobalService.Account.user = null;
            GlobalService.Account.token = null;
            GlobalService.Account.type = null;
        }
    }

    /**
    *   @name login
    *   @desc Try to log in with email `email` and password `password`
    *   @param {string} email The email entered by the user
    *   @param {string} password The password entered by the user
    *   @returns {Promise}
    *   @memberOf thinkster.authentication.services.Authentication
    */
    function login(username, password, type) {
        console.log("auth phone verify");

        // if (Authentication.isAuthenticated()) {
        //     $location.url('/dashboards/dashboard');
        //     return;
        // };
        type = GlobalService.Account.type;

        if (type == "employee") {
            url = '/account/employee/login/';
        }
        else if (type == "employer") {
            url = '/account/employer/login/';
        } else {
            console.log("invalid type");
            return;
        }

        console.log("username:" + username + ", password:" + password);
        console.log(GlobalService.ApiUrl + url);
        return $http.post(GlobalService.ApiUrl + url, {
            username: username,
            password: password
        }).then(onSuccessFn, onErrorFn);

        function onSuccessFn(data, status, headers, config) {
            console.log("success!");
            console.log(data.data);
            $location.url('/dashboards/dashboard');
        }

        function onErrorFn(data, status, headers, config) {
            // resend code
            console.log("login failure");
        }
        // return $http.post(GlobalService.ApiUrl + '/api/v1/auth/login/', {
        //     email: email, password: password
        // }).then(loginSuccessFn, loginErrorFn);

        // /**
        // *   @name loginSuccessFn
        // *   @desc Set the authenticated account and redirect to index
        // */
        // function loginSuccessFn(data, status, headers, config) {
        //     console.log("success login");
        //     Authentication.setAuthenticatedAccount(data.data);

        //     $location.url('/dashboards/dashboard');
        // }

        // /**
        // *   @name loginErrorFn
        // *   @desc Log "Epic failure!" to the console
        // */
        // function loginErrorFn(data, status, headers, config) {
        //     console.error('Epic failure!');
        // }
    }

    /**
    *   @name getAuthenticatedAccount
    *   @desc Return the currently authenticated account
    *   @returns {object|undefined} Account if authenticated, else `undefined`
    *   @memberOf thinkster.authentication.services.Authentication
    */
    function getAuthenticatedAccount() {
        // if (!$cookies.authenticatedAccount) {
        //     return;
        // }

        // return JSON.parse($cookies.authenticatedAccount);

    }

    /**
    *   @name isAuthenticated
    *   @desc Check if the current user is authenticated
    *   @returns {boolean} True is user is authenticated, else false
    *   @memberOf thinkster.authentication.services.Authentication
    */
    function isAuthenticated() {
        // return !!$cookies.authenticatedAccount;
        return !!GlobalService.Account.token;
    }

    /**
    *   @name setAuthenticatedAccount
    *   @desc Stringfy the account object and store it in a cookie
    *   @param {Object} user The account object to be stored
    *   @returns {undefined}
    *   @memberOf thinkster.authentication.services.Authentication
    */
    function setAuthenticatedAccount(account) {
        $cookies.authenticatedAccount = JSON.stringify(account);
    }

    /**
    *   @name unauthenticate
    *   @desc Delete the cookie where the user object is stored
    *   @returns {undefined}
    *   @memberOf thinkster.authenticationservices.Authentication
    */
    function unauthenticate() {
        // delete $cookies.authenticatedAccount;
        GlobalService.Account.token = null;
    }

}


angular
    .module('onzeit')
    .factory('GlobalService', GlobalService)
    .factory('Authentication', Authentication);
