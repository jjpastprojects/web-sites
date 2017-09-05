/* Komae API - Request Endpoints (/requests) */

var express = require('express');
var db = require('../../config/db');
var uuid = require('node-uuid');

var apiRouter = express.Router();

apiRouter.route('/')
    .get(function (req, res) {
        var sql = "SELECT * FROM requests WHERE 1";
        db.queryDB(sql, null, function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            //redirect to account route to create a new user account
            res.send({
                "count": results.length,
                "requests": results
            });
        });
    })
    .post(function (req, res) {
        var isql = "INSERT INTO requests SET ?";
        var requestID = uuid.v1();
        var iargs = {
            ID: requestID,
            AccountID: req.body.AccountId,
            RequestTypeID: req.body.requestTypeId,
            AdditionalInformation: req.body.additionalInfo,
            Status: req.body.status,
            StartDate: req.body.startdate,
            EndDate: req.body.enddate,
            Expires: req.body.expires,
            PointValue: req.body.pointValue,
            LocationID: req.body.locationId
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
        var sql = "SELECT * FROM requests WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    })
    .put(function (req, res) {
        var sql = "UPDATE requests SET ? WHERE ?";
        var iargs = {
            AccountID: req.body.AccountId,
            RequestTypeID: req.body.requestTypeId,
            AdditionalInformation: req.body.additionalInfo,
            Status: req.body.status,
            StartDate: req.body.startdate,
            EndDate: req.body.enddate,
            Expires: req.body.expires,
            PointValue: req.body.pointValue,
            LocationID: req.body.locationId
        };
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
        var sql = "DELETE FROM requests WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    });

module.exports = apiRouter;