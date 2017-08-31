
			  <div class="form-group">
			    {!! Form::label('user_id',trans('messages.Staff'),['class' => 'control-label'])!!}
			    {!! Form::select('user_id[]', $users, isset($selected_user) ? $selected_user : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select User','multiple' => true])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('award_type_id',trans('messages.Award Name'),['class' => 'control-label'])!!}
			    {!! Form::select('award_type_id', [''=> ''] + $award_types, isset($award->award_type_id) ? $award->award_type_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Award Name'])!!}
			  	@if(Entrust::hasRole('admin'))
			  	<p class="help-block">{!! trans('messages.To add new award type')!!} <a href="/configuration#award" target="_blank">{!! trans('messages.Click here') !!}</a></p>
			  	@endif
			  </div>
			  <div class="form-group">
			    {!! Form::label('month_year',trans('messages.Month & Year'),[])!!}
			    <div class="row">
					<div class="col-xs-4">
						{!! Form::select('month', [null=> 'Please select'] + App\Classes\Helper::getMonths(), isset($award->month) ? $award->month : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Month'])!!}
					</div>
					<div class="col-xs-4">
						{!! Form::select('year', [null=> 'Please select'] + App\Classes\Helper::getYears(), isset($award->year) ? $award->year : date('Y'),['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Year'])!!}
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('gift',trans('messages.Gift Prize'),[])!!}
				{!! Form::input('text','gift',isset($award->gift) ? $award->gift : '',['class'=>'form-control','placeholder'=>'Enter Gift Prize'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('cash',trans('messages.Cash Prize'),[])!!}
				{!! Form::input('number','cash',isset($award->cash) ? $award->cash : '',['class'=>'form-control','placeholder'=>'Enter Cash Prize'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('award_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('award_description',isset($award->award_description) ? $award->award_description : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Description'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('award_date',trans('messages.Award Date'),[])!!}
				{!! Form::input('text','award_date',isset($award->award_date) ? $award->award_date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Award Date','readonly' => 'true'])!!}
			  </div>
			  	{{ App\Classes\Helper::getCustomFields('award-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
