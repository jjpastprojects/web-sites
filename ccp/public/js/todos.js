function TodosController($scope, $http) {
	$http.get('http://localhost/ccp/public/angular/todos').success(function(response){
		$scope.todos = response;
	});
	$scope.remain = function(){
			count = 0;
			angular.forEach($scope.todos, function(todo){
					count += !todo.completed;
			});
			return count;
	};
	$scope.add = function(){
		todo = {body: $scope.new_todo, completed: false};
		$scope.todos.push(todo);
		$http.post('http://localhost/ccp/public/angular/add',todo);
	};
}