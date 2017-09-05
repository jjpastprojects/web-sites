var passport = require('passport'),
    LocalStrategy = require('passport-local').Strategy;
var db = require('../../config/db');
var bcrypt = require('bcrypt-nodejs');


module.exports = function () {
    
  passport.use(
    new LocalStrategy({
      usernameField: 'email',
      passwordField: 'password',
      session: false,
      passReqToCallback: true
    },
    function (req, username, password, done) {
     var sql = "SELECT * FROM komaeusers WHERE Email = ?";

    db.queryDB(sql, [username],
      function(err, user){

        if(err) {
          return done(err);
        }

        if(!user[0]){
          return done(null);
        }
        else {

          //check for valid password

          bcrypt.compare(password, user[0].PasswordHash,
            function (err, res) {

              if(err) {
                return done(err, false);
              }
              else {
                done(null,res);
              }

          });
        }
      });
    })
  );
};