
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.Edit Leave Type') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::model($leave_type,['method' => 'PATCH','route' => ['leave_type.update',$leave_type->id] ,'class' => 'leave-type-form']) !!}
			@include('leave_type._form', ['buttonText' => 'Update'])
		{!! Form::close() !!}
	</div>
	<script>
	$(function() {
  	 Validate.init();
    });
	</script>
