<div class="row class-search__date">
  <h5 class="text-center">Filter By Date Range</h5>
  <div class="small-6 column">
    <label for="date-filter__start-input" class="show-for-sr">Start Date</label>
    <input id="date-filter__start-input" class="datepicker" placeholder="Enter start date" ng-change="ctrl.filterClasses()" ng-model="ctrl.option.sdate">
  </div>
  <div class="small-6 column">
    <label for="date-filter__end-input" class="show-for-sr">End Date</label>
    <input id="date-filter__end-input" class="datepicker" placeholder="Enter end date" ng-change="ctrl.filterClasses()" ng-model="ctrl.option.edate">
  </div>
</div>
