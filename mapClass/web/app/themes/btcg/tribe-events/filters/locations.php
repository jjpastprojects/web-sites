<div class="row class-search__location">
  <h5 class="text-center">Filter By Location</h5>
  <selectize config="ctrl.selectizeConfig" options="ctrl.locations"
    ng-model="ctrl.option.market"  ng-change="ctrl.selectMarket()">
  </selectize>
</div>
