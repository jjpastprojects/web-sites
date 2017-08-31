@extends('layouts.default')

	@section('content')

		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Locations') !!}
					<div class="additional-btn">
						{!! \App\Classes\Helper::help(config('help.location_index')) !!}
						<a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/location/create">{!! trans('messages.Add New Location') !!}</a></li>
								@if(Entrust::hasRole('admin'))
								<li role="presentation"><a role="menuitem" tabindex="-1" href="/reporting">{!! trans('messages.Report All Location') !!}</a></li>
								@endif
						</ul>
					</div>
					</h2>
					@include('common.datatable_location',['col_heads' => $col_heads])
				</div>
			</div>
		</div>

	@stop