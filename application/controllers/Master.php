<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends DJ_Admin {

	function pejabat(){
		$this->data['list_css_plugin'] = array(
				'jquery.gritter/css/jquery.gritter.css',
				'datatables/css/dataTables.bootstrap.css',
				'datatables/css/datatables.responsive.css',
				'fuelux/dist/css/fuelux.min.css'
			);
		$this->data['list_js_plugin'] = array(
				'datatables/js/jquery.dataTables.min.js',
				'datatables/js/dataTables.bootstrap.js',
				'datatables/js/datatables.responsive.js',
				'fuelux/dist/js/fuelux.min.js',
				'jquery.gritter/js/jquery.gritter.min.js',
				'jquery-validation/dist/jquery.validate.min.js',
				'noty/js/noty/packaged/jquery.noty.packaged.min.js'
			);
		$this->layout('default/pejabat', $this->data);
	}

	function pejabat_json(){
		$query = $this->global->find_data('pejabat')->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['nama']);
			array_push($baris,$data['nip']);
			array_push($baris,$data['posisi']);
			array_push($baris,$data['organisasi']);
			array_push($baris,$data['aktif']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("master/pejabat_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Atasan / Pejabat", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function pejabat_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('pejabat', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/pejabat_form', $this->data);
	}

	function pejabat_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'nama'=>trim($this->input->post("nama")),
					'nip'=>trim($this->input->post("nip")),
					'posisi'=>trim(strtoupper($this->input->post("posisi"))),
					'organisasi'=>trim(strtoupper($this->input->post("organisasi"))),
					'pangkat_golongan'=>trim($this->input->post("pangkat_golongan")),
					'aktif'=>$this->input->post("aktif"),
					'created_by'=>$this->session->userdata('id'),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('pejabat', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'nama'=>trim($this->input->post("nama")),
					'nip'=>trim($this->input->post("nip")),
					'posisi'=>trim(strtoupper($this->input->post("posisi"))),
					'organisasi'=>trim(strtoupper($this->input->post("organisasi"))),
					'pangkat_golongan'=>trim($this->input->post("pangkat_golongan")),
					'aktif'=>$this->input->post("aktif"),
					'updated_by'=>$this->session->userdata('id'),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('pejabat', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function jabatan(){
		$this->data['list_css_plugin'] = array(
				'jquery.gritter/css/jquery.gritter.css',
				'datatables/css/dataTables.bootstrap.css',
				'datatables/css/datatables.responsive.css',
				'fuelux/dist/css/fuelux.min.css',
				'chosen_v1.2.0/chosen.min.css'
			);
		$this->data['list_js_plugin'] = array(
				'datatables/js/jquery.dataTables.min.js',
				'datatables/js/dataTables.bootstrap.js',
				'datatables/js/datatables.responsive.js',
				'fuelux/dist/js/fuelux.min.js',
				'jquery.gritter/js/jquery.gritter.min.js',
				'jquery-validation/dist/jquery.validate.min.js',
				'noty/js/noty/packaged/jquery.noty.packaged.min.js',
				'chosen_v1.2.0/chosen.jquery.min.js'
			);
		$this->layout('default/jabatan', $this->data);
	}

	function jabatan_json(){
		$query = $this->db
			->select('a.*,b.id as idskpd,b.nama as namaSkpd')
			->from('jabatan a')
			->join('unit_kerja b', 'a.id_skpd = b.id')
			->get()->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			if($data['parent'] == 0){
				$induk = $data['nama']; 
			} else{
				$induk = show_row('jabatan', array('id'=>$data['parent']), 'nama');
			}
			array_push($baris,$data['nama']);
			array_push($baris,$data['namaSkpd']);
			array_push($baris,$data['nilai']);
			array_push($baris,$data['kelas']);
			array_push($baris,$induk);
			array_push($baris,$data['aktif']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("master/jabatan_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Jabatan", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function jabatan_form(){
		$this->load->model('skpd_model');
		$this->data['skpd'] = $this->skpd_model->getAll();
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('jabatan', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
			$this->data['list_parent'] = $this->global->find_data('jabatan', array('aktif'=>'Ya', 'id !='=>$_POST['id']))->result_array();
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
			$this->data['list_parent'] = $this->global->find_data('jabatan', array('aktif'=>'Ya'))->result_array();
		}
		$this->load->view('default/jabatan_form', $this->data);
	}

	function jabatan_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'nama'=>trim($this->input->post("nama")),
					'parent'=>$this->input->post("parent"),
					'id_skpd'=>$this->input->post("skpd"),
					'type'=>$this->input->post("type"),
					'nilai'=>$this->input->post("nilai"),
					'kelas'=>$this->input->post("kelas"),
					'aktif'=>$this->input->post("aktif"),
					'created_by'=>$this->session->userdata('id'),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('jabatan', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'nama'=>trim($this->input->post("nama")),
					'parent'=>$this->input->post("parent"),
					'id_skpd'=>$this->input->post("skpd"),
					'type'=>$this->input->post("type"),
					'nilai'=>$this->input->post("nilai"),
					'kelas'=>$this->input->post("kelas"),
					'aktif'=>$this->input->post("aktif"),
					'updated_by'=>$this->session->userdata('id'),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('jabatan', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function unit_kerja(){
		$this->data['list_css_plugin'] = array(
			'jquery.gritter/css/jquery.gritter.css',
			'datatables/css/dataTables.bootstrap.css',
			'datatables/css/datatables.responsive.css',
			'fuelux/dist/css/fuelux.min.css',
			'bootstrap-datepicker-vitalets/css/datepicker.css',
			'chosen_v1.2.0/chosen.min.css'
		);
		$this->data['list_js_plugin'] = array(
			'datatables/js/jquery.dataTables.min.js',
			'datatables/js/dataTables.bootstrap.js',
			'datatables/js/datatables.responsive.js',
			'fuelux/dist/js/fuelux.min.js',
			'jquery.gritter/js/jquery.gritter.min.js',
			'jquery-validation/dist/jquery.validate.min.js',
			'noty/js/noty/packaged/jquery.noty.packaged.min.js',
			'bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js',
			'chosen_v1.2.0/chosen.jquery.min.js'
		);
		$this->layout('default/unit_kerja', $this->data);
	}

	function skpd_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('unit_kerja', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = ["nama"=>""];
		}
		if($this->data['user_active']['fid_user_level'] == 1){
			$this->data['list_level'] = $this->global->find_data('user_level', array('active'=>1))->result();
		} else{
			$array_id = array(1,6);
			$this->data['list_level'] = $this->db
				->select('*')
				->where('active', 1)
				->where_not_in('id', $array_id)
				->get('user_level')->result();
		}
		
		$this->load->view('default/skpd_form', $this->data);
	}

	function skpd_save(){
		$flag = $this->input->post("flag");
		$username = trim($this->input->post("username"));
		if($flag == 0){
			$check = $this->global->find_data('user', array('username'=>$username));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$data = array(
					'nama'=>trim($this->input->post("nama")),
				);
				$simpan = $this->global->save_data('unit_kerja', $data);
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		} else{
			$skpd = array(
					'nama'=>trim($this->input->post("nama")),				
				);
			$simpan = $this->global->edit_data('unit_kerja', $skpd, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
			
		}
		redirect('master/unit_kerja');
	}

	function skpd_save_backup() {
		$data = array(
			'nama'=>trim($this->input->post("nama")),
		);
		$simpan = $this->global->save_data('unit_kerja', $data);
		if($simpan == "TRUE"){
			$status = 'success';
		} else{
			$status = 'error';
		}

		redirect('master/unit_kerja');
	}

	function hapusskpd($id) {
		$this->load->model('skpd_model');
		if ($id != NULL) {
			$this->skpd_model->hapus($id);
		}

		redirect('master/unit_kerja');
	}

	

	function unit_kerja_json(){
		$query = $this->db
			->select('a.*')
			->get('unit_kerja a')->result_array();
		$output=array('data'=>array());
		
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['nama']);
			array_push($baris,array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("master/skpd_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit SKPD", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>
			<a onclick = "return confirm(\'Apakah anda yakin ingin menghapus item ini ?\')" href="'.base_url().'master/hapusskpd/'.$data['id'].'"><span data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><button class="btn btn-danger btn-xs"><i class="fa fa-close"></i></button></span></a>'));
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

}
