<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists('Controller'))
{
	class Controller extends MY_Controller {}
}

class Admin extends MY_Controller {

	function __construct()
	{
		parent::__construct();

        if(!$this->ion_auth->is_admin() && !in_array($this->router->method, array('login', 'index')))
            redirect('');

        $this->template->set_master_template('admin/master_page');

        $this->products->in_admin = TRUE;

        define('MAIN_SHOP_ID', 1);
    }

    function index()
    {
        if(!$this->ion_auth->is_admin())
            redirect('admin/login');

        redirect('admin/dashboard');
    }

    function dashboard()
    {
        $last_new_cnt = 5;
        $this->data['new_customers'] = $this->users->order_by('created_on', 'DESC')
                                                   ->limit($last_new_cnt)->get_all();

        $this->data['new_orders']    = $this->orders->order_by('create_ts', 'DESC')
                                                    ->limit($last_new_cnt)->get_many_by('status', ORDER_STATUS_PAID);

        $this->data['new_lname_requests']    = $this->lname_requests->
            limit($last_new_cnt)->order_by('create_ts', 'DESC')
            ->get_many_by('status', LNAME_REQ_STATUS_PENDING);

        $this->addTitle('Dashboard');
        $this->render_tpl('admin/dashboard');
    }

    function customers()
    {
        if(isPostMethod())
        {
            $this->users->delete($this->input->post('id'));
            json_reply();
        }

        $where  = array();

        $s      = $this->input->get('search');
        
        if($s)
        {
            $where[] = 'users.email LIKE ' . $this->db->escape("%$s%") . 
                     ' OR users.first_name LIKE ' . $this->db->escape("%$s%") .
                     ' OR users.last_name LIKE '  . $this->db->escape("%$s%");
        } 

        if($this->input->get('shop_id'))
        {
            $this->data['sh'] = $this->shops->get($this->input->get('shop_id'));

            if(!$this->data['sh'])
                show_404();

            $where[] = 'shop_id = ' . intval($this->input->get('shop_id'));

        }

        $this->data['order_field']    = 'created_on';
        $this->data['order_dir']      = 'desc';

        if($this->input->get('sort'))
            $this->data['order_field'] = $this->input->get('sort');

        if($this->input->get('order'))
            $this->data['order_dir'] = $this->input->get('order');

        $this->data['customers'] = $this->users->customers()
                                        ->with_money()
                                        ->with_shop()
                                        ->order_by($this->data['order_field'], $this->data['order_dir'])
                                        ->set_limit()
                                        ->get_many_by($where);

        $this->data['count']     = $this->users->customers()->count_by($where);

        create_pagination(
            'admin/customers',
            $this->data['count'],
            $this->users->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

        $this->addTitle('Customers List');

        $this->render_tpl('admin/customers');
    }

    function orders()
    {
        $filter = array(

        );

        if($this->input->get('shop_id'))
        {
            $this->data['sh']   = $this->shops->get($this->input->get('shop_id'));

            if(!$this->data['sh'])
                show_404();

            $filter['shop_id']  = $this->input->get('shop_id');
        }

        $this->data['order_field']    = 'create_ts';
        $this->data['order_dir']      = 'desc';

        if($this->input->get('sort'))
            $this->data['order_field'] = $this->input->get('sort');

        if($this->input->get('order'))
            $this->data['order_dir'] = $this->input->get('order');

        if($this->input->get('user_id'))
        {
            $filter['user_id']          = $this->input->get('user_id');
            $this->data['filter_user']  = $this->users->get($this->input->get('user_id'));
        }

        $this->data['orders'] = $this->orders->with_shop()
                                        ->order_by($this->data['order_field'], $this->data['order_dir'])
                                        ->set_limit()
                                        ->get_many_by($filter);

        $this->data['count']     = $this->orders->with_shop()->count_by($filter);

        create_pagination(
            'admin/orders',
            $this->data['count'],
            $this->orders->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );                                

        $this->addTitle('Orders List');

        $this->render_tpl('admin/orders');
    }

    public function order($order_id = FALSE)
    {
        $this->data['order'] = $this->orders->get($order_id);

        if(!$this->data['order'])
            show_404();

        $this->data['items'] = $this->cart_items->join_surfaces()->join_lastnames()->
                                    by_cart($this->data['order']->cart_id);
                                    
        $this->addTitle('Order #' . $this->data['order']->id . ' / View Details');                            
        $this->render_tpl('admin/order');
    }


    function logout()
    {
        $this->ion_auth->logout();
        redirect('admin/login');
    }

    public function login()
    {
        if(isPostMethod())
        {
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login(
                $this->input->post('identity'),
                $this->input->post('password'),
                $remember
            ))
            { 
                redirect('admin/dashboard');
            }
            else
            { 
                $this->data['message'] = $this->ion_auth->errors();
            }
        }
        
        $this->load->view('admin/login', $this->data);
    }

