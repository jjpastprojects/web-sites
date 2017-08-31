<div class="col-md-12">
    <div class="form-group margin-bottom5">
        {!! Form::label('car_rental_enterprise',trans('messages.Enterprise'),[])!!}
    </div>
    <div class="form-group margin-bottom5">
        {!! Form::radio('car_rental_enterprise', 'Yes', false, array('id' => 'car_rental_enterprise_yes'))!!}
        {!! Form::label('car_rental_enterprise_yes',trans('messages.Yes'),['class' => 'sub_label'])!!}
    </div>
    <div class="form-group">
        {!! Form::radio('car_rental_enterprise', 'No', false, array('id' => 'car_rental_enterprise_no'))!!}
        {!! Form::label('car_rental_enterprise_no',trans('messages.No'),['class' => 'sub_label'])!!}
    </div>
</div>