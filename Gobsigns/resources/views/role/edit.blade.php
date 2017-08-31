
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.Edit Role') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::model($role,['method' => 'PATCH','route' => ['role.update',$role->id] ,'class' => 'role-form']) !!}
			@include('role._form', ['buttonText' => 'Update'])
		{!! Form::close() !!}
	</div>
	<script>
	$(function() {
  	 Validate.init();
    });
	</script>