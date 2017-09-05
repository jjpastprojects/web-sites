/* Komae API - Responses Endpoints (/responses) */

var express = require('express');
var db = require('../../config/db');
var uuid = require('node-uuid');

var apiRouter = express.Router();

apiRouter.route('/')
    .get(function (req, res) {
        var sql = "SELECT * FROM responses WHERE 1";
        db.queryDB(sql, null, function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            //redirect to account route to create a new user account
            res.send({
                "count": results.length,
                "responses": results
            });
        });
    })
    .post(function (req, res) {
        var isql = "INSERT INTO responses SET ?";
        var responseID = uuid.v1();
        var iargs = {
            ResponseID: responseID,
            AccountID: req.body.AccountId,
            RequestID: req.body.RequestID,
            ResponseAction: req.body.responseAction,
            AdditionalInformation: req.body.additionalInfo
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
        var sql = "SELECT * FROM responses WHERE ID = ?";

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
            RequestID: req.body.RequestID,
            ResponseAction: req.body.responseAction,
            AdditionalInformation: req.body.additionalInfo
        };
        var sql = "UPDATE responses SET ? WHERE ?";
    
    db.queryDB(sql, [args, {ResponseID: req.params.id}], function (err, response) {

            if (err) {
                return res.status(403).send({
                    Error: "Registration Failed - " + err
                });
            }

            res.send(response);

        });
    
    })
    .delete(function (req, res) {
        var sql = "DELETE FROM responses WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    });

module.exports = apiRouter;