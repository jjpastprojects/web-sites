<?php

class Cron extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}

	public function test()
	{
		echo __METHOD__;
		// foreach($this->config->item('surfaces') as $surface)
		// {
		// 	$this->db->insert('surfaces', $surface);
		// }
	}

	private function console_log($msg)
	{
		echo $msg . PHP_EOL;
	}

	public function generate_popular($limit = INDEX_SLIDER_NUM)
	{
		$this->lnames->limit = $limit;

		$popular_lnames = $this->lnames->order_by('rank')->get_many_by(array('rank != 0'));
		
		$this->db->where('type', INDEX_SLIDER_POPULAR)
		 		 ->delete('index_slider');

		foreach($popular_lnames as $lname)
		{
			$avail_folders = array_keys(object_transparent($this->db->select('folder_id')
									  ->from('templates T')
									  ->where('T.lastname_id', $lname->id)
									  ->where('T.folder_id IS NOT NULL')
									  ->group_by('T.folder_id')
									  ->get()->result(), 'folder_id', TRUE));
			
			$template = $this->templates->get_by(array(
				'lastname_id'		=> $lname->id,
				'folder_id'			=> $avail_folders[array_rand($avail_folders)]
			));

			$this->db->insert('index_slider', array(
				'template_id'		=> $template->id,
				'type'				=> INDEX_SLIDER_POPULAR,
				'create_ts'			=> mysql_now_date()
			));
		}
	}

	public function generate_bestsellers($limit = INDEX_SLIDER_NUM)
	{
		$folders = object_transparent(
			$this->folders->order_by('num_sales', 'DESC')->limit($limit)->get_all(),
			'id', TRUE
		);

		$this->db->where('type', INDEX_SLIDER_BESTSELLERS)
				 ->delete('index_slider');

		foreach($folders as $folder)
		{
			$res = $this->db->select('id')
					 ->from('templates')
					 ->where('folder_id', $folder->id)
					 // ->limit(20)
					 ->get()->result();


			$ids = array_keys(object_transparent($res, 'id', TRUE));		 
			
			$this->db->insert('index_slider', array(
				'template_id'		=> $ids[array_rand($ids)],
				'type'				=> INDEX_SLIDER_BESTSELLERS,
				'create_ts'			=> mysql_now_date()
			));
		}
	}

	public function create_folders()
	{
		exit;
		$folders = array(
			'surfing_crab', 'surfing_dolphin', 'surfing_killer_whale', 'surfing_monkey', 'surfing_octopus',
			'surfing_parrot', 'surfing_polar_bear', 'surfing_shark'
			// 'angels', 'baseball', 'bear', 'beaver', 'bobcat', 'boxing',
			// 'braves', 'bull', 'bumblebee', 'cardinal', 'cat',
			// 'cavalier', 'cheerleader', 'chiefs', 'cobra', 'cougar', 'cowboy',
			// 'dragon', 'eagle', 'eagle2', 'elephant', 'football', 'fox', 'gators',
			// 'golf', 'hawks', 'horse', 'irish', 'jesus', 'karate', 'lacrosse', 'lions',
			// 'motorcross', 'owl', 'panther', 'pirate', 'rockets', 'rottweiler', 'scorpion',
			// 'shark', 'stingray', 'swim', 'tiger', 'viking', 'volleyball', 'wizards', 'wolf',
			// 'wolverine'
		);

		$parent = 'beach/';
		$cat_id = 21;

		foreach($folders as $folder)
		{
			$this->db->insert('logo_folders', array(
				'name'		=> humanize($folder),
				'dir'		=> $parent . $folder,
				'price'		=> 5,
				'create_ts'	=> date('Y-m-d H:i:s')
			));

			$folder_id = $this->db->insert_id();

			$this->db->insert('folder_cats', array(
				'folder_id'		=> $folder_id,
				'cat_id'		=> $cat_id
			));
		}

		debug('DONE');
	}

	public function cats()
	{
		exit;
		ini_set('max_execution_time', 0);
		// $lastnames = explode(PHP_EOL, file_get_contents('../newlist2017_clean.txt'));

		// $i = 0;
		// foreach($lastnames as $l)
		// {
		// 	if(sizeof(explode(' ', trim($l))) > 1)
		// 	{
		// 		debug($l);
		// 		$i++;
		// 	}

		// }

		// debug($i);
		// exit;




		// // show_404();
		// exit;


		$this->load->library('s3');

		//will start with templates.folder_id > 26
		//saint_bernard wrong filenames ends with 4
		$folders = $this->folders->get_many_by(array('id > 96'));
		// print_r($folders);exit;


		// $filename = 'st. paul.png';
		// $lastname = explode('.', $filename);
		// array_pop($lastname);
		// $lastname = implode('.', $lastname);



		// debug($lastname);exit;
		foreach($folders as $folder)
		{
			$folder->dir = $folder->dir . '/lo-res';

			$this->console_log('Working Dir: ' . $folder->dir . ' ID: ' . $folder->id);
			$res = $this->s3->list_keys($folder->dir);
			// $this->console_log('Fetching Dir: ' . $folder->dir . ' success');

			// 'sports/wizards - 8864';
			// 'zodiac/virgo - 8877'		
			//  cute/cocoa 8861
				
			// $this->load->helper('file');	
			
			$folder_id = $folder->id;
			$num_not_found = 0;
			$num_inserted = 0;

			$lnames = array();

			foreach ($res as $k => $object) 
			{
				

				if(!$k)
					continue;
				
				// if($k > 600)
				// 	break;


				// $key = 'sports/basketball/high-res/Zuckerberg.png';
				$key_explode = explode('/', $object['Key']);

				$filename = end($key_explode);
				// $lnames[] = $filename;


				// $lastname 	= current(explode('.', $filename));
				$lastname = explode('.', $filename);
				array_pop($lastname);
				$lastname = implode('.', $lastname);
				// debug($lastname);
				// continue;
				$ln_db 		= $this->lnames->get_by(array('lastname' => $lastname));

				if(!$ln_db)
				{
					// $this->lnames->insert(array(
					// 	'lastname'	=> trim(ucfirst(mb_strtolower($lastname)))
					// ));
					// $num_not_found++;
					// debug(trim(ucfirst(mb_strtolower($lastname))), 'Folder: ' . $folder->name);
				}
				else
				{
					$res = $this->templates->get_by(array(
						'lastname_id'	=> $ln_db->id,
						'folder_id'		=> $folder_id
					));

					if(!$res)
					{
						$tpl_name = $folder->name . ' ' . $k;

						$insert = array(
							'lastname_id'		=> $ln_db->id,
							'folder_id'			=> $folder_id,
							'name'				=> $tpl_name,
							'slug'				=> make_slug($tpl_name),
							'low_res_b'			=> $filename,
							'hi_res_b'			=> $filename
						);	

						$this->templates->insert($insert);
						$num_inserted++;
					}
				}
			}

			$this->console_log('Num Inserted: ' . $num_inserted);
		}
		// write_file('./monsters_green_monster_low_res.txt', implode(PHP_EOL, $lnames));
		// debug($k, 'NUM_FILES');
		$this->console_log('DONE');
		exit;
	}

	// public function _remap($method)
	// {
	// 	$method_param = explode('-', $method);
		
	// 	$param = isset($method_param[1]) ? $method_param[1] : NULL;

	// 	$this->$method_param[0]($param);

	
	// }

	public function test_cron()
	{
		echo 1;
	}

	public function import_logo_types($job_id = NULL)
    {
    	if(!$job_id)
    	{
    		$this->console_log('ERR: empty job id');
    		exit(1);
    	}

    	$job = $this->db->get_where('import_jobs', array('id' => $job_id))->row();

    	if(!$job)
    	{
    		$this->console_log('ERR: job not found');
    		exit(1);
    	}

        $this->load->library('s3');
        
        $folder = $this->folders->get($job->folder_id);

        if(!$folder)
        {
        	$this->console_log('ERR: folder not found');
            exit(1);
        }
      

        $folder->dir = $folder->dir . '/lo-res';

        // $this->console_log('Working Dir: ' . $folder->dir . ' ID: ' . $folder->id);
        $res = $this->s3->list_keys($folder->dir);
        
        // $this->console_log('Fetching Dir: ' . $folder->dir . ' success');
        
        $folder_id = $folder->id;
        $num_not_found = 0;
        $num_inserted = 0;

        $lnames = array();

        foreach ($res as $k => $object) 
        {
        	

            if(!$k)
                continue;

            $key_explode = explode('/', $object['Key']);

            $filename = end($key_explode);
        
            $lastname = explode('.', $filename);
            array_pop($lastname);
            $lastname = implode('.', $lastname);
            
            $ln_db      = $this->lnames->get_by(array('lastname' => $lastname));

            if(!$ln_db)
            {
                continue;
            }
            else
            {
                $res = $this->templates->get_by(array(
                    'lastname_id'   => $ln_db->id,
                    'folder_id'     => $folder_id
                ));

                if(!$res)
                {
                    $tpl_name = $folder->name . ' ' . $k;

                    $insert = array(
                        'lastname_id'       => $ln_db->id,
                        'folder_id'         => $folder_id,
                        'name'              => $tpl_name,
                        'slug'              => make_slug($tpl_name),
                        'low_res_b'         => $filename,
                        'hi_res_b'          => $filename
                    );  

                    $this->templates->insert($insert);
                    $num_inserted++;

                    $this->db->where('id', $job->id)
                    		 ->update('import_jobs', array('num_inserted' => $num_inserted));
                }
            }
        }

        $this->db->where('id', $job->id)
                 ->update('import_jobs', array(
                 	'status' 	=> 'completed',
                 	'done_ts'	=> mysql_now_date()
        ));

        $this->console_log('Num Inserted: ' . $num_inserted);

        exit(0);
    }

	public function cache_printful_db()
	{
		// echo 'Caching products...';
		// $this->_cache_products();
		// echo 'OK' . PHP_EOL;

		echo 'Caching variants price...';
		$this->_cache_variants();
		echo 'OK' . PHP_EOL;

		echo 'DONE' . PHP_EOL;
	}

	private function _cache_products()
	{
		$products = $this->printful->products();

		if(!$products)
		{
			echo 'Can not recieve products list from printful' . PHP_EOL;
			return FALSE;
		}

		$insert = array();

		foreach($products as $type => $list)
		{
			foreach($list as $product)
			{
				$res = $this->db->where('id', $product->id)
								->get('products')->row();

				if($res)
				{
					$this->db->where('id', $product->id)
							 ->update('products', $product);
				}
				else
				{
					$tmp = $product;
					
					$tmp->files 		= json_encode($tmp->files);
					$tmp->options 		= json_encode($tmp->options);
					$tmp->import_date 	= date('Y-m-d H:i:s');
					$tmp->enabled 		= 0;

					$insert[] = $tmp;
				}
			}
		}

		if($insert)
			$this->db->insert_batch('products', $insert);

		return TRUE;
	}

	private function _cache_variants()
	{
		$products_db 	= $this->db->get('products')->result();
		$size 			= sizeof($products_db);

		$insert = array();

		// echo "\033[5D";

		foreach($products_db as $k => $product)
		{
			// echo 'Product ' . ($k+1) . ' of ' . $size;

			$res = $this->printful->variants($product->id);

			if(!$res['variants'])
			{
				continue;
			}

			foreach($res['variants'] as $variant)
			{
				$variant = (object) $variant;
				
				$res = $this->db->where('id', $variant->id)
								->get('variants')->result();

				if($res)
				{
					$this->db->where('id', $variant->id)
							 ->update('variants', array('price' => $variant->price));
							 // ->update('variants', $variant);
				}
				else
				{
					$insert[] = $variant;
				}
			}
		}

		// if($insert)
		// 	$this->db->insert_batch('variants', $insert);

		return TRUE;
	}

	public function invert()
	{
		if(isPostMethod())
		{
			$filepath 	= $_FILES['img']['tmp_name'];
			$imgsize 	= getimagesize($filepath);

			switch($imgsize[2])
			{
				case IMAGETYPE_JPEG:
				{
					$im = imagecreatefromjpeg($filepath);
				} break;

				case IMAGETYPE_PNG:
				{
					$im = imagecreatefrompng($filepath);
				} break;

				case IMAGETYPE_GIF:
				{
					$im = imagecreatefromgif($filepath);
				} break;

				default:
				{
					echo 'Unknown image type';
					exit;
				}
			}
			
			imagealphablending($im, false);
			imagesavealpha($im, true);

			if($im && imagefilter($im, IMG_FILTER_NEGATE))
			{
				$this->data['inverted'] = random_string('alnum', 8) . '.png';
				

				ob_start();
				imagepng($im);
				$stringdata = ob_get_contents(); // read from buffer
				ob_end_clean(); // delete buffer
				// echo '<img src="data:image/png;base64,' . base64_encode($stringdata) . '" >';exit;
				$this->data['img_inverted'] = base64_encode($stringdata);
				$this->data['img_orig'] 	= base64_encode(file_get_contents($filepath));
			}

		}
		$this->render_tpl('invert_test');
	}

	// function test_email()
	// {
	// 	debug($this->send_email('zhyrny@gmail.com', 'Subject test mail', 'Email body'));
	// }
}