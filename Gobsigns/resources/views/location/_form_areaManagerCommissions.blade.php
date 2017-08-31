<div class="col-sm-12">
    <div class="form-group">
    	{!! Form::label('area_manager_name',trans('messages.Name'),[])!!}
        {!! Form::input('text','area_manager_name',isset($location->area_manager_name) ? $location->area_manager_name : '',['class'=>'form-control', 'placeholder'=>'Enter Name'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('area_manager_amount',trans('messages.Amount'),[])!!}
    <div class="form-group currency-group">
    	<span class='input-group-addon'>$</span>
        {!! Form::input('number','area_manager_amount',isset($location->area_manager_amount) ? $location->area_manager_amount : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Amount'])!!}
    </div>
</div>