

module.exports = {

  prod_database: {
    host: process.env.CLEARDB_DATABASE_URL,
    user: process.env.DBUSER,
    password: process.env.DBPASSWORD,
    database: process.env.DB
  },
  devdatabase: {
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'komae_local',
    socketPath: process.env.SOCKET_PATH
  },
  session: {
    cookie_name: 'komae',
    cookie_secret: 'babysitting'
  },
  mandrill: {
    apiKey: process.env.MANDRILL_APIKEY
  },
  facebook: {
    facebook_app_id: process.env.FACEBOOK_API,
    facebook_secret_id: process.env.FACEBOOK_SECRET_ID,
    callback_url: process.env.FACEBOOK_CALLBACK_URL
  },
  google: {
    clientId: process.env.GOOGLE_CLIENTID,
    clientSecret: process.env.GOOGLE_CLIENT_SECRET,
    callbackURL: process.env.GOOGLE_CALLBACK_URL
  }
};