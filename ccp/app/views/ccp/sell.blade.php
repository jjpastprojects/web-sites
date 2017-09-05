@extends('layout.main')

@section('content')
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>{{ Lang::get('steps.step1') }}</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>{{ Lang::get('steps.step2') }}</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>{{ Lang::get('steps.step3') }}</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
            <p>{{ Lang::get('steps.step4') }}</p>
        </div>
    </div>
</div>
<form role="form" method="post" action="{{ URL::route('sell') }}" >
   {{  Form::token() }}

    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> {{ Lang::get('steps.step1') }} </h3>
                <div class="form-group">
                    <label class="control-label">{{ Lang::get('ccp.amount') }}</label>
                    <input type="number" name="amount" (Input::old('amount'))? 'value='.e(Input::old('amount')):'' }} min="{{ Config::get('constants.sell_min_dollar') }}"   max="{{ Config::get('constants.sell_max_dollar' ) }}"  required="required" class="form-control" placeholder=""  />
                    @if($errors->has('amount'))
                        <div class="help-block col-sm-4">{{ $errors->first('amount') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label">{{ Lang::get('ccp.ccp') }}</label>
                    <input type="number" name="ccp"  {{ (Input::old('ccp'))? 'value='.e(Input::old('ccp')):'' }}   maxlength="100" required="required" class="form-control" placeholder="" />
                    @if($errors->has('ccp'))
                        <div class="help-block col-sm-4">{{ $errors->first('cpp') }}</div>
                    @endif
                </div>
                <button class="btn btn-primary nextBtn btn-lg <?php if(Session::get('locale') == 'ar') echo 'pull-left'; else echo 'pull-right'; ?>" type="button" >{{ Lang::get('general.next') }}</button>
            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> {{ Lang::get('steps.step2') }} </h3>
                <div class="form-group">
                    <label class="control-label">{{ Lang::get('general.first_name') }}</label>
                    <input type="text" name="first_name" {{ (Input::old('first_name'))? 'value='.e(Input::old('first_name')):'' }} maxlength="100"  required="required" class="form-control" placeholder=""  />
                    @if($errors->has('ccp'))
                        <div class="help-block col-sm-4">{{ $errors->first('cpp') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label">{{ Lang::get('general.last_name') }}</label>
                    <input type="text" name="last_name"  {{ (Input::old('last_name'))? 'value='.e(Input::old('last_name')):'' }}  maxlength="100" required="required" class="form-control" placeholder="" />
                    @if($errors->has('last_name'))
                        <div class="help-block col-sm-4">{{ $errors->first('last_name') }}</div>
                    @endif
                </div>
                <button class="btn btn-primary nextBtn btn-lg <?php if(Session::get('locale') == 'ar') echo 'pull-left'; else echo 'pull-right'; ?>" type="button" >{{ Lang::get('general.next') }}</button>
            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> {{ Lang::get('steps.step3') }} </h3>
                <div class="form-group">
                    <label class="control-label">{{ Lang::get('ccp.paypal_account') }}</label>
                    <input type="email" name="paypal"  {{ Input::old('paypal')? "value='".Input::old('paypal')."'":""  }} maxlength="100"  required="required" class="form-control" placeholder=""  />
                    @if($errors->has('paypal'))
                        <div class="help-block col-sm-4">{{ $errors->first('paypal') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label">{{ Lang::get('ccp.paypal_first_name') }}</label>
                    <input type="text" name="paypal_first_name"  {{ Input::old('paypal_first_name')? "value='".Input::old('paypal_first_name')."'":""  }} maxlength="100" required="required" class="form-control" placeholder="" />
                    @if($errors->has('paypal_first_name'))
                        <div class="help-block col-sm-4">{{ $errors->first('paypal_first_name') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label">{{ Lang::get('ccp.paypal_last_name') }}</label>
                    <input type="text" name="paypal_last_name"  {{ Input::old('paypal_last_name')? "value='".Input::old('paypal_last_name')."'":""  }} maxlength="100" required="required" class="form-control" placeholder="" />
                    @if($errors->has('paypal_last_name'))
                        <div class="help-block col-sm-4">{{ $errors->first('paypal_last_name') }}</div>
                    @endif
                </div>
                <button class="btn btn-primary nextBtn btn-lg <?php if(Session::get('locale') == 'ar') echo 'pull-left'; else echo 'pull-right'; ?>" type="button" >{{ Lang::get('general.next') }}</button>
            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-4">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> {{ Lang::get('steps.step4') }} </h3>
                 <div class="form-group">
                    <label class="control-label">{{ Lang::get('general.email') }}({{ Lang::get('general.optional') }})</label>
                    <input type="email" name="email"  {{ (Input::old('email'))? 'value='.e(Input::old('email')):'' }} maxlength="100" class="form-control" placeholder="" >
                    @if($errors->has('email'))
                        <div class="help-block col-sm-4">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                 <div class="form-group">
                    <label class="control-label">{{ Lang::get('general.phone_number') }}({{ Lang::get('general.optional') }})</label>
                    <input type="number" name="phone_number" {{ (Input::old('phone_number'))? 'value='.e(Input::old('phone_number')):'' }}  maxlength="100" class="form-control" placeholder=""    >
                    @if($errors->has('phone_number'))
                        <div class="help-block col-sm-4">{{ $errors->first('phone_number') }}</div>
                    @endif
                </div>
                <button class="btn btn-success btn-lg <?php if(Session::get('locale') == 'ar') echo 'pull-left'; else echo 'pull-right'; ?>" type="submit">{{ Lang::get('general.finish') }}</button>
            </div>
        </div>
    </div>
    <br/>
</form>
@endsection
