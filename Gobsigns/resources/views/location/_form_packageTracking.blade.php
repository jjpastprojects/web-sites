<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('package_ground',trans('messages.Ground').'*',[])!!}
        {!! Form::input('text','package_ground',isset($location->package_ground) ? $location->package_ground : '',['class'=>'form-control', 'placeholder'=>'Enter Ground'])!!}
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('package_express',trans('messages.Express').'*',[])!!}
        {!! Form::input('text','package_express',isset($location->package_express) ? $location->package_express : '',['class'=>'form-control', 'placeholder'=>'Enter Express'])!!}
    </div>
</div>