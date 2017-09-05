var express = require('express');
var path = require('path');
var logger = require('morgan');
var cookieParser = require('cookie-parser'); //used by passport
var bodyParser = require('body-parser');
var passport = require('passport');
var session = require('express-session');
var dotenv = require('dotenv').config();

var PORT = process.env.PORT || 3000;
var sessionConfig = require('./config/config');

var app = express();
var db = require('./config/db');

//allow other komae domains to access API
var allowCrossDomain = function(req, res, next) {
    res.header('Access-Control-Allow-Origin', '*');
    res.header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS');
    res.header('Access-Control-Allow-Headers', 'Content-Type, Authorization, Content-Length, X-Requested-With');

    // intercept OPTIONS method
    if ('OPTIONS' == req.method) {
      res.send(200);
    }
    else {
      next();
    }
};
app.use(allowCrossDomain);

var apiRouter = require('./routes/api');
var userRouter = require('./routes/users');
var roleRouter = require('./routes/roles');
var authRouter = require('./routes/authentication');
var accountRouter = require('./routes/accounts');
var childrenRouter = require('./routes/children');
var requestRouter = require('./routes/requests');
var locationRouter = require('./routes/locations');
var requestTypesRouter = require('./routes/requestTypes');
var responseRouter = require('./routes/responses');
var relationshipTypeRouter = require('./routes/relationshipTypes');
var villagesRouter = require('./routes/villages');

app.use(logger('dev'));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());


app.use(session({
    secret: sessionConfig.session.cookie_secret,
    name: sessionConfig.session.cookie_name,
    proxy: false,
    resave: true,
    saveUninitialized: true
}));


require('./config/passport')(app);

app.use(express.static(path.join(__dirname, 'public')));
app.use(express.static(path.join(__dirname, 'views')));
app.use('/', apiRouter);
app.use('/users', userRouter);
app.use('/auth', authRouter);
app.use('/roles', roleRouter);
app.use('/accounts', accountRouter);
app.use('/children', childrenRouter);
app.use('/requests', requestRouter);
app.use('/locations', locationRouter);
app.use('/requestTypes', requestTypesRouter);
app.use('/responses', responseRouter);
app.use('/relationshipTypes', relationshipTypeRouter);
app.use('/villages', villagesRouter);

app.listen(PORT, function(err){
    if(!err)
        console.log("Running Komae API on port " + PORT); 
    else 
        console.log( "Error " + err );
});

module.exports = app;
