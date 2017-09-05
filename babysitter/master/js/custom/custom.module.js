(function () {
    'use strict';

    angular
        .module('custom', [
            // request the the entire framework
            'komae',
            // or just modules
            'app.core',
            'app.sidebar'
            /*...*/
        ]);
})();