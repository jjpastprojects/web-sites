<?php

Class Orders_s extends MY_Controller
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
		return $this->listing();
	}

	public function listing()
	{	
		$filter = array(
			'carts.shop_id'		=> $this->data['shop']->id
        );

        $this->data['order_field']    = 'orders.create_ts';
        $this->data['order_dir']      = 'desc';

        if($this->input->get('sort'))
            $this->data['order_field'] = $this->input->get('sort');

        if($this->input->get('order'))
            $this->data['order_dir'] = $this->input->get('order');

        if($this->input->get('user_id'))
        {
            $filter['user_id']          = $this->input->get('user_id');
            $this->data['filter_user']  = $this->users->get($this->input->get('user_id'));
        }

        $this->db->select('orders.*, carts.id as cart_id');
        $this->db->join('carts', 'carts.id = orders.cart_id');
        
        $this->data['orders'] = $this->orders
                                     ->order_by($this->data['order_field'], $this->data['order_dir'])
                                     ->set_limit()
                                     ->get_many_by($filter);
        
        $this->db->join('carts', 'carts.id = orders.cart_id');                                
        $this->data['count']     = $this->orders->count_by($filter);

		create_pagination(
            STORE_ADMIN_URL_PREFIX . '/orders/listing',
            $this->data['count'],
            $this->orders->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );
		
		$this->addTitle('My Orders');
		$this->render_tpl('storeadmin/orders/listing');
	}

	public function order($order_id = FALSE)
    {
        $this->data['order'] = $this->orders->get($order_id);
        
        if(!$this->data['order'])
            show_404();

        $cart = $this->carts->get($this->data['order']->cart_id);

        if($cart->shop_id != $this->data['shop']->id)
            show_404();

        $this->data['items'] = $this->cart_items->join_surfaces()->join_lastnames()->
                                    by_cart($this->data['order']->cart_id);
                                    
        $this->addTitle('Order #' . $this->data['order']->id . ' / View Details');
        $this->render_tpl('admin/order');
    }
}