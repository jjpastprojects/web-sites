<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('ground_signs_quantity',trans('messages.Friday - Monday'),[])!!}
        {!! Form::input('number','ground_signs_quantity',isset($location->ground_signs_quantity) ? $location->ground_signs_quantity : '',['class'=>'form-control', 'placeholder'=>'Enter Ground Signs Install Quantity'])!!}
    </div>
</div>