<?php
class Saved_logo extends MY_Model
{
	public $before_get 			= array('before_get');
	public $after_get 			= array('after_get');

	protected function before_get()
	{
		$this->db->select('saved_logos.*');	
	}

	protected function after_get($row)
	{
		if(!empty($row))
		{
			$row->params 			= json_decode($row->params);
		}

		return $row;
	}

	public function join_variant()
	{
		$this->db->select('V.image');
		$this->db->join('variants V', 'V.id = saved_logos.surface_id');

		return $this;
	}

	public function join_surface()
	{
		$this->db->select(
			'S.css_class, S.slug as surface_slug, S.slug, P.id as product_id, P.image, P.preview_thumb'
		);

		// $this->db->join('variants V', 'V.id = saved_logos.surface_id');

		$this->db->join('products P', 'V.product_id = P.id');

		$this->db->join('surfaces S', 'S.type = P.type');

		return $this;
	}

	public function join_template()
	{
		$this->db->select('T.slug as tpl_slug, L.lastname');

		$this->db->join('templates T', 'T.id = saved_logos.template_id');
		$this->db->join('lastnames L', 'L.id = T.lastname_id');

		return $this;
	}
}