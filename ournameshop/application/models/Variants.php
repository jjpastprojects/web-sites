<?php
class Variants extends MY_Model
{
	public $before_get          = array('select_default', 'only_active');
	public $after_get 			= array('after_get');

	public $template;

	// public function __construct()
	// {
	// 	$this->ci = &get_instance();
	// }

	public function join_product()
	{
		$this->db->select('P.type')
				 ->join('products P', 'P.id = variants.product_id');

		return $this;
	}

	// public function join_surface()
	// {
	// 	$this->db->select('S.slug as surface_slug');
	// 	$this->db->join('surfaces S', 'S.type = variants.type');

	// 	return $this;
	// }

	protected function select_default()
    {
        $this->db->select($this->_table . '.*');
    }

    protected function only_active()
	{
		if($this->in_admin === FALSE)
			$this->_database->where($this->_table . '.active', 1);
	}

	public function after_get($data)
	{
		if(isset($data->type))
		{
			$surface = $this->config->item($data->type, 'surfaces');
			
			if(!$surface)
				return NULL;

			$ci 			= &get_instance();
			$data->profit 	= 0;
			
			if(!empty($ci->data['shop']->options['income_type']))
			{
				if($ci->data['shop']->options['income_type']->option_value == 'fixed')
				{
					$data->profit = $ci->data['shop']->options['income']->option_value;
				}
				elseif($ci->data['shop']->options['income_type']->option_value == 'percentage')
				{
					$data->profit = $data->price * ($ci->data['shop']->options['income']->option_value / 100);
				}

				$data->price += $data->profit;
			}
			
			if(isset($data->folder_price))
			{
				$data->profit 	+= $data->folder_price;
				$data->price 	+= $data->folder_price;
			}

			$data->price += $surface->extra_price;	
		}
		
		return $data;
	}

	public function join_folder($folder_id)
	{
		$this->db->select('LF.price as folder_price');
		$this->db->join('logo_folders LF', 'LF.id = ' . $folder_id);
		return $this;
	}
}