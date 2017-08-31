<?php

Class Dashboard_s extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		if(!$this->ion_auth->in_group(GROUP_ID_STORE_OWNER))
			redirect(STORE_ADMIN_URL_PREFIX . '/login');

		if($this->user_id != $this->data['shop']->user_id)
            redirect(STORE_ADMIN_URL_PREFIX . '/login');
        
		$this->template->set_master_template('storeadmin/main_template');
	}

	public function index()
	{
		$this->data['active_campaigns'] = $this->campaigns->count_by(array(
			'shop_id'		=> $this->data['shop']->id,
			'options & '	=> CAMPAIGN_OPTION_ACTIVE
		));

		$this->data['total_visitors'] 	= $this->shops->total_visitors($this->data['shop']->id);
		
		$this->data['total_sales']		= $this->shops->total_sales($this->data['shop']->id);
		
		$this->data['last_orders'] 		= $this->shops->last_orders($this->data['shop']->id);

		$this->campaigns->limit = 5;
        $this->data['active_campaigns_list'] = $this->campaigns
                                        ->join_lastname()
                                        ->join_template()
                                        ->join_product()
                                        ->order_by('campaigns.till_ts')
                                        ->set_limit()
                                        ->get_many_by(array('shop_id' => $this->data['shop']->id, 'campaigns.options & ' . CAMPAIGN_OPTION_ACTIVE));


		$this->addTitle('Dashboard');
		$this->render_tpl('storeadmin/dashboard/index');
	}

	public function chart_data()
	{
		$output = array();
		
		$output['visits']	= $this->_chart_visits_data($this->data['shop']->id);
		
		$output['sales'] 	= $this->_chart_sales_data($this->data['shop']->id);
		
		$output['profit'] 	= $this->_chart_profit_data($this->data['shop']->id);

		json_reply(TRUE, '', $output);
	}

	private function _chart_profit_data($shop_id)
	{
		$return = array();

		$orders = $this->db->select('O.id, O.cart_id, DATE_FORMAT(O.create_ts, "%Y-%m-%d") as order_date, O.profit, O.create_ts')
						 ->from('orders O')
						 ->from('carts C')
						 ->where('C.shop_id', $shop_id)
						 ->where('O.status', ORDER_STATUS_PAID)
						 ->where('O.cart_id = C.id')
						 ->order_by('O.create_ts')
						 ->get()->result();

		foreach($orders as $o)
		{
			$return[] = array(strtotime($o->create_ts) * 1000, floatval($o->profit));

		}

		return $return;
	}

	private function _chart_sales_data($shop_id, $days = 8)
	{
		$return = array();

		$orders = $this->db->select('CI.q, O.create_ts as order_ts')
						 ->from('orders O')
						 ->from('carts C')
						 ->from('cart_items CI')
						 ->where('C.shop_id', $shop_id)
						 ->where('O.status', ORDER_STATUS_PAID)
						 ->where('O.cart_id = C.id')
						 ->where('CI.cart_id = C.id')
						 ->order_by('O.create_ts')
						 ->get()->result();
		if(!$orders)
			return $return;

		foreach(object_transparent($orders, 'order_ts') as $k => $v)
		{
			$sum = 0;
			foreach($v as $vv)
			{
				$sum += $vv->q;
			}

			$return[] = array(strtotime($k) * 1000, intval($sum));
		}

		return $return;
	}

	private function _chart_visits_data($shop_id, $days = 8)
	{
		$return = array();

		$data = $this->db
					 ->where('shop_id', $shop_id)
					 ->order_by('date ASC')
					 ->get('shop_visitors')->result();
		
		foreach($data as $v)
		{
			$return[] = array(strtotime($v->date) * 1000, intval($v->uniques));
		}

		return $return;
	}

	public function generate_visits()
	{
		
		$shop_id = 26;

		for($i = 500; $i >= 1; $i--)
		{
			$this->db->insert('shop_visitors', array(
				'date'			=> date('Y-m-d', strtotime('-' . $i . ' days')),
				'shop_id'		=> $shop_id,
				'uniques'		=> rand(100, 300),
				'hits'			=> rand(400, 1000)
			));
		}

		debug('Done');
	}

	public function generate_sales()
	{
		return;
		

		// $data = $this->orders->get_all();

		// foreach($data as $o)
		// {
		// 	$this->orders->update($o->id, array('create_ts' => date('Y-m-d H:i:s', rand(strtotime('-500 days'), strtotime('-2 days')))));
		// }

		// exit;
		
		$order_id 		= 11;
		$shop_id 		= 26;
		$customer_id 	= 79;

		// $order = $this->orders->get($order_id);
		
		for($i = 1000; $i >= 1; $i--)
		{
			$cart = $this->carts->insert(array(
				'shop_id'		=> $shop_id,
				'create_ts'		=> mysql_now_date()
			));

			$cart_id = $this->db->insert_id();

			$num_items = rand(1, 11);

			for($ii = 1; $ii <= $num_items; $ii++)
			{
				$this->cart_items->insert(array(
					'cart_id'		=> $cart_id,
					'lastname_id'	=> rand(1, 45000),
					'tpl_id'		=> rand(20000, 30000),
					'surface_id'	=> rand(1, 5000),
					'q'				=> rand(1, 10),
					'price'			=> rand(10, 30),
					'create_ts'		=> mysql_now_date()
				));
			}

			$this->orders->insert(array(
				'user_id'			=> $customer_id,
				'cart_id'			=> $cart_id,
				'subtotal'			=> rand(30, 400),
				'shipping'			=> rand(3, 50),
				'total'				=> rand(35, 500),
				'status'			=> ORDER_STATUS_PAID,
				'create_ts'			=> date('Y-m-d H:i:s', rand(strtotime('-500 days'), strtotime('-2 days')))
			));
		}

		debug('Done');
	}
}