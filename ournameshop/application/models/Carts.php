<?php
class Carts extends MY_Model
{
	private $ci;

	public function __construct()
	{
		parent::__construct();
		$this->ci = &get_instance();
	}


	public function current_id()
	{
		if($this->ci->session->userdata('cart_id'))
		{
			return $this->ci->session->userdata('cart_id');
		}
		else
		{
			$cart_id = $this->insert(array(
				'create_ts'		=> date('Y-m-d H:i:s'),
				'update_ts'		=> date('Y-m-d H:i:s'),
				'shop_id'		=> $this->ci->data['shop']->id
			));

			$this->ci->session->set_userdata('cart_id', $cart_id);
			return $cart_id;
		}
	}

	public function subtotal()
	{
		return $this->db->select('SUM(q * price) as subtotal')
				 	->get_where('cart_items', array('cart_id' => $this->cart_id))
				 	->row()->subtotal;
	}

	public function need_shipping($cart_id)
	{
		$cart_items = $this->ci->cart_items->join_surfaces()->my();

		if(!$cart_items)
			return FALSE;

		$num_shipping = 0;
		$num_digital  = 0;

		foreach($cart_items as $item)
		{
			if(downloadable_product($item))
				$num_digital++;
			else
				$num_shipping++;
		}

		return $num_shipping > 0;
	}

	public function has_printaura($cart_id = FALSE)
	{
		if(!$cart_id)
			$cart_id = $this->current_id();
		
		$res = $this->db->from('cart_items CI')
						->from('variants V')
						->from('products P')
						->where('CI.cart_id', $cart_id)
						->where('V.id = CI.surface_id')
						->where('P.id = V.product_id')
						->where('P.type', 'PHONE-CASE')
						->get()->result();

		return $res ? TRUE : FALSE;
	}

	public function has_printfull($cart_id = FALSE)
	{
		if(!$cart_id)
			$cart_id = $this->current_id();

		$res = $this->db->from('cart_items CI')
						->from('variants V')
						->from('products P')
						->where('CI.cart_id', $cart_id)
						->where('V.id = CI.surface_id')
						->where('P.id = V.product_id')
						->where('P.type != "PHONE-CASE"')
						->where('P.type != "DIGITAL-PRODUCT"')
						->get()->result();

		return $res ? TRUE : FALSE;
	}

	public function diff_warehouse()
	{
		$cart_id = $this->current_id();

		return ($this->has_printfull($cart_id) && $this->has_printaura($cart_id));
	}
}











