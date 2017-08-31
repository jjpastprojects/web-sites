
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.Edit Salary Type') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::model($salary_type,['method' => 'PATCH','route' => ['salary_type.update',$salary_type->id] ,'class' => 'salary-type-form']) !!}
			@include('salary_type._form', ['buttonText' => 'Update'])
		{!! Form::close() !!}
	</div>
	<script>
	$(function() {
  	 Validate.init();
    });
	</script>
