<?php

Class Profile_s extends MY_Controller
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
		if(isPostMethod())
		{
			switch($this->input->post('action'))
			{
				case 'profile':
				{
					$update = array(
						'first_name'			=> $this->input->post('first_name'),
						'last_name'				=> $this->input->post('last_name')
					);

					if($this->input->post('password'))
					{	
						$update['password'] = $this->ion_auth->hash_password(
							$this->input->post('password'), $this->data['user']->salt
						);

						$update['remember_code'] = NULL;
					}
					
					$this->users->update($this->data['user']->id, $update);

					$this->session->set_flashdata('success', TRUE);
					redirect(current_url());

				} break;
			}
		}

		$this->addTitle('My Profile');
		$this->render_tpl('storeadmin/profile/edit');
	}
}