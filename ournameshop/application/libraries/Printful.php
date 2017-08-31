<?php

require_once(APPPATH . 'libraries/library.php');
require_once(APPPATH . 'libraries/PrintfulClient.php');

Class Printful extends Library {

	private $pf;

	public function __construct()
	{
		parent::__construct();

		$this->pf = new PrintfulClient($this->ci->config->item('printful_api_key'));
	}

	public function products_types()
	{
		$data = $this->_api_call('products');

		if(!$data)
			return FALSE;

		$data = array_transparent($data, 'type', TRUE);
		
		foreach($data as $k => &$v)
			$v = (object) $v;
		
		return $data;
	}

	private function _get_products()
	{
		return $this->products->get_all();
	}

	public function products($type = FALSE)
	{
		$data = $this->_api_call('products');

		if(!$data)
			return FALSE;

		$data = array_transparent($data, 'type');

		if($type)
		{
			$data = $data[$type];

			foreach($data as $k => &$v)
				$v = (object) $v;
		}
		else
		{
			foreach($data as $k => $vv)
			{
				foreach($vv as $kk => $v3)
				{
					$data[$k][$kk] = (object) $data[$k][$kk];
				}
			}
		}
		
		reset($data);	
		return $data;	
	}

	public function variants($product_id, $template = FALSE)
	{		
		$data = $this->_api_call('products/' . $product_id);

		if(!$data)
			return FALSE;

		return $this->after_variants($data, $template);
	}

	protected function after_variants($data, $template)
	{
		if(!$template)
			return $data;

		$data['product'] = (object) $data['product'];

		foreach($data['variants'] as &$v)
		{
			$v = (object) $v;
			$v->price = $v->price + $template->price;
			
			if($data['product']->type == 'EMBROIDERY')
				$v->price += EMBROIDERY_DIGITALIZE_PRICE;
		}

		$data['by_size'] 	= object_transparent($data['variants'], 'size');
		$data['by_color'] 	= object_transparent($data['variants'], 'color_code');

		return $data;
	}

	public function variant($id, $template = FALSE)
	{
		$data = $this->_api_call('products/variant/' . $id);
		
		if(!$data)
			return FALSE;

		$data = ($this->after_variant($data, $template));
		return $data['variant'];
	}

	protected function after_variant($data, $template)
	{
		$data['product'] = (object) $data['product'];
		$data['variant'] = (object) $data['variant'];

		$data['variant']->price = $data['variant']->price + $template->price;

		if($data['product']->type == 'EMBROIDERY')
			$data['variant']->price += EMBROIDERY_DIGITALIZE_PRICE;

		return $data;
	}

	public function shipping_rates($params)
	{
		$data = $this->_api_call('shipping/rates', $params);

		if(!$data)
			return FALSE;

		foreach($data as &$v)
			$v = (object) $v;

		return $data;
	}

	public function calc_shipping($cart_items, $recipient, $shipping_id)
    {
        $items                  = array();

        foreach($cart_items as $item)
        {
            $items[] = array(
                'variant_id'     => $item->surface_id,
                'quantity'       => $item->q
            );
        }
        
        $rates = $this->shipping_rates(array(
            'recipient' => $recipient,
            'items'     => $items
        ));

        if(!$rates)
        	return FALSE;
        
        $rates = object_transparent($rates, 'id', TRUE);
        
        return $rates[$shipping_id]->rate;
    }

    public function place_order($order_id)
    {	
    	$order = $this->ci->orders->get($order_id);
    	
		$items = $this->ci->cart_items->join_surfaces()->by_cart($order->cart_id);
    	
    	$order_items = array();
    	
    	foreach($items as $item)
    	{
    		if(!is_printfull_product($item->product_type))
    			continue;

    		$order_items[] = array(
				'variant_id' 		=> $item->surface_id,
				'name' 				=> $item->params->name,
				'retail_price' 		=> $item->price,
				'quantity' 			=> $item->q,
				'files' => array(
					array(
						'url' => printful_image_url($item)//$item->custom_print ? site_url(custom_print_url($item)) :
					)
				)
			);
    	}

    	if(!$order_items)
    		return TRUE;
    	
		$printful_order = $this->_api_call('orders',
			array(
				// 'external_id'	=> $order->id,
				'shipping'		=> $order->shipping_id,

				'recipient' => array(
					'name' 			=> $order->name,
					'address1' 		=> $order->address,
					'address2' 		=> $order->address2,
					'city' 			=> $order->city,
					'state_code' 	=> $order->state,
					'country_code' 	=> $order->country,
					'zip' 			=> $order->zip,
					'phone'			=> $order->phone,
					'email'			=> $order->email
				),

				'items' => $order_items
			)

			//array('confirm' => 0)
		);

		return $printful_order;
    }

    public function delete_order($order_id)
    {
    	return $this->_api_call('orders/' . $order_id, array(), 'delete');
    }

	private function _api_call($method, $params = array(), $request_method = FALSE)
	{
		if(!$request_method)
			$request_method = $params ? 'post' : 'get';
		
		try {
			return $this->pf->$request_method($method, $params);
		}
		catch(PrintfulApiException $e){
			$this->set_error('Printful API Exception: '.$e->getCode().' '.$e->getMessage());
			return FALSE;
		}
		catch(PrintfulException $e){
			$this->set_error('Printful Exception: '.$e->getMessage());
			return FALSE;
		}
	}

	public function webhooks()
	{
		return $this->_api_call('webhooks');
	}
}