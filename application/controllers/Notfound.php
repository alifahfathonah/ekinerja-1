<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends DJ_Admin {

	public function index()
	{	
		$this->data['list_css_page'] = array('error-page.css');

		$this->output->set_status_header('404');
		$this->layout('default/notfound', $this->data);
	}
}