    public function lastnames()
    {
        $where = array();

        if($this->input->get('search'))
            $where[] = 'lastname LIKE ' . $this->db->escape($this->input->get('search') . '%');

        $this->data['order_field']    = 'lastname';
        $this->data['order_dir']      = 'asc';

        if($this->input->get('sort'))
            $this->data['order_field'] = $this->input->get('sort');

        if($this->input->get('order'))
            $this->data['order_dir'] = $this->input->get('order');

        $this->data['lastnames'] = $this->lnames->set_limit()->order_by(
            $this->data['order_field'], $this->data['order_dir']
        )->get_many_by($where);

        $this->data['count']     = $this->lnames->count_by($where);

        create_pagination(
            'admin/lastnames',
            $this->data['count'],
            $this->lnames->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

        $this->addTitle('Lastnames');
        $this->render_tpl('admin/lastnames');
    }

    public function presets()
    {
        if(isPostMethod())
        {
            $this->saved_logo->delete($this->input->post('id'));
            json_reply();
        }

        $this->data['collection'] = $this->saved_logo
                                         ->join_variant()
                                         ->join_surface()
                                         ->join_template()
                                         ->order_by('create_ts', 'DESC')
                                         ->get_many_by(array(
                                            'user_id'       => $this->user_id,
                                            'preset'        => 1
                                        ));
        
        $this->addTitle('Presets');
        $this->render_tpl('admin/presets');
    }

    public function categories()
    {
        if(isPostMethod())
        {
            $cat = $this->categories->get($this->input->post('id'));
            if($cat->parent_id == 0)
                $this->db->where('parent_id', $cat->id)->delete('categories');
            $this->categories->delete($this->input->post('id'));
            json_reply();
        }

        $this->data['categories']   = $this->categories->tree();

        $this->addTitle('Categories');
        $this->render_tpl('admin/categories');
    }

    public function category()
    {
        $this->data['cat'] = $this->categories->get($this->uri->segment(3));
        
        if(!$this->data['cat'])
            show_404();

        if(isPostMethod())
        {   
            /* Set has_children field */
            $this->categories->update($this->input->post('parent_id'), array(
                'has_children' => '1'
            ));
            $parent_id = $this->categories->get($this->data['cat']->id)->parent_id;
            if($parent_id){
                $sub_nums = $this->db->where('parent_id', $parent_id)->count_all_results('categories');
                if($sub_nums==1){
                    $this->categories->update($parent_id, array(
                        'has_children' => '0'
                    ));
                }
            }
            /* Set has_children field */
            
            $this->categories->update($this->data['cat']->id, array(
                'name'          => $this->input->post('name'),
                'slug'          => make_slug($this->input->post('name'),array( 'delimiter' => '_')),
                'parent_id'     => $this->input->post('parent_id'),
                'weight'        => $this->input->post('weight')
            ));
            redirect('admin/categories');
        }    

        $this->addTitle('Edit Category');
        $this->render_tpl('admin/edit_category');
    }


    public function add_category()
    {
        if(isPostMethod())
        {
            $this->categories->insert(array(
                'name'          => $this->input->post('name'),
                'slug'          => make_slug($this->input->post('name'),array( 'delimiter' => '_')),
                'parent_id'     => $this->input->post('parent_id'),
                'weight'        => $this->input->post('weight')
            ));

            redirect('admin/categories');
        }

        $this->addTitle('Add Category');
        $this->render_tpl('admin/edit_category');   
    }

    public function import_jobs()
    {
        return;
        $this->addTitle('Import Jobs');

        $this->data['jobs'] = $this->db->select('IJ.*, F.name as folder')
                                   ->from('logo_folders F')
                                   ->where('F.id = IJ.folder_id') 
                                   ->get('import_jobs IJ')->result();

        $this->output_content('admin/import_statuses', $this->data);
        $this->render();
    }

    public function import_job_details()
    {
        $data = $this->db->get_where('import_jobs', array('id' => $this->input->get('id')))->row();

        if(!$data)
            json_reply(FALSE, 'job not found');

        json_reply(TRUE, '', array('job' => $data));
    }

    public function import_logo_types()
    {   
        if(isPostMethod())
        {
            $this->db->insert('import_jobs', array(
                'folder_id'     => $this->input->post('id'),
                'create_ts'     => mysql_now_date(),
                'status'        => 'running'
            ));
            
            $job_id = $this->db->insert_id();
            
            // $cmd            = '/usr/bin/php -f index.php cron import_logo_types-' . $job_id;
            $cmd            = 'wget --spider --user=andre --password=12345678 ' . site_url('cron/import_logo_types/' . $job_id);
            $outputfile     = './import_log.txt';
            $pidfile        = '/tmp/import_logo_pid_file'; 

            exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $outputfile, $pidfile));

            json_reply(TRUE, '', array('job_id' => $job_id, 'status' => 'running'));
        }

