/* Komae API - Children Endpoints (/children) */

var express = require('express');
var db = require('../../config/db');
var uuid = require('node-uuid');

var apiRouter = express.Router();

apiRouter.route('/')
    .get(function (req, res) {
        var sql = "SELECT * FROM children WHERE 1";
        db.queryDB(sql, null, function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            //redirect to account route to create a new user account
            res.send({
                "count": results.length,
                "children": results
            });
        });
    })
    .post(function (req, res) {
        var isql = "INSERT INTO children SET ?";
        var childrenID = uuid.v1();
        var iargs = {
            ID: childrenID,
            AccountID: req.body.AccountId,
            FirstName: req.body.firstname,
            LastName: req.body.lastname,
            Birthdate: req.body.birthdate,
            Gender: req.body.gender,
            Nickname: req.body.nickname,
            Photo: req.body.photo
        };

        db.queryDB(isql, iargs, function (err, response) {

            if (err) {
                return res.status(403).send({
                    Error: "Registration Failed - " + err
                });
            }

            res.send(response);

        });
    });

apiRouter.route('/:id')
    .get(function (req, res) {

        var sql = "SELECT * FROM children WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
                if (err)
                    res.send({
                        'Error': err
                    });

                res.send(results);
            });
    })
    .put(function (req, res) {
        var sql = "UPDATE children SET ? WHERE ?";

        var args = {
            FirstName: req.body.firstname,
            LastName: req.body.lastname,
            Birthdate: req.body.birthdate,
            Gender: req.body.gender,
            Nickname: req.body.nickname,
            Photo: req.body.photo
        };
    
        db.queryDB(sql, [args, {ID:req.params.id}], function (err, results) {
                if (err)
                    res.send({
                        'Error': err
                    });

                res.send(results);
            });
    })
    .delete(function (req, res) {
 var sql = "DELETE FROM children WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
                if (err)
                    res.send({
                        'Error': err
                    });

                res.send(results);
            });
    });

module.exports = apiRouter;