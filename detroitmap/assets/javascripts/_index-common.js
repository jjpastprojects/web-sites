/**
 * Created by Georgi K on 29/09/15.
 */
(function () {

  console.log('in commonservices.');

  angular.module('artmap.commonservices', [])
    .service('appFunc', function ($q, $modal, $http, $interval, appContext) {

      var badgeObj, isManager = null;
      return {
        getSaveWorkDlg: function() {
          var working = appContext.getWorking();
          if (!working.option || working.option.editing === false) {
            var deferred = $q.defer();

            deferred.resolve(SKIP);
            return deferred.promise;

          }
          else {

            var dlg = $modal.open({
              templateUrl: 'modules/_layouts/partials/authenticated_save_work_modal.html',
              windowClass: 'schedule-builder',
              controller: function ($scope, $modalInstance) {



                // Save Action
                $scope.save = function () {
                  $modalInstance.close(SAVE);
                };

                // Discard Action
                $scope.discard = function () {
                  $modalInstance.close(DISCARD);
                };

                // Close Modal
                $scope.close = function () {
                  $modalInstance.dismiss('cancel');
                };

                $scope.entityName = working.entityName;
              }

            });

            return dlg.result.then(function (reason) {

              /**
               * here we just need Save, we don't need Discard, since it will be reloading anyway
               */
              return reason;


            }, function (reason) {

              console.log('dismissed');
              return $q.reject(reason);
            });
          }
        },
        /**
         * This function is used to save the datetime value to DB
         * @param year
         * @param month
         * @param date
         * @param timezone
         * @returns {Date}
         */
        getDateWithTimezone: function(year, month, date, timeZone) {
          var dtFormat = [year, month, date];
          var dt = moment.tz(dtFormat, timeZone);
          return new Date(dt);
        },
        convertToBrowserTimezone: function(date,srcTimezone) {
          if (!date)
            return null;

          var dt = new Date(date);

          var diffMin = moment.tz(dt, srcTimezone).utcOffset() - (moment(dt)).utcOffset();

          return (new Date(dt.getTime() + diffMin * 60 * 1000));
        },
        /**
         * Get pending and new requests count
         */
        updatePendingAndNewRequests: function() {

          var url = '';
          var _this = this;

          if (isManager === true) {
            url = appContext.getBaseRestUrl() + 'requests/manager/pendingandnewrequestcounts?teamrequests=true';
//          "status": "SUCCESS",  "pendingManagerRequests": 123, "newManagerRequests":5, "pendingTeamRequests": 12, "newTeamRequests":2
          }
          else if (isManager === false){
            url = appContext.getBaseRestUrl() + 'requests/peer/pendingandnewrequestcounts';
//          "status": "SUCCESS",  "pendingTeamRequests": 12, "newTeamRequests":2
          }
          else {
            return;
          }


          $http.get(url, {})
            .then(function (response) {
              angular.copy(response.data, appContext.getBadgeMsg());
            }, function(error) {
              // unauthorized or insufficient permission
              // stop it in every error
//            if (error.status === 401 || error.status === 403) {
//
//            }
              _this.stopBadgeRefresh();
              appContext.setNotificationMsgWithValues(error.data.message, '', true, error.statusText);
            });
        },
        badgeRefresh: function(boolManager) {
          if (angular.isDefined(badgeObj)) return;
          isManager = boolManager;

          badgeObj = $interval(this.updatePendingAndNewRequests.bind(this), appContext.getBadgeRefreshInterval() * 1000);
          this.updatePendingAndNewRequests();
        },
        stopBadgeRefresh: function() {
          if (angular.isDefined(badgeObj)) {
            $interval.cancel(badgeObj);
            badgeObj = undefined;
            isManager = null;
          }
        }
      };
    })

    .service('appContext', function($timeout, $q) {

      // current filter for grid
      var entityFilter = {
        url: '',
        txt: '',
        searchFields: '',
        returnedFields: '',
        limit: 15,
        orderBy: '',
        orderDir: ''
      };

      // Entity Grid Page Item Size
      var gridPageItemSize = 20;

      // current grid list
      var browser = {totalRecords:0, showingRecords: 0 };
      // current module
      var module = {name: '',  icoClass: '',   href: '', disableModuleBreadcrumb: false};

      //base Rest Url
      var baseRestUrl = '../emlogis/rest/';

      //base Url
      var baseUrl = '../emlogis/';

      // afterLoginUrl
      var afterLoginUrl = '';

      //Notification Message
      var notificationMsg = {content: '', type: '', visible: false, entityName: '', param: {
        lostConnection: false
      }
      };

      /**
       * Info of editing section
       * @type {{status: boolean, restoreFunc: null, saveFunc: null}}
       */
      var working = {
        option: null,
        entityName: '',
        restoreFunc: null,
        saveFunc: null
      };

      /**
       * This variable indicates the interval which displays at the top right corner of the page.
       */
      var badgeRefreshInterVal = 30; // In sec
      var badgeMsg = {};

      return {

        getEntityFilter : function(){
          return entityFilter;
        },
        setEntityFilter: function(value){
          entityFilter = value;
        },
        getBrowser: function(){
          return browser;
        },
        setBrowser: function(value){
          browser = value;
        },
        getModule: function(){
          return module;
        },
        setModule: function(value){
          module = value;
        },
        setModuleName: function(moduleName){
          module.name = moduleName;
        },
        getAfterLoginUrl: function(){
          return afterLoginUrl;
        } ,
        setAfterLoginUrl: function(value){
          afterLoginUrl = value;
        },
        getBaseRestUrl: function() {
          return baseRestUrl;
        } ,
        setBaseRestUrl: function(value){
          baseRestUrl = value;
        },
        getBaseUrl: function() {
          return baseUrl;
        } ,
        setBaseUrl: function(value){
          baseUrl = value;
        },
        getGridPageItemSize: function() {
          return gridPageItemSize;
        },
        setGridPageItemSize: function(value) {
          gridPageItemSize = value;
        },
        getNotificationMsg: function() {
          return notificationMsg;
        },
        setNotificationMsg: function(value) {
          notificationMsg = value;
          //notificationMsg.visible = true;
          var interval = 5;

          if (notificationMsg.type !== 'danger' && notificationMsg.type !== 'save' && notificationMsg.type !== 'login'){
            var _this = this;
            $timeout(function(){
              //notificationMsg.content = ''; don't change content, otherwise it will be automatically disappeared
              //notificationMsg.type = '';
              notificationMsg.visible = false;

              _this.updateNotificationArea();
            }, interval * 1000);
          }

          this.updateNotificationArea();

        },
        /**
         *
         * @param content
         * @param type
         * @param visible
         */
        setNotificationMsgWithValues: function(content, type, visible, entityName) {

          if (typeof content !== 'undefined' ) {
            notificationMsg.content = content;
          }

          if (typeof type !== 'undefined' ) {
            notificationMsg.type = type;
          }

          if (typeof visible !== 'undefined' ) {
            notificationMsg.visible = visible;
          }

          if (typeof entityName !== 'undefined' ) {
            notificationMsg.entityName = entityName;
          }

          this.setNotificationMsg(notificationMsg);

        },
        updateNotificationArea: function() {

          // Notification Scope apply
          var notificationArea = angular.element('#notificationArea');

          // Page hasn't been fully loaded yet.
          if (typeof notificationArea.scope() === 'undefined') {
            return;
          }

          // Check digest is in the progress
          if(!notificationArea.scope().$$phase) {
            notificationArea.scope().$apply();
          }

        },
        getWorking: function() {
          return working;
        },
        setWorking: function(value) {
          working = value;
        },
        getBadgeMsg: function() {
          return badgeMsg;
        },
        setBadgeMsg: function(value) {
          angular.copy(value, badgeMsg);
        }

      };

    });

}());