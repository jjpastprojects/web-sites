@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Payrolls') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/payroll/create">{!! trans('messages.Generate New Payroll') !!}</a></li>
						  </ul>
					</div>
					</h2>
					{!! Form::open(['route' => 'payroll.myPayroll','role' => 'form','class'=>'form-inline']) !!}
					  <div class="form-group">
					    {!! Form::select('user_id', [null => 'Please Select'] + $users, isset($user_id) ? $user_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select User'])!!}
					  </div>
					  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Get'),['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
					<br /><br />
					@include('common.datatable',['col_heads' => $col_heads])
				</div>
			</div>
		</div>

	@stop