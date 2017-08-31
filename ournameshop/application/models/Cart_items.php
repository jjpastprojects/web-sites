<?php
class Cart_Items extends MY_Model
{
	public $before_create 		= array('before_create');
	
	public $before_get          = array('select_default');

	public $after_get          	= array('after_get');

	private $ci;

	public function __construct()
	{
		parent::__construct();
		$this->ci = &get_instance();
	}

	protected function before_create($data)
	{
		$data['create_ts'] = date('Y-m-d H:i:s');
		return $data;
	}

	protected function select_default()
    {
        $this->db->select($this->_table . '.*');
    }

    public function after_get($data)
    {	
    	if(!$data)
    		return $data;
    	// if(isset($data->surface_name))
    	// {
	    // 	$data->surface = new stdClass();
	    // 	$data->surface->name = $data->surface_name;
	    // 	$data->surface->slug = $data->surface_slug;
	    // }

	    if(isset($data->template_name))
	    {
	    	$data->template = new stdClass();
    	
	    	$data->template->name 		= $data->template_name;
	    	$data->template->slug 		= $data->template_slug;
	    	$data->template->price 		= $data->template_price;
	    	$data->template->folder_id 	= $data->folder_id;
	    	
	    	// $data->template->low_res_w 	= $data->low_res_w;
	    	$data->template->low_res_b 	= $data->low_res_b;
	    	$data->template->hi_res_b 	= $data->hi_res_b;

	    	// $data->template->low_res_w 	= $data->low_res_w;
	    	

	    	// $data->template->category_name 		= $data->tpl_category_name;
	    	// $data->template->category_slug 		= $data->tpl_category_slug;
	    	// $data->template->bucket_folder 		= $data->bucket_folder;
	    	// $data->template->bucket_sub_folder 	= $data->bucket_sub_folder;
	    }
    	

    	$data->params = json_decode($data->params);

    	if(isset($data->product_id))
    	{
    		$data->product = new stdClass();
    		$data->product->id = $data->product_id;
    	}

    	$data->surface 	= new stdClass();
    	$data->surface 	= $this->ci->config->item($data->product_type, 'surfaces');

    	unset(
    		$data->surface_name, $data->surface_slug,
    		$data->template_name, $data->template_slug, $data->template_price,
    		$data->tpl_category_slug, $data->tpl_category_name, $data->low_res_w,
    		$data->low_res_b
    	);
    	
    	return $data;
    }

	public function my()
	{
		// $cart_id = $this->ci->carts->current_id();

		return $this->join_templates()->get_many_by(array(
			'cart_id'	=> $this->ci->cart_id
		));
	}

	public function count_my()
	{
		$cart_id = $this->ci->cart_id;
		
		return intval($this->db->select('SUM(q) as count_items')
				 ->where(array(
			'cart_id'	=> $cart_id
		))->get($this->_table)->row()->count_items);
	}

	public function by_cart($cart_id)
	{
		return $this->join_templates()->get_many_by(array(
			'cart_id'	=> $cart_id
		));	
	}

	public function join_surfaces()
	{
		$this->db->join('variants V', $this->_table . '.surface_id = V.id');
		$this->db->join('products P', 'V.product_id = P.id');
		// $this->db->join('surfaces S', 'S.product_id = P.id');

		$this->db->select('V.pa_product_id, pa_brand_id, pa_color_id, pa_size_id,
            P.type as product_type, P.id as product_id
        ');

        return $this;
	}

	public function join_templates()
	{
		$this->db->select('
                T.name                as template_name,
                T.slug                as template_slug,
                F.price 			  as template_price,
                T.low_res_w			  as low_res_w,
                T.low_res_b			  as low_res_b,
                T.hi_res_w			  as hi_res_w,
                T.hi_res_b			  as hi_res_b,
                T.bucket_sub_folder,
                T.folder_id
                
        ');

		$this->db->join('templates T', $this->_table . '.tpl_id = T.id');
        // $this->db->join('categories CAT', 'T.category_id = CAT.id');
        $this->db->from('logo_folders F')
        		 ->where('F.id = T.folder_id');

		

        // CAT.name              as tpl_category_name,
        // CAT.slug              as tpl_category_slug,
        // CAT.bucket_folder

        return $this;
	}

	public function join_lastnames()
	{
		$this->db->join('lastnames L', $this->_table . '.lastname_id = L.id');

		$this->db->select('
                L.lastname            as lastname
        ');

        return $this;
	}
}
