var passport = require('passport')
    , config = require("../config")
    , db = require('../../config/db')
    , FacebookStrategy = require('passport-facebook').Strategy;


module.exports = function () {

    passport.use(new FacebookStrategy({
        clientID: config.facebook.facebook_app_id,
        clientSecret: config.facebook.facebook_secret_id,
        callbackURL: config.facebook.callback_url,
        passReqToCallback: true
    },
      function(req, accessToken, refreshToken, profile, done) {
        var user = {};
        user.displayName = profile.displayName;
        user.facebook = {};
        user.facebook.id = profile.id;
        user.facebook.token = accessToken;
        
        db.queryDB("SELECT * FROM komaeusers WHERE facebookID = ?", profile.id, 
        function(err, user){


        if(!user){
          var sql = "INSERT INTO komaeusers SET ?";
          var args = {
            Email: profile.id + "@facebook.com",
            PasswordHash: 'facebook',
            facebookID: profile.id,
            facebookCode: accessToken,
            Name: profile.displayName
          };

          db.queryDB(sql, args, function(err, results){
            done(null, {user: profile.displayName});
          });
        }

        done(null, user);
        });
        
      }
    ));
    
};
