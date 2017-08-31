
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.Edit Document Type') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::model($document_type,['method' => 'PATCH','route' => ['document_type.update',$document_type->id] ,'class' => 'document-type-form']) !!}
			@include('document_type._form', ['buttonText' => 'Update'])
		{!! Form::close() !!}
	</div>
	<script>
	$(function() {
  	 Validate.init();
    });
	</script>
