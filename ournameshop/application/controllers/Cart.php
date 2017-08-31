<?php

Class Cart extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
    {
		$this->data['items'] 	= $this->cart_items->join_surfaces()
                                ->join_lastnames()->order_by('create_ts', 'DESC')->my();

		$this->render_tpl('carts/index');
	}


	protected function _calc_order_amount()
	{
        return $this->carts->subtotal();
		$amount 				= 0;
		$this->data['items'] 	= $this->cart_items->my();
		

		foreach($this->data['items'] as $item)
		{
			$tpl 		= $this->templates->get($item->tpl_id);

			if(!$tpl)
				return FALSE;

			$amount += ($item->price + $item->template->price) * $item->q;
		}

		return $amount;
	}

    public function shipping_methods()
    {
        $this->data['items']    = $this->cart_items->join_surfaces()->my();
        $items                  = array();

        foreach($this->data['items'] as $item)
        {
            $items[] = array(
                'variant_id'     => $item->surface_id,
                'quantity'       => $item->q
            );
        }
        
        $rates = $this->printful->shipping_rates(array(
            'recipient' => $this->input->get(),
            'items'     => $items
        ));

        if($rates)
        {
            json_reply(TRUE, '', array('methods' => $rates));
        }
        else
        {
            json_reply(FALSE, $this->printful->errors());
        }
    }

    public function shipping()
    {
        if(!$this->user_id)
            show_404();

        if(isPostMethod())
        {
            $res = $this->orders->get_by(array('cart_id' => $this->cart_id));


            $subtotal       = $this->_calc_order_amount();

            $shipping_price = 0;

            $cart_items = $this->cart_items->join_surfaces()->my();

            if($this->input->post('printfull_shipping_id'))
            {
                $printfull_shipping_price = $this->printful->calc_shipping(
                    $cart_items,
                    array(
                        'country_code'  => $this->input->post('country'),
                        'state_code'    => $this->input->post('state'),
                        'zip'           => $this->input->post('zip')
                    ),
                    $this->input->post('printfull_shipping_id')
                );

                if(!$printfull_shipping_price)
                    $this->data['error'] = 'Can not calculate shipping price';
                else
                    $shipping_price += $printfull_shipping_price;
            }
            
            if($this->input->post('printaura_shipping_id'))
            {
                $printaura_shipping_price = $this->print_aura->calc_shipping(
                    $cart_items,
                    $this->input->post('printaura_shipping_id')
                );

                $shipping_price += $printaura_shipping_price;
            }
            
            if(!isset($this->data['error']))
            {
                $address = array_map('strip_tags', array(
                    'address'           => $this->input->post('address'),
                    'address2'          => $this->input->post('address2'),
                    'country'           => $this->input->post('country'),
                    'city'              => $this->input->post('city'),
                    'state'             => $this->input->post('state'),
                    'zip'               => $this->input->post('zip'),
                    'phone'             => $this->input->post('phone'),
                ));
                
                $data = array_merge($address, array(
                    'name'              => strip_tags($this->input->post('name')),
                    
                    'email'             => strip_tags($this->input->post('email')),
                    
                    'subtotal'          => $subtotal,
                    'shipping'          => $shipping_price,
                    'total'             => $subtotal + $shipping_price,

                    'shipping_id'       => strip_tags($this->input->post('printfull_shipping_id')),
                    // 'paypal_address'    => intval($this->input->post('use_paypal_address'))
                ));

                if($res)
                {
                    $this->orders->update($res->id, $data);
                }
                else
                {
                    $this->orders->insert(
                        array_merge(array(
                            'cart_id'           => $this->cart_id,
                            'user_id'           => $this->user_id ? $this->user_id : NULL,
                            'status'            => ORDER_STATUS_UNPAID
                        ), $data
                    ));
                }

                if($this->input->post('save_addr'))
                {
                    $this->users->update($this->user_id, $address);
                }

                redirect('cart/confirm');
            }            
        }
        
        $this->data['items']    = $this->cart_items->join_surfaces()
                                ->join_lastnames()->order_by('create_ts', 'DESC')->my();
        
        if(!$this->data['items'])
            redirect('/cart');
        
        $this->data['order'] = $this->orders->get_by(
            array('cart_id' => $this->cart_id)
        );

        if(!$this->carts->need_shipping($this->cart_id))
        {

            $subtotal = $this->_calc_order_amount();

            $data = array(
                'cart_id'           => $this->cart_id,
                'user_id'           => $this->user_id ? $this->user_id : NULL,
                'status'            => ORDER_STATUS_UNPAID,

                'name'              => sprintf('%s %s', $this->data['user']->first_name, $this->data['user']->last_name),
                
                'email'             => $this->data['user']->email,
                
                'subtotal'          => $subtotal,
                'total'             => $subtotal
            );

            if($this->data['order'])
            {
                $this->orders->update($this->data['order']->id, $data);
            }
            else
            {
                $this->orders->insert(
                    $data
                );
            }

            redirect('cart/confirm');
        }


        if(!$this->data['user']->country)
            $this->data['user']->country = 'US';


        $this->data['print_aura_shipping'] = $this->print_aura->listshipping();
        
        $this->data['pa_s2cc']             = array('USA' => 'US', 'Canada' => 'CA');

        $this->render_tpl('carts/shipping');
    }

    public function confirm()
    {
        $this->data['items']    = $this->cart_items->join_surfaces()->my();
        
        $this->data['order']    = $this->orders->get_by(array(
                'cart_id' => $this->cart_id
            )
        );
	//cezar_Start
        $this->load->library('s3');//cezar
        $items = $this->data['items'];
        $order = $this->data['order'];
        $recipient = array();
        $recipient['name'] = $order->name;
        $recipient['address1'] = $order->address;
        $recipient['address2'] = $order->address2;
        $recipient['city'] = $order->city;
        $recipient['state_code'] = $order->state;
        $recipient['country_code'] = $order->country;
        $recipient['zip'] = $order->zip;
        $recipient['phone'] = $order->phone;

        $order_items = array();
        $print_files = array();
        foreach ($items as $item) {
            $image = $item->custom_print;
            $imagepath = "/home/lastnamecompany/public_html/media/print_previews/" . $image;
            $logo_folder_id = $item->folder_id;

            $dest_path = $this->folders->get_logo_folder_path($logo_folder_id);
            $filepath = $this->s3->upload_products_image ($dest_path[0]->dir . "/hi-res", $imagepath);
            $print_files[] = array('url'=>'http://' . $filepath);
            $order_items[] = array('variant_id' => $item->surface_id, 'name' => $item->params->name, 'retail_price' => $item->price, 'quantity' => $item->q, 'files' =>$print_files);
        }
        $orders = array('recipient' => $recipient, 'items' => $order_items);
        $postString = json_encode($orders);
//        $command ='/usr/local/bin/node /home/lastnamecompany/public_html/nodejs/printful.js';
//        $new_tmp_name = exec(implode(' ', $command), $output);
        # Create a connection
        $url = 'localhost:3030/orders';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
	// Cezar_END

        if(!$this->data['order'])
            show_404();

        $this->render_tpl('carts/confirm');
    }

    private function _place_orders($order_id)
    {
        function returner($success, $errors = '') {
            return (object) array(
                'isSuccessful'      => $success,
                'errors'            => $errors
            );
        }

        $printful_order = $this->printful->place_order($order_id);
        
        if($printful_order)
        {
            $printaura_order = $this->print_aura->place_order($order_id);

            if(!$printaura_order)
            {
                if(isset($printful_order['id']))
                    $this->printful->delete_order($printful_order['id']);

                return returner(FALSE, $this->print_aura->errors());
            }

            return returner(TRUE);
        }
        else
        {
            return returner(FALSE, $this->printful->errors());
        }
    }

	public function pay()
	{
        $order = $this->orders->get_by(array('cart_id' => $this->cart_id));

        if(!$order)
            json_reply(FALSE, 'order not found');

		$this->purchase_params['amount']    	= number_format($order->total, 2, '.', '');
        $this->purchase_params['currency']  	= 'USD';
        
        $data = $this->input->post();

        switch($data['method'])
        {
            case PAY_METHOD_STRIPE:
            {
                $gateway = get_payment_gateway('Stripe');

                $this->purchase_params['card'] = array(
                    'number'            => str_replace(' ', '', $data['cardnum']),
                    'expiryMonth'       => $data['exp_month'],
                    'expiryYear'        => $data['exp_year'],
                    'cvv'               => $data['cvv'],
                    'name'              => $data['payer_name']
                );
            } break;

            case PAY_METHOD_PP:
            {
                $this->purchase_params['cancelUrl']     = site_url() . 'cart';
                $this->purchase_params['returnUrl']     = site_url() . 'cart/paypal_complete?order_id=' . $order->id;

                $gateway = get_payment_gateway('PayPal_Express');                    
            } break;

            default:
            {
                json_reply(FASE, 'invalid payment method');
            }
        }

        try {
            $response = $gateway->authorize($this->purchase_params)->send();
        } catch (\Exception $e) {
            json_reply(FALSE, $e->getMessage());
            exit;
        }

        if($response->isSuccessful())
        {   
            $t_reference    = $response->getTransactionReference();

            $order_handler  = $this->_place_orders($order->id);
            
            if($order_handler->isSuccessful)
            {    
                $response = $gateway->capture(array(
                    'transactionReference'  => $t_reference,
                    'amount'                => number_format($order->total, 2, '.', '')
                ))->send();

                if ($response->isSuccessful()) 
                {
                    $pp_details = $response->getData();

                    $this->orders->update($order->id, array(
                        'status'            => ORDER_STATUS_PAID,
                        'transaction_id'    => $pp_details['id'],
                        'payment_method'    => PAY_METHOD_STRIPE
                    ));

                    $this->notify_order_placed($order->id);

                    $this->_update_num_sales();

                    $this->_after_payment($order->id);

                    $this->session->set_flashdata('payment_success', TRUE);
                    $this->session->unset_userdata('cart_id');

                    json_reply(TRUE, '', array('redirect' => FALSE));
                }
                else
                {
                    json_reply(FALSE, $response->getMessage());
                }
            }
            else
            {
                $response = $gateway->refund(array(
                    'amount'                => number_format($order->total, 2),
                    'transactionReference'  => $t_reference,
                ))->send();

                if($response->isSuccessful())
                {
                    json_reply(FALSE, $order_handler->errors);
                }
                else
                {
                    json_reply(FALSE, $response->getMessage());
                }
            }
        }
        elseif ($response->isRedirect())
        {
        	json_reply(TRUE, '', array(
                'redirect'      => $response->getRedirectUrl()
            ));
        }
        else
        {
            json_reply(FALSE, $response->getMessage());
        }
	}

	public function paypal_complete()
    {
    	$order = $this->orders->get($this->input->get('order_id'));

    	if(!$order)
    	{
    		debug('Order not found');
    		exit;
    	}
     
        $this->purchase_params = array(
            'amount'        => number_format($order->total, 2, '.', ''),
            'currency'      => 'USD',
        );

        $gateway    = get_payment_gateway('PayPal_Express');
            
        try {
            $response = $gateway->completeAuthorize($this->purchase_params)->send();

            if($response->isSuccessful())
            {
            	// $data           = $response->getData();
                $t_reference    = $response->getTransactionReference();
                
                // $res_pr = $this->printful->place_order($order->id);
                // $res_pa = $this->print_aura->place_order($order->id);

                //$this->printful->place_order($order->id)

                $order_handler  = $this->_place_orders($order->id);

                if($order_handler->isSuccessful)
                {    
                    $response = $gateway->capture(array(
                        'transactionReference'  => $t_reference,
                        'amount'                => number_format($order->total, 2)
                    ))->send();

                    if ($response->isSuccessful()) 
                    {
                        $t_reference    = $response->getTransactionReference();
                        
                        // $pp_details     = $gateway->fetchExpressCheckoutDetail(array(
                        //     // 'transactionReference' => $data['TOKEN']
                        //     'transactionReference' => $t_reference
                        // ))->getData();
                        // debug($pp_details, __LINE__);
                        // exit;
                        $order_update = array(
                            'status'            => ORDER_STATUS_PAID,
                            'transaction_id'    => $t_reference,
                            'payment_method'    => PAY_METHOD_PP
                        );
                        
                        $this->orders->update($order->id, $order_update);

                        $this->notify_order_placed($order->id);

                        $this->_update_num_sales();

                        $this->session->set_flashdata('payment_success', TRUE);
                        $this->session->unset_userdata('cart_id');

                        redirect('cart/payment_success');   
                    }
                    else 
                    {
                        $this->session->set_flashdata('error', $response->getMessage());
                    }                	
                }
                else
                {
                    $response = $gateway->void(array(
                        'transactionReference' => $t_reference,
                    ))->send();

                    if($response->isSuccessful())
                    {
                        $this->session->set_flashdata('error', $order_handler->errors);
                    }
                    else
                    {
                        $this->session->set_flashdata('error', $response->getMessage());
                    }
                }

                redirect('cart/confirm');
            }
            else
            {
            	debug($response->getMessage());
            	exit;
                // $this->set_error($response->getMessage());
            }
        }
        catch(\Exception $e)
        {
        	debug($e->getMessage(), __METHOD__.':'.__LINE__);
        	exit;
            $this->set_error($e->getMessage());
        }

        return FALSE;
    }

    private function _after_payment($order_id)
    {
        $aff_profit = 0;

        $order = $this->orders->get($order_id);
        
        $items = $this->cart_items->join_surfaces()
                                  ->join_lastnames()
                                  ->join_templates()
                                  ->get_many_by(array('cart_id' => $order->cart_id));

        foreach($items as $i)
        {
            $variant = $this->variants
                           ->join_product()
                           ->join_folder($i->template->folder_id)
                           ->get_by(array('variants.id' => $i->surface_id));
            
            $aff_profit += percent($variant->profit * $i->q, AFF_PROFIT_PERCENT);

            if($i->campaign_id)
            {
                $campaign = $this->campaigns->get($i->campaign_id);

                $aff_profit += $campaign->profit * $i->q;
            }
        }

        $this->shops->update($this->data['shop']->id, array(
            'balance'       => ($this->data['shop']->balance + $aff_profit),
            'total_profit'  => ($this->data['shop']->total_profit + $aff_profit)
        ));

        $this->orders->update($order_id, array('profit' => $aff_profit));
    }

    private function _update_num_sales()
    {
        $this->data['items']    = $this->cart_items->join_surfaces()
                                    ->join_lastnames()->order_by('create_ts', 'DESC')->my();
                                    
        foreach($this->data['items'] as $item)
        {
            $this->products->update_num_sales($item->product_id);
            $this->templates->update_num_sales($item->tpl_id);
            
            if($item->campaign_id)
                $this->campaigns->update_num_sales($item->campaign_id, $item->q);
        }                            
    }

    function notify_order_placed($order_id)
    {
        $this->data['order']    = $this->orders->get($order_id);
        
        $this->data['items']    = $this->cart_items->join_surfaces()->by_cart(
            $this->data['order']->cart_id
        );

        $this->send_email_template(
            $this->data['order']->email,
            'Order #' . $this->data['order']->id,
            'order_confirmation',
            $this->data
        );

        $this->send_email_template(
            $this->config->item('admin_email'),
            'Lastnamecompany New Order #' . $this->data['order']->id,
            'admin_order_confirmation',
            $this->data
        );
    }

    private function assign_user($order_id, $data)
    {
    	$res = $this->users->get_by(array('email' => $data['email']));

    	if(!$res)
    	{
	    	$password = '1111';//random_string('alnum', 5);
	    	
	    	$hook_params = array(
	    		'email'			=> $data['email'],
	    		'password'		=> $password,
	    		'first_name'	=> $data['first_name'],
	    		'last_name'		=> $data['last_name']
    		);

	    	// $this->ion_auth->set_hook(
	    	// 	'post_account_creation_successful', 'invitation_email', 'auth', 'invitation_email', $hook_params
    		// );

	    	$user_id = $this->ion_auth->register(NULL, $password, $data['email'], array(
	    		'first_name' =>$data['first_name'], 'last_name' => $data['last_name']
			));
	    }
	    else
	    {
	    	$user_id = $res->id;
	    }
    	
	    $this->orders->update($order_id, array('user_id' => $user_id));

        if(!$this->user_id)
            $this->ion_auth->set_session($this->users->get($user_id));
    }


    public function payment_success()
    {
    	if($this->session->flashdata('payment_success') || TRUE)
    	{
    		$this->session->unset_userdata('cart_id');
    		$this->render_tpl('carts/payment_success');
    	}
    	else
    	{
    		show_404();
    	}
    }

	public function add_item()
	{
        if(!isPostMethod())
            show_404();

        $custom_print = $this->input->post('custom_print_file');
        
        $tpl    = $this->templates->get(
            $this->input->post('tpl_id')
        );

        if(!$tpl)
            show_404();
        
        $this->variants->template = $tpl;

        $variant = $this->variants->join_product()->join_folder($tpl->folder_id)->get_by(array(
                'variants.id' => $this->input->post('surface_id')
            )
        );

        if(!$variant)
            json_reply(FALSE, 'Product not found');

        $q = abs(intval($this->input->post('q')));

        if($q < 1)
            $q = 1;
        
        $lname  = $this->lnames->get(
            $this->input->post('lastname_id')
        );
        
        if(!$lname)
            show_404();        

        $params = array(
            'name'              => $variant->name,
            'canvas'            => $this->input->post('canvas_params')
        );

        if($this->input->post('canvas'))
        {
            $img        = $this->input->post('canvas');
            $img        = str_replace('data:image/png;base64,', '', $img);
            $img        = str_replace(' ', '+', $img);

            $filename   = random_string('alnum', 10) . '.png';

            write_file(
                $this->config->item('path', 'print_preview') . $filename, base64_decode($img)
            );

            $custom_print = $filename;
        }

        if($this->input->post('logo_color'))
        {
            $params['logo_color'] = mb_substr($this->input->post('logo_color'), 0, 7);
        }

		$cart_item_id = $this->cart_items->insert(array(
			'cart_id'			=> $this->cart_id,
            'lastname_id'       => $lname->id,
			'tpl_id'			=> $tpl->id,
            'custom_print'      => $custom_print ? $custom_print : NULL,
			'surface_id'        => $variant->id,
			'params'			=> json_encode($params),

			'price'				=> $variant->price,
			'q'					=> $q,
            'options'           => downloadable_product((object)array('product_type' => $variant->type)) ? CART_ITEM_OPTION_DIGITAL : 0,
            'campaign_id'       => $this->input->post('campaign_id') ? $this->input->post('campaign_id') : NULL
		));



        $data = array(
            'lastname'          => $lname->lastname,
            'variant'           => $variant,
            'q'                 => $q,
            'cart_items_cnt'    => $this->cart_items->count_my(),
            'item'              => $this->db->get_where('cart_items', array('id' => $cart_item_id))->row()
        );

        json_reply(TRUE, '', array(
                'html'              => $this->load->view('carts/added2cart', $data, TRUE),
                'cart_items_cnt'    => $data['cart_items_cnt']
            )
        );
	}

	public function remove_item()
	{
		$this->cart_items->delete_by(array(
			'id'		=> $this->input->post('id'),
			'cart_id'	=> $this->cart_id
		));

		json_reply(TRUE, '', array(
			'subtotal'           => format_price($this->carts->subtotal()),
            'cart_items_cnt'     => $this->cart_items->count_my()
		));
	}

	function update_q()
	{
		$q = intval($this->input->post('q'));

		if($q)
		{
			$this->cart_items->update_by(array(
				'id'		=> $this->input->post('id'),
				'cart_id'	=> $this->cart_id
			), array('q' => $q));
		}

		$item = $this->cart_items->join_surfaces()->get_by(array(
			'cart_items.id'  => $this->input->post('id'),
			'cart_id'        => $this->cart_id
		));

		$subtotal = format_price($this->carts->subtotal());

		$item->total = format_price($item->price * $item->q);
		json_reply(TRUE, '', array(
            'subtotal'              => $subtotal,
            'item'                  => $item,
            'cart_items_cnt'        => $this->cart_items->count_my()
        ));
		
	}

}