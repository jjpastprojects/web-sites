@extends('shareFiles::layout.master')

@section('title')

@stop

@section('content')
    @inject('countries', 'Lembarek\Core\Countries\Countries');
    @include('core::partials.errors')
    <form method="post" action="{{ route('file::files.store') }}" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">

       <div class="form-group">
            <label class="col-md-4 control-label">{{ trans('shareFiles::form.name') }}</label>
            <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">{{ trans('shareFiles::form.description')}}</label>
            <div class="col-md-6">
            <input type="textarea" class="form-control" name="description" value="{{ old('description') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">{{ trans('shareFiles::form.links')}}</label>
            <div class="col-md-6">
            <input type="text" class="form-control" name="links" value="{{ old('links') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">{{ trans('shareFiles::form.universities')}}</label>
            <div class="col-md-6">
            <input type="text" class="form-control" name="universities" value="{{ old('universities') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">{{ trans('shareFiles::form.faculty')}}</label>
            <div class="col-md-6">
            <input type="text" class="form-control" name="faculty" value="{{ old('faculty') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">{{ trans('shareFiles::form.filetype')}}</label>
            <div class="col-md-6">
            <select name="filetype" value="{{ old('filetype') }}" class="form-control">
                <option value="pdf">pdf</option>
                <option value="doc">doc</option>
                <option value="rar">rar</option>
                <option value="zip">zip</option>
            </select>
            </div>
        </div>

        <div class="form-group">
                <label class="col-md-4 control-label">{{ trans('shareFiles::form.country')}}</label>
                <div class="col-md-6">
                <select name="country" value="{{ old('country') }}" class="form-control select2">
                    @foreach($countries::$CountriesLongNames as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-4 control-label">{{ trans('shareFiles::form.year')}}</label>
              <div class="col-md-6">
              <input type="number" class="form-control" name="year" value="{{ old('year') }}">
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-4 control-label">{{ trans('shareFiles::form.semester')}}</label>
              <div class="col-md-6">
              <input type="number" class="form-control" name="semester" value="{{ old('semester') }}">
              </div>
          </div>

        <div class="form-group">
            <div class="col-md-4 col-md-push-4">
                <input type="submit" class="btn btn-primary" value="{{ trans('shareFiles::form.add') }}" />
            </div>
        </div>


    </form>
@stop

