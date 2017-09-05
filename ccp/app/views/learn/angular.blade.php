@extends('layout.main')

@section('title')

@stop

@section('content')
<div ng-app="" ng-controller="TodosController">
	<h1 ng-if="remain()">(<small ng-bind="remain()"></small>)remain</h1>
	<input type="text" placeholder="search" ng-model="search">
	<ul>
		<li ng-repeat="todo in todos | filter: search">
			<label ng-bind="todo.body"></label>
			<input type="checkbox"  ng-model="todo.completed"/>
		</li>
	</ul>
	<form ng-submit="add()">
		<input type="text" ng-model="new_todo">
		<input type="submit" value="add">
	</form>
</div>
@stop						