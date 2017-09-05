/* Komae API - Authentication Endpoints (/login, /register, /forgot, /facebook, /google, /email) */

var express = require('express');
var apiRouter = express.Router();
var db = require('../../config/db');
var mailer = require('../../config/config');
var passport = require('passport');
var bcrypt = require('bcrypt-nodejs');
var mandrill = require('mandrill-api/mandrill');
var uuid = require('node-uuid');

apiRouter.post('/login', function (req, res, next) {
    passport.authenticate('local', function (err, user, info) {
        if (err)
            next(err);

        if (!user)
            return res.status(401).send({
                'Error': 'Unauthorized'
            });

        req.logIn(user, function (err, data) {
            if (err)
                next(err);

            res.send({"user": req.body.email});

        });
    })(req, res, next)
});

apiRouter.post('/register', function (req, res, next) {

  var sql = "INSERT INTO komaeusers SET ?";
  var userId = uuid.v1();

  //bcrypt
  bcrypt.genSalt(5, function (err, salt) {
    if (err) {
      return callback(err);
    }
    else {

      bcrypt.hash(req.body.password, salt, null, function (err, hash) {
        // Store hash in your password DB.
        var args = {
          ID: userId,
          Email: req.body.email,
          PasswordHash: hash,
          Name: req.body.name,
          Terms: req.body.terms
        };

        db.queryDB(sql, args, function (err, response) {

          if (err) {

            if (err.code === 'ER_DUP_ENTRY') {
              return res.status(403).send({
                Error: 'Account has already existed'
              });
            }

            return res.status(403).send({
                Error: "Registration Failed - " + err
            });
          }

          //check Accounts with same user id exist or not
          db.queryDB('SELECT * FROM accounts where EMAIL = ?', req.body.email, function(err, users) {

            if (err) {
              return res.status(403).send({
                Error: "Account info can not been retrieved, but you can try login: - " + err
              });
            }

            console.log(users);

            if (users && 0 < users.length ) {
              return res.status(403).send({
                Error: 'Account already exists. You can login.'
              });
            }

            // add user info to Accounts
            var isql = "INSERT INTO accounts SET ?";
            var acctID = uuid.v1();

            var iargs = {
              ID: acctID,
              UserID: userId,
              Email: req.body.email,
              FirstName: '',
              LastName: ''
            };

            db.queryDB(isql, iargs, function (err, response) {

              if (err) {
                return res.status(403).send({
                  Error: "Registration Failed - " + err
                });
              }

              var arguments = {
                "html": "<h3>Welcome to <a href=http://www.mykomae.com>Komae</a>! </h3>",
                "text": "You forgot your password! Navigate to http://www.mykomae.com to reset.",
                "subject": "Welcome to Komae",
                "to": [{"email":req.body.email, "type":"to"}]
              };

              sendEmail(arguments, function(result){

                // email error
                if (res.Error) {
                  res.send({
                    success: true,
                    Error: 'Registration completed, but email has not been sent, you can login now.'
                  });
                }
                else {
                  res.send({
                    success: true
                  });
                }
              }, function(e) {
                console.log('A mandrill error occurred: ' + e.name + ' - ' + e.message);
              });


            });


          });



        });
      });
    } //end else genSalt

  });

}); //end route /register

// this router accepts the facebook detail from app.mykomae.com and create facebook user entry in db
apiRouter.post('/customFacebook', function (req, res, next) {

  db.queryDB("SELECT * FROM komaeusers WHERE facebookID = ? limit 1", req.body.user.id,
    function(err, user){

      if(!user || 0 === user.length  ){

        var sql = "INSERT INTO komaeusers SET ?";

        var args = {
          Email: req.body.user.id + "@facebook.com",
          PasswordHash: 'facebook',
          facebookID: req.body.user.id,
          facebookCode: req.body.access_token,
          Name: req.body.user.name,
          id: 'fb' + req.body.user.id
        };

        db.queryDB(sql, args, function(err, results){

          if (err) {
            return res.status(500).json({
              success: false,
              status: 'not created'
            })
          }

          res.status(200).json({
            success: true,
            status: 'created'
          });

        });
      }
      else {

        res.status(200).json({
          success: true,
          status: 'signed'
        });
      }

    });


}); //end route /customFacebook

