var mysql = require('mysql');
var config = require('./config');

if (process.env.NODE_ENV == 'production') {
    conn = mysql.createPool(process.env.CLEARDB_DATABASE_URL);
    console.log("Connecting to the Production DB");
} else {
    conn = mysql.createPool(config.devdatabase);
    console.log("Connecting to Local DB");
}

module.exports = {

  queryDB: function (sql, args, done) {
    conn.getConnection(function (err, connection) {
      if (err) {
        console.log(err);
        return done(err);
      }

      connection.query(sql, args,
        function (err, results) {

          if (err) {
            return done(err);
          }

          return done(null, results);
        });

      connection.release();
    });

  }
};