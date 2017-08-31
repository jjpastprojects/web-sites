
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.Edit Award Type') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::model($award_type,['method' => 'PATCH','route' => ['award_type.update',$award_type->id] ,'class' => 'award-type-form']) !!}
			@include('award_type._form', ['buttonText' => 'Update'])
		{!! Form::close() !!}
	</div>
	<script>
	$(function() {
  	 Validate.init();
    });
	</script>
