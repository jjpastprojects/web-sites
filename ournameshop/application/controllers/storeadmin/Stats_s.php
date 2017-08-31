<?php

Class Stats_s extends MY_Controller
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
		$filter = array(
			'shop_id' 		=> $this->data['shop']->id
		);

		$this->data['order_field']    = 'date';
        $this->data['order_dir']      = 'desc';

		if($this->input->get('sort'))
		{
            $this->data['order_field'] = in_array(
            	$this->input->get('sort'), array('date', 'uniques', 'hits')
        	) ? $this->input->get('sort') : 'date';
        }

        if($this->input->get('order'))
            $this->data['order_dir'] = $this->input->get('order');

		$this->data['stats'] = $this->visit_stats
									->order_by(
										$this->data['order_field'], $this->data['order_dir']
									)->set_limit()->get_many_by($filter);
									

		$this->data['count']     = $this->visit_stats->count_by($filter);

        create_pagination(
            STORE_ADMIN_URL_PREFIX . '/stats',
            $this->data['count'],
            $this->visit_stats->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

		$this->addTitle('Shop Visits');
		$this->render_tpl('storeadmin/stats/index');
	}

	
}