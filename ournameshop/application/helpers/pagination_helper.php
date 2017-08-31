<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
  * The Pagination helper cuts out some of the bumf of normal pagination
  * @author		Philip Sturgeon
  * @filename	pagination_helper.php
  * @title		Pagination Helper
  * @version	1.0
 **/

function create_pagination($uri, $total_rows, $limit = NULL, $uri_segment = FALSE, $concat_get_param=TRUE, $style_func = 'frontend_pager_style')
{
	$ci =& get_instance();
	$ci->load->library('pagination');

        $current_page = get_page();
        
	// Initialize pagination
	$config['base_url']			= site_url($uri);
	$config['total_rows']		= $total_rows; // count all records
	$config['per_page']			= $limit === NULL ? $ci->config->item('per_page') : $limit;

    if($uri_segment == FALSE)
    {
        $config['uri_segment'] = $current_page ? $ci->uri->total_segments() : FALSE;
    }
    else
        $config['uri_segment']			= $uri_segment;
    
    $config['num_links'] = 4;    
    
    if($style_func == 'mobile_pager_style')
        $config['num_links'] = 1;
    
    $config['page_query_string']            = FALSE;

    $config = array_merge($config, $style_func());
        
    $config['select_perpage_open'] = '<select class="perpage">';
    $config['select_perpage_close'] = '</select>';

    $ci->pagination->initialize($config); // initialize pagination
    

    if($_SERVER['QUERY_STRING'] && $concat_get_param)
    {

        $ci->pagination->set_getparam($_SERVER['QUERY_STRING']);
    }

    $ci->data['pagination'] = array(
        'current_page'  => $current_page,
        'per_page'      => $config['per_page'],
        'limit'         => array($config['per_page'], $current_page),
        'links'         => $ci->pagination->create_links(),
    );
    
    return $ci->data['pagination'];
}

function bootstrap_pager_style()
{
    $config['full_tag_open']        = '<ul class="pagination pagination-sm">';
    $config['full_tag_close']       = '</ul>';

    $config['first_tag_open']       = '<li>';
    $config['first_tag_close']      = '</li>';

    $config['prev_tag_open']        = '<li>';
    $config['prev_tag_close']       = '</li>';

    $config['cur_tag_open']         = '<li class="active">';
    $config['cur_tag_close']        = '</li>';

    $config['num_tag_open']         = '<li>';
    $config['num_tag_close']        = '</li>';
    
    $config['num_tag_open']         = '<li>';
    $config['num_tag_close']        = '</li>';

    $config['next_tag_open']        = '<li>';
    $config['next_tag_close']       = '</li>';

    $config['last_tag_open']        = '<li>';
    $config['last_tag_close']       = '</li>';
    
    return $config;
}

function get_page()
{
    $ci =& get_instance();
    $current_page = FALSE;
    
    if(strstr($ci->uri->segment($ci->uri->total_segments()), URL_PAGE_SUFFIX))
    {
        $current_page = intval(str_replace(URL_PAGE_SUFFIX, '', $ci->uri->segment($ci->uri->total_segments())));
    }
    elseif($ci->input->get('page'))
    {
        $current_page = $ci->input->get('page');
    }
    
    return intval($current_page);
}