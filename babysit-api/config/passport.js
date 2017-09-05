var passport = require('passport');
var connection = require('./db');

module.exports = function(app) {
    
    app.use(passport.initialize());
    app.use(passport.session());
    
    passport.serializeUser(function(user, done){
        done(null, user);
    });
    
    passport.deserializeUser(function(user, done){
         done(null, user);
    });
    
    require('./strategies/localStrategy')();
    require('./strategies/facebookStrategy')();
    require('./strategies/googleStrategy')();

};
