<div class="col-sm-6">
	<div class="form-group">
		{!! Form::label('manager',trans('messages.Manager'),[])!!}
		{!! Form::input('text','manager',isset($location->manager) ? $location->manager : '',['class'=>'form-control', 'placeholder'=>'Enter Manager'])!!}
	</div>
</div>
<div class="col-sm-6">
	<div class="form-group">
		{!! Form::label('manager_mobile_phone',trans('messages.Mobile Phone'),[])!!}
		{!! Form::input('text','manager_mobile_phone',isset($location->manager_mobile_phone) ? $location->manager_mobile_phone : '',['class'=>'form-control', 'placeholder'=>'Enter Mobile Phone'])!!}
	</div>
</div>
<div class="col-sm-6">
	<div class="form-group">
		{!! Form::label('regional_manager',trans('messages.Regional Manager'),[])!!}
		{!! Form::input('text','regional_manager',isset($location->regional_manager) ? $location->regional_manager : '',['class'=>'form-control', 'placeholder'=>'Enter Regional Manager'])!!}
	</div>
</div>
<div class="col-sm-6">
	<div class="form-group">
		{!! Form::label('address',trans('messages.Mobile Phone'),[])!!}
		{!! Form::input('text','regional_manager_mobile_phone',isset($location->regional_manager_mobile_phone) ? $location->regional_manager_mobile_phone : '',['class'=>'form-control', 'placeholder'=>'Enter Mobile Phone'])!!}
	</div>
</div>