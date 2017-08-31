<?php

class Print_designer extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['template']		= $this->templates->join_category()
										   ->get_by(array('templates.id' => $this->input->get('tpl_id')));

		$this->load->view('print_designer/index', $this->data);
	}

	public function save_print()
	{
		$this->data['template']		= $this->templates->join_category()
										   ->get_by(array('templates.id' => $this->input->post('tpl_id')));

		if(!$this->data['template'])
			json_reply(FALSE, 'template not found');

		$img_photo 	= imagecreatefromstring(
			base64_decode(preg_replace('/data\:image\/(\w+);base64\,/', '', $this->input->post('image')))
		);

		$img_logo 	= imagecreatefrompng('./' . tpl_thumb($this->data['template'], 'hi_res_b'));
		imagesavealpha($img_logo, TRUE);

		$logo_width 		= $this->input->post('designer_width');//470;
		$logo_height 		= $this->input->post('designer_height');//361
		
		$image_width 		= $this->input->post('width');
		$image_height 		= $this->input->post('height');

		$ratio = round(imagesx($img_photo) / $image_width, 2);
		
		$src_x = abs($this->input->post('left')) * $ratio;
		$src_y = abs($this->input->post('top')) * $ratio;
		
		$dst_x = 0;
		$dst_y = 0;

		$src_w = (imagesx($img_photo) - (($image_width - $logo_width) * $ratio));
		$src_h = (imagesy($img_photo) - (($image_height - $logo_height) * $ratio));

		$dst_w = $src_w;
		$dst_h = $src_h;

		$img_dest = imagecreatetruecolor($dst_w, $dst_h);

		imagecopyresampled(
			$img_dest, $img_photo, $dst_x, $dst_y, $src_x, $src_y, 
			$dst_w, $dst_h, $src_w, $src_h
		);

		$frame_resized = imagecreatetruecolor($dst_w, $dst_h);
		
		imagesavealpha($frame_resized, TRUE);
    	
    	imagefill(
    		$frame_resized, 0, 0, imagecolorallocatealpha($frame_resized, 0, 0, 0, 127)
		);

		imagecopyresampled(
			$frame_resized, $img_logo, 0, 0, 0, 0, 
			$dst_w, $dst_h,

			imagesx($img_logo), imagesy($img_logo)
		);

		imagecopyresampled(
			$img_dest, $frame_resized, 0, 0, 0, 0, 
			$dst_w, $dst_h,

			imagesx($frame_resized), imagesy($frame_resized)
		);	
		
		$filename = random_string('alnum', 10) . '.png';
		imagepng($img_dest, $this->config->item('path', 'print_preview') . $filename);
		

		json_reply(TRUE, '', array(
			'image_url' => $this->config->item('url_path', 'print_preview') . $filename,
			'filename'	=> $filename
		));
	}

	public function text_designer_popup()
	{
		$this->load->view('print_designer/text_designer_popup');
	}

	public function text_preview()
	{
		if(!$this->resizer->set_template($this->input->post('tpl_id')))
			json_reply(FALSE, $this->resizer->errors());

		
		$filename = $this->resizer->set_font($this->input->post('family'))
				  		->set_font_color($this->input->post('color'))
				  		->set_text($this->input->post('text'))
				  		->add_text_to_logo()
				  		->resize(300, 300)
				  		->save($this->config->item('path', 'print_preview'));

		if($filename)
		{
			json_reply(TRUE, '', array(
				'filename'	=> $filename,
				'image_url' => $this->config->item('url_path', 'print_preview') . $filename
			));
		}	
		else
		{
			json_reply(FALSE, 'Sorry cat not create preview');
		}
		// $template = $this->templates->join_category()->get_by('templates.id',
		// 	$this->input->post('tpl_id')
		// );

		// if(!$template)
		// 	json_reply(FALSE, 'template not found');

		// $text 	= trim(str_replace('<br>', PHP_EOL, $this->input->post('text')));
		// $color 	= $this->input->post('color');
		
		// $font 	= $this->config->item(
		// 	$this->input->post('family'), 'print_fonts'
		// );

		// $command = '/usr/bin/convert ' . tpl_thumb($template, 'lo-res') . ' -background none ';
		
		

		// if($font)
		// {
		// 	$command .= '-font ' . $this->config->item('print_fonts_path') . $font['file'];
		// 	$command .= ' -pointsize ' . $font['preview_size'] . ' ';
		// }

		// $command .= '-fill "' . $color . '" ';
		// $command .= 'label:"' . $text . '" ';

		// $command .= '-gravity center -size 100x100 -append ';

		// $filename = random_string('alnum', 10) . '.png';
		// $command .= $this->config->item('path', 'print_preview') . $filename;
		

		//
		$tmp = '/tmp/' . random_string('alnum', 10);

		$this->load->helper('file');
		
		write_file(
			$tmp, file_get_contents(tpl_thumb($template, 'lo-res'))
		);

		list($w, $h) = getimagesize($tmp);

		$command = '/usr/bin/convert ' . $tmp . ' -background none -gravity north ';

		if($font)
		{
			$font_path = $this->config->item('print_fonts_path') . $font['file'];

			$str_lines 	= 0;
			$str_width 	= 0;

			$strlen 	= strlen($text);

			for ($i = 0; $i < $strlen; $i++)
			{
    			$dimensions = imagettfbbox($font['preview_size'], 0, $font_path, $text[$i]);
    			$str_width += $dimensions[2];
 			}

 			$caption_width 	= $w - 100;
 			$caption_lines 	= round($str_width / $caption_width);
 			$caption_height	= ($font['preview_size'] * $caption_lines) + $font['preview_size'];
		}

		$extent_height = $h + (($font['preview_size'] * $caption_lines) * 1.2);

		if($template->category_slug == 'trees')
			$extent_height -= 30;

		$command .= '-extent ' . $w . 'x' . $extent_height . ' - 2> /tmp/convert.log | ';
		

		$command .= '/usr/bin/convert -background none ';
		$command .= '-font ' . $font_path;
		$command .= ' -pointsize ' . $font['preview_size'] . ' ';
		$command .= '-gravity center -size ' . $caption_width . 'x' . $caption_height . ' ';
		
		$command .= '-fill "' . $color . '" ';
		
		$command .= 'caption:"' . $text . '" - +swap -gravity south -composite ';

		$filename = random_string('alnum', 10) . '.png';
		$command .= $this->config->item('path', 'print_preview') . $filename;
		$command .= ' 2> /tmp/convert.log';
		
		system($command, $ret);
		
		json_reply(TRUE, '', array(
			'status'	=> $ret,
			'filename'	=> $filename,
			'image_url' => $this->config->item('url_path', 'print_preview') . $filename
		));
	}
}