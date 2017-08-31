/**
 * MainCtrl - controller
 * Contains several global data used in different view
 *
 */
function MainCtrl($scope, $location, Authentication) {

    /**
     * daterange - Used as initial model for data range picker in Advanced form view
     */
    this.daterange = {startDate: null, endDate: null};

    /**
     * slideInterval - Interval for bootstrap Carousel, in milliseconds:
     */
    this.slideInterval = 5000;


    /**
     * check's - Few variables for checkbox input used in iCheck plugin. Only for demo purpose
     */
    this.checkOne = true;
    this.checkTwo = true;
    this.checkThree = true;
    this.checkFour = true;

    /**
     * knobs - Few variables for knob plugin used in Advanced Plugins view
     */
    this.knobOne = 75;
    this.knobTwo = 25;
    this.knobThree = 50;

    /**
     * Variables used for Ui Elements view
     */
    this.bigTotalItems = 175;
    this.bigCurrentPage = 1;
    this.maxSize = 5;
    this.singleModel = false;
    this.radioModel = 'Middle';
    this.checkModel = {
        left: false,
        middle: true,
        right: false
    };

    /**
     * groups - used for Collapse panels in Tabs and Panels view
     */
    this.groups = [
        {
            title: 'Dynamic Group Header - 1',
            content: 'Dynamic Group Body - 1'
        },
        {
            title: 'Dynamic Group Header - 2',
            content: 'Dynamic Group Body - 2'
        }
    ];

    /**
     * alerts - used for dynamic alerts in Notifications and Tooltips view
     */
    this.alerts = [
        { type: 'danger', msg: 'Oh snap! Change a few things up and try submitting again.' },
        { type: 'success', msg: 'Well done! You successfully read this important alert message.' },
        { type: 'info', msg: 'OK, You are done a great job man.' }
    ];

    /**
     * addAlert, closeAlert  - used to manage alerts in Notifications and Tooltips view
     */
    this.addAlert = function() {
        this.alerts.push({msg: 'Another alert!'});
    };

    this.closeAlert = function(index) {
        this.alerts.splice(index, 1);
    };

    /**
     * randomStacked - used for progress bar (stacked type) in Badges adn Labels view
     */
    this.randomStacked = function() {
        this.stacked = [];
        var types = ['success', 'info', 'warning', 'danger'];

        for (var i = 0, n = Math.floor((Math.random() * 4) + 1); i < n; i++) {
            var index = Math.floor((Math.random() * 4));
            this.stacked.push({
                value: Math.floor((Math.random() * 30) + 1),
                type: types[index]
            });
        }
    };
    /**
     * initial run for random stacked value
     */
    this.randomStacked();

    /**
     * summernoteText - used for Summernote plugin
     */
    this.summernoteText = ['<h3>Hello Jonathan! </h3>',
    '<p>dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the dustrys</strong> standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more',
        'recently with</p>'].join('');

    /**
     * General variables for Peity Charts
     * used in many view so this is in Main controller
     */
    this.BarChart = {
        data: [5, 3, 9, 6, 5, 9, 7, 3, 5, 2, 4, 7, 3, 2, 7, 9, 6, 4, 5, 7, 3, 2, 1, 0, 9, 5, 6, 8, 3, 2, 1],
        options: {
            fill: ["#1ab394", "#d7d7d7"],
            width: 100
        }
    };

    this.BarChart2 = {
        data: [5, 3, 9, 6, 5, 9, 7, 3, 5, 2],
        options: {
            fill: ["#1ab394", "#d7d7d7"]
        }
    };

    this.BarChart3 = {
        data: [5, 3, 2, -1, -3, -2, 2, 3, 5, 2],
        options: {
            fill: ["#1ab394", "#d7d7d7"]
        }
    };

    this.LineChart = {
        data: [5, 9, 7, 3, 5, 2, 5, 3, 9, 6, 5, 9, 4, 7, 3, 2, 9, 8, 7, 4, 5, 1, 2, 9, 5, 4, 7],
        options: {
            fill: '#1ab394',
            stroke: '#169c81',
            width: 64
        }
    };

    this.LineChart2 = {
        data: [3, 2, 9, 8, 47, 4, 5, 1, 2, 9, 5, 4, 7],
        options: {
            fill: '#1ab394',
            stroke: '#169c81',
            width: 64
        }
    };

    this.LineChart3 = {
        data: [5, 3, 2, -1, -3, -2, 2, 3, 5, 2],
        options: {
            fill: '#1ab394',
            stroke: '#169c81',
            width: 64
        }
    };

    this.LineChart4 = {
        data: [5, 3, 9, 6, 5, 9, 7, 3, 5, 2],
        options: {
            fill: '#1ab394',
            stroke: '#169c81',
            width: 64
        }
    };

    this.PieChart = {
        data: [1, 5],
        options: {
            fill: ["#1ab394", "#d7d7d7"]
        }
    };

    this.PieChart2 = {
        data: [226, 360],
        options: {
            fill: ["#1ab394", "#d7d7d7"]
        }
    };
    this.PieChart3 = {
        data: [0.52, 1.561],
        options: {
            fill: ["#1ab394", "#d7d7d7"]
        }
    };
    this.PieChart4 = {
        data: [1, 4],
        options: {
            fill: ["#1ab394", "#d7d7d7"]
        }
    };
    this.PieChart5 = {
        data: [226, 134],
        options: {
            fill: ["#1ab394", "#d7d7d7"]
        }
    };
    this.PieChart6 = {
        data: [0.52, 1.041],
        options: {
            fill: ["#1ab394", "#d7d7d7"]
        }
    };
};
/**
 * landingCtrl - Controller for landing functions (Particle running)
 * used in Landing view
 */