// this router accepts the google detail from app.mykomae.com and create google user entry in db
apiRouter.post('/customGoogle', function (req, res, next) {

  db.queryDB("SELECT * FROM komaeusers WHERE googleID = ? limit 1", req.body.user.id,
    function(err, user){

      if(!user || 0 === user.length  ){

        var sql = "INSERT INTO komaeusers SET ?";

        var args = {
          Email: req.body.user.id + "@gmail.com",
          PasswordHash: 'google',
          googleID: req.body.user.id,
          googleCode: req.body.access_token,
          Name: req.body.user.name,
          id: 'google' + req.body.user.id
        };

        db.queryDB(sql, args, function(err, results){

          if (err) {
            return res.status(500).json({
              success: false,
              status: 'not created'
            })
          }

          res.status(200).json({
            success: true,
            status: 'created'
          });

        });
      }
      else {

        res.status(200).json({
          success: true,
          status: 'signed'
        });
      }

    });


}); //end route /customGoogle

apiRouter.get('/unauthorized', function (req, res) {
    res.send({
        'Error': 'Unauthorized user'
    });
});

apiRouter.post('/forgot', function (req, res, next) {
    //send email of link to reset password
    var sql = "SELECT * FROM komaeusers WHERE Email = ? ";
    db.queryDB(sql, [req.body.email], function (err, user) {
        if (err)
            next(err);

        if (!user)
            return res.send({
                'Error': 'User not found'
            });

         var arguments = {
        "html": "<h3>You forgot your password! <a href=http://komae-ux.herokuapp.com/#/page/recover-change-password>Click Here</a> to reset.</h3>",
        "text": "You forgot your password! Navigate to http://komae-ux.herokuapp.com/#/page/recover-change-password to reset.",
        "subject": "Forgot Password",
        "to": [{"email":req.body.email, "type":"to"}]
    };
    
    sendEmail(arguments, function(result){
        res.send({"result": result});
    }, function(e) {
        console.log('A mandrill error occurred: ' + e.name + ' - ' + e.message);
    });
        
    });
});

apiRouter.get('/facebook/callback',
    passport.authenticate('facebook', {
        successRedirect: 'http://app.mykomae.com/#/app/dashboard',
        failureRedirect: '/auth/unauthorized'
    }));

apiRouter.get('/facebook', passport.authenticate('facebook', {
    scope: ['email']
}));

apiRouter.get('/google', passport.authenticate('google', {
    scope: ['https://www.googleapis.com/auth/userinfo.profile',
  'https://www.googleapis.com/auth/userinfo.email']
}));

apiRouter.get('/google/callback', passport.authenticate('google', {
    successRedirect: 'http://komae-ux.herokuapp.com/#/app/dashboard',
    failureRedirect: '/auth/unauthorized'
}));

apiRouter.post('/email', function(req, res){
    var arguments = {
        "html": req.body.html,
        "text": req.body.text,
        "subject": req.body.subject,
        "to": req.body.to
    };
    
    sendEmail(arguments, function(result){
        res.send({"result": result});
    }, function(e) {
        console.log('A mandrill error occurred: ' + e.name + ' - ' + e.message);
    });
    
});

var sendEmail = function(args, done){
 var mandrill_client = new mandrill.Mandrill(process.env.MANDRILL_APIKEY);
    var message = {
    "html": args.html,
    "text": args.text,
    "subject": args.subject,
    "from_email": "info@mykomae.com",
    "from_name": "no-reply@mykomae.com",
    "to": args.to,
    "headers": {
        "Reply-To": "no-reply@mykomae.com"
    },
    "important": false,
    "track_opens": null,
    "track_clicks": null,
    "auto_text": null,
    "auto_html": null,
    "inline_css": null,
    "url_strip_qs": null,
    "preserve_recipients": null,
    "view_content_link": null,
    "bcc_address": "",
    "tracking_domain": null,
    "signing_domain": "api.mykomae.com",
    "return_path_domain": "mykomae.com",
    "merge": false,
    "merge_language": "mailchimp",
    "global_merge_vars": [],
    "merge_vars": [],
    "tags": [
        "password-resets"
    ],
    "subaccount": null,
    "google_analytics_domains": [],
    "google_analytics_campaign": "",
    "metadata": {},
    "recipient_metadata": [],
    "attachments": [],
    "images": []
};  
    var arguments = {
        "message": message,
         "async":false,
         "ip_pool": "",
         "send_at": ""
     };
    
    mandrill_client.messages.send(arguments, function(result) {
        done( result );
    }, function(e) {
        done( { "Error": e.message });
    });

};

module.exports = apiRouter;