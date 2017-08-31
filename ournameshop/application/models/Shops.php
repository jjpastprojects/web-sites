<?php
class Shops extends MY_Model
{
	// public $before_get 			= array('select_default');

	public function options($shop_id)
	{
		$ci = &get_instance();

		$data = $this->db->where('shop_id', $shop_id)
					 ->get('shop_options')->result();

		if(!is_main_shop($ci->data['shop']))
        {
        	$main_shop = $ci->shops->get_by(array('main' => 1));

            $this->db->where_in('option_name', array('income', 'income_type'));

            $income_options = $this->db->get_where(
                'shop_options', array('shop_id' => $main_shop->id)
            )->result();

            $data = array_merge($data, $income_options);
        }

		$data = object_transparent(
			$data, 'option_name', TRUE
		);

		if(isset($data['enabled_cats']))
		{
			$data['enabled_cats']->option_value = explode(',', $data['enabled_cats']->option_value);
		}
		else
		{
			$data['enabled_cats'] = (object)array('option_value' => array());
		}

		return $data;
	}

	public function total_sales($shop_id)
	{
		$data = $this->db->select('SUM(CI.q) as sum')
				 	 ->from('cart_items CI')
				 	 ->from('carts C')
				 	 ->from('orders O')
				 	 ->where('O.status', ORDER_STATUS_PAID)
				 	 ->where('C.id = O.cart_id')
				 	 ->where('C.shop_id', $shop_id)
				 	 ->where('C.id = CI.cart_id')
				 	 ->get()->row();

		
		return $data->sum ? $data->sum : 0;
	}

	public function total_visitors($shop_id)
	{
		return $this->db->select('SUM(uniques) as sum')
												 ->from('shop_visitors')
												 ->where('shop_id', $shop_id)
												 ->get()->row()->sum;
	}

	public function last_orders($shop_id, $cnt = 5)
	{
		$ci = &get_instance();

		$where = array(
			'C.shop_id' 		=> $shop_id,
			'orders.status' 	=> ORDER_STATUS_PAID
		);

		$ci->orders->limit = 5;

		$orders 		= $ci->orders->join_cart($shop_id)->order_by(
							'create_ts', 'DESC'
						)->set_limit()->get_many_by($where);
		

		// if($orders)
		// {
		// 	$cart_ids = array();

		// 	foreach($orders as $order)
		// 	{
		// 		$cart_ids[] = $order->cart_id;
		// 	}
			
		// 	if($cart_ids)
		// 	{
		// 		$cart_items = $ci->cart_items->join_surfaces()->join_templates()->join_lastnames()->get_many_by(
		// 			'cart_items.cart_id IN(' . implode(',', $cart_ids) . ')'
		// 		);
		// 	}

		// 	$cart_items = object_transparent($cart_items, 'cart_id');

		// 	foreach($orders as &$order)
		// 	{
		// 		$order->items = isset($cart_items[$order->cart_id]) ? $cart_items[$order->cart_id] : array();
		// 	}
		// }

		return $orders;
	}
}