<?php

Class Settings_s extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		if(!$this->ion_auth->in_group(GROUP_ID_STORE_OWNER))
			redirect(STORE_ADMIN_URL_PREFIX . '/login');

		if($this->user_id != $this->data['shop']->user_id)
            redirect(STORE_ADMIN_URL_PREFIX . '/login');
        
		$this->template->set_master_template('storeadmin/main_template');

		$this->categories->in_admin = TRUE;
	}

	public function index()
	{
		if(isPostMethod())
		{
			$this->shops->update($this->data['shop']->id, array(
				'name'			=> $this->input->post('name'),
				'domain'		=> $this->input->post('domain'),
				'custom_domain'	=> intval($this->input->post('custom_domain'))
			));

			$this->_update_options(
				$this->data['shop']->id, $this->input->post('options')
			);

			$this->session->set_flashdata('success', TRUE);
			redirect(current_url());
		}

		$this->data['options'] = $this->shops->options($this->data['shop']->id);
		
		$this->addTitle('Shop Settings');
		$this->render_tpl('storeadmin/settings/form');
	}

	private function _update_options($shop_id, $data)
	{
		$allowed = array(
			'pp_email', 'fb_app_id', 'g_client_id', 'li_api_key', 'enabled_cats'
		);

		foreach($allowed as $option)
		{
			if(empty($data[$option]))
			{
				$this->db->where(array(
					'shop_id'		=> $shop_id,
					'option_name'	=> $option
				))->delete('shop_options');
			}
			else
			{
				$res = $this->db->where(array(
					'shop_id'		=> $shop_id,
					'option_name'	=> $option
				))->get('shop_options')->row();

				if(is_array($data[$option]))
					$data[$option] = implode(',', $data[$option]);

				if($res)
				{
					$this->db->where('id', $res->id);
					$this->db->update('shop_options',  array(
						'option_value'	=> $data[$option]
					));
				}
				else
				{
					$this->db->insert('shop_options', array(
						'shop_id'		=> $shop_id,
						'option_name'	=> $option,
						'option_value'	=> $data[$option]
					));
				}
			}
		}
	}

	public function metatags()
    {
        if(isPostMethod())
        {
            $this->db->query('
                INSERT INTO meta_tags SET 
                page        = ' . $this->db->escape($this->input->post('page')) . ',
                shop_id		= ' . $this->data['shop']->id . ',
                title       = ' . $this->db->escape($this->input->post('title')) . ',
                description = ' . $this->db->escape($this->input->post('desc')) . ',
                keywords    = ' . $this->db->escape($this->input->post('keys')) . ',
                header      = ' . $this->db->escape($this->input->post('header')) . '

                ON DUPLICATE KEY UPDATE

                title       = ' . $this->db->escape($this->input->post('title')) . ',
                description = ' . $this->db->escape($this->input->post('desc')) . ',
                keywords    = ' . $this->db->escape($this->input->post('keys')) . ',
                header      = ' . $this->db->escape($this->input->post('header'))
            );
            
            redirect(current_url());
        }

        $this->data['meta_tags'] = $this->db->where(
        	'shop_id', $this->data['shop']->id
        )->get('meta_tags')->result();

        if($this->data['meta_tags'])
            $this->data['meta_tags'] = object_transparent($this->data['meta_tags'], 'page', TRUE);        

        $this->addTitle('Meta Tags');
        $this->render_tpl('admin/meta_tags');
    }


	public function upload_logo()
    {
    	$this->load->library('upload');

        $this->upload->initialize(array(
            'upload_path'       => $this->config->item('path', 'shop_logo'),
            'allowed_types'     => $this->config->item('allowed_types', 'shop_logo'),
            'max_size'          => $this->config->item('upload_max_size', 'shop_logo'),
            'file_name'         => random_string('alnum', 10)
        ));


        if(!$this->upload->do_upload('file'))
            json_reply(FALSE, strip_tags($this->upload->display_errors()));

        $upload_data = $this->upload->data();
        $this->load->library('image_moo');

        $img_config = $this->config->item('shop_logo');

        $this->image_moo
             ->load($upload_data['full_path'])
             ->resize($img_config['width'], $img_config['height'])
             ->save_pa(IMG_THUMB_PREFIX);

        unlink_shop_logo();
        
        $this->shops->update($this->data['shop']->id, array(
        	'logo'		=> $upload_data['file_name']
    	));      

        json_reply(!$this->image_moo->errors, 
            $this->image_moo->display_errors(), 
            array('img' => IMG_THUMB_PREFIX . $upload_data['file_name'])
        );
    }
}