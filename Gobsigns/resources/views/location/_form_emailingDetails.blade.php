<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('emailing_eventNotify',trans('messages.Daily Event Notification').'*',[])!!}
        {!! Form::input('text','emailing_eventNotify',isset($location->emailing_eventNotify) ? $location->emailing_eventNotify : '',['class'=>'form-control', 'placeholder'=>'Enter Daily Event Notification'])!!}
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('emailing_invoice',trans('messages.Invoice').'*',[])!!}
        {!! Form::input('text','emailing_invoice',isset($location->emailing_invoice) ? $location->emailing_invoice : '',['class'=>'form-control', 'placeholder'=>'Enter Invoice'])!!}
    </div>
</div>