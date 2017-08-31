<?php
class Lnames extends MY_Model
{
	public $_table 			= 'lastnames';

	public $before_get 		= array('select_default');

	protected function select_default()
    {
        $this->db->select($this->_table . '.*');
    }

	public function with_template()
	{
		$this->_database->join('templates T', 'T.lastname_id = lastnames.id');
		$this->group_by('lastnames.id');

		return $this;
	}

	
}