function landingCtrl($scope, $rootScope, $timeout, Authentication, $location) {
    // Dashboard button click
    var vm = this;

    vm.dashboard = dashboard;

    /**
    *   @name dashboard
    *   @desc goto dashboard from landing to dashboard
    *   @memberOf landingCtrl
    */
    function dashboard() {
        console.log("dashboard controller");
        if (Authentication.isAuthenticated()) {
            $location.url('/dashboards/dashboard');
        }
    }

    // All data will be store in this object
    $scope.formData = {};

    // After process wizard
    $scope.processForm = function() {
        alert('Wizard completed');
    };
}


function NavbarController($scope, $location, Authentication, GlobalService) {
    var vm = this;

    vm.logout = logout;

    /**
    *   @name logout
    *   @desc Log the user out
    *   @memberOf thinkster.layout.controllers.NavbarController
    */
    function logout() {
        console.log("log out controller");
        Authentication.logout();
    }
}
/**
 * signupEmployeeCtrl - Controller for signup functions ()
 * used in Signup Employee View
 */
function signupEmployeeCtrl($scope, $location, Authentication, GlobalService) {
    console.log("signup Employee controller");
        
    var vm = this;

    vm.register = register;
    vm.changeDistance = changeDistance;
    vm.changeZCode = changeZCode;

    vm.is_map_show = false;
    vm.staticmap = '';
    vm.distance = 0;
    vm.zipcode = '';
    vm.lat = 0;
    vm.lng = 0;

    vm.distances = [
        {no : 0, value : 0,  label : "Select distance", zoom : 15},
        {no : 1, value : 1,  label : "1 mile", zoom : 12},
        {no : 2, value : 2,  label : "2 miles", zoom : 11},
        {no : 3, value : 3,  label : "3 miles", zoom : 11},
        {no : 4, value : 5,  label : "5 miles", zoom : 10},
        {no : 5, value : 10,  label : "10 miles", zoom : 9},
        {no : 6, value : 20,  label : "20 miles", zoom : 8},
        {no : 7, value : 30,  label : "30 miles", zoom : 7},
        {no : 8, value : 50,  label : "50 miles", zoom : 7},
        {no : 9, value : 100,  label : "100 miles", zoom : 6},
    ]

    activate();

    // vm.mapOptions = {
    //     zoom: 8,
    //     center: new google.maps.LatLng(28.544709, -81.260578),
    //     // Style for Google Maps
    //     styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}],
    //     mapTypeId: google.maps.MapTypeId.ROADMAP
    // };

    /**
    *   @name register
    *   @desc Register a new user
    *   @memberOf thinkster.authentication.controllers.RegisterController
    */
    function register() {
        Authentication.register(vm.email, vm.password, vm.username, vm.phone, vm.city, vm.zipcode, vm.distances[vm.distance]['value']);
    }

    function changeDistance() {
        console.log("distance changed!");

        if (vm.distance > 0 && vm.zipcode != '') {
          vm.staticmap = GMapCircle(vm.lat, vm.lng, vm.distances[vm.distance]['value']);
          vm.is_map_show = true;
        } else {
          vm.is_map_show = false;
          vm.staticmap = '';
        };

    }
    function changeZCode() {
        console.log("zipcode changed!");
        var geocoder = new google.maps.Geocoder();
        var address = vm.zipcode;

        geocoder.geocode(
        { 'address' : address}, function(results, status) {

              if (status == google.maps.GeocoderStatus.OK) {
                vm.lat = results[0].geometry.location.lat();
                vm.lng = results[0].geometry.location.lng();

                console.log("lat:" + vm.lat + ", lng:" + vm.lng);
              };


        });

        if (vm.distance > 0 && vm.zipcode != '') {
          vm.staticmap = GMapCircle(vm.lat, vm.lng, vm.distances[vm.distance]['value']);
          vm.is_map_show = true;
        } else {
          vm.is_map_show = false;
          vm.staticmap = '';
        };
    }

    /**
    *   @name activate
    *   @desc Actions to be performed when this controller is instantiated
    *   @memberOf thinkster.authentication.controllers.RegisterController
    */
    function activate() {
        // If the user is authenticated, they should not be here.
        if (Authentication.isAuthenticated()) {
            $location.url('/dashboards/dashboard');
        };
    }

    function GMapCircle(lat,lng,rad,detail=8){

        var uri = 'https://maps.googleapis.com/maps/api/staticmap?';
        var staticMapSrc = 'center=' + lat + ',' + lng;
        //staticMapSrc += '&zoom=' + zoom;
        staticMapSrc += '&maptype=roadmap';
        staticMapSrc += '&size=600x200';
        staticMapSrc += '&key=AIzaSyAPegjsMnS1sfSZPOX5bBW8QlxJLQ_NkLs';
        staticMapSrc += '&path=color:0xff0000ff:weight:1';

        var r    = 6371;
        rad *= 1.6093; // Change mile to km

        var pi   = Math.PI;

        var _lat  = (lat * pi) / 180;
        var _lng  = (lng * pi) / 180;
        var d    = (rad) / r;

        var i = 0;

        for(i = 0; i <= 360; i+=detail) {
            var brng = i * pi / 180;

            var pLat = Math.asin(Math.sin(_lat) * Math.cos(d) + Math.cos(_lat) * Math.sin(d) * Math.cos(brng));
            var pLng = ((_lng + Math.atan2(Math.sin(brng) * Math.sin(d) * Math.cos(_lat), Math.cos(d) - Math.sin(_lat) * Math.sin(pLat))) * 180) / pi;
            pLat = (pLat * 180) / pi;

           staticMapSrc += "|" + pLat + "," + pLng;
        }

        return uri + encodeURI(staticMapSrc);
    }
}

