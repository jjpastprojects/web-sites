@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Word for Translation') !!}</h2>
					{!! Form::open(['route' => 'language.addWords','role' => 'form', 'class'=>'language-entry-form']) !!}
					  
			  		  <div class="form-group">
					    {!! Form::label('text','Word/Sentences',[])!!}
						{!! Form::input('text','text','',['class'=>'form-control','placeholder'=>'Enter Word/Sentences'])!!}
					  </div>
					  	{!! Form::submit(isset($buttonText) ? $buttonText : 'Save',['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Translate') !!}</strong> {!! trans('messages.Words/Sentences') !!}</h2>
					
					{!! Form::model($language,['method' => 'PATCH','route' => ['language.updateTranslation',$locale] ,'class' => 'form-horizontal']) !!}
						@foreach($language_entries as $key => $language_entry)
							<div class="form-group">
						    	{!! Form::label($key,$language_entry,['class'=>'col-sm-4 control-label'])!!}
								<div class="col-sm-8">
									@if($locale == 'en')
									{!! Form::input('text',$key,(array_key_exists($language_entry, $trans)) ? $trans[$language_entry] : $language_entry,['class'=>'form-control','placeholder'=>'Enter Translation'])!!}
									@else
									{!! Form::input('text',$key,(array_key_exists($language_entry, $trans)) ? $trans[$language_entry] : '',['class'=>'form-control','placeholder'=>'Enter Translation'])!!}
									@endif
								</div>
						  	</div>
						@endforeach
						{!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

	@stop