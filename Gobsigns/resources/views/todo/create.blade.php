
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.To do List') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::open(['route' => 'todo.store','role' => 'form', 'class'=>'todo-form ']) !!}
			@include('todo._form')
		{!! Form::close() !!}
	</div>
	  <script>
		$(document).ready(function() { 
			$('.datepicker-input').datepicker({
			    format: 'yyyy-mm-dd',
			    autoclose: true,
			});
			$('input').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue',
			increaseArea: '20%' // optional
			});
		});
	  </script>
