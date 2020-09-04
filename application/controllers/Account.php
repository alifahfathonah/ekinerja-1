<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends DJ_Admin {

	public function index()
	{	
		$this->data['list_css_plugin'] = array('jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css');
		$this->data['list_js_plugin'] = array(
				'jquery-validation/dist/jquery.validate.min.js',
				'noty/js/noty/packaged/jquery.noty.packaged.min.js',
				'jasny-bootstrap-fileinput/js/jasny-bootstrap.fileinput.min.js'
			);
		$this->layout('default/account', $this->data);
	}

	function ganti_password(){
		$pass_lama = trim($this->input->post("pass_lama"));
		$pass_baru = trim($this->input->post("pass_baru"));
		$pass_baru2 = trim($this->input->post("pass_baru2"));
		if($pass_baru == $pass_baru2){
			$check = $this->global->find_data('user', array('password'=>md5($pass_lama.$this->config->item('keyRandom')), 'id'=>$this->session->userdata('id')));
			if($check->num_rows() > 0){
				$simpan = $this->global->edit_data('user', array('password'=>md5($pass_baru.$this->config->item('keyRandom'))), array('id'=>$this->session->userdata('id')));
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			} else{
				$status = 'not_same';
			}
		} else{
			$status = 'not_same2';
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function ganti_foto_form(){
		$this->load->view('default/ganti_foto', $this->data);
	}

	function ganti_foto(){
		header('Content-Type: application/json');
		$pesan = '';
		if(isset($_FILES['userfile'])){
			buat_direktori('./upload/images/');
			$config['upload_path'] = './upload/images/';
			$config['allowed_types'] = 'jpeg|jpg|png|gif';
			$config['max_size'] = 5000;
			$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$this->load->library('upload', $config);

			if($this->upload->do_upload('userfile')){
				$data_upload = $this->upload->data();
				buat_direktori('./upload/images/profil/');
				$this->load->library('image_lib');
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = './upload/images/' . $data_upload['file_name'];
				$config2['new_image'] = './upload/images/profil/' . $data_upload['file_name'];
				$config2['create_thumb'] = FALSE;
				$config2['maintain_ratio'] = FALSE;
				$config2['quality'] = '100%';
				$config2['width'] = 200;
				$config2['height'] = 200;
				$this->image_lib->initialize($config2);
				if($this->image_lib->resize()){
					$img_lama = $this->global->find_data('user', array('id'=>$this->session->userdata('id')))->row_array();
					$update = $this->global->edit_data('user', array('foto'=>$data_upload['file_name']), array('id'=>$this->session->userdata('id')));
					if($update == "TRUE"){
						@unlink('./upload/images/profil/' . $img_lama['foto']);
						@unlink('./upload/images/' . $data_upload['file_name']);
						$flag = 1;
					} else{
						@unlink('./upload/images/profil/' . $data_upload['file_name']);
						@unlink('./upload/images/' . $data_upload['file_name']);
						$flag = 2;
					}
				} else{
					@unlink('./upload/images/' . $data_upload['file_name']);
					$flag = 3;
					$pesan = $this->image_lib->display_errors();
				}
			} else{
				$flag = 4;
				$pesan = $this->upload->display_errors();
			}
		}
		$this->output->set_output(json_encode(array('flag'=>$flag, 'pesan'=>$pesan)));
	}

}
