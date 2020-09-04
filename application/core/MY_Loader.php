<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

    public function __construct() {
        parent::__construct();
        $this->_ci_view_paths = array(FCPATH.'themes/' => TRUE);
    }
}