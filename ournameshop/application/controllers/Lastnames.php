<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lastnames extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->lnames->limit = 102;
	}

	public function index()
	{
		return $this->lastnames();
	}	

	public function lastnames()
	{
        $where = array('has_logo' => 1);

        $this->data['letter']= mb_strlen($this->uri->segment(2)) == 1 ? $this->uri->segment(2) : NULL;
        
        if(preg_match('/[A-Z]/', $this->data['letter']))
        	$where[] = 'SUBSTR(lastname, 1, 1) = ' . $this->db->escape($this->data['letter']);
        
        $this->data['order_field']    = 'lastname';
        $this->data['order_dir']      = 'asc';

        $this->data['lastnames'] = $this->lnames->with_template()->order_by(
            $this->data['order_field'], $this->data['order_dir']
        )->get_many_by($where);

        $this->data['count']     = $this->lnames->count_by($where);
        
        
        create_pagination(
            'lastnames' . ($this->data['letter'] ? '/' . $this->data['letter'] : ''),
            $this->data['count'],
            $this->lnames->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

        $this->addTitle('Lastnames');
        $this->render_tpl('lastnames/lastnames');
	}

    public function request_lastname()
    {
        $this->data['lname'] = strip_tags($this->input->post('lastname'));

        $res = $this->lnames->get_by(array(
            'lastname'  => $this->data['lname'],
            'has_logo'  => 1
        ));

        if($res)
            json_reply(FALSE, 'Lastname already exists');

        $res = $this->lname_requests->get_by(
            'lastname', $this->data['lname']
        );

        if($res)
            json_reply(FALSE, 'Request for this lastname alreay exists');

        $this->data['email']        = $this->input->post('email');
        $this->data['firstname']    = $this->input->post('firstname');

        $this->lname_requests->insert(array(
            'lastname'      => $this->data['lname'],
            'firstname'     => $this->input->post('firstname'),
            'email'         => $this->input->post('email'),
            'create_ts'     => date('Y-m-d H:i:s')
        ));

        $this->send_email_template(
            $this->config->item('admin_email'),
            $this->data['lname'] . ' Lastname Request',
            'admin_notify_new_lastname_request',
            $this->data
        );

        json_reply();
    }

    public function insert_logos()
    {

        show_404();
        exit;
        $logos          = glob('/home/lastnamecompany/familynamestore/crest7/hi-res/*');
        $category_id    = 2;


        foreach($logos as $k => $logo)
        {
            $filename   = pathinfo($logo, PATHINFO_BASENAME);
            $lname      = current(explode('.', $filename));

            $lastname = $this->lnames->get_by('lastname', $lname);

            if($lastname)
            {
                $name = 'Crest 7 / ' . ++$k;

                $this->templates->insert(array(
                    'lastname_id'       => $lastname->id,
                    'category_id'       => $category_id,
                    'name'              => $name,
                    'slug'              => make_slug($name),
                    'hi_res_b'          => $filename,
                    'low_res_b'         => $filename,
                    'bucket_sub_folder'     => 'crest7'
                ));
            }
            else
            {
                debug($lname, 'NOT FOUND');
            }
        }

        debug('DONE');
        exit;

    }


}
