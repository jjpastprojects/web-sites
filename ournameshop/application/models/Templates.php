<?php
class Templates extends MY_Model
{
    public $before_get                      = array('select_default', 'filter_shop_cats');
    public $before_count                    = array('filter_shop_cats_for_count');

    public $after_get                       = array('after_get');

    public $ci;

    public function __construct()
    {
        parent::__construct();
        $this->ci = &get_instance();
    }

    public function join_index_slider()
    {
        $this->_database->from('index_slider IS');
        return $this;
    }

    function join_category2()
    {
        $this->db->select('
                CAT.name                as category,
                CAT.slug                as category_slug,
                F.name as f_name, F.dir, F.hi_res_dir, F.lo_res_dir, F.price
        ')->from('categories CAT')
          ->from('folder_cats FC')
          ->from('logo_folders F')
          ->where('FC.cat_id = CAT.id')
          ->where('F.id = templates.folder_id')
          ->where('FC.folder_id = templates.folder_id')
          ->group_by('templates.id');

        return $this;
    }

    function join_category()
    {
        $this->db->select('
                CAT.name                as category,
                CAT.slug                as category_slug,
                F.name as f_name, F.dir, F.hi_res_dir, F.lo_res_dir, F.price
        ')
        ->join('folder_cats FC', 'FC.folder_id = templates.folder_id', 'left')
        ->join('categories CAT', 'FC.cat_id = CAT.id', 'left')
          
          ->from('logo_folders F')
          // ->where('FC.cat_id = CAT.id')
          ->where('F.id = templates.folder_id');
          // ->where('FC.folder_id = templates.folder_id')
          // ->group_by('templates.id');
          
        return $this;
    }

    function join_lastname()
    {
        $this->db->select('
                L.lastname               
                
        ')->join('lastnames L', $this->_table . '.lastname_id = L.id');

        return $this;
    }

    protected function select_default()
    {
        $this->db->select($this->_table . '.*');//->from( . ' MT');
    }

    protected function after_get($obj)
    {
        if(!$obj)
            return $obj;

        $obj->monochromic = bits($obj->options, TEMPLATE_OPTION_MONOCHROME);

        return $obj;
    }

    protected function filter_shop_cats()
    {
        return;
        if(!$this->in_admin)
        {
            if(!empty($this->ci->data['shop']->options['enabled_cats']->option_value))
            {
                $this->_database->where_in(
                    'CAT.id', $this->ci->data['shop']->options['enabled_cats']->option_value
                );
            }
        }
    }

    protected function filter_shop_cats_for_count()
    {
        if(!$this->in_admin)
        {
            if(!empty($this->ci->data['shop']->options['enabled_cats']->option_value))
            {
                $this->_database->where_in(
                    'category_id', $this->ci->data['shop']->options['enabled_cats']->option_value
                );
            }
        }
    }

    public function update_num_views($id, $increment = 1)
    {
        $this->increment_counter($id, 'num_views', $increment);
    }

    public function update_num_sales($id, $increment = 1)
    {
        $this->increment_counter($id, 'num_sales', $increment);
    }

    private function increment_counter($id, $counter, $increment)
    {
        $this->db->set($counter, $counter . ' + ' . $increment, FALSE);
        $this->update($id, array());
    }

    public function enabled()
    {
        $this->_database->where('enabled', 1);
        return $this;
    }

    public function featured()
    {
        $this->_database->where('featured', 1);
        return $this;
    }

    public function join_def_comb()
    {
        $this->_database->select('SL.params as canvas_params, SL.id as has_def_comb');
        $this->_database->join('saved_logos SL', 'SL.folder_id = templates.folder_id AND SL.def_comb = 1', 'left');

        return $this;
    }
}

