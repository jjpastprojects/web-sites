@extends('layout.main')

@section('content')
<div>
	<form class="form-horizontal" method="post" action="https://www.paypal.com/cgi-bin/webscr">
			<input type="hidden" name="cmd" value="_xclick" >
			<input type="hidden" name="business" value="{{  Config::get('constants.paypal_account') }} ">
			<input type="hidden" name="item_name" value="{{ Lang::get('ccp.sell_dollar') }}">
			<input type="hidden" name="amount" value="{{ $amount }}">
			<input type="hidden" name="tax"   value="0.00" >
			<input type="hidden" name="currency_code"   value="USD" >

			<input type="hidden" name="return"  value="{{ URL::route('sell_success') }}">
			<input type="hidden" name="cancel_return" value="{{ URL::route('sell_cancel') }}" >
			<input type="hidden" name="notify_url" value="{{ URL::route('ipn') }}" >
			<input type="hidden" name="custum" value="{{ $custum }}" >

			<div class="form-group">
                            <div class=" col-sm-offset-2 col-sm-10">
                                <input class="btn btn-success" type='submit' value="{{ Lang::get('ccp.go2paypal') }}"/>
                            </div>
                        </div>
    		</div>
	</form>
</div>
@endsection
