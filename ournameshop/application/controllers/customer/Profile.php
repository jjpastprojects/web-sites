<?php

Class Profile extends MY_Controller
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

				case 'shipping':
				{
					$update = array(
						'address'				=> $this->input->post('address'),
						'address2'				=> $this->input->post('address2'),
						'city'					=> $this->input->post('city'),
						'state'					=> $this->input->post('state'),
						'zip'					=> $this->input->post('zip'),
						'country'				=> $this->input->post('country'),
						'phone'					=> $this->input->post('phone')
					);

					$this->users->update($this->data['user']->id, $update);

					$this->session->set_flashdata('success', TRUE);
					redirect(current_url());

				} break;

			}
		}

		$this->addTitle('My Profile');
		$this->render_tpl('customer/profile/edit');
	}
}