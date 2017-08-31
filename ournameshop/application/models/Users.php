<?php
class Users extends MY_Model
{
	public $before_get 			= array('select_default');
	public $after_get			= array('after_get');

	public function customers()
	{
		$this->db->from('users_groups UG')
				 ->where('UG.user_id = users.id')
				 ->where('UG.group_id', GROUP_ID_CUSTOMER);

		return $this;
	}

	public function with_money()
	{
		$this->db->select('SUM(O.total) as spent, COUNT(O.id) as orders_cnt')
				 ->join(
				 	'orders O', 'O.user_id = users.id AND O.status = ' . ORDER_STATUS_PAID, 'left'
			 	)->group_by('users.id');

		return $this;
	}

	public function with_shop()
	{
		$this->db->select('S.name as shop_name, S.domain as shop_domain, S.custom_domain')
				 ->join(
				 	'shops S', 'S.id = users.shop_id'
			 	);

		return $this;
	}

	protected function select_default()
    {
        $this->db->select($this->_table . '.*');
    }

    protected function after_get($row)
    {
    	if(isset($row->shop_domain))
    	{
    		$row->shop = (object)array(
    			'domain' 			=> $row->shop_domain,
    			'custom_domain'		=> $row->custom_domain
    		);
    	}
    	
    	return $row;
    }
}