function signinEmployeeCtrl($location, $scope, Authentication, GlobalService) {
        var vm = this;

        vm.login = login;

        activate();

        /**
        *   @name activate
        *   @desc Actions to be performed when this controller is instantiated
        *   @memberOf thinkster.authentication.controllers.LoginController
        */
        function activate() {
            // If the user is authenticated, they should not be here.
            if (Authentication.isAuthenticated()) {
                $location.url('/dashboards/dashboard');
            };
        }

        /**
        *   @name login
        *   @desc Log the user in
        *   @memberOf thinkster.authentication.controllers.LoginController
        */
        function login() {
            GlobalService.Account.type = 'employee';
            Authentication.login(vm.username, vm.password);
        }
}

/**
 * signupEmployerCtrl - Controller for signup functions ()
 * used in Signup Employee View
 */
function signupEmployerCtrl($scope, $location, Authentication, GlobalService) {
    console.log("signup Employer controller");
        
    var vm = this;

    vm.register = register;
    vm.changeDistance = changeDistance;
    vm.changeZCode = changeZCode;

    vm.is_map_show = false;
    vm.staticmap = '';
    vm.distance = 0;
    vm.zipcode = '';
    vm.lat = 0;
    vm.lng = 0;

    vm.distances = [
        {no : 0, value : 0,  label : "Select distance", zoom : 15},
        {no : 1, value : 1,  label : "1 mile", zoom : 12},
        {no : 2, value : 2,  label : "2 miles", zoom : 11},
        {no : 3, value : 3,  label : "3 miles", zoom : 11},
        {no : 4, value : 5,  label : "5 miles", zoom : 10},
        {no : 5, value : 10,  label : "10 miles", zoom : 9},
        {no : 6, value : 20,  label : "20 miles", zoom : 8},
        {no : 7, value : 30,  label : "30 miles", zoom : 7},
        {no : 8, value : 50,  label : "50 miles", zoom : 7},
        {no : 9, value : 100,  label : "100 miles", zoom : 6},
    ]
    activate();
        
    /**
    *   @name register
    *   @desc Register a new user
    *   @memberOf thinkster.authentication.controllers.RegisterController
    */
    function register() {
        Authentication.register_employer(vm.email, 
                                vm.password, 
                                vm.fb_name, 
                                vm.ac_name, 
                                vm.ss_no, 
                                vm.bm_addr, 
                                vm.city,
                                vm.state, 
                                vm.zipcode, 
                                vm.distances[vm.distance]['value'],
                                vm.o_phone, 
                                vm.c_phone, 
                                vm.w_phone, 
                                vm.b_fax);

        //$location.url('/signup/employer/payment_reference');
    }

    /**
    *   @name activate
    *   @desc Actions to be performed when this controller is instantiated
    *   @memberOf thinkster.authentication.controllers.RegisterController
    */
    function activate() {
        // If the user is authenticated, they should not be here.
        if (Authentication.isAuthenticated()) {
            $location.url('/dashboards/dashboard');
        };
    }

    function changeDistance() {
        console.log("distance changed!");

        if (vm.distance > 0 && vm.zipcode != '') {
          vm.staticmap = GMapCircle(vm.lat, vm.lng, vm.distances[vm.distance]['value']);
          vm.is_map_show = true;
        } else {
          vm.is_map_show = false;
          vm.staticmap = '';
        };

    }
    function changeZCode() {
        console.log("zipcode changed!");
        var geocoder = new google.maps.Geocoder();
        var address = vm.zipcode;

        geocoder.geocode(
        { 'address' : address}, function(results, status) {

              if (status == google.maps.GeocoderStatus.OK) {
                vm.lat = results[0].geometry.location.lat();
                vm.lng = results[0].geometry.location.lng();

                console.log("lat:" + vm.lat + ", lng:" + vm.lng);
              };


        });

        if (vm.distance > 0 && vm.zipcode != '') {
          vm.staticmap = GMapCircle(vm.lat, vm.lng, vm.distances[vm.distance]['value']);
          vm.is_map_show = true;
        } else {
          vm.is_map_show = false;
          vm.staticmap = '';
        };
    }

    function GMapCircle(lat,lng,rad,detail=8){

        var uri = 'https://maps.googleapis.com/maps/api/staticmap?';
        var staticMapSrc = 'center=' + lat + ',' + lng;
        //staticMapSrc += '&zoom=' + zoom;
        staticMapSrc += '&maptype=roadmap';
        staticMapSrc += '&size=600x200';
        staticMapSrc += '&key=AIzaSyAPegjsMnS1sfSZPOX5bBW8QlxJLQ_NkLs';
        staticMapSrc += '&path=color:0xff0000ff:weight:1';

        var r    = 6371;
        rad *= 1.6093; // Change mile to km

        var pi   = Math.PI;

        var _lat  = (lat * pi) / 180;
        var _lng  = (lng * pi) / 180;
        var d    = (rad) / r;

        var i = 0;

        for(i = 0; i <= 360; i+=detail) {
            var brng = i * pi / 180;

            var pLat = Math.asin(Math.sin(_lat) * Math.cos(d) + Math.cos(_lat) * Math.sin(d) * Math.cos(brng));
            var pLng = ((_lng + Math.atan2(Math.sin(brng) * Math.sin(d) * Math.cos(_lat), Math.cos(d) - Math.sin(_lat) * Math.sin(pLat))) * 180) / pi;
            pLat = (pLat * 180) / pi;

           staticMapSrc += "|" + pLat + "," + pLng;
        }

        return uri + encodeURI(staticMapSrc);
    }
}

