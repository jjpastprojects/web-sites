<?php

class MY_Library {
	protected $errors                     = array();
    protected $error_start_delimiter      = '<p>';
    protected $error_end_delimiter        = '</p>';

    protected $ci;

    public function __construct()
    {
        $this->ci = & get_instance();
    }

    protected function set_error($error)
    {
        $this->errors[] = $error;
    }

    public function get_errors()
    {
        if($this->errors)
        {
            return $this->error_start_delimiter . 
                   implode(
                        $this->error_end_delimiter .
                        $this->error_start_delimiter, $this->errors
                    ) . $this->error_end_delimiter;
       }

        return FALSE;
    }

    public function errors()
    {
        return !empty($this->errors);
    }
}