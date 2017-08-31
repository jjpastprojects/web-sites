<?php
class Surfaces extends MY_Model
{
	public $before_get = array('select_default', 'only_active');

	protected function select_default()
    {
        $this->db->select($this->_table . '.*');
    }
    
	protected function only_active()
	{
		if($this->in_admin === FALSE)
			$this->_database->where($this->_table . '.active', 1);
	}

	public function join_default_product()
	{
		$this->_database->select('P.model as product_name')
			 ->join(
				'products P', 'P.id = surfaces.default_product', 'left'
			);

		return $this;
	}
}