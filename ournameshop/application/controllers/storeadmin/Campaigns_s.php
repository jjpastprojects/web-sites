<?php

Class Campaigns_s extends MY_Controller
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
        $where = array('shop_id' => $this->data['shop']->id);

        $this->data['campaigns'] = $this->campaigns
                                        ->join_lastname()
                                        ->join_template()
                                        ->join_product()
                                        ->order_by('campaigns.create_ts', 'DESC')
                                        ->set_limit()
                                        ->get_many_by($where);

        $this->data['count']     = $this->campaigns->count_by($where);

        create_pagination(
            STORE_ADMIN_URL_PREFIX . '/campaigns',
            $this->data['count'],
            $this->campaigns->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

        $this->addTitle('Campaigns List');

        $this->render_tpl('storeadmin/campaigns/listing');
	}

    public function activate()
    {
        $this->data['campaign'] = $this->campaigns->get_by(array(
            'id'        => $this->input->post('id'),
            'shop_id'   => $this->data['shop']->id
        ));

        if(!$this->data['campaign'])
            json_reply(FALSE, 'campaign not found');

        $this->campaigns->update(
            $this->data['campaign']->id, array(
                'options'       => $this->data['campaign']->options | CAMPAIGN_OPTION_ACTIVE,
                'publish_ts'    => mysql_now_date(),
                'till_ts'      => date('Y-m-d H:i:s', strtotime('+' . $this->data['campaign']->days . ' days'))
        ));

        json_reply();
    }

    public function edit($campaign_id = FALSE)
    {
        $this->data['campaign'] = $this->campaigns->get_by(array(
            'id'        => $campaign_id,
            'shop_id'   => $this->data['shop']->id
        ));

        if(!$this->data['campaign'])
            show_404();


        if(isPostMethod())
        {
            $update = array(
                'name'          => strip_tags($this->input->post('name')),
                'description'   => strip_tags($this->input->post('description')),
                'days'          => $this->input->post('days'),
                'profit'        => $this->input->post('profit'),
                'goal'          => $this->input->post('goal'),
                'options'       => is_array($this->input->post('options')) ? array_sum($this->input->post('options')) : NULL
            );

            $this->campaigns->update($this->data['campaign']->id, $update);

            redirect(STORE_ADMIN_URL_PREFIX . '/campaigns');
        }

        $this->data['template'] = $this->templates->join_category()->get_by(
            array('templates.id' => $this->data['campaign']->template_id)
        );

        $this->data['variant'] = $this->variants
                                       ->join_product()
                                       ->join_folder($this->data['template']->folder_id)
                                       ->get_by(array('variants.id' => $this->data['campaign']->variant_id));
        
        $this->data['saved_logo'] = $this->saved_logo->get_by(array(
            'id'        => $this->data['campaign']->saved_id,
        )); 
                                           
        $this->addTitle('Edit Campaign');
        $this->render_tpl('storeadmin/campaigns/form');   
    }
}





