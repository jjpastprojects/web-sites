<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 */

// ------------------------------------------------------------------------

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 */
class MY_Pagination  extends CI_Pagination{
        
        public $get_param = '';
        public $select_perpage_open  ='';
        public $select_perpage_close ='';
        public $perpage              =10;
        public $item_wrap_open		 = '';
        public $item_wrap_close	     = '';
        public $current_class		 = '';

        public $anchor_class;

        function __construct()
        {
            parent::__construct();
        }
        
        
        function set_getparam($sParam){
            $this->get_param = $sParam;
        }
        
	// --------------------------------------------------------------------

	/**
	 * Generate the pagination links
	 *
	 * @access	public
	 * @return	string
	 */
	function create_links()
	{
                // And here we go...
		$output = '';
		 
                // If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
                    	return $this->create_select();
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
                   	return $this->create_select();
		}

		// Determine the current page number.
		$CI =& get_instance();
                $url_sufix = $CI->config->item('url_suffix');
                
		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			if ($CI->input->get($this->query_string_segment) != 0)
			{
				$this->cur_page = $CI->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		else
		{
			if ($CI->uri->segment($this->uri_segment) != '0')
			{
                                $this->cur_page = intval(str_replace(URL_PAGE_SUFFIX, '', $CI->uri->segment($CI->uri->total_segments())));    
                                
				// Prep the current page - no funny business!
				//$this->cur_page = (int) $this->cur_page;
			}
		}
                
               
		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}

		if ( ! is_numeric($this->cur_page))
		{
			$this->cur_page = 0;
		}
		
		if($this->cur_page > $num_pages)
		{
			$this->cur_page = $num_pages;
		}
		else 
		{
			if($this->cur_page < 1)
			{
				$this->cur_page = 1;
			}
		}

		$uri_page_number = $this->cur_page;
                
		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			$this->base_url = rtrim($this->base_url).'&'.$this->query_string_segment.'=';
		}
		else
		{
            $this->base_url = preg_replace('/' . $url_sufix .'$/', '', $this->base_url);
			$this->base_url = rtrim($this->base_url, '/') .'/';
		}
                
        if($this->get_param!='')
        {
             $this->get_param = '/?'.$this->get_param;
        } 
                 
		// Render the "First" link
		if  ($this->cur_page > ($this->num_links + 1))
		{
			$output .= $this->first_tag_open.'<a class="' . $this->anchor_class . '" href="'.$this->base_url.URL_PAGE_SUFFIX.'1'.$url_sufix.$this->get_param.'">'.$this->item_wrap_open.$this->first_link.$this->item_wrap_close.'</a>'.$this->first_tag_close;
		}

                   
                
		// Render the "previous" link
		if  ($this->cur_page != 1)
		{
			$i = $uri_page_number - 1;

			if ($i == 0) $i = '';
			$output .= $this->prev_tag_open.'<a class="' . $this->anchor_class . '" href="'.$this->base_url.URL_PAGE_SUFFIX . $i.$url_sufix.$this->get_param.'">'.$this->item_wrap_open.$this->prev_link.$this->item_wrap_close.'</a>'.$this->prev_tag_close;
		}

		// Write the digit links
		for ($loop = $start -1; $loop <= $end; $loop++)
		{
			$i = $loop;

			if ($i >= 0)
			{
				if ($this->cur_page == $loop)
				{
					$output .= $this->cur_tag_open.'<a class="' . $this->anchor_class . ' ' . $this->current_class . '">' . $this->item_wrap_open.$loop.$this->item_wrap_close.' </a>' . $this->cur_tag_close; // Current page
				}
				else
				{
					if($i > 0)
					{	
						$output .= $this->num_tag_open.'<a class="' . $this->anchor_class . '" href="'.$this->base_url.URL_PAGE_SUFFIX.$i.$url_sufix.$this->get_param.'">'.$this->item_wrap_open . $i . $this->item_wrap_close.'</a>'.$this->num_tag_close;	
					}
				}
			}
		}
                
                
		// Render the "next" link
		if ($this->cur_page < $num_pages)
		{
			$next = $this->cur_page + 1;
			
			$output .= $this->next_tag_open.'<a class="' . $this->anchor_class . '" href="'.$this->base_url.URL_PAGE_SUFFIX.$next.$url_sufix.$this->get_param.'">'.$this->item_wrap_open.$this->next_link.$this->item_wrap_close.'</a>'.$this->next_tag_close;
		}

		// Render the "Last" link
		if (($this->cur_page + $this->num_links) < $num_pages)
		{
			$i = $num_pages;
			
			$output .= $this->last_tag_open.'<a class="' . $this->anchor_class . '" href="'.$this->base_url.URL_PAGE_SUFFIX.$i.$url_sufix.$this->get_param.'">'.$this->item_wrap_open.$this->last_link.$this->item_wrap_close.'</a>'.$this->last_tag_close;
		}

		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);
               
                $output .= $this->create_select();
                
		// Add the wrapper HTML if exists
		$output = $this->full_tag_open.$output.$this->full_tag_close;
        
		return $output;
	}
        
        function create_select()
        {
            // Determine the current page number.
            $output = '';
	    $CI =& get_instance();
            if($this->select_perpage_open && $this->select_perpage_close && $CI->config->item('select_per_page')) {
                    $curr = $CI->session->userdata('perpage');
                    $output.= $this->select_perpage_open; 
                      foreach($CI->config->item('select_per_page') as $np){
                        //$output.='<option value="'.$this->base_url.'1/'.$np.$this->get_param.'">'.$np.'</option>';
                        $output.='<option value="'.$np.'" '.( ($np==$curr)? 'selected="selected"': '' ).'>'.$np.'</option>';
                      }
                    $output .= $this->select_perpage_close;
                    return $output;
                }
                return '';
        }
        
        
}
