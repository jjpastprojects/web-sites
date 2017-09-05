<?php

class CcpController extends BaseController{
	function getSell(){
			file_put_contents("ipn.txt", "before");
			return View::make('ccp.sell');
	}

	function postSell(){
		$validator = Validator::make(Input::get(),array(
				'amount' => 'required|integer|min:'.Config::get('constants.sell_min_dollar').'|max:'.Config::get('constants.sell_max_dollar'),
				'ccp' => 'required',
				'first_name' => 'required',
				'last_name' => 'required',
                                'paypal' => 'required|email',
                                'paypal_first_name' => 'required',
                                'paypal_last_name' => 'required',
				'email' => 'email',
				'phone_number' => '',
			));
		if($validator->fails()){
			return Redirect::route('sell')
				->withErrors($validator)
				->withInput();
		}

                $sell = Sell::where('amount','=',Input::get('amount'))
                                        ->where('ccp','=',Input::get('ccp'))
                                        ->where('first_name','=',Input::get('first_name'))
                                        ->where('last_name','=',Input::get('last_name'))
                                        ->where('paypal','=',Input::get('paypal'))
                                        ->where('paypal_first_name','=',Input::get('paypal_first_name'))
                                        ->where('paypal_last_name','=',Input::get('paypal_last_name'))
                                        ->where('email','=',Input::get('email'))
                                        ->where('phone_number','=',Input::get('phone_number'));
                if($sell->count() == 0){
                        $sell = Sell::create(array(
                                'amount' => Input::get('amount'),
                                'ccp' => Input::get('ccp'),
                                'first_name' => Input::get('first_name'),
                                'last_name' => Input::get('last_name'),
                                'paypal' => Input::get('paypal'),
                                'paypal_first_name' => Input::get('paypal_first_name'),
                                'paypal_last_name' => Input::get('paypal_last_name'),
                                'email' => Input::get('email'),
                                'phone_number' => Input::get('phone_number'),
                                'activate' => 0,
                                'txt_id' => 0,
                                'finish' => 0,
                        ));
                        if($sell){
                        return View::make('ccp.check')
                                ->with('amount',Input::get('amount'))
                                ->with('custum',$sell->id);
                        }
                }
                else{
                        $sell =  $sell->first();
                        return View::make('ccp.check')
                                ->with('info', Lang::get('ccp.sell_exist'))
                                ->with('amount',Input::get('amount'))
                                ->with('custum',$sell->id);
                }

		return Input::get();
	}

	function getBuy(){
		return View::make('ccp.buy');
	}

	function postBuy(){
			$validator = Validator::make(Input::all(),array(
					'paypal' => 'required|email',
					'amount' => 'required|integer|min:'.Config::get('constants.buy_min_dollar').'|max:'.Config::get('constants.buy_max_dollar'),
					'email' => 'email',
					'phone_number' => 'required|phone',
                                        'img_back' => 'required|max:10000',
                                        'img_front' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
				));
			if($validator->fails()){
				return Redirect::route('buy')
					->withErrors($validator)
					->withInput();
			}else{
                                        $back = Input::file('img_back');
                                        $front = Input::file('img_front');
                                        $name = time();
                                        $back_directory = public_path()."/img/back/";
                                        $front_directory = public_path()."/img/front/";

                                        $back->move($back_directory, $name);
                                        $front->move($front_directory, $name);



					$buy = Buy::create(array(
							'paypal' => Input::get('paypal'),
							'amount' => Input::get('amount'),
                                                        'img' =>(string) $name,
							'email' => Input::get('email'),
							'phone_number' => Input::get('phone_number'),
							'activate' => 0,
						));
					if($buy){
						return Redirect::route('home')
							->with('global',Lang::get('ccp.buy_waitting'));
					}

			}
		}

	function ipn(){

		$admin_email = "lembarekbuss@gmail.com";
		$payment_status = Input::get('payment_status');
		$payment_amount = Input::get('mc_gross');
		$payment_currency  = Input::get('mc_currency');
		$txn_id = Input::get('txt_id');
		$receiver_email = Input::get('receiver_email');
		$payer_email = Input::get('payer_email');
		$custum = Input::get('custum');

		$order = Sell::where('amount','=',$payment_amount)
				->where("id","=",$custum)
				->where('activate','=',0);
			if($order->count()){
				$order->activate = 1;
				$order->save();
			}


		$req = 'cmd=_notify-vadidate';

		foreach (Input::get() as $key => $value) {
			$value = urlencode(stripcslashes($value));
			$req .= "&$key=$value";
		}



		$url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		$result = curl_exec($ch);
		curl_close($ch);

		if($payment_status == "Completed"){
		if($result == "VERIFIED"){
		if($receiver_email == $admin_email and $payment_currency == 'USD'){
				$order = Sell::where('amount','=',$payment_amount)
				->where("id","=",$custum)
				->where('activate','=',0);
			if($order->count()){
				$order->activate = 1;
				$order->txn_id = $txn_id;
				if($order->save()){
					return "success";
				}
			}
		}
		}
		}
		return Input::get();
	}
	function sell_success(){
		return "success";
	}

	function sell_cancel(){
		return "cancel";
	}
}
