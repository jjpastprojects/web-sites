<?php 
Class Webhooks extends MY_Controller {
	function __construct()
	{
		parent::__construct();
	}

	public function import_pics()
	{
		$brands = array(
			'alternative' 			=> 'Alternative',
			'americanapparel'		=> 'American Apparel',
			'anvil'					=> 'Anvil',
			'bella'					=> 'Bella + Canvas',
			'nextlevel'				=> 'Next Level'
		);

		$path = '/www/lastname/skin/rereplaceimages/';

		foreach($brands as $k => $brand)
		{
			$imgs = glob($path . $k . '/*');
			
			foreach ($imgs as $img_path)
			{
				$path_split =  explode('/', $img_path);
				$filename = end($path_split);

				preg_match('/_\d+_(\w+) /ims', $filename, $matches);

				if(!$matches)
					continue;

				$id = $matches[1];

				$this->db->like('model', $id, 'both');
				$product = $this->products
										  
										  ->get_by(array('brand' => $brand));
				if(!$product)
					debug($img_path, 'NOT FOUND');
				else
				{
					$this->products->update($product->id, array('listing_thumb' => $filename));
				}
				

			}

			// $short = $this->products->like('name', get_by(array('name'))



			// exit;
		}
	}

	public function printful()
	{
		
		log_message('ERROR', print_r($this->input->post(), TRUE));

		return;
		$data = (object) array(
			'type'		=> 'package_shipped',
			
			'data'	=> (object) array(
				'shipment'	=> (object) array(
					'tracking_number'	=> '8381703081',
					'tracking_url'		=> 'http://google.com',
					'ship_date'			=> date('Y/m/d')
				),

				'order'		=> (object)  array(
					'external_id'	=> 132
				)
			)
		);

		$this->data['printful_data'] 	= $data;
		$this->data['order'] 			= $this->orders->get($data->data->order->external_id);
		
		$this->data['items']			= $this->cart_items->join_surfaces()->by_cart(
            $this->data['order']->cart_id
        );

		// $this->load->view('email/order_shipped', $this->data);
		
		$this->send_email_template(
			$this->data['order']->email,
			'Order #' . $this->data['order']->id . ' has been shipped',
			'order_shipped',
			$this->data
		);
	}
}