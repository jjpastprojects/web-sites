var express = require('express');
var dotenv = require('dotenv').config();

var app = express();
app.use(express.static(__dirname));
var port = process.env.PORT || 3000;
console.log(process.env.API_BASE_URL);
app.listen(port);