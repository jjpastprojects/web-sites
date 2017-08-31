(function () {
    angular.module('onzeit', [
        'ui.router',                    // Routing
        'oc.lazyLoad',                  // ocLazyLoad
        'ui.bootstrap',                 // Ui Bootstrap
        'pascalprecht.translate',       // Angular Translate
        'ngIdle',                       // Idle timer
        'ngSanitize',
        'ngCookies'                    // ngSanitize
    ])
})();

// Other libraries are loaded dynamically in the config.js file using the library ocLazyLoad