function signinEmployerCtrl($location, $scope, Authentication, GlobalService) {
        var vm = this;

        vm.login = login;

        activate();

        /**
        *   @name activate
        *   @desc Actions to be performed when this controller is instantiated
        *   @memberOf thinkster.authentication.controllers.LoginController
        */
        function activate() {
            // If the user is authenticated, they should not be here.
            if (Authentication.isAuthenticated()) {
                $location.url('/dashboards/dashboard');
            };
        }

        /**
        *   @name login
        *   @desc Log the user in
        *   @memberOf thinkster.authentication.controllers.LoginController
        */
        function login() {
            console.log("employer log in");
            GlobalService.Account.type = 'employer';
            Authentication.login(vm.username, vm.password);
        }
}

function verifyPhoneCtrl($location, $scope, Authentication, GlobalService) {
        var vm = this;

        vm.verify = verify;

        activate();

        // if (!GlobalService.Account.user) {
        //     $location.url('/');
        // };

        function activate() {
            // If the user is authenticated, they should not be here.
            if (Authentication.isAuthenticated()) {
                $location.url('/dashboards/dashboard');
            };
        }

        function verify() {
            console.log("phone verify controller  in");
            Authentication.generate_passcode(vm.phone);
             // action="#/signup/verify_code"
        }
}

