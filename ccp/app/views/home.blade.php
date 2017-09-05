@extends('layout.main')

@section('content')
                <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">
                                    {{ Lang::get('pages/home.description'); }}
                                </h4>
                            </div>
                        </div>
                <div class="row row-eq-height">

		<div id="buy"  class="col-sm-6 col-md-5 col-lg-4  col-md-offset-1 col-lg-offset-2" >
			<div class="panel panel-default">
				@if($buy)
                                        <div class="panel-heading">
					    <h2>{{ Lang::get('ccp.buy_h1') }} </h2>
                                        </div>
                                        <div class="panel-body">
					    <p class="description-3"> {{ Lang::get('ccp.buy_desc') }} </p>
			 		    <p><a class="btn btn-primary btn-block"  href="{{ URL::route('buy') }}" >{{ Lang::get('ccp.buy') }}</a></p>
                                        </div>
			 	@else
                                        <div class="panel-heading">
					    <h2>{{ Lang::get('ccp.buy_h1') }} </h2>
                                        </div>
                                        <div class="panel-body">
			 		    <p class="description-3"> {{ Lang::get('ccp.buy_desc_try_later') }} </p>
			 		    <p><a class="btn btn-warning btn-block">{{ Lang::get('ccp.try_after_24')  }}</a></p>
                                        </div>
			 	@endif
			 </div>
		</div>

		<div id="sell" class="col-sm-6 col-md-5 col-lg-4">
			<div class="panel panel-default">
				@if($sell)
                                        <div class="panel-heading">
					    <h2> {{ Lang::get('ccp.sell_h1') }} </h2>
                                        </div>
                                        <div class="panel-body">
					    <p class="description-3"> {{ Lang::get('ccp.sell_desc') }} </p>
					    <p><a class="btn btn-primary btn-block" href="{{ URL::route('sell') }}" >{{ Lang::get('ccp.sell') }}</a></p>
                                        </div>
				@else
                                        <div class="panel-heading">
					    <h2> {{ Lang::get('ccp.sell_h1') }} </h2>
                                        </div>
                                        <div class="panel-body">
					    <p class="description-3"> {{ Lang::get('ccp.sell_desc_try_later') }} </p>
					    <p><a class="btn btn-warning btn-block">{{ Lang::get('ccp.try_after_24') }}</a> </p>
                                        </div>
				@endif
			</div>
		</div>
	</div>
@endsection