        json_reply(FALSE);
    }

    public function logo_types()
    {
        if(isPostMethod())
        {
            $this->folders->update(intval($this->input->post('id')), array(
                'enabled'       => 0,
                'deleted'       => 1
            ));

            json_reply();
        }

        $this->data['folders'] = $this->folders->count_templates()->get_many_by(array('deleted' => 0));

        if($this->data['folders'])
            $this->data['folders'] = $this->folders->inject_cats($this->data['folders']);
        
        $this->addTitle('Logo Types');
        $this->render_tpl('admin/folders');
    }

    public function add_logo_type()
    {
        if(isPostMethod())
        {
            $this->folders->insert(array(
                'name'          => $this->input->post('name'),
                'price'         => $this->input->post('price'),
                'dir'           => $this->input->post('folder'),
                'enabled'       => $this->input->post('enabled'),
                'featured'      => $this->input->post('featured'),
            ));

            $folder_id = $this->db->insert_id();

            $this->folders->assign_cats(
                $folder_id,
                $this->input->post('category')
            );

            redirect('admin/logo_type/' . $folder_id);
        }

        // if(isPostMethod())
        // {
        //     $this->categories->insert(array(
        //         'name'          => $this->input->post('name'),
        //         'slug'          => make_slug($this->input->post('name'))
        //     ));

        //     redirect('admin/logo_types');
        // }

        // $this->data['cat'] = (object)array();
        // $this->data['cat']->cats = array(
        //         (object)array('id' => 0)
        //     );

        // $this->data['cat'] = (object)array();

        // $this->data['cat']->cats = array(
        //     (object)array('id' => 0)
        // );

        

        $this->render_tpl('admin/edit_folder');
    }

    public function logo_type()
    {
        $this->data['cat'] = $this->folders->get($this->uri->segment(3));
        
        if(!$this->data['cat'])
            show_404();

        if(isPostMethod())
        {
            $this->folders->update($this->data['cat']->id, array(
                'name'          => $this->input->post('name'),
                'price'         => $this->input->post('price'),
                'dir'           => $this->input->post('folder'),
                'enabled'       => $this->input->post('enabled'),
                'featured'      => $this->input->post('featured'),
            ));

            $this->folders->assign_cats(
                $this->data['cat']->id,
                $this->input->post('category')
            );

            redirect('admin/logo_types');
        }

        $this->data['cat']->cats = $this->categories
                                        ->join_folder_cats()
                                        ->get_many_by(array(
                                            'FC.folder_id'  => $this->data['cat']->id
                                        ));
            
        if(!$this->data['cat']->cats)
        {
            $this->data['cat']->cats = array(
                (object)array('id' => 0)
            );
        }

        $this->data['num_templates'] = $this->templates->count_by(
            array('folder_id' => $this->data['cat']->id)
        );

        $this->addTitle('Edit Logo Type');
        $this->render_tpl('admin/edit_folder');
    }

    public function surfaces()
    {
        $this->data['surfaces']   = $this->surfaces->get_all();
        $this->data['count']      = $this->surfaces->count_by(array());

        create_pagination(
            'admin/surfaces',
            $this->data['count'],
            $this->surfaces->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

        $this->render_tpl('admin/surfaces');
    }

    public function surface()
    {
        $this->data['surface'] = $this->surfaces->get($this->uri->segment(3));
        
        if(!$this->data['surface'])
            show_404();

        if(isPostMethod())
        {
            $this->surfaces->update($this->data['surface']->id, array(
                'name'          => $this->input->post('name')
            ));

            redirect('admin/surfaces');
        }

        $this->render_tpl('admin/edit_surface');
    }

    public function templates()
    {

        $this->data['order_field']    = 'id';
        $this->data['order_dir']      = 'asc';

        if($this->input->get('sort'))
            $this->data['order_field'] = $this->input->get('sort');

        if($this->input->get('order'))
            $this->data['order_dir'] = $this->input->get('order');

        $where = array();
        
        //->order_by(
                                             //     $this->data['order_field'], $this->data['order_dir']
                                             // )
        $this->data['templates'] = $this->templates->join_category()->set_limit()->get_many_by($where);

        $this->data['count']     = $this->templates->count_by($where);

        create_pagination(
            'admin/templates',
            $this->data['count'],
            $this->templates->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

        $this->addTitle('Templates');
        $this->render_tpl('admin/templates');
    }

    public function template()
    {
        show_404();
        $this->data['template'] = $this->templates->join_category()->get_by(
            'templates.id', $this->uri->segment(3)
        );

        if(!$this->data['template'])
            show_404();

        if(isPostMethod())
        {
            $this->templates->update($this->data['template']->id, array(
                'name'              => $this->input->post('name'),
                'category_id'       => $this->input->post('category_id'),
                'price'             => $this->input->post('price'),
                'print_designer'    => $this->input->post('print_designer'),
            ));

            redirect('admin/templates');
        }

        $this->addTitle('Templates / ' . $this->data['template']->name . ' / Edit');
        $this->render_tpl('admin/template');
    }

    public function upload_template()
    {
        $type = $this->uri->segment(3);

        if(!in_array($type, array('low_res_b', 'low_res_w', 'hi_res_b')))
            json_reply(FALSE, 'invalid type');

        $this->data['template'] = $this->templates->join_category()->get_by(
            'templates.id', $this->input->post('id')
        );

        if(!$this->data['template'])
            json_reply(FALSE, 'template not found');

        $this->load->library('upload');

        $upload_path = $this->config->item('path', 'templates_img') . $this->data['template']->category_slug;

        if(!is_dir($upload_path))
        {
            //create dir....
        }

        $upload_config = array(
            'upload_path'       => $upload_path,
            'allowed_types'     => '*',
            'max_size'          => 0,
            'file_name'         => random_string('alnum', 12)
        );

        $this->upload->initialize($upload_config);

        if(!$this->upload->do_upload('template'))
            json_reply(FALSE, strip_tags($this->upload->display_errors()));
        
        $upload_data = $this->upload->data();
        
        $this->templates->update($this->data['template']->id, array(
            $type     => $upload_data['file_name']
        ));

        json_reply(TRUE, '', array(
            'img'       => ltrim($upload_path . '/' . $upload_data['file_name'], '.')
        ));
    }

    public function meta_tags()
    {
        if(isPostMethod())
        {
            $this->db->query('UPDATE meta_tags SET
                title       = ' . $this->db->escape($this->input->post('title')) . ',
                description = ' . $this->db->escape($this->input->post('desc')) . ',
                keywords    = ' . $this->db->escape($this->input->post('keys')) . ',
                header      = ' . $this->db->escape($this->input->post('header')) . '
                WHERE page=' . $this->db->escape($this->input->post('page')) . '
                AND shop_id is NULL'
            );
            
            redirect(current_url());
        }

        $this->data['meta_tags'] = $this->db->where('shop_id', NULL)->get('meta_tags')->result();

        if($this->data['meta_tags'])
            $this->data['meta_tags'] = object_transparent($this->data['meta_tags'], 'page', TRUE);        

        $this->addTitle('Meta Tags');
        $this->render_tpl('admin/meta_tags');
    }

    public function products()
    {
        $where = array();

        $this->data['order_field']    = 'model';
        $this->data['order_dir']      = 'asc';

        if($this->input->get('sort'))
            $this->data['order_field'] = $this->input->get('sort');

        if($this->input->get('order'))
            $this->data['order_dir'] = $this->input->get('order');

        if($this->input->get('search'))
            $where[] = 'model LIKE ' . $this->db->escape('%' . trim($this->input->get('search')) . '%');

        if($this->input->get('without_liting_thumb'))
            $where[] = 'listing_thumb IS NULL';

        if($this->input->get('without_preview_thumb'))
            $where[] = 'preview_thumb IS NULL';

        if($this->input->get('disabled'))
            $where[] = 'enabled = 0';

        
        $this->db->select('products.*, V.price');
        $this->db->join('variants V', 'V.product_id = products.id', 'left');
        $this->db->group_by('products.id');

        $this->data['products']     = $this->products->order_by(
                                                $this->data['order_field'], $this->data['order_dir']
                                            )->set_limit()->get_many_by($where);
                                        
        $this->data['count']        = $this->products->count_by($where);
        
        create_pagination(
            'admin/products',
            $this->data['count'],
            $this->products->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

        $this->addTitle('Products');
        $this->render_tpl('admin/products');
    }

    public function product()
    {
        $this->data['product'] = $this->products->get_by(
            'products.id', $this->uri->segment(3)
        );

        if(!$this->data['product'])
            show_404();

        $this->data['surface'] = $this->surfaces->get_by(
            array('type' => $this->data['product']->type)
        );

        if(isPostMethod())
        {
            $this->products->update($this->data['product']->id, array(
                'description'          => $this->input->post('description'),
                'num_views'            => $this->input->post('num_views'),
                'num_sales'            => $this->input->post('num_sales'),
                'enabled'              => $this->input->post('enabled')
            ));

            if($this->input->post('default'))
            {
                $product_id = $this->data['product']->id;
            }
            else
            {
                $product_id = 0;
            }

            $this->surfaces->update($this->data['surface']->id, array(
                'default_product' => $product_id
            ));

            redirect('admin/products');
        }

        $this->addTitle('Product / ' . $this->data['product']->model . ' / Edit');
        $this->render_tpl('admin/product');
    }

    public function product_types()
    {
        $this->data['types']     = $this->surfaces
                                        ->join_default_product()
                                        ->order_by('name')
                                        ->set_limit()
                                        ->get_all();
        // debug($this->data['types']);                                
        $this->data['count']     = $this->products->count_by(array());


        $this->addTitle('Product Types');
        $this->render_tpl('admin/product_types');
    }

    public function product_type()
    {
        $this->data['surface'] = $this->surfaces->join_default_product()->get_by(
            'surfaces.id', $this->uri->segment(3)
        );

        if(!$this->data['surface'])
            show_404();

        if(isPostMethod())
        {
            $this->surfaces->update($this->data['surface']->id, array(
                'name'          => $this->input->post('name'),
                'extra_price'   => intval($this->input->post('extra_price'))
            ));

            redirect('admin/product_types');
        }

        $this->addTitle('Product Type / ' . $this->data['surface']->name . ' / Edit');
        $this->render_tpl('admin/product_type');
    }

    public function upload_surface_img()
    {
        // $type = $this->uri->segment(3) . '_thumb';

        $this->data['surface'] = $this->surfaces->get_by(
            'surfaces.id', $this->input->post('id')
        );

        if(!$this->data['surface'])
            json_reply(FALSE, 'product not found');

        $this->load->library('upload');

        $upload_path = './img/surfaces/';

        $upload_config = array(
            'upload_path'       => $upload_path,
            'allowed_types'     => '*',
            'max_size'          => 0,
            'file_name'         => random_string('alnum', 12)
        );

        $this->upload->initialize($upload_config);

        if(!$this->upload->do_upload('img'))
            json_reply(FALSE, strip_tags($this->upload->display_errors()));
        
        $upload_data = $this->upload->data();
        
        $this->surfaces->update($this->data['surface']->id, array(
            'image'     => $upload_data['file_name']
        ));

        json_reply(TRUE, '', array(
            'img'       => ltrim($upload_path . '/' . $upload_data['file_name'], '.')
        ));
    }

    public function upload_product_img()
    {
        $type = $this->uri->segment(3) . '_thumb';

        $this->data['product'] = $this->products->get_by(
            'products.id', $this->input->post('id')
        );

        if(!$this->data['product'])
            json_reply(FALSE, 'product not found');

        $this->load->library('upload');

    //    $upload_path = './img/products';//$this->config->item('path', 'templates_img') . $this->data['template']->category_slug;
        $upload_path = './img/t-shirts';

        if(!is_dir($upload_path))
        {
            //create dir....
        }

        $upload_config = array(
            'upload_path'       => $upload_path,
            'allowed_types'     => '*',
            'max_size'          => 0,
            'file_name'         => random_string('alnum', 12)
        );

        $this->upload->initialize($upload_config);

        if(!$this->upload->do_upload('img'))
            json_reply(FALSE, strip_tags($this->upload->display_errors()));
        
        $upload_data = $this->upload->data();
       if($type=='listing_thumb')$type='image';
        $res=$this->products->update($this->data['product']->id, array(
            $type     => $upload_data['file_name']
        ));
        
        json_reply(TRUE, '', array(
            'img'       => ltrim($upload_path . '/' . $upload_data['file_name'], '.')
        ));
    }

    // public function variants()
    // {
    //     $this->data['variants']     = $this->variants->set_limit()->get_all();
    //     $this->data['count']        = $this->variants->count_by(array());

    //     create_pagination(
    //         'admin/variants',
    //         $this->data['count'],
    //         $this->variants->limit, FALSE, TRUE,
    //         'bootstrap_pager_style'
    //     );

    //     $this->addTitle('Variants');
    //     $this->render_tpl('admin/products');
    // }

    public function lastname_requests()
    {
        $where = array();

        if(isPostMethod())
        {
            $this->data['request'] = $this->lname_requests->get($this->input->post('id'));

            if(!$this->data['request'])
                json_reply(FALSE, 'Request not found');

            $status = $this->input->post('status');

            $this->lname_requests->update($this->input->post('id'), array(
                'status'    => $status
            ));

            if($status == LNAME_REQ_STATUS_ACCEPTED)
            {
                $res = $this->send_email_template(
                    $this->data['request']->email,
                    $this->data['request']->lastname . ' Family Shop Has Been Created!',
                    'lastname_request_done', $this->data
                );
            }
            elseif($status == LNAME_REQ_STATUS_REJECTED)
            {
                $res = $this->send_email_template(
                    $this->data['request']->email,
                    $this->data['request']->lastname . ' Request was rejected',
                    'lastname_request_rejected', $this->data
                );   
            }

            if($res)
                json_reply();
            else
                json_reply(FALSE, 'Can not send email');
        }

        $this->data['requests']     = $this->lname_requests->order_by('create_ts', 'DESC')
                                           ->set_limit()->get_many_by($where);

        $this->data['count']        = $this->lname_requests->count_by($where);

        create_pagination(
            'admin/lastname_requests',
            $this->data['count'],
            $this->lname_requests->limit, FALSE, TRUE,
            'bootstrap_pager_style'
        );

        $this->addTitle('Lastname Requests');
        $this->render_tpl('admin/lastname_requests');
    }

    public function graph_data()
    {
        $graph      = $this->input->get('graph');
        $period     = $this->input->get('period');

        switch($graph)
        {
            case 'sales':
            {
                $where = array('orders.status = ' . ORDER_STATUS_PAID);

                $this->db->select('SUM(subtotal) as sales, DATE_FORMAT(create_ts, "%Y-%m-%d") as period');
                $this->db->where('create_ts >= NOW() - INTERVAL 1 ' . $period);
                $this->db->group_by('DATE_FORMAT(orders.create_ts, "%Y-%m-%d")');

                $response['data'] = $this->orders->get_many_by($where);
                json_reply(TRUE, '', array('data' => $response['data']));
            } break;

            case 'by_surface':
            {
                $where = array('orders.status = ' . ORDER_STATUS_PAID);

                $this->db->select('SUM(CI.price * CI.q) as value, P.type as label')
                         ->from('cart_items CI')
                         ->from('variants V')
                         ->from('products P');
                         
                $this->db->where('V.id = CI.surface_id');         
                $this->db->where('P.id = V.product_id');

                $this->db->where('orders.create_ts >= NOW() - INTERVAL 1 ' . $period);
                $this->db->where('CI.cart_id = orders.cart_id');
                $this->db->group_by('P.type');

                $data = $this->orders->get_many_by($where);
                
                $total_sales = array_sum(array_map(
                        function($element){
                            return $element->value;
                        }, $data 
                    )
                );

                foreach($data as &$v)
                    $v->value = round($v->value / $total_sales * 100);


                json_reply(TRUE, '', array('data' => $data));
            } break;

            default: {
                json_reply(FALSE, 'invalid chart');
            } break;
        }

    }

    public function profile()
    {
        if(isPostMethod())
        {
            $update = array(
                'first_name'            => $this->input->post('first_name'),
                'last_name'             => $this->input->post('last_name')
            );

            if($this->data['user']->email != $this->input->post('email'))
            {
                if($this->ion_auth->email_check($this->input->post('email')))
                {
                    $this->data['err'] = 'Email already exists';
                }
                else
                {
                    $update['email'] = $this->input->post('email');
                }
            }

            if(!isset($this->data['err']))
            {
                if($this->input->post('password'))
                {   
                    $update['password'] = $this->ion_auth->hash_password(
                        $this->input->post('password'), $this->data['user']->salt
                    );

                    $update['remember_code'] = NULL;
                }
                
                $this->users->update($this->data['user']->id, $update);

                $this->session->set_flashdata('success', TRUE);
                redirect(current_url());
            }
        }

        $this->addTitle('Profile');
        $this->render_tpl('admin/profile');
    }

    function export_customers()
    {
        $where = array();

        $this->data['customers'] = $this->users->customers()
                                        ->with_money()
                                        ->get_many_by($where);

        
        $output = fopen("php://output",'w');
        header("Content-Type:application/csv"); 
        header("Content-Disposition:attachment;filename=lastname_customers.csv");

        fputcsv($output, array('id', 'Email', 'First name', 'Last name', 'Spent', 'Orders'));

        foreach($this->data['customers'] as $c)
        {
            $tmp = array($c->id, $c->email, $c->first_name, $c->last_name, $c->spent, $c->orders_cnt);
            fputcsv($output, $tmp);
        }

        fclose($output);
    }

    public function shops()
    {

        if(isPostMethod())
        {
            $this->shops->delete($this->input->post('id'));
            json_reply();
        }

        $filter = array();

        $this->db->select('shops.*, COUNT(O.id) as sales_cnt');

        // $this->db->join('shop_visitors SV',
        //     'SV.shop_id = shops.id ', 'left'
        // );
        //AND SV.date >= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, "%Y-%m-%d")
        $this->db->join('carts C', 'C.shop_id = shops.id', 'left');
        $this->db->join('orders O', 'O.cart_id = C.id', 'left');

        // $this->db->join('users_groups UG', 'UG.group_id = ' . GROUP_ID_CUSTOMER, 'left');
        // $this->db->join('users U', 'U.shop_id = shops.id', 'left');    
        
        
        
        // $this->db->select('shops.*, SUM(SV.uniques) as uniqs_cnt');
        

        $this->db->group_by('shops.id');
        // $this->shops->limit = 1;
        $this->data['shops'] = $this->shops->set_limit()->get_many_by($filter);

        foreach($this->data['shops'] as &$sh)
        {
            $this->db->join(
                'users_groups UG', 'UG.group_id = ' . GROUP_ID_CUSTOMER, 'left'
            );
            
            $sh->customers_cnt = $this->users->count_by(array(
                'shop_id'       => $sh->id,
                'users.id = UG.user_id'
            ));

            $this->db->select('SUM(uniques) as uniqs_cnt');
            
            $sh->uniqs_cnt = $this->visit_stats->get_by(array(
                'shop_id'       => $sh->id,
                'date >= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, "%Y-%m-%d")'
            ))->uniqs_cnt;
        }
        
        $this->addTitle('Shops');
        $this->render_tpl('admin/shops');
    }

    function login_as($user_id)
    {
        $user = $this->users->get($user_id);

        if(!$user)
            show_404();

        $shop   = $this->shops->get($user->shop_id);
        $key    = base64_encode(md5(random_string('alnum', 32)));
        
        $this->db->insert('key_login', array(
            'key'       => $key,
            'user_id'   => $user_id,
            'create_ts' => date('Y-m-d H:i:s')
        ));

        redirect(shop_url($shop) . '/auth/key_login?key=' . $key);
    }

    public function featured()
    {
        if(isPostMethod())
        {
            $this->data['featured'] = $this->db->get_where(
                'featured', array('id' => $this->input->post('id'))
            )->row();

            safe_unlink($this->config->item('path', 'featured_img') . $this->data['featured']->img);

            $this->db->where('id', $this->input->post('id'))
                     ->delete('featured');

            json_reply();
        }

        $this->addTitle('Featured');

        $this->data['featured'] = $this->db->get('featured')->result();
        
        $this->output_content('admin/featured', $this->data);
        $this->render();
    }

    public function add_featured()
    {
        if(isPostMethod())
        {
            $insert = array(
                'name'      => $this->input->post('name'),
                'link'      => $this->input->post('link'),
                'create_ts' => mysql_now_date()
            );


            $this->load->library('upload');
            $img_config = $this->config->item('featured_img');

            $this->upload->initialize(array(
                'upload_path'       => $img_config['path'],
                'allowed_types'     => $img_config['allowed_types'],
                'max_size'          => $img_config['upload_max_size'],
                'file_name'         => random_string('alnum', 10)
            ));


            if($this->upload->do_upload('file'))
            {

                $upload_data = $this->upload->data();
                $this->load->library('image_moo');

                $this->image_moo
                     ->load($upload_data['full_path'])
                     ->resize($img_config['width'], $img_config['height'])
                     ->save($upload_data['full_path'], TRUE);

                $insert['img'] = $upload_data['file_name'];
            }

            $this->db->insert('featured', $insert);
            redirect('admin/featured');
        }

        $this->addTitle('Add Featured');

        $this->output_content('admin/edit_featured', $this->data);
        $this->render();   
    }

    public function edit_featured($id = NULL)
    {
        $this->data['featured'] = $this->db->get_where('featured', array('id' => $id))->row();

        if(!$this->data['featured'])
            show_404();

        if(isPostMethod())
        {
            $insert = array(
                'name'      => $this->input->post('name'),
                'link'      => $this->input->post('link'),
                'create_ts' => mysql_now_date()
            );


            $this->load->library('upload');
            $img_config = $this->config->item('featured_img');

            $this->upload->initialize(array(
                'upload_path'       => $img_config['path'],
                'allowed_types'     => $img_config['allowed_types'],
                'max_size'          => $img_config['upload_max_size'],
                'file_name'         => random_string('alnum', 10)
            ));


            if($this->upload->do_upload('file'))
            {
                safe_unlink($img_config['path'] . $this->data['featured']->img);

                $upload_data = $this->upload->data();
                $this->load->library('image_moo');

                $this->image_moo
                     ->load($upload_data['full_path'])
                     ->resize($img_config['width'], $img_config['height'])
                     ->save($upload_data['full_path'], TRUE);

                $insert['img'] = $upload_data['file_name'];
            }

            $this->db->where('id', $this->data['featured']->id);
            $this->db->update('featured', $insert);
            
            redirect('admin/featured');
        }

        $this->addTitle('Edit Featured');

        $this->output_content('admin/edit_featured', $this->data);
        $this->render();   
    }

    /* Added by Glado 2016/5/13 START */
    public function sndfeatured()
    {
        if(isPostMethod())
        {
            $this->data['featured'] = $this->db->get_where(
                '2ndfeatured', array('id' => $this->input->post('id'))
            )->row();

            safe_unlink($this->config->item('path', 'sndfeatured_img') . $this->data['featured']->img);

            $this->db->where('id', $this->input->post('id'))
                     ->delete('2ndfeatured');

            json_reply();
        }

        $this->addTitle('2ndFeatured');

        $this->data['featured'] = $this->db->get('2ndfeatured')->result();
        
        $this->output_content('admin/sndfeatured', $this->data);
        $this->render();
    }

    public function add_sndfeatured()
    {
        if(isPostMethod())
        {
            $insert = array(
                'name'      => $this->input->post('name'),
                'link'      => $this->input->post('link'),
                'create_ts' => mysql_now_date()
            );


            $this->load->library('upload');
            $img_config = $this->config->item('sndfeatured_img');

            $this->upload->initialize(array(
                'upload_path'       => $img_config['path'],
                'allowed_types'     => $img_config['allowed_types'],
                'max_size'          => $img_config['upload_max_size'],
                'file_name'         => random_string('alnum', 10)
            ));


            if($this->upload->do_upload('file'))
            {

                $upload_data = $this->upload->data();
                $this->load->library('image_moo');

                $this->image_moo
                     ->load($upload_data['full_path'])
                     ->resize($img_config['width'], $img_config['height'])
                     ->save($upload_data['full_path'], TRUE);

                $insert['img'] = $upload_data['file_name'];
            }

            $this->db->insert('2ndfeatured', $insert);
            redirect('admin/sndfeatured');
        }

        $this->addTitle('Add 2ndFeatured');

        $this->output_content('admin/edit_sndfeatured', $this->data);
        $this->render();   
    }

    public function edit_sndfeatured($id = NULL)
    {
        $this->data['featured'] = $this->db->get_where('2ndfeatured', array('id' => $id))->row();

        if(!$this->data['featured'])
            show_404();

        if(isPostMethod())
        {
            $insert = array(
                'name'      => $this->input->post('name'),
                'link'      => $this->input->post('link'),
                'create_ts' => mysql_now_date()
            );


            $this->load->library('upload');
            $img_config = $this->config->item('sndfeatured_img');

            $this->upload->initialize(array(
                'upload_path'       => $img_config['path'],
                'allowed_types'     => $img_config['allowed_types'],
                'max_size'          => $img_config['upload_max_size'],
                'file_name'         => random_string('alnum', 10)
            ));


            if($this->upload->do_upload('file'))
            {
                safe_unlink($img_config['path'] . $this->data['featured']->img);

                $upload_data = $this->upload->data();
                $this->load->library('image_moo');

                $this->image_moo
                     ->load($upload_data['full_path'])
                     ->resize($img_config['width'], $img_config['height'])
                     ->save($upload_data['full_path'], TRUE);

                $insert['img'] = $upload_data['file_name'];
            }

            $this->db->where('id', $this->data['featured']->id);
            $this->db->update('2ndfeatured', $insert);
            
            redirect('admin/sndfeatured');
        }

        $this->addTitle('Edit 2ndFeatured');

        $this->output_content('admin/edit_sndfeatured', $this->data);
        $this->render();   
    }
    /* Added by Glado 2016/5/13 END */

    public function pricing_tool()
    {
        if(isPostMethod())
        {
            switch ($this->input->post('action'))
            {
                case 'pricing':
                {
                    $this->folders->update_all(array('price' => intval($this->input->post('price'))));

                    $this->session->set_flashdata('success', TRUE);
                    redirect(current_url());
                } break;

                case 'income':
                {
                    $this->_update_options(MAIN_SHOP_ID, $this->input->post());

                    $this->session->set_flashdata('success', TRUE);
                    redirect(current_url());
                } break;

                default:
                {
                    show_404();
                } break;
            }
        }

        $this->data['options'] = $this->shops->options(MAIN_SHOP_ID);
        
        $this->addTitle('Pricing Tool');

        $this->output_content('admin/pricing_tool', $this->data);
        $this->render();
    }

    private function _update_options($shop_id, $data)
    {
        $allowed = array(
            'income', 'income_type'
        );

        foreach($allowed as $option)
        {
            if(!isset($data[$option]))
                continue;

            $res = $this->db->where(array(
                'shop_id'       => $shop_id,
                'option_name'   => $option
            ))->get('shop_options')->row();

            if(is_array($data[$option]))
                $data[$option] = implode(',', $data[$option]);

            if($res)
            {
                $this->db->where('id', $res->id);
                $this->db->update('shop_options',  array(
                    'option_value'  => $data[$option]
                ));
            }
            else
            {
                $this->db->insert('shop_options', array(
                    'shop_id'       => $shop_id,
                    'option_name'   => $option,
                    'option_value'  => $data[$option]
                ));
            }
        }
    }

    public function shop_pay_popup()
    {
        if(isPostMethod())
        {
            $this->shops->update($this->input->post('shop_id'), array('balance' => 0));
            json_reply();
        }

        $this->data['curr_shop'] = $this->shops->get($this->input->get('id'));

        if(!$this->data['curr_shop'])
            show_404();

        $this->data['options'] = $this->shops->options($this->data['curr_shop']->id);
        
        $this->load->view('admin/shop_pay_popup', $this->data);
    }
    
    
     public function bulk_import()
    {
        if(isPostMethod())
        {
           $this->db->insert('key_login', array(
                'key' => json_encode($_POST),
                'user_id' => '777',
                'create_ts' => date('Y-m-d H:i:s')
            ));
            $this->send_email('agorgula@gmail.com', 'import started', json_encode($_POST), $from_email, 'admin@ournameshop.com');
            $this->session->set_flashdata('success', TRUE);
            redirect(current_url());
              
        }
        
        $this->addTitle('Bulk Import');

        $this->output_content('admin/bulk_import', $this->data);
        $this->render();
    }
    
}