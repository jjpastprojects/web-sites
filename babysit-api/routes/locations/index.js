/* Komae API - Location Endpoints (/locations) */

var express = require('express');
var db = require('../../config/db');
var uuid = require('node-uuid');

var apiRouter = express.Router();

apiRouter.route('/')
    .get(function (req, res) {
        var sql = "SELECT * FROM locations WHERE 1";
        db.queryDB(sql, null, function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            //redirect to account route to create a new user account
            res.send({
                "count": results.length,
                "locations": results
            });
        });
    })
    .post(function (req, res) {
        var isql = "INSERT INTO locations SET ?";
        var locID = uuid.v1();
        var iargs = {
            ID: locID,
            Location: req.body.location
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
        var sql = "SELECT * FROM locations WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    })
    .put(function (req, res) {
        var sql = "UPDATE locations SET ? WHERE ?";

        var args = {
            Location: req.body.location
        };

        db.queryDB(sql, [args, {
            ID: req.params.id
        }], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    })
    .delete(function (req, res) {
        var sql = "DELETE FROM locations WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    });

module.exports = apiRouter;