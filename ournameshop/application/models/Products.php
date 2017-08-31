<?php
class Products extends MY_Model
{
	public $before_get 			= array('select_default', 'default_where');
	public $after_get 			= array('after_get');
	public $before_count 		= array('default_where');

	protected function default_where()
	{
		if($this->in_admin === FALSE)
			$this->_database->where('products.enabled = 1');
	}

	protected function after_get($obj)
	{
		if($obj && $obj->type == 'EMBROIDERY')
		{
			$obj->options = object_transparent(
				json_decode($obj->options), 'id', TRUE
			);
		}
		
		return $obj;
	}

	public function update_num_views($product_id, $increment = 1)
	{
		$this->increment_counter($product_id, 'num_views', $increment);
	}

	public function update_num_sales($product_id, $increment = 1)
	{
		$this->increment_counter($product_id, 'num_sales', $increment);
	}

	public function join_surfaces()
	{
		$this->db->select('S.css_class, S.slug as surface_slug, S.default_product');
		$this->db->join('surfaces S', 'S.printful_type = products.type');

		return $this;
	}

	protected function select_default()
    {
        $this->db->select($this->_table . '.*');
    }

	private function increment_counter($product_id, $counter, $increment)
	{
		$this->db->set($counter, $counter . ' + ' . $increment, FALSE);
		$this->update($product_id, array());
	}
}