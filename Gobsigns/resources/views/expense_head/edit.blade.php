
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.Edit Expense Head') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::model($expense_head,['method' => 'PATCH','route' => ['expense_head.update',$expense_head->id] ,'class' => 'expense-head-form']) !!}
			@include('expense_head._form', ['buttonText' => 'Update'])
		{!! Form::close() !!}
	</div>
	<script>
	$(function() {
  	 Validate.init();
    });
	</script>
