<?php

Class Order extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library('Print_aura');
	}

	function popup_form()
	{
		$this->load->view('orders/popup_form');
	}

	function place()
	{
		$template = $this->templates->join_category()->get_by(array(
			'templates.id' => $this->input->post('tpl_id'))
		);
		
		if(!$template)
			json_reply(FALSE, 'Template not found');

		$uploaded_image = $this->print_aura->upload_image(array(
			'file' => ('@' . realpath(rtrim(FCPATH, '/') . tpl_thumb($template)))
		));
		
		if(!$uploaded_image->status)
		{
			json_reply(FALSE, $uploaded_image->message);
		}

		$colorsarray = array();

		$colorsarray['colors'][$this->input->post('color_id')]['normal_price'] 	= '25';
		$colorsarray['colors'][$this->input->post('color_id')]['plus_price'] 	= '30';
	
		$params = array(
			'brand_id'			=> $this->input->post('brand_id'),
			'product_id'		=> $this->input->post('product_id'),
			'sku'				=> random_string('alnum', '10'),
			'title'				=> 'Api Product',
			'description'		=> 'Product api description',
			'front_print'		=> $uploaded_image->results->image_id,
			'colors'			=> base64_encode(json_encode($colorsarray))
		);

		$product = $this->print_aura->add_product($params);
		// print_r();exit;
		if(!$product)
		{
			json_reply(FALSE, $this->print_aura->errors());	
		}
		
		$shipping_address = implode(PHP_EOL, array(
			$this->input->post('address'),
			$this->input->post('address2'),
			$this->input->post('city'),
			$this->input->post('state'),
			$this->input->post('zip'),
		));
		// debug($shipping_address);exit;
		$params['clientname']			= $this->input->post('name');
		$params['businessname'] 		= 'Lastnamecompany';
		$params['businesscontact'] 		= 'Mr A Z';
		$params['email'] 				= 'email@mail.dev';
		$params['your_order_id'] 		= rand(10, 10000);
		$params['returnlabel'] 			= 'Return Label Line 1 \n Return Label Line 2';
		// $params['shippingaddress'] 		= $shipping_address;

		$params['address1']				= $this->input->post('address');
		$params['address2']				= $this->input->post('address2');
		$params['city']					= $this->input->post('city');
		$params['state']				= $this->input->post('state');
		$params['zip']					= $this->input->post('zip');
		$params['country']				= $this->input->post('country');
		$params['customerphone'] 		= '01132501401';
		// $params['packingslip'] = '@packingslip.doc';
		$params['shipping_id'] 			= 1;
		// $params['attach_hang_tag'] = 1;
		// $params['hang_tag_removal_price'] = 1;
		// $params['tag_application_price'] = 1;
		// $params['additional_material_price'] = 1;
		// $params['instructions'] = 'Special Instructions!';

		// Item 1

		$product = $this->print_aura->viewproducts(array(
			'paproduct_id' => $product->product_id	
		));
		
		$itemsarray = array();

		$itemsarray['items']['0']['product_id'] 	= $product->product_id;
		$itemsarray['items']['0']['brand_id'] 		= $this->input->post('brand_id');
		$itemsarray['items']['0']['color_id'] 		= $this->input->post('color_id');
		$itemsarray['items']['0']['size_id'] 		= $this->input->post('size_id');
		$itemsarray['items']['0']['front_print'] 	= $uploaded_image->results->image_id;
		// $itemsarray['items']['0']['front_mockup'] 	= 508; // Set if you require front_mockup
		// $itemsarray['items']['0']['back_print'] = 508; // Set if you require back_print
		// $itemsarray['items']['0']['back_mockup'] = 508; // set if you require back_mockup
		$itemsarray['items']['0']['quantity'] = 1;
		
		$params['items'] = base64_encode(json_encode($itemsarray));

		if(!$this->print_aura->add_order($params))
		{
			json_reply(FALSE, $this->print_aura->errors());
		}

		json_reply();
	}

	function calc_price()
	{
		$params 	= $this->input->get('params');
		$tpl 		= $this->templates->get($this->input->get('tpl_id'));

		if(!$tpl)
			json_reply(FALSE, 'Template not found');

		$params['product_id'] 	= $params['fashion_id'];
		$params['front_print'] 	= TRUE;
		

		if(!$res = $this->print_aura->get_shirt_price($params))
			json_reply(FALSE, $this->print_aura->errors());


		$price = $res + $tpl->price;
		json_reply(TRUE, '', array('price' => $price));
	}

	public function refund()
	{
		if(!$this->ion_auth->in_group(array(GROUP_ID_SUPER_ADMIN, GROUP_ID_STORE_OWNER)))
			json_reply(FALSE, 'access denied');

		$order = $this->orders->get($this->input->post('order_id'));

		if(!$order)
			show_404();

		if($order->status != ORDER_STATUS_PAID)
			show_404();
	
		$cart = $this->carts->get($order->cart_id);

		if(!$cart)
			show_404();

		if(!$this->ion_auth->is_admin())
		{
			if($cart->shop_id != $this->data['user']->shop_id)
				show_404();	
		}
		
	
		$gateway = get_payment_gateway(
			$order->payment_method == 2 ? 'Stripe' : 'PayPal_Express'
		);

		$response = $gateway->refund(array(
            'amount'                => number_format($order->total, 2),
            'transactionReference'  => $order->transaction_id
        ))->send();

        if($response->isSuccessful())
        {
        	$this->orders->update(
        		$order->id, array('status' => ORDER_STATUS_REFUNDED)
        	);

            json_reply(TRUE);
        }
        else
        {
            json_reply(FALSE, $response->getMessage());
        }
	}
}