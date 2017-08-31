<?php

Class Orders_c extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		if(!$this->user_id)
			redirect('/');

		$this->template->set_master_template('customer/main_template');
	}

	public function index()
	{
		return $this->listing();
	}

	public function listing()
	{	
		$where = array(
			'orders.user_id' => $this->user_id
		);

		$this->data['orders'] 		= $this->orders->order_by(
											'create_ts', 'DESC'
										)->set_limit()->get_many_by($where);

		$this->data['count']     	= $this->orders->count_by($where);

		if($this->data['orders'])
		{
			$cart_ids = array();

			foreach($this->data['orders'] as $order)
			{
				$cart_ids[] = $order->cart_id;
			}
			
			if($cart_ids)
			{
				$cart_items = $this->cart_items->join_surfaces()->join_templates()->join_lastnames()->get_many_by(
					'cart_items.cart_id IN(' . implode(',', $cart_ids) . ')'
				);
			}

			$cart_items = object_transparent($cart_items, 'cart_id');

			foreach($this->data['orders'] as &$order)
			{
				$order->items = $cart_items[$order->cart_id];
			}
		}

		create_pagination(
            'customer/orders/listing',
            $this->data['count'],
            $this->orders->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );
		
		$this->addTitle('My Orders');
		$this->render_tpl('customer/orders/listing');
	}
}