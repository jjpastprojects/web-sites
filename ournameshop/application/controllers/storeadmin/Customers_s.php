<?php

Class Customers_s extends MY_Controller
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
		$where  = array();

        $s      = $this->input->get('search');
        
        $where[] = 'shop_id = ' . $this->data['shop']->id;

        if($s)
        {
            $where[] = '(users.email LIKE ' . $this->db->escape("%$s%") . 
                     ' OR users.first_name LIKE ' . $this->db->escape("%$s%") .
                     ' OR users.last_name LIKE '  . $this->db->escape("%$s%") . ')';
        }    

        $this->data['order_field']    = 'created_on';
        $this->data['order_dir']      = 'desc';

        if($this->input->get('sort'))
            $this->data['order_field'] = $this->input->get('sort');

        if($this->input->get('order'))
            $this->data['order_dir'] = $this->input->get('order');

        $this->data['customers'] = $this->users->customers()
                                        ->with_money()
                                        ->order_by($this->data['order_field'], $this->data['order_dir'])
                                        ->set_limit()
                                        ->get_many_by($where);

        $this->data['count']     = $this->users->customers()->count_by($where);

        create_pagination(
            'admin/customers',
            $this->data['count'],
            $this->users->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

        $this->addTitle('Customers List');

        $this->render_tpl('storeadmin/customers/listing');
	}
}