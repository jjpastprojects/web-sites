<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library
{
    protected $ci;

    private $errors                     = array();
    private $error_start_delimiter      = '';
    private $error_end_delimiter        = '';

    public function __construct()
    {
      $this->ci = &get_instance();
    }
    
    protected function set_error($error)
    {
        $this->errors[] = $error;
    }

    public function errors()
    {
        if($this->errors)
        {
            return $this->error_start_delimiter . 
                   implode(
                        $this->error_end_delimiter .
                        $this->error_start_delimiter, $this->errors
                    ) . $this->error_end_delimiter;
        }

        return NULL;
    }
}