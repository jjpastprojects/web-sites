@extends('layout.main')

@section('content')
	<div class="row row-eq-height">
		<div class="col-sm-6 col-md-5 col-lg-4  col-md-offset-1 col-lg-offset-2">
			<div class="panel panel-default">
                                <div class="panel-heading">
				    <h1>{{ Lang::get('ccp.ccp_infos') }}</h1>
                                </div>
                                <div class="panel-body">
				    <p>{{ Config::get('constants.ccp_infos') }}</p>
                                </div>
			</div>
		</div>
		<div class="col-sm-6 col-md-5 col-lg-4">
			<div class="panel panel-default">
                                <div class="panel-heading">
				    <h1>{{ Lang::get('contact.contact_us') }}</h1>
                                </div>
                                <div class="panel-body">
				    <p>	{{ Lang::get('contact.mobilis_phone') }} : {{  	Config::get('constants.mobilis_phone') }} <br/>
							{{ Lang::get('contact.djezzy_phone') }} : {{ 		Config::get('constants.djezzy_phone')}} <br/>
							{{ Lang::get('contact.nedjma_phone') }} : {{ 	Config::get('constants.nedjma_phone') }}  <br/>
				    		{{ Lang::get('contact.facebook') }}  : {{ 		Config::get('constants.facebook_account') }}<br/>
				    		{{ Lang::get('contact.skype') }}: 		{{ Config::get('constants.skype_account') }} </p>
                                 </div>

			</div>
		</div>
	</div>
@endsection
