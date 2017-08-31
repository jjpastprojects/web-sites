<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('ground_signs',trans('messages.Ground Signs'),[])!!}
        {!! Form::input('number','ground_signs',isset($location->ground_signs) ? $location->ground_signs : '',['class'=>'form-control', 'placeholder'=>'Enter Ground Signs'])!!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('car_signs',trans('messages.Car Signs'),[])!!}
        {!! Form::input('number','car_signs',isset($location->car_signs) ? $location->car_signs : '',['class'=>'form-control', 'placeholder'=>'Enter Car Signs'])!!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('walker_signs',trans('messages.Walker Signs'),[])!!}
        {!! Form::input('number','walker_signs',isset($location->walker_signs) ? $location->walker_signs : '',['class'=>'form-control', 'placeholder'=>'Enter Walker Signs'])!!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('verbiage_decals',trans('messages.Verbiage Decals'),[])!!}
        {!! Form::input('number','verbiage_decals',isset($location->verbiage_decals) ? $location->verbiage_decals : '',['class'=>'form-control', 'placeholder'=>'Enter Verbiage Decals'])!!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('address_decals',trans('messages.Address Decals'),[])!!}
        {!! Form::input('number','address_decals',isset($location->address_decals) ? $location->address_decals : '',['class'=>'form-control', 'placeholder'=>'Enter Address Decals'])!!}
    </div>
</div>