<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_Controller extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('America/Los_Angeles');
        
        $this->load->library('session');
        $this->_assign_shop();

        // $this->output->enable_profiler(TRUE);
        $this->template->set_master_template('main_template');
        $this->cart_id = $this->carts->current_id();

        $this->data['cart_items_cnt']   = $this->cart_items->count_my();
        

        $this->user_id = $this->session->userdata('user_id');

        $this->data['fav_items_cnt'] = 0;
        
        if($this->ion_auth->logged_in())
        {
            $this->data['user']             = $this->users->get($this->user_id);
            $this->data['fav_items_cnt']    = $this->saved_logo->count_by(array('user_id' => $this->user_id));

        }
        
        $this->_set_config_items();
    }

    private function _set_config_items()
    {
        $surfaces = $this->surfaces->get_all();
        
        $this->config->set_item(
            'surfaces', object_transparent($surfaces, 'type', TRUE)
        );

        $this->config->set_item(
            'print_fonts', json_decode(file_get_contents(APPPATH . 'config/print_designer.json'), TRUE)
        );

        $options = $this->db->get_where(
            'shop_options', array('shop_id' => $this->data['shop']->id)
        )->result();

        

        foreach($options as $option)
        {
            if($option->option_value)
                $this->config->set_item($option->option_name, $option->option_value);
        }
    }


    private function _assign_shop()
    {
        $domain             = $this->input->server('SERVER_NAME');
        $domain_explode     = explode('.', $domain);
        $main_domain        = implode('.', array_slice($domain_explode, -2));
        
        if(sizeof($domain_explode) > 2 && $main_domain == $this->config->item('domain'))
        {   
            $subdomain = array_slice($domain_explode, 0, -2);
            
            $this->data['shop'] = $this->shops->get_by(array(
                    'domain'            => $subdomain,
                    'custom_domain'     => 0
                )
            );   
        } 
        else
        {
            $this->data['shop'] = $this->shops->get_by(array(
                    'domain'            => $domain,
                    'custom_domain'     => 1
                )
            );
        }

        if(!$this->data['shop'])
            show_404();

        $this->data['shop']->options = $this->shops->options($this->data['shop']->id);


        if(!is_main_shop($this->data['shop']) && $this->data['shop']->custom_domain)
        {
            $this->config->set_item('noreply_email', sprintf('noreply@%s', $this->data['shop']->domain));
        }

        return TRUE;
        
    }

    protected function render_tpl($tpl)
    {
        $this->output_content($tpl, $this->data);
        $this->render();
    }

    public function output_content($view, $data)
    {
       $data['meta_keywords']     = $this->print_meta_keywords();
       $data['meta_description']  = $this->print_meta_description();
       $data['title']             = $this->print_title();
       
       $this->template->write_view('content',  $view.'.php', $data);
    }

    public function print_title()
    {
        return isset($this->title) ? $this->title : '';
    }

    public function print_meta_description()
    {
        return isset($this->mdesc) ? $this->mdesc : '';
    }

    public function print_meta_keywords()
    {
        return isset($this->mkey) ? $this->mkey : '';
    }

    public function render()
    {
        $this->template->render();  
    }

    public function addTitle($text)
    {
        if($text)
            $this->title = $text;
    }

    public function add_meta_desc($text)
    {
        if($text)
            $this->mdesc = $text;
    }

    public function add_meta_keys($text)
    {
        if($text)
            $this->mkey = $text;
    }

    function send_email_template($to, $subject, $tpl, $data, $from_email = FALSE, $from = FALSE)
    {
        $text = $this->load->view('email/' . $tpl, $data, TRUE);
        return $this->send_email($to, $subject, $text, $from_email, $from);
    }
    
    function send_email($to, $subject, $text, $from_email = FALSE, $from = FALSE)
    {
        $this->load->library('email');
        $this->load->config('email');

        $this->email->clear();
        $this->email->initialize();
        
        if($to == 'admin')
            $to = $this->config->item('admin_email');
        
        if($from && $from_email)
        {
            $this->email->reply_to($from_email, $from);
        }
        else
        {
            if(!$from_email)
                $from_email = $this->config->item('noreply_email');

            if(!$from && isset($this->data['shop']))
            {
                $from = $this->data['shop']->name;
            }
            else
            {
                $from = $this->config->item('site_title');   
            }
        }
        
        $this->email->from($from_email, $from);
        
        $this->email->to($to);
        $this->email->subject($subject);
        
        $this->email->message($text);

        $res = $this->email->send();
        
        if(!$res && (ENVIRONMENT == 'development' || ENVIRONMENT == 'testing'))
        {
            // echo $this->email->print_debugger();
            // exit;
        }
        
        return $res;
    }
}