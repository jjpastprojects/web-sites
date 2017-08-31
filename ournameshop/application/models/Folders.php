<?php
class Folders extends MY_Model
{
    public $before_get                      = array('select_default');
    protected $_table                       = 'logo_folders';

    public $ci;

    public function __construct()
    {
        parent::__construct();
        $this->ci = &get_instance();
    }

    protected function select_default()
    {
        $this->db->select($this->_table . '.*');
    }

    public function count_templates()
    {
        $this->_database->select('COUNT(T.id) as tpl_cnt')
                        ->join('templates T', 'T.folder_id = logo_folders.id', 'left')
                        ->group_by('logo_folders.id');

        return $this;
    }
    //Cezar
    public function get_logo_folder_path ($folder_id) {
        $this->db->select();
        $this->db->from($this->_table);
        $this->db->where("id = " . $folder_id);

        $query = $this->db->get();
        return $query->result();
    }
    //Cezar_END
    public function assign_cats($folder_id, $cats)
    {
        $this->db->where('folder_id', $folder_id)
                 ->delete('folder_cats');

        $insert = array();

        foreach($cats as $c)
        {
            if($c)
                $insert[] = array('folder_id' => $folder_id, 'cat_id' => $c);
        }

        if($insert)
            $this->db->insert_batch('folder_cats', $insert);
    }

    public function inject_cats($folders)
    {
        $f_ids = array();

        foreach($folders as $f)
        {
            $f_ids[] = $f->id;
        }

        $cats = $this->categories->join_folder_cats()->get_many_by(array(
            'folder_id'     => $f_ids
        ));

        if($cats)
        {
            $cats = object_transparent($cats, 'folder_id');
        }

        foreach($folders as &$f)
        {
            if(isset($cats[$f->id]))
            {
                $f->cats = $cats[$f->id];
            }
            else
            {
                $f->cats = array();
            }
        }

        return $folders;
    }
}

