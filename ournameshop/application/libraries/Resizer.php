<?php

require_once(APPPATH . 'libraries/library.php');

Class Resizer extends Library {

	protected $text;
	protected $font 					= 'AngillaTattoo';
	protected $font_color 				= '#000';

	protected $template;
	protected $variant;

	protected $image;

	protected $tmp_path;

	protected $size_prefix 				= 'print_';


	protected $text_margin_top 			= 50;

	protected $random_name_length 		= 10;

	protected $node_output;

	protected $gravity 					= 'center';

	protected $node_canvas_sizes;

	public function __construct()
	{
		parent::__construct();
	}

	public function set_text($text)
	{
		$this->text = trim(str_replace('<br>', PHP_EOL, $text));
		return $this;
	}

	public function set_font($font)
	{
		$this->font = $font;
		return $this;
	}

	public function set_font_color($color)
	{
		$this->font_color = $color;
		return $this;
	}

	public function set_size_prefix($prefix)
	{
		$this->size_prefix = $prefix . '_';
		return $this;
	}

	public function set_template($tpl_id)
	{
		$this->template = $this->ci->templates->join_category()->get_by(
			'templates.id', $tpl_id
		);

		if(!$this->template)
		{
			$this->set_error('template not found');
			return FALSE;
		}

		$this->tmp_path = '/tmp/' . random_string('alnum', 10);
		
		write_file(
			$this->tmp_path, file_get_contents(tpl_thumb(
					$this->template, 'hi-res', 'cloudfront'
				)
			)
		);

		return $this;
	}

	public function set_variant($variant)
	{
		$this->variant = $variant;

		return $this;
	}

	public function set_gravity($gravity)
	{
		$this->gravity = $gravity;
	}

	public function set_node_canvas_sizes($sizes)
	{
		$this->node_canvas_sizes = json_encode($sizes);

		return $this;
	}


	public function add_text_to_logo()
	{
		if(!$this->template)
		{
			$this->set_error('template not set');
			return false;
		}
		
		$font 	= $this->ci->config->item(
			$this->font, 'print_fonts'
		);		

		

		list($w, $h) = getimagesize($this->tmp_path);

		if($font)
		{
			$font_path = $this->ci->config->item('print_fonts_path') . $font['file'];


 			$this->text_arr = array_map('trim', explode(PHP_EOL, $this->text));
 			$caption_lines 	= sizeof($this->text_arr); //ceil($str_width / $caption_width);
 			
 			$caption_height	= ($font[$this->size_prefix . 'size'] * $caption_lines);// + $font[$this->size_prefix . 'size'];
		}

		$commands 		= array();
		$commands[] 	= '/usr/bin/convert ' . $this->tmp_path . ' -background none -gravity north';

		$extent_height 	= ($h - $this->get_bottom_offset() + $this->text_margin_top)
						+ $caption_height; //(($font[$this->size_prefix . 'size'] * $caption_lines) /** 1.2*/);


		$commands[]		= '-extent ' . $w . 'x' . $extent_height . ' - 2> /tmp/convert.log |';
	


		$first_line_y 	= isset($this->text_arr[1]) ? $font[$this->size_prefix . 'size'] : 0;

		$commands[] 	= '/usr/bin/convert - -gravity south -fill "' . $this->font_color . '"';
		$commands[]		= '-pointsize ' . $font[$this->size_prefix . 'size'];
		$commands[]		= '-font ' . $font_path;
		$commands[]		= '-draw "text 0, ' . $first_line_y . ' ' . $this->ci->db->escape($this->text_arr[0]) . '"';

		if(isset($this->text_arr[1]))
		{
			$commands[] 	= '- |';

			$commands[] 	= '/usr/bin/convert - -gravity south -fill "' . $this->font_color . '"';
			$commands[]		= '-pointsize ' . $font[$this->size_prefix . 'size'];
			$commands[]		= '-font ' . $font_path;
			$commands[]		= '-draw "text 0,0 ' . $this->ci->db->escape($this->text_arr[1]) . '"';
		}

		$filename 		= random_string('alnum', 10) . '.png';
		$commands[] 	= $this->tmp_path;

		
		$commands[]		= '2> /tmp/convert.log';
		system(implode(' ', $commands), $ret);
		
		if($ret)
		{
			$this->set_error(file_get_contents('/tmp/convert.log'));
			return FALSE;
		}

		return $this;
	}

	public function resize_to_bounds()
	{
		list($w, $h) 					= getimagesize($this->tmp_path);
		list($surface_w, $surface_h) 	= explode('x', $this->variant->dimensions);
		
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
		
		$command = '/usr/bin/convert ' . $this->tmp_path . ' -background none -gravity ' . $this->gravity . ' -extent ' . 
					$w . 'x' . $h . ' ' . $this->tmp_path . ' 2> /tmp/printful_converter_err.log';
					
		system($command, $ret);

		if($ret)
		{
			$this->set_error('Can not extent image');
			
		}
			
		return $this;
	}

	/* Using node.js canvas and fabric.js library for node.js to build hi-res logo*/

	public function build_from_canvas($params)
	{
		$command = array(
			'cd ./nodejs/',
			'/usr/local/bin/node builder.js ' . base64_encode($params) . ' ' . $this->tmp_path . ' ' .
			'\'' . $this->node_canvas_sizes . '\''
		);

		$new_tmp_name 		= exec(implode(' && ', $command), $output);
		
		$this->node_output 	= $output;

		if(!$new_tmp_name)
		{
			$this->set_error('node js builder failed');
			return FALSE;
		}

		$this->set_tmp_name($new_tmp_name);	

		return $this;
	}

	public function get_tmp_path()
	{
		return $this->tmp_path;
	}

	public function set_tmp_name($name)
	{
		$this->tmp_path = '/tmp/' . $name;
		return $this;
	}

	public function get_node_output()
	{
		return $this->node_output;
	}
	public function get_bottom_offset($template = FALSE)
	{	
		if($template)
			$this->template = $template;

		$this->offsets = array(
			'eagles' => array(
				'left' => 500, 'bottom' => 81
			),

			'trees' => array(
				'left' => 60, 'bottom' => 265
			),

			'crest1' => array(
				'left' => FALSE, 'bottom' => 80	
			),

			'crest3' => array(
				'left' => FALSE, 'bottom' => 130	
			),

			'crest5' => array(
				'left' => FALSE, 'bottom' => 195
			),

			'crest6' => array(
				'left' => FALSE, 'bottom' => 55
			),

			'crest7' => array(
				'left' => FALSE, 'bottom' => 40
			),
		);

		$key = !empty($this->template->bucket_sub_folder) ? $this->template->bucket_sub_folder 
		: $this->template->category_slug;

		return $this->offsets[$key]['bottom'];
	}

	public function resize($w, $h = FALSE)
	{
		$command = 'convert ' . $this->tmp_path . ' -resize ' . $w . 'x' . $h . ' -quality 9 ' . $this->tmp_path;
		
		system($command, $ret);
		
		if($ret)
		{
			$this->set_error(file_get_contents('/tmp/convert.log'));
			return FALSE;
		}

		return $this;
	}

	public function save($path, $filename = FALSE)
	{
		if(!$filename)
			$filename = random_string('alnum', $this->random_name_length) . '.png';

		if(copy($this->tmp_path, $path . $filename))
		{
			return $filename;
		}
		else
		{
			$this->set_error('error coping file');
			return FALSE;
		}
	}

	public function output_image()
	{
		header('Content-type: image/png');
		echo file_get_contents($this->tmp_path);
		
		exit;
	}

	public function test_anno()
	{
		define("LEFT", 1);
	   define("CENTER", 2);
	   define("RIGHT", 3);

	   $w = 700;
	   $h = 200;
	   $gradient = new Imagick();
	   $gradient->newPseudoImage($w, $h, "gradient:white-white");

	   $draw = new ImagickDraw();
	   $draw->setFontSize(80);
	   $draw->setFillColor(new ImagickPixel("#000000"));
	   $draw->setTextAlignment(CENTER);
	   $draw->annotation($w/2, 100, "Hello World2! Hello World2!");
	   // $draw->setTextAlignment(RIGHT);

	   $gradient->drawImage($draw);

	   $gradient->setImageFormat("png");
	   header("Content-Type: image/png");
	   echo $gradient;
	}


	public function change_hue($hue)
	{
		$img = new Imagick($this->tmp_path);

		
		$imagick_hue 	= -100 + ($hue * 2);

		$img->modulateImage(100, 100, $imagick_hue);
		$img->writeImage($this->tmp_path);

		return $this;
		

		header('Content-type: image/png');
		echo $img;
		exit;
	}

	public function change_color($color)
	{
		if(!$this->template)
		{
			$this->set_error('template not set');
			return FALSE;
		}

		
		$command[] = '/usr/bin/convert ' . $this->tmp_path . ' -fuzz 100%  -fill "' . $color . '" -opaque black ' . $this->tmp_path;
		
		system(implode(' ', $command), $ret);

		if($ret)
		{
			$this->set_error('Can not change color of image');
		}

		return $this;
	}

}