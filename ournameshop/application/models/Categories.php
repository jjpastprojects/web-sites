<?php
class Categories extends MY_Model
{
	public $ci;

	public $before_get = array('before_get');

	public function __construct()
	{
		parent::__construct();
		$this->ci = &get_instance();
	}

	public function before_get()
	{
		if(!$this->in_admin)
		{
			if(!empty($this->ci->data['shop']->options['enabled_cats']->option_value))
			{
				$this->_database->where_in(
					'categories.id', $this->ci->data['shop']->options['enabled_cats']->option_value
				);	
			}
			
		}
		
		return $this;
	}

	public function root()
	{
		$this->_database->where('parent_id', 0);
		return $this;
	}

	public function join_folder_cats()
	{
		$this->db->from('folder_cats FC')
				 // ->where('FC.folder_id', $folder_id)
				 ->where('categories.id = FC.cat_id');

		return $this;
	}

	public function tree()
	{
		$data = $this->order_by('parent_id', 'asc')->get_all();

		if(!$data)
			return FALSE;

		$data 	= object_transparent($data, 'parent_id');
		
		$roots 	= current($data);

		foreach($roots as &$c)
		{
			if(isset($data[$c->id]))
			{
				$c->children = $data[$c->id];
			}
			else
			{
				$c->children = array();
			}
		}

		usort($roots, function($a, $b)
		{
		    return strcmp($a->name, $b->name);
		});
		
		return $roots;
	}
}