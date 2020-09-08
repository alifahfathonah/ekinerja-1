<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		if ($this->auth->is_logged_in() != TRUE) {
			if($_POST){
				$username = trim($this->input->post('username'));
				$password = md5($this->input->post('password').$this->config->item('keyRandom'));
				$cek = $this->auth->login($username, $password);
				if($cek == "TRUE"){
					$data = array('flag'=>'success', 'url'=>base_url().'dashboard');
				} else{
					$data = array('flag'=>'fail');
				}
				$this->output->set_output(json_encode($data));
			} else{
				$this->load->view('default/login');
			}
		} else{
			redirect(base_url().'dashboard');
		}
	}
}