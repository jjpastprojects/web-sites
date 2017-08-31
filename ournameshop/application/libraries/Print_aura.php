<?php

require_once(APPPATH . 'libraries/library.php');

Class Print_aura extends Library {

	protected $api_url = 'http://www.api.printaura.com/api.php';
	

	public function __construct()
	{
		parent::__construct();
		$this->ci->load->library('curl');
	}

	public function test()
	{
		// return $this->upload_imgage_from_url(array(
		// 	'url'	=> 'http://image.motortrend.com/f/oftheyear/car/1301_2013_motor_trend_car_of_the_year_tesla_model_s/41007734+w644/2013-tesla-model-s-front-1.jpg'
			
		// ));
		
		debug($this->_api_call('listproducts'));exit;
		// debug($this->add_product());
		// debug($this->errors());
	}

	public function listshipping($type_id = PA_PHONE_CASE_TYPE_ID, $shipping_id = FALSE)
	{
		$data = $this->_api_call('listshipping');
			
		if($data)
		{
			$data = get_object_vars($data);
			

			if($shipping_id)
			{
				$data = object_transparent($data[$type_id], 'shipping_id', TRUE);
				return $data[$shipping_id];
			}
			else
			{
				$data = $data[$type_id];
			}

			return $data;
		}

		return FALSE;
	}

	public function calc_shipping($items, $shipping_id = 1)
	{
		$tmp = array();

		foreach($items as $key => $item)
		{
			if(is_printaura_product($item->product_type))
			{
				$tmp[] = $item;
			}
		}

		if(!$tmp)
			return 0;

		$price 			= 0;
		$total_items 	= 0;

		$shippings = $this->listshipping(
			PA_PHONE_CASE_TYPE_ID, $shipping_id
		);

		foreach($tmp as $item)
		{
			$total_items += $item->q;
			
			// $params = array(
			// 	'product_id'		=> $item->pa_product_id,
			// 	'brand_id'			=> $item->pa_brand_id,
			// 	'color_id'			=> $item->pa_color_id,
			// 	'size_id'			=> $item->pa_size_id,
			// 	'shipping_id'		=> $shipping_id,
			// 	'front_print'		=> TRUE,
			// 	'quantity'			=> $item->q	
			// );

			// $res = $this->_api_call('getallpricing', $params);
			// debug($res);
			// if(is_array($res))
			// {
			// 	$res = object_transparent($res, 'shipping_id', TRUE);
			// }

			// if($res)
			// {
			// 	$price += $res[$shipping_id]->shipping_cost;
			// }
		}

		return $shippings->first_item_price + (($total_items - 1) * $shippings->additional_item_price);
	}

	public function shipping_info($shipping_id)
	{
		$shippings = $this->listshipping();

		if(!$shippings)
			return FALSE;

		$shippings 	= object_transparent($shippings, 'shipping_id', TRUE);
		
		if(!isset($shippings[$shipping_id]))
		{
			$this->set_error('Shipping id not found');
			return FALSE;
		}

		return $shippings[$shipping_id];
	}

	public function viewproducts($params)
	{
		$data = $this->_api_call('viewproducts', $params);

		if(!empty($params['paproduct_id']))
			$data = current($data);

		return $data;
	}

	public function brands()
	{	
		$data = $this->_api_call('listbrands');

		if(!$data)
			return FALSE;
			
		usort($data, function($a, $b) {
		    return strcmp($a->brand_name, $b->brand_name);
		});
		
		return $data;
	}

	public function colors()
	{	
		$data = $this->_api_call('listcolors');

		if(!$data)
			return FALSE;

		$data = object_transparent($data, 'color_id', TRUE);
		
		foreach($data as $k => &$v)
		{
			unset($v->color_group, $v->color_id);
		}
		
		return $data;
	}

	public function sizes()
	{	
		$data = $this->_api_call('listsizes');

		usort($data, function($a, $b) {
		    return strcmp($a->size_name, $b->size_name);
		});

		return object_transparent($data, 'size_id', TRUE);
	}

	public function tshirts($brand_id = FALSE)
	{	
		$data = $this->_api_call('listproducts');
		
		if($brand_id)
		{
			$tmp = array();

			foreach($data as $k => $v)
			{
				if($v->brand_id == $brand_id)
					$tmp[] = $v;
			}

			$data = $tmp;
		}

		

		usort($data, function($a, $b) {
		    return strcmp($a->product_name, $b->product_name);
		});

		return object_transparent($data, 'product_id', TRUE);
	}

	public function upload_imgage_from_url($params)
	{
		return $this->_api_call('uploadimagefromurl', $params);
	}

	public function upload_image($params)
	{
		$params = array(
			'key'			=> $this->ci->config->item('pa_api_key'),
			'hash'			=> $this->ci->config->item('pa_api_hash'),
			'method'		=> 'uploadimage',
			'file'			=> $params['file']
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		
		$data = curl_exec($ch);
		curl_close($ch);

		return json_decode($data);
		

		// $this->_api_call('uploadimage', $params);
		// debug($this->ci->curl->debug(), 'DEBUG CURL');exit;
		// return $this->_api_call('uploadimage', $params);
	}

	public function add_product($params)
	{
		// Select the Brand and Product , You can retrieve these by using methods listbrands and listproducts
		// $postfields['brand_id'] = '1';
		// $postfields['product_id'] = '1';

		// // Product Details
		// $postfields['sku'] = '003';
		// $postfields['title'] = 'Api Product';
		// $postfields['description'] = 'Product api description';

		// // Must be a valid image ID returned by methods uploadimage or listmyimages
		// $postfields['front_print'] = '292780';
		// $postfields['back_print'] = '292781';

		// // We are also going to use the front_print image as a storeimage

		// //
		// // Below is an array of the Color IDs (1 and 2) retrieved using listcolors each mentioning a normal_price and a plus_price which is for plus sizes of that product.
		// //
		// $colorsarray = array();
		// $colorsarray['colors'][1]['normal_price'] = '25';
		// $colorsarray['colors'][1]['plus_price'] = '30';

		// $colorsarray['colors'][3]['normal_price'] = '26';
		// $colorsarray['colors'][3]['plus_price'] = '31';

		// $colorsarray['colors'][7]['normal_price'] = '26';
		// $colorsarray['colors'][7]['plus_price'] = '31';

		// //(update 12/13/2013) New way: array in print aura are decoded in json format and then base64_encoded
		// //$postfields['colors'] = base64_encode(serialize($colorsarray)); (old way)
		// $postfields['colors'] = base64_encode(json_encode($colorsarray)); // New way



		return $this->_api_call('addproduct', $params);
		//
		// Below is an array of the apps the product is to be activated in
		//
		// $appsarray = array();
		// $appsarray[] = 1; // must be a valid app_id – can be retrieved using method viewapps

		// Arrays in Print Aura API are always serialized and then base64_encoded
		//(update 12/13/2013) New way: array in print aura are decoded in json format and then base64_encoded

		//$postfields['apps'] = base64_encode(serialize($appsarray)); old way
		// $postfields['apps'] = base64_encode(json_encode($appsarray));

		// Below are the custom parameters needed for the selected app (Shopify in this example) – These parameters can be retrieved for different apps using method viewapps
		// $postfields['product_type'] = 'my type';
		// $postfields['product_vendor'] = 'my vendor';
		// $postfields['product_tags'] = 'tag1,tag2,tag3';

		//
		// Below are the Store Images to be uploaded to the APPs selected for the product to be activated in
		//
		// $storeimages = array();
		// $storeimages[0]['image_id'] = '292780'; // Must be a valid image ID returned by methods uploadimage or listmyimages
		// $storeimages[0]['default'] = 1; // Sets this image as the default image ( 1 for default 0 for normal)

		// $storeimages[1]['image_id'] = '1780'; // Must be a valid image ID returned by methods uploadimage or listmyimages

		// Arrays in Print Aura API are always serialized and then base64_encoded
		//(update 12/13/2013) New way: array in print aura are decoded in json format and then base64_encoded

		//$postfields['storeimages'] = base64_encode(serialize($appsarray)); old way
		// $postfields['storeimages'] = base64_encode(json_encode($storeimages));// New Way

		// Send the query to PrintAura API using CURL and upload the image

		
		
	}

	function add_order($params)
	{
		return $this->_api_call('addorder', $params);
	}

	function get_shirt_price($params)
	{
		$data = $this->_api_call('getallpricing', $params);

		if(!$data)
			return FALSE;

		$data = current($data);

		return $data->base_price + $data->printing_price;
	}

	public function get_pricing()
	{
		$data = $this->_api_call('getpricing', $params);		
	}

	public function place_order($order_id)
    {	
    	$order = $this->ci->orders->get($order_id);
    	
		// $items = $this->ci->cart_items->by_cart($order->cart_id);  	 
		$items = $this->ci->cart_items->join_surfaces()->by_cart($order->cart_id);
    	
		

		$itemsarray = array();

    	foreach($items as $key => $item)
    	{
    		
    		if(!is_printaura_product($item->product_type))
    			continue;
    		
    		$uploaded_image = $this->upload_imgage_from_url(array(
    			// 'url' => 'http://design.ubuntu.com/wp-content/uploads/ubuntu-logo32.png'
    			'url'	=> printful_image_url($item)
				// 'file' => ('@' . realpath(rtrim(FCPATH, '/')) . '/print_aura_image.png')
			));
    		
			if(!$uploaded_image)
			{
				$this->set_error('image_upload_failed');
				return FALSE;
			}
			
			$itemsarray['items'][$key]['product_id'] 	= $item->pa_product_id;//243;//$product->product_id;
			$itemsarray['items'][$key]['brand_id'] 		= $item->pa_brand_id;//27;//$item->params['brand_id'];
			$itemsarray['items'][$key]['color_id'] 		= $item->pa_color_id;//334;//$item->params['color_id'];
			$itemsarray['items'][$key]['size_id'] 		= $item->pa_size_id;//43;//$item->params['size_id'];
			$itemsarray['items'][$key]['front_print'] 	= $uploaded_image->image_id;//$uploaded_image->results->image_id;
			
			$itemsarray['items'][$key]['quantity'] 		= $item->q;	
    	}
    	
    	if($itemsarray)
    	{
    		$params['clientname']			= $order->name;
			$params['businessname'] 		= 'Lastnamecompany';
			$params['businesscontact'] 		= 'Lastnamecompany';
			$params['email'] 				= $order->email;
			$params['your_order_id'] 		= $order->id + rand(1, 1000000);
			$params['returnlabel'] 			= 'Return Label Line 1 \n Return Label Line 2';

			$params['address1']				= $order->address;
			$params['address2']				= $order->address2;
			$params['city']					= $order->city;
			$params['state']				= $order->state;
			$params['zip']					= $order->zip;
			$params['country']				= $order->country;
			
			$params['customerphone'] 		= $order->phone;
			$params['shipping_id'] 			= 1;

	    	$params['items'] = base64_encode(json_encode($itemsarray));

	    	if(!$this->add_order($params))
			{
				return FALSE;
			}
		}
		
		return TRUE;
    }

	private function _api_call($method, $params = array())
	{
		$params = array_merge($params, array(
			'key'			=> $this->ci->config->item('pa_api_key'),
			'hash'			=> $this->ci->config->item('pa_api_hash'),
			'method'		=> $method
		));
		
		$res = $this->ci->curl->_simple_call('post', $this->api_url, $params);

		if(!$res)
		{
			$this->set_error('network problem');
			return FALSE;
		}

		$res = json_decode($res);
		
		if($res->status === FALSE)
		{
			$this->set_error($res->message);
			return FALSE;
		}
		else
		{
			return $res->results;
		}
	}
}