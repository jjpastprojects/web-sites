<?php

Class Campaign extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		
	}

	public function create($step = 1)
	{
		if(!$this->user_id)
			redirect('auth/aff_login');

		if(!in_array($step, array(1, 2, 3)))
			show_404();

		$cid 					= $this->input->get('cid');

		$this->data['campaign'] 		= array();
		$this->data['campaign_shop'] 	= array();
		$this->data['saved_logo'] 		= array();

		if($cid || $step > 1)
		{
			$this->data['campaign'] = $this->campaigns->join_lastname()->get_by(array(
				'campaigns.user_id'		=> $this->user_id,
				'campaigns.id'			=> $this->input->get('cid')
			));

			if(!$this->data['campaign'])
				show_404();

			if($this->data['campaign']->shop_id)
			{
				$this->data['campaign_shop'] = $this->shops->get_by(
					array('id' => $this->data['campaign']->shop_id)
				);
			}
			else
			{
				$res = $this->campaigns->get_by(
					array('user_id' => $this->user_id, 'shop_id IS NOT NULL')
				);
				
				if($res)
				{
					$this->data['campaign_shop'] = $this->shops->get_by(
						array('id' => $res->shop_id)
					);
				}
			}
			
		}

		if($this->input->get('sid') || $this->data['campaign'])
		{
			$this->data['saved_logo'] = $this->saved_logo->get_by(array(
				'id'		=> $this->data['campaign'] ? $this->data['campaign']->saved_id : $this->input->get('sid'),
				'user_id'	=> $this->user_id
			));	
		}

		$this->data['template'] = array();
		$this->data['variant'] 	= array();
		$this->data['lastname'] = array();

		if($this->input->get('tid') || $this->data['campaign'])
		{
			$lid = $this->data['campaign'] ? $this->data['campaign']->template_id : $this->input->get('tid');

			$this->data['template'] = $this->templates->join_category()->get_by(
				array('templates.id' => $lid)
			);
		}

		if($this->input->get('vid') || $this->data['campaign'])
		{
			$vid = $this->data['campaign'] ? $this->data['campaign']->variant_id : $this->input->get('vid');

			$this->data['variant'] = $this->variants
									   ->join_product()
									   ->join_folder($this->data['template']->folder_id)
									   ->get_by(array('variants.id' => $vid));

			$this->data['product'] = $this->products->join_surfaces()->get_by(
				array('products.id' => $this->data['variant']->product_id)
			);

			$this->data['variant']->slug = $this->data['product']->surface_slug;
		}

		if($this->input->get('lid') || $this->data['campaign'])
		{
			$lid = $this->data['campaign'] ? $this->data['campaign']->lastname_id : $this->input->get('lid');

			$this->data['lastname'] = $this->lnames
									   	   ->get_by(array('lastnames.id' => $lid));
		}

		if(!$this->data['variant'] || !$this->data['template'] || !$this->data['lastname'])
			show_404();

		

		if(isPostMethod())
		{
			switch($step)
			{
				case 1:
				{
					$data = array(
						'goal'			=> $this->input->post('goal'),
						'profit'		=> $this->input->post('profit'),
						'template_id'	=> $this->input->post('template_id'),
						'product_id'	=> $this->data['variant']->product_id,
						'variant_id'	=> $this->input->post('variant_id'),
						'lastname_id'	=> $this->input->post('lastname_id'),
						'saved_id'		=> $this->data['saved_logo']->id
					);

					if(!$this->data['campaign'])
					{
						$data['user_id'] 	= $this->user_id;
						
						$data['create_ts'] 	= mysql_now_date();

						$this->campaigns->insert($data);
						$cid = $this->db->insert_id();	
					}
					else
					{
						$this->campaigns->update($cid, $data);
					}

					redirect('campaign/create/2?cid=' . $cid);
				} break;

				case 2:
				{
					if(!$this->data['campaign_shop'] && !$this->_check_subdomain($this->input->post('subdomain')))
					{
						$this->session->set_flashdata('error', 'subdomain invalid or already in use');
						redirect(current_url());
					}

					$update = array(
						'name'			=> strip_tags($this->input->post('name')),
						'description' 	=> strip_tags($this->input->post('description')),
						'days'			=> $this->input->post('days'),
						'options'		=> is_array($this->input->post('options')) ? array_sum($this->input->post('options')) : NULL
					);


					$res = $this->campaigns->get_by(
						array('user_id' => $this->user_id, 'shop_id IS NOT NULL')
					);
					
					if(!$res)
					{
						$shop_user 			= $this->_create_shop(
							array('subdomain' => $this->input->post('subdomain'))
						);

						$update['shop_id']	= $shop_user['shop_id'];
					}
					else
					{
						$update['shop_id'] = $res->shop_id;
					}

					if($this->data['campaign_shop'] && !$this->data['campaign_shop']->domain)
					{
						$this->shops->update($this->data['campaign']->shop_id, array(
							'domain'		=> $this->input->post('subdomain'),
							'name'			=> $this->input->post('subdomain')
						));	
					}
					
					$this->campaigns->update($cid, $update);

					redirect('campaign/create/3?cid=' . $cid);
				} break;

				case 3:
				{
					if($this->input->post('publish'))
					{
						$this->campaigns->update($this->data['campaign']->id, array(
							'options' 		=> $this->data['campaign']->options | CAMPAIGN_OPTION_ACTIVE,
							'publish_ts'	=> mysql_now_date(),
							'till_ts'      	=> date('Y-m-d H:i:s', strtotime('+' . $this->data['campaign']->days . ' days'))
						));

						$this->session->set_flashdata('success', TRUE);
						redirect(current_url() . '?cid=' . $this->data['campaign']->id);
					}
				} break;

				default:
				{
					redirect('/');
				}
			}

		}

		$this->data['step'] = $step;

		$this->render_tpl('form');
	}

	private function _create_shop($data)
	{
		$this->shops->insert(array(
			'name'			=> $data['subdomain'],
			'domain'		=> $data['subdomain']
		));	

		$shop_id = $this->db->insert_id();
		$this->data['shop']->id = $shop_id;

		$password = random_string('alnum', 6);
		$password = 1111;

		$user_id = $this->ion_auth->register(
			NULL, $password,
			$this->data['user']->email, array(),
			array(GROUP_ID_STORE_OWNER)
		);

		if(!$user_id)
		{
			debug($this->ion_auth->errors());
			exit;
		}

		// $this->shops->insert(array(
		// 	'domain'		=> $this->input->post('domain'),
		// 	'user_id'		=> NULL,
		// 	'name'			=> ucfirst($this->input->post('domain')) . ' Shop'
		// ));

		

		if($shop_id)
		{
			$this->users->update($user_id, array('shop_id' => $shop_id));
			$this->shops->update($shop_id, array('user_id' => $user_id));
		}

		$res = $this->send_email_template(
			$this->data['user']->email, 
			'Campaign Account', 
			'campaign_new_account', 
			array(
				'email' 		=> $this->data['user']->email,
				'password' 		=> $password,
				'shop'			=> (object)array(
						'domain' 		=> $data['subdomain'],
						'custom_domain' => 0
					)
			)
		);

		return array('user_id' => $user_id, 'shop_id' => $shop_id);
	}

	public function check_subdomain()
	{
		json_reply(TRUE, '', array(
			'valid' => $this->_check_subdomain($this->input->get('subdomain'))
		));
	}

	private function _check_subdomain($subdomain)
	{
		$res = $this->shops->get_by(array(
			'domain'			=> $subdomain,
			'custom_domain'		=> 0
		));
		
		if($res)
		{
			$valid = FALSE;
		}
		else
		{
			$valid = (bool)preg_match('/^[a-zA-Z0-9\-]+$/', $subdomain);
		}

		return $valid;
	}
	public function render_tpl($tpl)
	{
		if(!strstr($tpl, '/'))
		{
			$tpl = 'campaign/' . $tpl;
		}

		$this->output_content($tpl, $this->data);
		$this->render();
	}
}