function verifyCodeCtrl($location, $scope, Authentication, GlobalService) {
        var vm = this;

        vm.verify = verify;

        activate();

        // if (!GlobalService.Account.user) {
        //     $location.url('/');
        // };

        function activate() {
            // If the user is authenticated, they should not be here.
            if (Authentication.isAuthenticated()) {
                $location.url('/dashboards/dashboard');
            };
        }

        function verify() {
            console.log("code verify controller  in");
            Authentication.verify_passcode(vm.code);
             // action="#/signup/verify_code"
        }
}

function newHireIntakeCodeCtrl($location, $scope, Authentication, GlobalService) {
        var vm = this;

        vm.done = done;

        activate();

        // if (!GlobalService.Account.user) {
        //     $location.url('/');
        // };

        function activate() {
            // If the user is authenticated, they should not be here.
            if (Authentication.isAuthenticated()) {
                $location.url('/dashboards/dashboard');
            };
        }

        function done() {
            console.log("newhireintake controller in");
            Authentication.hireintake_done(vm.ssn);
             // action="#/signup/verify_code"
        }
}

function wizardCtrl($scope, $rootScope) {
    // All data will be store in this object
    $scope.formData = {};

    // After process wizard
    $scope.processForm = function() {
        alert('Wizard completed');
    };
}

/**
 * dashboardFlotOne - simple controller for data
 * for Flot chart in Dashboard view
 */
function dashboardFlotOne() {

    var data1 = [
        [0, 4],
        [1, 8],
        [2, 5],
        [3, 10],
        [4, 4],
        [5, 16],
        [6, 5],
        [7, 11],
        [8, 6],
        [9, 11],
        [10, 30],
        [11, 10],
        [12, 13],
        [13, 4],
        [14, 3],
        [15, 3],
        [16, 6]
    ];
    var data2 = [
        [0, 1],
        [1, 0],
        [2, 2],
        [3, 0],
        [4, 1],
        [5, 3],
        [6, 1],
        [7, 5],
        [8, 2],
        [9, 3],
        [10, 2],
        [11, 1],
        [12, 0],
        [13, 2],
        [14, 8],
        [15, 0],
        [16, 0]
    ];

    var options = {
        series: {
            lines: {
                show: false,
                fill: true
            },
            splines: {
                show: true,
                tension: 0.4,
                lineWidth: 1,
                fill: 0.4
            },
            points: {
                radius: 0,
                show: true
            },
            shadowSize: 2,
            grow: {stepMode:"linear",stepDirection:"up",steps:80}
        },
        grow: {stepMode:"linear",stepDirection:"up",steps:80},
        grid: {
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#d5d5d5'
        },
        colors: ["#1ab394", "#1C84C6"],
        xaxis: {
        },
        yaxis: {
            ticks: 4
        },
        tooltip: false
    };

    /**
     * Definition of variables
     * Flot chart
     */
    this.flotData = [data1, data2];
    this.flotOptions = options;
}

/**
 * chartJsCtrl - Controller for data for ChartJs plugin
 * used in Chart.js view
 */
