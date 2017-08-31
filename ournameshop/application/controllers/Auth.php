<?php

Class Auth extends MY_Controller {
	function __construct()
	{
		parent::__construct();
	}

	public function signin()
	{
		$this->ion_auth->set_hook(
			'extra_where', 'add_shop_id_clause', $this, 'store_admin_pre_login_hook', array()
		);

		if($this->ion_auth->login(
			$this->input->post('email'), $this->input->post('password'), $this->input->post('remember')
		))
		{
			json_reply();
		}
		else
		{
			json_reply(FALSE, $this->ion_auth->errors());
		}
	}

	public function login()
    {
        if(isPostMethod())
        {
    		$this->ion_auth->set_hook(
				'extra_where', 'add_shop_id_clause', $this, 'store_admin_pre_login_hook', array()
			);
            if($this->ion_auth->login(
                $this->input->post('email'), $this->input->post('password'), $this->input->post('remember')
            ))
            { 
                redirect('admin/dashboard');
            }
            else
            { 
                $this->data['message'] = $this->ion_auth->errors();
            }
        }
        $this->load->view('admin/login', $this->data);
    }

	public function signup()
	{
		$user_id = $this->ion_auth->register(
			
			NULL,
			$this->input->post('password'),
			$this->input->post('email'),
			
			array(
				'first_name' 		=> $this->input->post('first_name'),
				'shop_id' 			=> $this->data['shop']->id,
				'last_login'		=> time()
			)
		);

		if($user_id)
		{
			$this->ion_auth->set_session($this->users->get($user_id));
			
			json_reply();
		}
		else
		{
			json_reply(FALSE, $this->ion_auth->errors());
		}
	}

	function social_login()
	{
		$provider = $this->config->item(
			$this->input->post('network'), 'social_networks'
		);

		if(!$provider)
			json_reply(FALSE, 'invalid provider');

		$oath = $this->db->get_where('oauth_users', array(
			'oauth_provider'		=> $provider,
			'oauth_uid'				=> $this->input->post('id'),
			'shop_id'				=> $this->data['shop']->id
		))->row();

		if(!$oath)
		{
			$email 	= $this->input->post('email');

			$res 	= $this->users->get_by(array(
				'email' 	=> $email,
				'shop_id'	=> $this->data['shop']->id
			));

			if($res)
			{
				$this->db->insert('oauth_users', array(
					'oauth_provider'		=> $provider,
					'oauth_uid'				=> $this->input->post('id'),
					'user_id'				=> $res->id,
					'shop_id'				=> $this->data['shop']->id
				));

				$user_id = $res->id;
			}
			else
			{
				$additional_data = array(
					'first_name'		=> $this->input->post('first_name'),
					'last_name'			=> $this->input->post('last_name'),
					'avatar' 			=> $this->input->post('picture'),
					'shop_id'			=> $this->data['shop']->id
				);

				$user_id = $this->ion_auth->register(
					NULL, NULL, $email, $additional_data
				);

				if($user_id)
				{
					$this->db->insert('oauth_users', array(
						'oauth_provider'		=> $provider,
						'oauth_uid'				=> $this->input->post('id'),
						'user_id'				=> $user_id,
						'shop_id'				=> $this->data['shop']->id
					));
				}
				else
				{
					json_reply(FALSE, $this->ion_auth->errors());
				}
			}
		}
		else
		{
			$user_id = $oath->user_id;
		}
		
		$user = $this->users->get($user_id);
		$this->ion_auth->set_session($user);

		$this->users->update($user_id, array('last_login' => time()));

		json_reply();
		
	}

	function logout()
	{
		$this->ion_auth->logout();
		redirect('/');
	}

	public function forgot()
	{
		$this->data['user'] = $this->users->get_by(array(
				'email' => $this->input->post('email')
			)
		);

		if(!$this->data['user'])
			json_reply();

		$this->data['password'] = random_string('alnum', 5);

		$this->users->update($this->data['user']->id, array(

			'password'		=> $this->ion_auth->hash_password(
				$this->data['password'], $this->data['user']->salt
			),

			'remember_code'	=> NULL
		));

		$res = $this->send_email_template(
			$this->data['user']->email,
			'Your new password',
			'reset_password',
			$this->data
		);
		
		if($res)
			json_reply();
		else
			json_reply(FALSE, 'Sorry, can not send email. Please try again.');
	}

	public function new_aff()
	{
		if(isPostMethod())
		{
			$user_id = $this->ion_auth->register(
				NULL, $this->input->post('password'),
				$this->input->post('email'), array(
					'first_name' => $this->input->post('firstname')
				),

				array(GROUP_ID_STORE_OWNER)

			);

			$this->shops->insert(array(
				'domain'		=> $this->input->post('domain'),
				'user_id'		=> NULL,
				'name'			=> ucfirst($this->input->post('domain')) . ' Shop'
			));

			$shop_id = $this->db->insert_id();

			if($shop_id)
			{
				$this->users->update($user_id, array('shop_id' => $shop_id));
				$this->shops->update($shop_id, array('user_id' => $user_id));
			}

			$shop = $this->shops->get($shop_id);
			redirect(shop_url($shop) . '/new-aff-complete');
		}

		$this->render_tpl('aff.form');
	}

	public function new_aff_complete()
	{
		$this->addTitle('Your Shop Is Ready');
		$this->render_tpl('aff.complete');
	}

	public function aff_login()
	{
		if(isPostMethod())
		{
			$this->ion_auth->set_hook(
				'extra_where', 'add_shop_id_clause', $this, 'store_admin_pre_login_hook', array()
			);

			$res = $this->ion_auth->login(
				$this->input->post('email'),
				$this->input->post('password')
			);

			if($res)
			{
				redirect(STORE_ADMIN_URL_PREFIX . '/dashboard');
			}

		}

		$this->addTitle('Affiliate Login');
		$this->render_tpl('aff.login');
	}

	public function store_admin_pre_login_hook()
	{
		$this->db->where('shop_id', $this->data['shop']->id);
	}


	// public function test()
	// {
	// 	$data = array('www@mail.dev', '334234', 'Kim', 'Smith');

	// 	$this->ion_auth->set_hook(
 //    		'post_account_creation_successful', 'invitation_email', 'auth', 'invitation_email', $data
	// 	);

 //    	$user_id = $this->ion_auth->register(NULL, '123123123', 'sdaasdsd@mail.dev', array(
 //    		'first_name' => 'Kim', 'last_name' => 'Smith'
	// 	));
	// }

	public function reset_aff_pwd()
	{
		$this->db->join(
			'users_groups UG', 'UG.user_id = users.id AND UG.group_id = ' . GROUP_ID_STORE_OWNER
		);

		$user = $this->users->get_by(array(
			'email'		=> $this->input->post('email'),
			'shop_id'	=> $this->data['shop']->id
		));

		if($user)
		{
			$data['user']		= $user;
			$data['password'] 	= random_string('alnum', 6);

			$update['password'] = $this->ion_auth->hash_password(
				$data['password'], $user->salt
			);

			$update['remember_code'] = NULL;
			
			$this->send_email_template(
				$user->email, 'Your password has been reset', 'reset_password', $data
			);

			$this->users->update($user->id, $update);
		}

		json_reply();
	}

	public function key_login()
	{
		$res = $this->db->get_where('key_login', array(
			'key'		=> $this->input->get('key')
		))->row();

		if(!$res)
			show_404();

		$this->ion_auth->set_session(
			$this->users->get($res->user_id)
		);

		$this->db->where('id', $res->id)->delete('key_login');

		redirect('/');
	}

}
