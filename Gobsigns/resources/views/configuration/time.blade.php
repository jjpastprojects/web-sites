			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('in_time',trans('messages.In Time'),[])!!}
				<div class="input-group date timepicker col-md-5" data-date="" data-date-format="HH:ii p" data-link-field="in_time" data-link-format="HH:ii p">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                </div>
				<input type="hidden" name="in_time" id="in_time" value="" /><br/>
			  </div>
				<div class="form-group">
			    {!! Form::label('out_time',trans('messages.Out Time'),[])!!}
				<div class="input-group date timepicker col-md-5" data-date="" data-date-format="HH:ii p" data-link-field="out_time" data-link-format="HH:ii p">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                </div>
				<input type="hidden" name="out_time" id="out_time" value="" /><br/>
			  </div>
			  {!! Form::hidden('config_type','time')!!}
		  	  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
			</div>
			<div class="col-sm-6">
				<ul class="list-group">
				  <li class="list-group-item">
					<span class="badge badge-info">{!! config('config.in_time') ? date('h:i a',strtotime(config('config.in_time'))) : 'Not set' !!}</span>
					In Time
				  </li>
				  <li class="list-group-item">
					<span class="badge badge-info">{!! config('config.out_time') ? date('h:i a',strtotime(config('config.out_time'))) : 'Not set' !!}</span>
					Out Time
				  </li>
				</ul>
			</div>
			<div class="clear"></div>
		  	