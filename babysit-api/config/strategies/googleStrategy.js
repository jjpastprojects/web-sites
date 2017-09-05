var passport = require('passport')
  , GoogleStrategy = require('passport-google-oauth').OAuth2Strategy;
var db = require('../../config/db');
var config = require("../config.js");


module.exports = function () {

    passport.use(new GoogleStrategy({
        clientID: config.google.clientId,
        clientSecret: config.google.clientSecret,
        callbackURL: config.google.callbackURL,
        passReqToCallback: true
    }, function(req, accessToken, refreshToken, profile, done) {
        console.log( profile);
        
        var user = {};
        user.displayName = profile.displayName;
        user.google = {};
        user.google.id = profile.id;
        user.google.token = accessToken;
        
        db.queryDB("SELECT * FROM komaeusers WHERE googleID = ?", profile.id, 
            function(err, user){
            
                if(!user){
                    var sql = "INSERT INTO komaeusers SET ?";
                    var args = {
                        Email: profile.emails[0].value,
                        googleID: profile.id,
                        googleCode: profile._json.etag,
                        Name: profile.displayName,
                        PasswordHash: 'google'
                    };
            
                    db.queryDB(sql, args, function(err, results){
                        done(null, {user: profile.emails[0].value});
                    });
                }
                
                done(null, user);
        });
        
           
    }));
};