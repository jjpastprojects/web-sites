  <table class="class-search__list">
    <thead>
      <th>
        <a href class="list__sort-option" ng-click="orderByField='start'; reverseSort = !reverseSort">
          Date <span ng-show="orderByField == 'start'"><i class="fa fa-caret-up" ng-class="(reverseSort) ? 'is-asc' : 'is-desc'"></i></span>
        </a>
      </th>
      <th>
        <a href class="list__sort-option" ng-click="orderByField='city'; reverseSort = !reverseSort">
          Location <span ng-show="orderByField == 'city'"><i class="fa fa-caret-up" ng-class="(reverseSort) ? 'is-asc' : 'is-desc'"></i></span>
        </a>
      </th>
      <th>
        <a href class="list__sort-option" ng-click="orderByField='title'; reverseSort = !reverseSort">
          Class <span ng-show="orderByField == 'title'"><i class="fa fa-caret-up" ng-class="(reverseSort) ? 'is-asc' : 'is-desc'"></i></span>
        </a>
      </th>
      <th>
        Price
      </th>
      <th>
        Details
      </th>
    </thead>
    <tr ng-repeat="class in ctrl.filteredClasses | orderBy:orderByField:reverseSort">
      <td>{{class.formattedStart}}&ndash;{{class.formattedEnd}}</td>
      <td>{{class.city}}</td>
      <td>{{class.title}}</td>
      <td>{{class.early_price}}<br>{{class.price}}</td>
      <td><a href="{{class.permalink}}" class="button tiny">More Details</a></td>
    </tr>
  </table>