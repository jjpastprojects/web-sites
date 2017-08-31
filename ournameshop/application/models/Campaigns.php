<?php
class Campaigns extends MY_Model
{
	private $ci;

	protected $before_get 	= array('select_default');
	protected $after_get 	= array('after_get');

	public $preview_mode	= FALSE;

	public function __construct()
	{
		parent::__construct();
		$this->ci = &get_instance();
	}	

	public function join_lastname()
	{
		$this->db->select('L.lastname');
		$this->db->join('lastnames L', 'L.id = campaigns.lastname_id');

		return $this;
	}

	public function join_template()
	{
		$this->db->select('T.slug as tpl_slug')
				 ->from('templates T')
				 ->where('T.id = campaigns.template_id');

		return $this;
	}

	public function join_product()
	{
		$this->db->select('S.slug as surface_slug')
				 ->from('products P')
				 ->from('surfaces S')
				 ->where('P.id = campaigns.product_id')
				 ->where('S.type = P.type');

		return $this;
	}

	public function update_num_sales($campaign_id, $q)
	{
		$this->db->set('num_sales', 'num_sales + ' . $q, FALSE);
        $this->update($campaign_id, array());
    }

	protected function select_default()
	{
		$this->db->select('campaigns.*');
	}

	protected function after_get($campaign)
	{
		if(!$campaign)
			return $campaign;

        $campaign->over = strtotime($campaign->till_ts) < time();

        
        return $campaign;
	}
}