function chartJsCtrl() {

    /**
     * Data for Polar chart
     */
    this.polarData = [
        {
            value: 300,
            color:"#a3e1d4",
            highlight: "#1ab394",
            label: "App"
        },
        {
            value: 140,
            color: "#dedede",
            highlight: "#1ab394",
            label: "Software"
        },
        {
            value: 200,
            color: "#A4CEE8",
            highlight: "#1ab394",
            label: "Laptop"
        }
    ];

    /**
     * Options for Polar chart
     */
    this.polarOptions = {
        scaleShowLabelBackdrop : true,
        scaleBackdropColor : "rgba(255,255,255,0.75)",
        scaleBeginAtZero : true,
        scaleBackdropPaddingY : 1,
        scaleBackdropPaddingX : 1,
        scaleShowLine : true,
        segmentShowStroke : true,
        segmentStrokeColor : "#fff",
        segmentStrokeWidth : 2,
        animationSteps : 100,
        animationEasing : "easeOutBounce",
        animateRotate : true,
        animateScale : false
    };

    /**
     * Data for Doughnut chart
     */
    this.doughnutData = [
        {
            value: 300,
            color:"#a3e1d4",
            highlight: "#1ab394",
            label: "App"
        },
        {
            value: 50,
            color: "#dedede",
            highlight: "#1ab394",
            label: "Software"
        },
        {
            value: 100,
            color: "#A4CEE8",
            highlight: "#1ab394",
            label: "Laptop"
        }
    ];

    /**
     * Options for Doughnut chart
     */
    this.doughnutOptions = {
        segmentShowStroke : true,
        segmentStrokeColor : "#fff",
        segmentStrokeWidth : 2,
        percentageInnerCutout : 45, // This is 0 for Pie charts
        animationSteps : 100,
        animationEasing : "easeOutBounce",
        animateRotate : true,
        animateScale : false
    };

    /**
     * Data for Line chart
     */
    this.lineData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Example dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "Example dataset",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.7)",
                pointColor: "rgba(26,179,148,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(26,179,148,1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };

    this.lineDataDashboard4 = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Example dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 40, 51, 36, 25, 40]
            },
            {
                label: "Example dataset",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.7)",
                pointColor: "rgba(26,179,148,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(26,179,148,1)",
                data: [48, 48, 60, 39, 56, 37, 30]
            }
        ]
    };

    /**
     * Options for Line chart
     */
    this.lineOptions = {
        scaleShowGridLines : true,
        scaleGridLineColor : "rgba(0,0,0,.05)",
        scaleGridLineWidth : 1,
        bezierCurve : true,
        bezierCurveTension : 0.4,
        pointDot : true,
        pointDotRadius : 4,
        pointDotStrokeWidth : 1,
        pointHitDetectionRadius : 20,
        datasetStroke : true,
        datasetStrokeWidth : 2,
        datasetFill : true
    };

    /**
     * Options for Bar chart
     */
    this.barOptions = {
        scaleBeginAtZero : true,
        scaleShowGridLines : true,
        scaleGridLineColor : "rgba(0,0,0,.05)",
        scaleGridLineWidth : 1,
        barShowStroke : true,
        barStrokeWidth : 2,
        barValueSpacing : 5,
        barDatasetSpacing : 1
    };
}

function translateCtrl($translate, $scope) {
    $scope.changeLanguage = function (langKey) {
        $translate.use(langKey);
        $scope.language = langKey;
    };
}


angular
    .module('onzeit')
    .controller('MainCtrl', MainCtrl)

    .controller('newHireIntakeCodeCtrl', newHireIntakeCodeCtrl)
    .controller('landingCtrl', landingCtrl)
    .controller('verifyCodeCtrl', verifyCodeCtrl)
    .controller('verifyPhoneCtrl', verifyPhoneCtrl)
    .controller('NavbarController', NavbarController)
    .controller('signupEmployeeCtrl', signupEmployeeCtrl)
    .controller('signupEmployerCtrl', signupEmployerCtrl)
    .controller('signinEmployerCtrl', signinEmployerCtrl)
    .controller('signinEmployeeCtrl', signinEmployeeCtrl)

    .controller('wizardCtrl', wizardCtrl)
    .controller('dashboardFlotOne', dashboardFlotOne)
    .controller('chartJsCtrl', chartJsCtrl)
    .controller('translateCtrl', translateCtrl);