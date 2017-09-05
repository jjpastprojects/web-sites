"use strict";

(function () {

    var ns = {};

    ns.validate = {
        password: function (val) {
            if (!val ||
                !val.match(/^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{5,15}$/)) {
              return false;
            }
            return true;
        },
        email: function (val) {
            if (!val ||
                !val.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                return false;
            }
            return true;
        }
    };

    window.util = ns;

})();