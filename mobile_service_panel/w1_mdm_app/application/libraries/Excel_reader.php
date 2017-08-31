<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Excel_reader
{
    public function __construct()
    {
        require_once APPPATH.'third_party/PHPExcel/PHPExcel.php';
    }
}