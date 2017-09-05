/* Komae API - Accounts Endpoints (/accounts) */
var express = require('express');
var db = require('../../config/db');
var uuid = require('node-uuid');

var apiRouter = express.Router();

apiRouter.route('/')
    .get(function (req, res) {

        var sql = "SELECT u.ID, u.Email, u.Name, acct.ID as aid, acct.FirstName, acct.LastName, acct.Expiration, acct.PointBalance, acct.Birthday, acct.Photo FROM komaeusers u JOIN accounts acct ON u.ID = acct.UserID  ";
        var acctResults = [];
        var acct = {};
        var child = {};

        db.queryDB(sql, null, function (err, results) {

            if (err)
                res.send({
                    'Error': 'Error ' + err
                });

            for (var i = 0; i < results.length; i++) {
                acct = {};
                acct.user = {};
                acct.children = [];

                acct.accountID = results[i].aid;
                acct.user.userID = results[i].ID;
                acct.user.email = results[i].Email;
                acct.user.name = results[i].Name;
                acct.user.firstname = results[i].FirstName;
                acct.user.lastname = results[i].LastName;
                acct.user.expiration = results[i].Expiration;
                acct.user.points = results[i].PointBalance;
                acct.user.birthdate = results[i].Birthday;
                acct.user.photo = results[i].Photo;

                acctResults.push(acct);
            }

            res.send({
                'count': acctResults.length,
                'accounts': acctResults
            });
        });
    });

apiRouter.route('/:id')
    .get(function (req, res) {
        var acctResults = [];
        var acct = {};
        var child = {};

        var aid = req.params.id;
        var sql = "SELECT * FROM accounts WHERE ?";
        db.queryDB(sql, [{
            ID: aid
        }], function (err, results) {

            if (err)
                res.send({
                    'Error': 'Error ' + err
                });

            res.send(results);
        });

    })
    .put(function (req, res) {

        var sql = "UPDATE accounts SET ? WHERE ?";
        var args = {
            FirstName: req.body.firstname,
            LastName: req.body.lastname,
            Expiration: req.body.expiration,
            PointBalance: req.body.points,
            Birthday: req.body.birthdate,
            Photo: req.body.photo
        };

        db.queryDB(sql, [args, {
            ID: req.params.id
        }], function (err, results) {

            if (err)
                res.send({
                    'Error': 'Error ' + err
                });

            res.send(results);
        });

    })
    .delete(function (req, res) {
        var sql = "DELETE FROM accounts WHERE ID = ?";

        db.queryDB(sql, [req.params.id], function (err, results) {

            if (err)
                res.send({
                    'Error': 'Error ' + err
                });

            res.send(results);
        });

    });

apiRouter.route('/:id/children')
    .get(function (req, res) {
        var sql = "SELECT * FROM children WHERE ?";

        db.queryDB(sql, [{
            AccountID: req.params.id
        }], function (err, results) {

            if (err)
                res.send({
                    'Error': 'Error ' + err
                });


            res.send({
                'count': results.length,
                'children': results
            });
        });


    })

module.exports = apiRouter;