/* Komae API - Villages Endpoints (/villages) */

var express = require('express');
var db = require('../../config/db');
var uuid = require('node-uuid');

var apiRouter = express.Router();

apiRouter.route('/')
    .get(function (req, res) {
        var sql = "SELECT * FROM villages WHERE 1";
        db.queryDB(sql, null, function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            //redirect to account route to create a new user account
            res.send({
                "count": results.length,
                "villages": results
            });
        });
    })
    .post(function (req, res) {
        var isql = "INSERT INTO villages SET ?";
        var villageID = uuid.v1();
        var iargs = {
            ID: villageID,
            AccountID: req.body.AccountId,
            MembershipAccountID: req.body.membershipId,
            RelationshipTypeID: req.body.relationshipTypeId
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
        var sql = "SELECT * FROM villages WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    })
    .put(function (req, res) {
        var args = {
            AccountID: req.body.AccountId,
            MembershipAccountID: req.body.membershipId,
            RelationshipTypeID: req.body.relationshipTypeId
        };

        var sql = "UPDATE villages SET ? WHERE ?";

        db.queryDB(sql, [args, {
            ID: req.params.id
        }], function (err, response) {

            if (err) {
                return res.status(403).send({
                    Error: "Registration Failed - " + err
                });
            }

            res.send(response);

        });

    })
    .delete(function (req, res) {
        var sql = "DELETE FROM villages WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    });

module.exports = apiRouter;