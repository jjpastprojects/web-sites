<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->data['lastname'] 	= $this->input->get('lastname') ? $this->input->get('lastname') : $this->uri->segment(1);

		$this->data['lname'] 		= $this->lnames->with_template()->get_by(
			'lastname', $this->data['lastname']
		);
	}

	public function cats()
	{
		exit;
		$products = $this->products->get_all();

		$this->load->helper('file');

		foreach($products as $product)
		{
			$url = product_thumb($product, 'listing');

			$ext = pathinfo($url, PATHINFO_EXTENSION);

			$filename = $product->id . '_' . random_string('alnum', 8) . '.' . $ext;

			if($product->listing_thumb)
			{
				write_file('./product_thumbs/' . $filename, read_file('img/t-shirts/' . $product->listing_thumb));
			}
			else
			{
				write_file('./product_thumbs/' . $filename, file_get_contents($url));
			}

			$this->products->update($product->id, array('image2' => $filename));



		}

		exit;
	}
	// public function cats()
	// {
	// 	// exit;
	// 	ini_set('max_execution_time', 0);
	// 	// $lastnames = explode(PHP_EOL, file_get_contents('../newlist2017_clean.txt'));

	// 	// $i = 0;
	// 	// foreach($lastnames as $l)
	// 	// {
	// 	// 	if(sizeof(explode(' ', trim($l))) > 1)
	// 	// 	{
	// 	// 		debug($l);
	// 	// 		$i++;
	// 	// 	}

	// 	// }

	// 	// debug($i);
	// 	// exit;




	// 	// // show_404();
	// 	// exit;


	// 	$this->load->library('s3');

	// 	//problem cats = 10, 12, 13
	// 	$folders = $this->folders->get_many_by(array('id > 15'));
	// 	debug($folders);exit;


	// 	// $filename = 'st. paul.png';
	// 	// $lastname = explode('.', $filename);
	// 	// array_pop($lastname);
	// 	// $lastname = implode('.', $lastname);



	// 	// debug($lastname);exit;
	// 	foreach($folders as $folder)
	// 	{
	// 		// debug('Fetching Dir: ' . $folder->dir . PHP_EOL;
	// 		$res = $this->s3->list_keys($folder->dir);

	// 		// 'sports/wizards - 8864';
	// 		// 'zodiac/virgo - 8877'
	// 		//  cute/cocoa 8861

	// 		// $this->load->helper('file');

	// 		$folder_id = $folder->id;
	// 		$num_not_found = 0;
	// 		$lnames = array();

	// 		foreach ($res as $k => $object)
	// 		{
	// 			if(!$k)
	// 				continue;

	// 			// if($k > 600)
	// 			// 	break;


	// 			// $key = 'sports/basketball/high-res/Zuckerberg.png';
	// 			$key_explode = explode('/', $object['Key']);

	// 			$filename = end($key_explode);
	// 			// $lnames[] = $filename;


	// 			// $lastname 	= current(explode('.', $filename));
	// 			$lastname = explode('.', $filename);
	// 			array_pop($lastname);
	// 			$lastname = implode('.', $lastname);
	// 			// debug($lastname);
	// 			// continue;
	// 			$ln_db 		= $this->lnames->get_by(array('lastname' => $lastname));

	// 			if(!$ln_db)
	// 			{
	// 				// $this->lnames->insert(array(
	// 				// 	'lastname'	=> trim(ucfirst(mb_strtolower($lastname)))
	// 				// ));
	// 				// $num_not_found++;
	// 				// debug(trim(ucfirst(mb_strtolower($lastname))), 'Folder: ' . $folder->name);
	// 			}
	// 			else
	// 			{
	// 				$res = $this->templates->get_by(array(
	// 					'lastname_id'	=> $ln_db->id,
	// 					'folder_id'		=> $folder_id
	// 				));

	// 				if(!$res)
	// 				{
	// 					$tpl_name = $folder->name . ' ' . $k;

	// 					$insert = array(
	// 						'lastname_id'		=> $ln_db->id,
	// 						'folder_id'			=> $folder_id,
	// 						'name'				=> $tpl_name,
	// 						'slug'				=> make_slug($tpl_name),
	// 						'low_res_b'			=> $filename,
	// 						'hi_res_b'			=> $filename
	// 					);

	// 					$this->templates->insert($insert);
	// 				}



	// 				// debug($insert);


	// 			}
	// 		}
	// 	}
	// 	// write_file('./monsters_green_monster_low_res.txt', implode(PHP_EOL, $lnames));
	// 	// debug($k, 'NUM_FILES');
	// 	debug('DONE');
	// 	exit;
	// }

	public function index()
	{
		$this->data['sliders'] = array(
			'trending' => array(
			),

			'popular' => array(
			),

			'bestsellers' => array(
			),
		);

		$this->data['def_combs'] = $this->saved_logo
										->join_variant()
										->join_surface()
										->get_many_by(array('def_comb' => 1));

		if($this->data['def_combs'])
		{
			$this->data['def_combs'] = object_transparent(
				$this->data['def_combs'], 'folder_id', TRUE
			);
		}

		$this->data['replace_with_canvas'] = TRUE;

		foreach($this->data['sliders'] as $k => $slider)
		{
			if($k == 'trending')
				continue;

			if($k == 'trending')
			{
				$random_shirt 	= $this->products->join_surfaces()->order_by('RAND()')->limit(6)->get_many_by('products.type', 'T-SHIRT');

				$random_hat 	= $this->products->join_surfaces()->order_by('RAND()')->limit(5)->get_many_by('products.type', 'EMBROIDERY');

				$random_mug 	= $this->products->join_surfaces()->order_by('RAND()')->limit(1)->get_many_by('products.type', 'MUG');


				$this->data['products']['trending'] = array();

				$this->data['products']['trending'] = array_merge(
					$this->data['products']['trending'], $random_shirt, $random_hat, $random_mug
				);

				shuffle($this->data['products']['trending']);

				$trends = $this->db->select('lastname_id, COUNT(lastname_id) as cnt')
								   ->from('lastname_trends')
								   ->where('create_ts >= NOW() - INTERVAL 1 MONTH')
								   ->group_by('lastname_id')
								   ->order_by('cnt DESC')
								   ->limit(12)->get()->result();

				foreach($this->data['products']['trending'] as $k => &$p)
				{
					if($p->type == 'EMBROIDERY')
					{
						$this->db->where('options & ' . TEMPLATE_OPTION_MONOCHROME);
					}

					if(!empty($this->data['shop']->options['enabled_cats']->option_value))
		            {
		                $this->db->where_in(
		                    'category_id', $this->data['shop']->options['enabled_cats']->option_value
		                );
		            }

					$random_id = $this->db->select('templates.id')
									  ->where('lastname_id', $trends[array_rand($trends)]->lastname_id)
									  ->get('templates')
									  ->row();

					if(!$random_id)
					{
						unset($this->data['products']['trending'][$k]);
					}
					else
					{
						$random_id = $random_id->id;

						$p->template = $this->templates->join_category()->join_lastname()
										    ->get_by(array(
										   		'templates.id' => $random_id
											)
										);
					}
				}
			}
			else if($k == 'popular')
			{
				$this->data['popular'] = $this->templates
											  ->join_def_comb()
											  ->join_category()
											  ->join_lastname()
											  ->join_index_slider()
											  ->order_by('has_def_comb', 'DESC')
											  ->order_by('CAT.weight', 'DESC')

											  ->get_many_by(array(
												'templates.id = IS.template_id',
												'IS.type'	  => INDEX_SLIDER_POPULAR
											));
			}
			else if($k == 'bestsellers')
			{
				$this->data['bestsellers'] = $this->templates
												  ->join_def_comb()
												  ->join_category()
												  ->join_lastname()
												  ->join_index_slider()
												  ->order_by('CAT.weight', 'DESC')
											  	  ->order_by('has_def_comb', 'DESC')
												 ->get_many_by(array(
													'templates.id = IS.template_id',
													'IS.type'	  => INDEX_SLIDER_BESTSELLERS
												));
			}
		}

		$this->data['surfaces'] = $this->_get_surfc();

		$this->data['featured'] = $this->db->order_by('id', 'RANDOM')->get('featured')->result();

	//	$this->data['sndfeatured'] = $this->db->order_by('id', 'RANDOM')->get('2ndfeatured', 20)->result();

		$this->_visit_log();
		$this->_assign_metas('index');

		$this->render_tpl('index');
	}

	/* Added By Glado 2016/5/13 START */
	public function loadmoreSnd() {
		if(isPostMethod()){
			$sndfeatured = $this->db->order_by('id', 'RANDOM')->get('2ndfeatured', 20)->result();
			json_reply(TRUE, '', array('sndfeatured' => $sndfeatured));
		}
	}
	/* Added By Glado 2016/5/13 END */

	private function _visit_log()
    {	
        $this->db->query('INSERT INTO shop_visitors_log SET
                          create_ts = NOW(),
                          shop_id   = ' . $this->data['shop']->id . ',
                          ip        = ' . ip2long($this->input->server('REMOTE_ADDR')) . ',
                          hits      = 1
                          ON DUPLICATE KEY UPDATE hits = hits+1');
    }

    private function _add_trend($lastname_id)
    {
    	$this->db->insert('lastname_trends', array(
    		'lastname_id'		=> $lastname_id,
    		'create_ts'			=> date('Y-m-d H:i:s')
		));
    }

    public function dummy_visitors()
    {
    	// debug(ip2long('192.213.165.11'));exit;
    	$arr_shop_ids = array(1, 8, 9);

    	for($i = 0; $i<= 50000; $i++)
    	{
    		// echo date('Y-m-d', mt_rand(1262055681,time())) . '<br />';
    		// continue;
    		$this->db->query('INSERT INTO shop_visitors_log SET
                          create_ts = ' . $this->db->escape(date('Y-m-d', mt_rand(1262055681,time()))) . ',
                          shop_id   = ' . $arr_shop_ids[array_rand($arr_shop_ids)] . ',
                          ip        = ' . rand(2130706433, -1059740405) . ',
                          hits      = 1
                          ON DUPLICATE KEY UPDATE hits = hits+1');
   //  		$insert = array(
   //  			'shop_id'		=> $arr_shop_ids[array_rand($arr_shop_ids)],
   //  			'create_ts'		=> date('Y-m-d', rand(1370073191, time())),
   //  			'ip'			=> rand(2130706433, -1059740405),
   //  			'hits'			=> rand(1, 10)
			// );

			// $this->db->insert('shop_visitors_log', $insert);
    	}

    	debug('DONE');
    }

	private function _fetch_tpl($tpl, $data = array())
	{
		foreach($data as $k => $v)
			$tpl = str_replace("%$k%", $v, $tpl);

		return $tpl;
	}

	private function _assign_metas($page)
	{
		$default = $this->db->select('title, description, keywords, header')
							->where('page', $page)
							->where('shop_id', NULL)
							->get('meta_tags')->row();

		$custom = $this->db->select('title, description, keywords, header')
							->where('page', $page)
							->where('shop_id', $this->data['shop']->id)
							->get('meta_tags')->row();

		$data = new stdClass();

		if($custom)
		{
			foreach($custom as $k => $value)
			{
				$data->$k = $value ? $value : $default->$k;
			}
		}
		else
		{
			$data = $default;
		}


		if($data)
		{
			$this->vars = array(
				'lastname' 		=> $this->data['lastname'],
				'shop_name'		=> $this->data['shop']->name,
			);

			if($page == 'product' || $page == 'products')
            {
                $this->vars['surface'] = $this->data['surface']->name;
                $this->vars['product_type'] = singular($this->data['surface']->name);
            }
            if($page == 'product' || $page == 'products' || $page == 'surface_category' || $page == 'logo_category')
            {
                $this->vars = array_merge($this->vars, array(
                    'category'		=> isset($this->data['category']->name)?$this->data['category']->name:$this->data['template']->category
                ));
            }

			if($page == 'product')
			{
				$this->vars = array_merge($this->vars, array(
					'model_name'		=> $this->data['product']->model,
                    'logo_name'         => $this->data['template']->f_name,
                    'surface'           => $this->data['surface']->name,
                    'category'          => $this->data['template']->category
				));
			}

            if($page=='lastname_surface' || $page == 'surface_category')
            {
                $surface=$this->surfaces->get_by(
                    'slug', $this->input->get('surface')
                );
                $this->vars = array_merge($this->vars, array(
                    'surface'		=> $surface->name
                ));
            }

            foreach($this->vars as $k=>&$v)
            {
                if($k!='lastname'&&$k!='shop_name')
                    $v=strtolower($v);
            }

			if($data->title)
				$this->addTitle($this->_fetch_tpl($data->title, $this->vars));

			if($data->description)
            {
                $data->description=$this->_fetch_tpl($data->description, $this->vars);
                $data->description = preg_replace('/(^| )a ([aeiouAEIOU])/', '$1an $2', $data->description);
                $this->add_meta_desc($data->description);
            }
			if($data->keywords)
				$this->add_meta_keys($this->_fetch_tpl($data->keywords, $this->vars));

			if($data->header)
				$this->data['header_title'] = $this->_fetch_tpl($data->header, $this->vars);
		}
	}

	function lastname()
	{
		if($this->data['lname'])
		{
			$this->data['templates'] = $this->_templates_by_cats();

			$this->data['count']		= 0;//$this->templates->enabled()->featured()->join_category()->count_by($where);

			$this->data['surfaces'] = $this->_get_surfc();

			$this->_visit_log();
			$this->_add_trend($this->data['lname']->id);
		}

		$this->data['replace_with_canvas'] = TRUE;
        $this->data['selected_surface_type']=null;
		if($this->input->get('surface'))
        {
            $this->data['selected_surface_type']=$this->data['surfaces'][0]->type;
		    $this->data['replace_with_canvas'] = FALSE;
        }
        
        if(@$this->data['category']&&$this->input->get('surface'))
            $this->_assign_metas('surface_category');
        else if($this->input->get('surface'))
            $this->_assign_metas('lastname_surface');
        else if(@$this->data['category'])
            $this->_assign_metas('logo_category');
        else
		    $this->_assign_metas(__FUNCTION__);

		$this->render_tpl('catalog/lastname');
	}



	private function _templates_by_cats()
	{
		$templates 	= array();

		$where 		= array('templates.lastname_id' => $this->data['lname']->id);

		$this->data['category'] = array();

		$this->data['cat_limit'] = 4;

		if($this->uri->segment(2) == 'category' && $this->uri->segment(3))
		{
			$this->data['category'] = $this->categories->get_by('slug', $this->uri->segment(3));

			if(!$this->data['category'])
				show_404();

			if($this->data['category']->has_children){

				$avail_cats = $this->db->where('parent_id', $this->data['category']->id)
									   ->or_where('id', $this->data['category']->id)->get('categories')->result();
				$cats = array();

				foreach($avail_cats as $c)
				{
					$cats[] = intval($c->id);
				}

				if($cats)
					$where['FC.cat_id'] = $cats;
			}
			else
				$where['CAT.slug'] = $this->uri->segment(3);
		}
		else
		{
			$this->db->limit($this->data['cat_limit'], (get_page() > 1 ? (get_page() - 1) * $this->data['cat_limit'] : 0));

			$avail_cats = $this->db->from('categories C')

								   ->order_by('C.id', 'asc')
								  
								   ->get()->result();
			$cats = array();

			foreach($avail_cats as $c)
			{
				$cats[] = intval($c->id);
			}

			if($cats)
				$where['FC.cat_id'] = $cats;
		}


		$this->data['def_combs'] = $this->saved_logo
										->join_variant()
										->join_surface()
										->get_many_by(array('def_comb' => 1));

		if($this->data['def_combs'])
		{
			$this->data['def_combs'] = object_transparent(
				$this->data['def_combs'], 'folder_id', TRUE
			);
		}


		$templates	= $this->templates->enabled()
									  ->join_category()
									  ->join_def_comb()
									  ->order_by('CAT.weight', 'DESC')
                                      ->order_by('CAT.name', 'asc')
									  ->order_by('has_def_comb', 'DESC')
									  ->get_many_by($where);

		if($templates)
		{
			$templates = object_transparent($templates, 'category');
		}

		return $templates;
	}

	public function load_folder_cats()
	{
		$this->data['surfaces'] 	= $this->_get_surfc();
		$this->data['templates'] 	= $this->_templates_by_cats();

		json_reply(TRUE, '', array('html' => $this->load->view('catalog/folder_cats_ajax', $this->data, TRUE)));
	}

	private function _get_surfc()
	{
		$surfaces = array();
		$s_types  = array('T-SHIRT', 'HOODIE', 'MUG', 'POSTER', 'PHONE-CASE', 'BIB', 'APRON', 'TOTE-BAG');

		if($this->input->get('surface') && in_array($this->input->get('surface'), $s_types))
			$s_types = array($this->input->get('surface'));

		foreach($s_types as $k)
		{
			$surfaces = array_merge($surfaces, $this->products->join_surfaces()
												 ->order_by('RAND()')
												 ->limit(20)
												 ->get_many_by(array(
												 	'products.type' 	=> $k,
												 	'products.enabled' 	=> 1
												 )));
		}

		return $surfaces;
	}

	function surfaces()
    {
		if(!$this->data['lname'])
			show_404();

		$this->data['template']		= $this->templates->join_category()
										   ->get_by(array(
										   		'templates.slug' 		=> $this->uri->segment(2),
										   		'templates.lastname_id' => $this->data['lname']->id
										   	)
										);

		if(!$this->data['template'])
			show_404();

		$this->templates->update_num_views($this->data['template']->id);

		$this->data['surfaces']		= $this->config->item('surfaces');//$this->printful->products_types();//$this->surfaces->get_all();

		$this->data['count']		= sizeof($this->data['surfaces']);//$this->surfaces->count_all();

		$this->_assign_metas(__FUNCTION__);

		$this->_visit_log();
		$this->render_tpl('catalog/surfaces');
	}

	// public function hue()
	// {
	// 	for($i = 0; $i <= 200; $i++)
	// 	{
	// 		echo "<img src=\"/hue/hue_$i.png\" />";
	// 	}
	// }

	public function product_json()
	{
		$this->data['product'] = $this->products->get(
			$this->input->get('id')
		);

		if(!$this->data['product'])
			json_reply(FALSE, 'product not found');

		// debug($this->data);
		$this->data['product']->image = product_thumb(
			$this->data['product'], 'product'
		);

		$this->data['variants'] = $this->variants->join_product()->get_many_by(array(
				'product_id' => $this->data['product']->id
			)
		);

		// reset($this->data['variants']);

		// if(!$this->data['variants'] || !current($this->data['variants']))
		// 	show_404();

		if($this->data['variants'])
		{
			$this->data['by_size'] 		= object_transparent($this->data['variants'], 'size');
			$this->data['by_color'] 	= object_transparent($this->data['variants'], 'color_code');
		}

		json_reply(TRUE, '', array(
			'product' 		=> $this->data['product'],
			'by_color'		=> $this->data['by_color'],
			'by_size'		=> $this->data['by_size']
		));
	}

	public function product($saved_id = FALSE)
	{
		if(!$this->data['lname'])
			show_404();

		$this->data['template']		= $this->templates->join_category()
										   ->get_by(array(
										   		'templates.slug' 		=> $this->uri->segment(2),
										   		'templates.lastname_id' => $this->data['lname']->id
										   	  )
										   );

		if(!$this->data['template'])
			show_404();

		$this->data['product'] = $this->products->get($this->uri->segment(4));

		if(!$this->data['template'])
			show_404();

		$this->data['surface'] = $this->_get_current_surface();

		if(!$this->data['surface'])
			show_404();
		// if($this->data['surface']->type != $this->data['product']->type)
		// 	show_404();

		if($this->data['surface']->type == 'EMBROIDERY' &&
			!bits($this->data['template']->options, TEMPLATE_OPTION_MONOCHROME)
		)
			show_404();

		$this->products->update_num_views($this->data['product']->id);

		$this->variants->template = $this->data['template'];

		$this->data['variants'] = $this->variants
									   ->join_product()
									   ->join_folder($this->data['template']->folder_id)
									   ->get_many_by(array(
				'product_id' => $this->data['product']->id
			)
		);

		reset($this->data['variants']);
		if(!$this->data['variants'] || !current($this->data['variants']))
			show_404();

		$this->data['by_size'] 		= object_transparent($this->data['variants'], 'size');
		$this->data['by_color'] 	= object_transparent($this->data['variants'], 'color_code');

		$this->data['variant'] = FALSE;

		$this->_has_campaign();

		if($saved_id || $this->data['campaign'])
		{
			$saved_id = $saved_id ? $saved_id : $this->data['campaign']->saved_id;

			$this->data['saved_logo'] = $this->saved_logo->get($saved_id);

			if($this->data['saved_logo'])
			{
				$this->data['variant'] = $this->variants->join_product()->join_folder($this->data['template']->folder_id)->get_by(array(
					'variants.id' => $this->data['saved_logo']->surface_id
					)
				);

				if($this->data['saved_logo']->filename)
				{
					$this->data['extra_meta'][] = '<meta property="og:image" content="' . saved_logo_url($this->data['saved_logo'], TRUE) . '" />';
				}
			}
		}


		$this->data['has_colors'] 	= (bool) $this->data['variants'][0]->color_code;
		$this->data['has_sizes'] 	= (bool) $this->data['variants'][0]->size;
		$this->data['surface_type']	= $this->uri->segment(3);

		$this->_assign_metas(__FUNCTION__);

		$this->data['product']->description = $this->_fetch_tpl(
			$this->data['product']->description, $this->vars
		);

		if(TRUE)
		{
			$this->data['avail_styles'] = $this->products->order_by('model')->get_many_by(array(
				'type'	=> $this->data['product']->type
			));
		}

		$this->data['product_img'] = product_thumb($this->data['product'], 'product');

		if(!$this->data['product']->preview_thumb)
		{
			reset($this->data['variants']);
			$this->data['product_img'] = current($this->data['variants'])->image;
		}

		if($this->ion_auth->is_admin())
		{
			$this->data['def_comb'] = $this->saved_logo->get_by(
				array('folder_id' => $this->data['template']->folder_id)
			);

			$this->data['def_comb_has_listing_image'] = ($this->data['def_comb'] || ($this->data['def_comb'] && !$this->data['def_comb']->listing_image));

		}

		$this->_visit_log();

		if(is_mobile() || $this->input->get('mobile'))
		{
			$this->data['mobile'] = TRUE;

			$this->template->set_master_template('product_app_template');

			$this->output_content('catalog/product_app', $this->data);
			$this->render();
		}
		else
		{
			$this->render_tpl('catalog/product');
		}
	}

	private function _has_campaign()
	{
		$this->data['campaign'] = array();

		if(!is_main_shop($this->data['shop']))
		{
			if($this->input->get('p') === NULL)
			{
				$this->db->where('options & ' . CAMPAIGN_OPTION_ACTIVE);
			}

			$this->data['campaign'] = $this->campaigns->get_by(array(
				'product_id'		=> $this->data['product']->id,
				'template_id'		=> $this->data['template']->id,
				'lastname_id'		=> $this->data['lname']->id,
				'shop_id'			=> $this->data['shop']->id,
			));

			if($this->input->get('p') === '')
			{
				$this->data['campaign']->till_ts = date(
					'Y-m-d H:i', strtotime('+' . $this->data['campaign']->days . ' days')
				);

				$this->data['campaign']->over 	 = FALSE;
			}
		}
	}

	private function _get_current_surface()
	{
		return $this->config->item(
			mb_strtoupper($this->uri->segment(3)), 'surfaces'
		);
	}

	function products()
	{
		if(!$this->data['lname'])
			show_404();

		$this->data['template']		= $this->templates->join_category()
										   ->get_by(array(
										   		'templates.slug' 		=> $this->uri->segment(2),
										   		'templates.lastname_id' => $this->data['lname']->id
										   	)
									    );

		if(!$this->data['template'])
			show_404();

		$this->data['folder'] = $this->folders->get($this->data['template']->folder_id);

		if(!$this->data['folder'])
			show_404();

		$this->data['surface'] = $this->_get_current_surface();

		if(!$this->data['surface'])
			show_404();

		if($this->data['surface']->type == 'EMBROIDERY' &&
			!bits($this->data['template']->options, TEMPLATE_OPTION_MONOCHROME)
		)
			show_404();

		$type = $this->data['surface']->printful_type;

		if($this->data['surface']->slug == 'hoodie')
		{
			$this->db->like('model', 'Hoodie', 'both');
			$this->db->or_like('model', 'hoody', 'both');
		}
		else if($this->data['surface']->slug == 'tote-bag')
		{
			$this->db->like('model', 'tote', 'both');
			$type = $this->data['surface']->type;
		}
		elseif($this->data['surface']->type == 'T-SHIRT')
		{
			$this->db->not_like('model', 'hoody', 'both');
			$this->db->not_like('model', 'hoodie', 'both');
			$this->db->not_like('model', 'tote', 'both');
		}

		$this->db->select('MIN(V.price) as price, products.*')
			 ->join('variants V', 'V.product_id = products.id')
			 ->group_by('products.id');

		$this->data['products'] = $this->products->get_many_by(
			array('type' => $type)
		);

		if(!$this->data['products'])
			show_404();

		if(sizeof($this->data['products']) == 1)
		{
			redirect(product_url(
					$this->data['lastname'], $this->data['template'], $this->data['surface'], $this->data['products'][0]
				)
			);
		}

		$this->variants->template = $this->data['template'];

		$this->data['arr_prices'] = array();

		foreach ($this->data['products'] as &$product)
		{
			$product->folder_price = $this->data['folder']->price;

			$product = $this->variants->after_get($product);
			array_push($this->data['arr_prices'], $product->price);
		}

		if(in_array($this->data['surface']->type, array('EMBROIDERY', 'T-SHIRT')))
		{
			$this->data['has_filter'] 	= TRUE;

			$this->data['brands'] 		= array_keys(object_transparent(
				$this->data['products'], 'brand'
			));
		}

		$this->_assign_metas(__FUNCTION__);

		$this->_visit_log();
		$this->render_tpl('catalog/products');
	}

	function load_family_items()
	{
		$this->data['lname'] 		= $this->lnames->get_by(
			'id', $this->input->get('lastname_id')
		);

		if(!$this->data['lname'])
			json_reply(FALSE);

		$where = array(
			'lastname_id' 	=> $this->data['lname']->id,
			'enabled'		=> 1
		);

		if($this->input->get('category_id'))
		{
			$where['FC.cat_id']	= intval($this->input->get('category_id'));
		}
		else
		{
			$where['featured'] = 1;
		}

		$this->data['templates']	= $this->templates->join_category()->get_many_by($where);

		$this->data['count']		= $this->templates->join_category()->count_by($where);


		if(!$this->data['lname'])
			json_reply(FALSE, 'lastname not found');

		$this->data['lastname'] 	= $this->data['lname']->lastname;

		$this->data['surfaces'] = array();

		foreach(array('T-SHIRT', 'MUG', 'POSTER', 'PHONE-CASE', 'BIB', 'APRON') as $k)
		{
			$this->data['surfaces'] = array_merge($this->data['surfaces'], $this->products->join_surfaces()
												 ->order_by('RAND()')
												 ->limit($k == 'T-SHIRT' ? 20 : 1)
												 ->get_many_by(array(
												 	'products.type' 	=> $k,
												 	'products.enabled' 	=> 1
												 )));
		}

		json_reply(TRUE, '', array(
			'html'		=> $this->load->view('catalog/listing.inc.php', $this->data, TRUE)
		));
	}

	public function custom_logo()
	{
		$path1 			= './img/family2.jpg';
		$path2 			= './img/hires_logo.png';

		$image1      	= new Imagick($path1);
        $image2      	= new Imagick($path2);

        // $image2->compositeImage($image1, Imagick::COMPOSITE_OVER, 0, 0);
        $image1->compositeImage($image2, Imagick::COMPOSITE_OVER, 0, 0);

        header('Content-Type: image/'.$image1->getImageFormat());
		echo $image1;

		exit;
	}

	private function _generate_image($cart_item_id)
	{
		$cart_item = $this->cart_items->join_surfaces()->get_by(
			'cart_items.id', $cart_item_id
		);


		if(!$cart_item)
			show_404();

		$variant = $this->variants->get(
			$cart_item->surface_id
		);

		if(!$cart_item || !$variant)
			show_404();


		if(!$this->resizer->set_template($cart_item->tpl_id))
			show_404();

		$product = $this->products->get($variant->product_id);

		$this->resizer->set_node_canvas_sizes(
			$this->canvas_sizes($product->type)
		);

		$res = $this->resizer->build_from_canvas(
			$cart_item->params->canvas
		);

		if(!$res)
		{
			show_404();
		}

		if($variant->dimensions)
		{
			if($product->type == 'MUG')
				$this->resizer->set_gravity('west');

			$this->resizer->set_variant($variant)->resize_to_bounds();
		}

		$this->resizer->output_image();
	}

	public function download_product()
	{
		$cart_item = $this->cart_items->join_surfaces()->get_by(
			'cart_items.id', $this->input->get('id')
		);

		if(!$cart_item)
			show_404();

		$order = $this->orders->get_by(array('cart_id' => $cart_item->cart_id));

		if(!$order || $order->user_id != $this->user_id)
			show_404();

		$this->_generate_image($this->input->get('id'));
	}

	public function printfull_image($cart_item_id)
	{
		$this->_generate_image($cart_item_id);

		exit;



		if(!$template || !$variant)
			show_404();

		$this->load->helper('file');
		$path = '/tmp/' . random_string('alnum', 10);


		$logo_img = file_get_contents(tpl_thumb($template, 'hi-res', 'cloudfront'));


		if(strstr($variant->dimensions, '×'))
		{
			write_file(
				$path, $logo_img
			);

			list($w, $h) 					= getimagesize($path);
			list($surface_w, $surface_h) 	= explode('×', $variant->dimensions);

			$precision = 2;

			//shit-code goes here
			if($surface_w > $surface_h)
			{
				while(round($w / $h, $precision) != round($surface_w / $surface_h, $precision))
					$w++;
			}
			else if($surface_h > $surface_w)
			{
				while(round($h / $w, $precision) != round($surface_h / $surface_w, $precision))
					$h++;
			}
			else
			{
				if($w > $h)
				{
					while($w / $h != $surface_w / $surface_h)
						$h++;
				}
				else if($h > $w)
				{
					while($h / $w != $surface_h / $surface_w)
						$w++;
				}
			}

			$command = '/usr/bin/convert ' . $path . ' -background none -gravity center -extent ' .
						$w . 'x' . $h . ' ' . $path . ' 2> /tmp/printful_converter_err.log';

			system($command, $ret);

			if($ret === 0)
			{
				header('Content-Type: image/png');
				echo file_get_contents($path);
			}
			else
			{

			}
		}
		else
		{
			header('Content-Type: image/png');
			echo $logo_img;
		}

		safe_unlink($path);
	}

	private function canvas_sizes($type)
	{
		$arr = array(
			'MUG' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 1387,
				'small_w'		=> 300,
				'small_h'		=> 231
			),

			'T-SHIRT' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 2160,
				'small_w'		=> 300,
				'small_h'		=> 360
			),

			'EMBROIDERY' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 655,
				'small_w'		=> 300,
				'small_h'		=> 109
			),

			'POSTER' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 2250,
				'small_w'		=> 300,
				'small_h'		=> 376
			),

			'FRAMED-POSTER' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 2250,
				'small_w'		=> 300,
				'small_h'		=> 385
			),


			'CARD' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 2790,
				'small_w'		=> 300,
				'small_h'		=> 385
			),

			'DIGITAL-PRODUCT' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 2790,
				'small_w'		=> 300,
				'small_h'		=> 360
			),

			'PHONE-CASE' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 3300,
				'small_w'		=> 300,
				'small_h'		=> 360
			),

			'BIB' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 3300,
				'small_w'		=> 300,
				'small_h'		=> 360
			),

			'APRON' => array(
				'cwidth' 		=> 1800,
				'cheight' 		=> 3300,
				'small_w'		=> 300,
				'small_h'		=> 360
			),
		);

		return $arr[$type];
	}

	function test_call()
	{
		$this->print_aura->test();exit;
		// debug($this->send_email('zhyrny@gmail.com', 'This is the subject', 'This is the body'));
		// exit;
		show_404();
		require APPPATH . 'libraries/Palivo.php';
		// $palivo = new Palivo();

		$type = $this->input->get('type');


		$api = new RestAPI(
			'MAYJC0MTA5ZDI2MWFJMZ', 'ZWUzNzIwNjk5ZmZlOTRkZDI5NDE4M2Q4NGQ5MDlh'
		);

		switch ($type)
		{
			case '2':
			{
				$r 		= new Response();
				$url 	= 'http://s3.amazonaws.com/plivocloud/music.mp3';

				$attributes = array (
				    'loop' => 2,
				);

				$r->addPlay($url, $attributes);

				$wait_attribute = array(
				    'length' => 3,
				);

				$r->addWait($wait_attribute);
				header('Content-type: text/xml');

				echo( $r->toXML());
			} break;
				// $response = new Response();
				// // debug($response);
				// $response->addPlay('http://s3.amazonaws.com/plivocloud/music.mp3');

    //     		$response->addRedirect(
    //     			'http://' . $_SERVER["SERVER_NAME"] . /*':' . $_SERVER["SERVER_PORT"] .*/ '/catalog/test_call', array('method' =>'GET')
    //     		);

				// // $palivo->play_sound()


			default:
			{
				// $record_url = 'http://s3.amazonaws.com/plivocloud/music.mp3';
				// // require_once 'plivo.php';
				// // $record_url = $_REQUEST['RecordUrl'];
				// $response = new Response();
				// $getdigits = $response->addGetDigits(array('action' => 'http://' . $_SERVER["SERVER_NAME"] . /*':' . $_SERVER["SERVER_PORT"] .*/ '/plivo-voicemail/follow-action.php?RecordUrl=' . $record_url, 'method' => 'GET'));
				// $getdigits->addSpeak('Press 1 to play your recording');
				// $getdigits->addSpeak('Press 2 to start over');
				// $getdigits->addSpeak('Press 3 to save and exit');
				// header('content-type: text/xml');
				// echo($response->toXML());
				$params = array(
			        'to' 			=> '380934810879',
			        // 'to' 			=> '380934810886',
			        'from' 			=> '13108531088',
			        'answer_url' 	=> 'http://huge-rabbit-4347.vagrantshare.com/catalog/test_call?type=2',
			    );

				$response = $api->make_call($params);

				debug($response);
			} break;
				// $palivo->test_call();

		}


	}

	public function save_print_design()
	{
		$template = $this->templates->get(intval($this->input->post('template_id')));

		if(!$template)
			json_reply(FALSE, 'Template not found');

		if($this->ion_auth->is_admin() && $this->input->post('clear'))
		{
			$this->saved_logo->delete_by(array(
				'folder_id' => $template->folder_id,
				'def_comb'	=> 1
			));

			json_reply();
		}

		$this->load->library('s3');

		$filename = image_from_data_url(
			$this->input->post('img'),
			$this->config->item('tmp_path')
		);

		$insert = array(
			'params' 		=> $this->input->post('canvas_params'),
			'user_id'		=> $this->user_id,
			'template_id'	=> $this->input->post('template_id'),
			'lastname_id'	=> $this->input->post('lastname_id'),
			'surface_id'	=> intval($this->input->post('variant_id')),
			'filename'		=> $filename,
			'create_ts'		=> date('Y-m-d H:i:s')
		);

		if($this->ion_auth->is_admin())
		{
			$insert['def_comb'] 	= $this->input->post('def_comb');
			$insert['preset'] 		= $this->input->post('preset');
			$insert['folder_id'] 	= $template->folder_id;


			if($_FILES)
			{
				$listing_filename = random_string('alnum', 9) . '.' . pathinfo(basename($_FILES[0]['name']), PATHINFO_EXTENSION);

				move_uploaded_file($_FILES[0]['tmp_name'], 'img/products/' . $listing_filename);

				$insert['listing_image'] = $listing_filename;
			}


			// foreach($_FILES)
			// $upload_config = array(
	  //           'upload_path'       => 'img/products/',
	  //           'allowed_types'     => '*',
	  //           'max_size'          => 0,
	  //           'file_name'         => random_string('alnum', 12)
	  //       );

	  //       $this->upload->initialize($upload_config);

	  //       if(!$this->upload->do_upload('file'))
	  //           json_reply(FALSE, strip_tags($this->upload->display_errors()));

	  //       $upload_data = $this->upload->data();

	  //       debug($upload_data);

		}


		$res = $this->saved_logo->get_by(array('folder_id' => $template->folder_id));


		if($res && $this->ion_auth->is_admin())
		{
			$this->saved_logo->update($res->id, $insert);
			$save_id = $res->id;
		}
		else
		{
			$save_id = $this->saved_logo->insert($insert);
		}


		$this->s3->upload_saved_logo(
			$this->config->item('tmp_path') . $filename
		);

		$this->data['saved_logo'] = $this->saved_logo->get($save_id);

		json_reply(TRUE, '', array(
				'id' 			=> $save_id,
				'image_url'		=> saved_logo_url($this->data['saved_logo'], TRUE),
				'fav_items_cnt' => $this->saved_logo->count_by(array('user_id' => $this->user_id))
			)
		);
	}

	public function logo_proxy($logo_id)
	{
		list($logo_id, $lastname_id) = explode('_', $logo_id);

		$template = $this->templates->join_category()->get_by(array(
			'templates.id'			=> $logo_id,
			'lastname_id'			=> $lastname_id
		));

		if(!$template)
			show_404();


		header('Content-Type: image/png');
		header('Last-Modified:Fri, 03 Apr 2015 10:06:28 GMT');

		echo file_get_contents(tpl_thumb($template, 'lo-res'));
	}

	public function variant_proxy()
	{
		$variant = $this->variants->get($this->input->get('variant_id'));

		if(!$variant)
			show_404();


		header('Content-Type: image/png');
		header('Last-Modified:Fri, 03 Apr 2015 10:06:28 GMT');

		if(strstr($variant->image, 'https://'))
		{
			echo file_get_contents($variant->image);
		}
		else
		{
			echo file_get_contents('./' . $variant->image);
		}
	}

	public function collection($user_id)
	{
		$this->data['user_collection'] = $this->users->get($user_id);

		if(!$this->data['user_collection'])
			show_404();

		$this->data['collection'] = $this->saved_logo
										 ->join_variant()
										 ->join_surface()
										 ->join_template()
										 ->get_many_by(array(
											'user_id' => $user_id
										));

		$this->render_tpl('catalog/collection');
	}

	public function remove_from_collection()
	{
		if(isPostMethod())
		{
			if(!$this->user_id)
				json_reply(FALSE, 'need auth');

			$this->db->where(array(
				'id'		=> $this->input->post('id'),
				'user_id' 	=> $this->user_id
			))->delete('saved_logos');

			json_reply(TRUE, '', array('fav_items_cnt' => $this->saved_logo->count_by(array('user_id' => $this->user_id))));
		}

		show_404();
	}
}
