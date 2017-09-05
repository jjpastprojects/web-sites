/*!
 * 
 * Komae Babysitting Exchange
 * 
 * Version: 3.2.0
 * Author: Komae
 * Website: http://www.mykoame.com
 * License: https://wrapbootstrap.com/help/licenses
 * 
 */

// APP START
// ----------------------------------- 

(function () {
  'use strict';

  angular
    .module('komae', [
      'app.core',
      'app.routes',
      'app.sidebar',
      'app.navsearch',
      'app.preloader',
      'app.loadingbar',
      'app.translate',
      'app.settings',
      'app.dashboard',
      'app.icons',
      'app.flatdoc',
      'app.notify',
      'app.bootstrapui',
      'app.elements',
      'app.panels',
      'app.charts',
      'app.forms',
      'app.locale',
      'app.maps',
      'app.pages',
      'app.tables',
      'app.extras',
      'app.mailbox',
      'app.utils'
    ])
    .constant('config', {
      apiBaseUrl: 'http://localhost:3000/'
    })
  ;
  //var baseURL = "http://api.mykomae.com/";
  //var baseURL = "http://localhost:3000/";

})();