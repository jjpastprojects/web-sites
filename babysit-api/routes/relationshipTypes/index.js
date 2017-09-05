/* Komae API - RelationshipTypes Endpoints (/relationshipTypes) */

var express = require('express');
var db = require('../../config/db');
var uuid = require('node-uuid');

var apiRouter = express.Router();

apiRouter.route('/')
    .get(function (req, res) {
        var sql = "SELECT * FROM relationshiptypes WHERE 1";
        db.queryDB(sql, null, function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send({
                "count": results.length,
                "relationshipTypes": results
            });
        });
    })
    .post(function (req, res) {
        var isql = "INSERT INTO relationshiptypes SET ?";
        var relID = uuid.v1();
        var iargs = {
            ID: relID,
            Relationship: req.body.relationship
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
        var sql = "SELECT * FROM relationshiptypes WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    })
    .put(function (req, res) {

        var sql = "UPDATE relationshiptypes SET ? WHERE ?";

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
        var sql = "DELETE FROM relationshiptypes WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {
            if (err)
                res.send({
                    'Error': err
                });

            res.send(results);
        });
    });

module.exports = apiRouter;