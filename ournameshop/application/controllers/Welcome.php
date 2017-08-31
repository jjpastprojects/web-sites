<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function terms()
	{
		$this->addTitle('Privacy & Conditions');
		$this->render_tpl('pages/terms');
	}

	public function privacy()
	{
		$this->addTitle('Privacy Policy');
		$this->render_tpl('pages/privacy');
	}

	

	public function parse_names()
	{
		// $this->load->library('curl');
		exit;
		$url = 'http://names.mongabay.com/data/';

		require(APPPATH . 'libraries/simple_html_dom.php');

		for($i = 1000; $i <= 49000; $i += 1000)
		{
			$curl_url = $url . "$i.html";
			
			$html = file_get_html($curl_url);
			
			foreach($html->find('table.boldtable tr') as $k => $tr)
			{
				if(!$k)
					continue;

				$lastname = ucfirst(trim(mb_strtolower($tr->find('td', 0)->innertext)));

				$this->db->insert('lastnames', array('lastname' => $lastname));


			}

			
			// debug($this->curl->_simple_call('get', $curl_url));
			// exit;



		}

		debug('DONE');
			exit;
		
	}

	function parse_drugs()
	{
		ini_set('display_errors', 1);
		echo __METHOD__; exit;
		require(APPPATH . 'libraries/simple_html_dom.php');

		$site_url = 'http://likitoriya.com';

		// $html = file_get_html($site_url);

		$data 		= $this->db->get('liki_cats')->result();
		$per_page 	= 100;

		foreach($data as $section)
		{
			
			preg_match('/atc\-\-([A-Z])\.htm/', $section->href, $matches);

			$letter = $matches[1];

			$res = explode('.', $section->href);

			

		
			$url = $res[0] . '--0--100.htm';

			$html = file_get_html($site_url . $url);
	
			$pager = $html->find('table.navigator a');

			$last_page = end($pager)->href;
		
			preg_match('/\-\-(\d+)\-\-/', $last_page, $matches);
			
			if($matches)
			{
				$num_pages = ceil($matches[1] / $per_page);
				
				for($i = 0; $i < $num_pages; $i++)
				{
					$url = $site_url . '/catalog/atc--' . $letter . '--' . $i * $per_page . '--100.htm';

					$page_html = file_get_html($url);

					foreach($page_html->find('table.cat_item_table a.i_name') as $anchor)
					{
						$product_html = file_get_html($site_url . $anchor->href);

						$tds = $product_html->find('table.item_opt_table2 td.opt_val_td');
						$instruct = $product_html->find('#instruct');

						$insert = array(
							'title'			=> $anchor->text(),
							'category'		=> $tds[1]->text(),
							'package_type'	=> $tds[2]->text(),
							'manufacturer'	=> $tds[4]->text(),
							'instruction'	=> $instruct[0]->outertext

						);

						$this->db->insert('liki_products', $insert);
						// foreach($product_html->find('table.item_opt_table2 td.opt_val_td') as $k => $td)
						// {
						// 	debug($td->text(), $k);

						// 	$insert = array(
						// 		'category'
						// 	);
						// }

						// $insert = array(
						// 	'category' 			=> current(current($product_html->find('td', 1))->find('a'))->text()
						// 	// 'package_type'		=> current($product_html->find('td.opt_val_td a'))->text()
						// );
						// debug($insert);
					}
					
				}
			}

			// foreach( as $lnk)
			// {
			// 	debug($lnk->href);
			// }
			// debug($url);
			exit;

		}
		//****************************************parase cats
		// foreach($html->find('ul.leftmenu_list a') as $element)
		// {
		// 	$this->db->insert('liki_cats', array(
		// 		'href'		=> $element->href,
		// 		'name'		=> $element->text()
		// 	));
		// }

		// debug('done');
		//****************************************

	}
}
