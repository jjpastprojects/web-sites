<section class="category-filters">
  <h5 class="text-center">Filter By Category</h5>
  <fieldset>
    <input id="category-filter--all" type="checkbox" ng-model="ctrl.allCategory" ng-change="ctrl.selectAllCategoryOption()">
    <label for="category-filter--all">All Classes</label>
  </fieldset>
  <fieldset ng-repeat="category in ctrl.categories">
    <input id="category-filter--{{category.id}}" type="checkbox" ng-model="category.selected" ng-change="ctrl.updateAllCategoryOption(category.name)">
    <label for="category-filter--{{category.id}}">{{category.name}}</label>
  </fieldset>
</section>