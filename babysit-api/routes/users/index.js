/* Komae API - User Endpoints (/users) */

var express = require('express');
var db = require('../../config/db');
var mandrill = require('mandrill-api/mandrill');

var apiRouter = express.Router();

apiRouter.route('/')
    .get(function (req, res) {
        var sql = "SELECT * FROM komaeusers WHERE 1";
        db.queryDB(sql, null, function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send({
                "count": results.length,
                "users": results
            });
        });
    })
    
apiRouter.route('/:email')
    .get(function (req, res) {
        var sql = "SELECT * FROM komaeusers WHERE Email = ? ";
        db.queryDB(sql, [req.params.email], function (err, user) {
            if(!err){
                delete user[0].PasswordHash; //do not return password to UI
               res.send(user);            }
        });
        
});
    
module.exports = apiRouter;