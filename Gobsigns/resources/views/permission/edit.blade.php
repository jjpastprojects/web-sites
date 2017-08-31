@extends('layouts.default')

	@section('content')
		
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>Edit</strong> Permission</h2>
					
					{!! Form::model($permission,['method' => 'PATCH','route' => ['permission.update',$permission->id] ,'class' => 'permission-form']) !!}
						@include('permission._form', ['buttonText' => 'Update Permission'])
					{!! Form::close() !!}
				</div>
			</div>
		</div>

	@stop