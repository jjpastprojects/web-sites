<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('shipping_consultant_checks',trans('messages.Consultant Checks'),[])!!}
        {!! Form::input('text','shipping_consultant_checks',isset($location->shipping_consultant_checks) ? $location->shipping_consultant_checks : '',['class'=>'form-control', 'placeholder'=>'Enter Consultant Checks'])!!}
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('shipping_promotional_materials',trans('messages.Promotional Materials'),[])!!}
        {!! Form::input('text','shipping_promotional_materials',isset($location->shipping_promotional_materials) ? $location->shipping_promotional_materials : '',['class'=>'form-control', 'placeholder'=>'Enter Promotional Materials'])!!}
    </div>
</div>