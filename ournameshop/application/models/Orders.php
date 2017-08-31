<?php
class Orders extends MY_Model
{
	public $before_create 		= array('before_create');
    public $after_get           = array('after_get');
	public $before_get          = array('select_default');

    // function join_items()
    // {
    //         $this->db->select('
    //                 CI.name                as category,
                   
    //         ')->join('categories CAT', $this->_table . '.category_id = CAT.id');

    //         return $this;
    // }

    protected function select_default()
    {
        $this->db->select($this->_table . '.*');//->from( . ' MT');
    }

	protected function before_create($data)
	{
		$data['create_ts'] = date('Y-m-d H:i:s');
		return $data;
	}

    public function with_shop()
    {
        $this->db->join('carts C', 'C.id = orders.cart_id');
        $this->db->select('S.name as shop_name, S.domain as shop_domain, S.custom_domain')
                 ->join(
                    'shops S', 'S.id = C.shop_id'
                );

        return $this;
    }

    protected function after_get($row)
    {
        if(isset($row->shop_domain))
        {
            $row->shop = (object)array(
                'domain'            => $row->shop_domain,
                'custom_domain'     => $row->custom_domain
            );
        }
        
        return $row;
    }

    public function join_cart()
    {
        $this->db->from('carts C')
                 ->where('orders.cart_id = C.id');
        
        return $this;
    }
}