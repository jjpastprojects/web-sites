/* Komae API - Root Endpoints (/) */
var express = require('express');
var db = require('../../config/db');

var apiRouter = express.Router();

apiRouter.route('/')
    .get(function (req, res) {
        res.send({
            'message': 'Welcome to Komae API!'
        });
    });

apiRouter.route('/routes')
  .get(function (req, res) {
    res.send({
      "base URL": "http://api.mykomae.com",
      "authentication": {
        "Parameters": "email",
        "Methods": {
          "Login": "/login [POST]",
          "Register": "/register [POST]",
          "Forgot Password": "/forgot [POST]",
          "Facebook": "/facebook [GET]",
          'customFacebook': '/customFacebook [POST]',
          "Google": "/google [GET]",
          'customGoogle': '/customGoogle [POST]'
        }
      },
      "user": {
          "All Users": "/users [GET]",
          "User By Email": "/users/:email [GET]"
      },
      "accounts": {
          "Parameters": "accountID",
          "Methods": {
              "All Accounts": "/accounts [GET]",
              "Create Account": "see /register",
              "Retrieve an Account": "/accounts/:id [GET]",
              "Update an Account": "/accounts/:id [PUT]",
              "Delete an Account": "/accounts/:id [DELETE]",
              "Retrieve Children for an Account": "/accounts/:id/children [GET]"
          }
      },
      "children": {
          "Parameters": "ID,AccountID,FirstName,LastName,Birthdate,Gender, Nickname, Photo",
          "Methods": {
              "All Children": "/children [GET]",
              "Create a Child": "/children [POST]",
              "Retrieve a Child": "/children/:id [GET]",
              "Update a Child": "/children/:id [PUT]",
              "Delete a Child": "/children/:id [DELETE]"
          }
      },
      "locations": {
          "All Locations": "/locations [GET]",
          "Create a Location": "/locations [POST]",
          "Retrieve a Location": "/locations/:id [GET]",
          "Update a Location": "/locations/:id [PUT]",
          "Delete a Location": "/locations/:id [DELETE]"

      },
      "requestTypes": {
          "All RequestTypes": "/requestTypes [GET]",
          "Create a RequestType": "/requestTypes [POST]",
          "Retrieve a RequestType": "/requestTypes/:id [GET]",
          "Update a RequestType": "/requestTypes/:id [PUT]",
          "Delete a RequestType": "/requestTypes/:id [DELETE]"

      },
      "roles": {
          "All Roles": "/roles [GET]",
          "Create a Role": "/roles [POST]",
          "Retrieve a Role": "/roles/:id [GET]",
          "Update a Role": "/roles/:id [PUT]",
          "Delete a Role": "/roles/:id [DELETE]"
      },
      "requests": {
          "Parameters": "ID: AccountID, RequestTypeID,AdditionalInformation,Status,StartDate,EndDate,Expires,PointValue,LocationID",
          "Methods": {
              "All Requests": "/requests [GET]",
              "Create a Request": "/requests [POST]",
              "Retrieve a Request": "/requests/:id [GET]",
              "Update a Request": "/requests/:id [PUT]",
              "Delete a Request": "/requests/:id [DELETE]"
          }
      },
      "responses": {
          "All Responses": "/responses [GET]",
          "Create a Response": "/responses [POST]",
          "Retrieve a Response": "/responses/:id [GET]",
          "Update a Response": "/responses/:id [PUT]",
          "Delete a Response": "/responses/:id [DELETE]"
      },
      "relatonshipTypes": {
          "All RelationshipTypes": "/relationshipTypes [GET]",
          "Create a relationshipType": "/relationshipTypes [POST]",
          "Retrieve a relationshipType": "/relationshipTypes/:id [GET]",
          "Update a relationshipType": "/relationshipTypes/:id [PUT]",
          "Delete a relationshipType": "/relationshipTypes/:id [DELETE]"
      },
      "villages": {
          "All Villages": "/villages [GET]",
          "Create a Village": "/villages [POST]",
          "Retrieve a Village": "/villages/:id [GET]",
          "Update a Village": "/villages/:id [PUT]",
          "Delete a Village": "/villages/:id [DELETE]"
      }
    })
  });


module.exports = apiRouter;