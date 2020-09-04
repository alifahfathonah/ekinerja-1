<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends DJ_Admin {

	function personal(){
		$this->data['list_css_plugin'] = array(
				'bootstrap-datepicker-vitalets/css/datepicker.css'
			);
		$this->data['list_js_plugin'] = array(
				'jquery-validation/dist/jquery.validate.min.js',
				'noty/js/noty/packaged/jquery.noty.packaged.min.js',
				'bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js'
			);

		$find_data = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')));
		$this->data['find_data'] = $find_data->row_array();
		$this->layout('default/personal_data', $this->data);
	}

	function personal_save(){
		$tunjangan = count($this->input->post("tunjangan"));
		if($tunjangan > 0){
			$tunjangan_val = implode(',', $this->input->post("tunjangan"));
		} else{
			$tunjangan_val = '';
		}
		$data = array(
				'nip'=> trim($this->input->post("nip")),
				'nama_panggilan'=> trim($this->input->post("nama_panggilan")),
				'nama'=> trim($this->input->post("nama")),
				'fid_jabatan'=> $this->input->post("fid_jabatan"),
				'tmp_lahir'=> trim($this->input->post("tmp_lahir")),
				'tgl_lahir'=> $this->input->post("tgl_lahir"),
				'gender'=> $this->input->post("gender"),
				'agama'=> $this->input->post("agama"),
				'alamat'=> trim($this->input->post("alamat")),
				'no_hp'=> trim($this->input->post("no_hp")),
				'npwp'=> trim($this->input->post("npwp")),
				'jenis_pegawai'=> $this->input->post("jenis_pegawai"),
				'pangkat_golongan'=> $this->input->post("pangkat_golongan"),
				'instansi_kerja'=> trim($this->input->post("instansi_kerja")),
				'unit_kerja'=> trim($this->input->post("unit_kerja")),
				'tunjangan'=> $tunjangan_val,
				'updated_by'=>$this->session->userdata('id'),
				'updated_date'=>date('Y-m-d H:i:s')
			);
		$simpan = $this->global->edit_data('pegawai', $data, array('fid_user'=>$this->session->userdata('id')));
		if($simpan == "TRUE"){
			$status = 'success';
		} else{
			$status = 'error';
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function riwayat_kepangkatan(){
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

		$this->layout('default/riwayat_pangkat', $this->data);
	}

	function riwayat_kepangkatan_json(){
		$query = $this->db
			->select('a.*, b.nama AS pejabat')
			->where('a.fid_user', $this->session->userdata('id'))
			->join('pegawai b', 'a.pejabat_sah=b.id')
			->get('riwayat_pangkat a')->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,pangkat_golongan($data['pangkat_golongan']));
			array_push($baris,$data['tmt']);
			array_push($baris,$data['no_sk']);
			array_push($baris,$data['tgl_sk']);
			array_push($baris,$data['pejabat']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/riwayat_kepangkatan_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Riwayat Kepangkatan", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function riwayat_kepangkatan_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('riwayat_pangkat', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = ["fid_user"=>"","tmt"=>"","no_sk"=>"","tgl_sk"=>"","pangkat_golongan"=>"","pejabat_sah"=>""];
		}

		$jabatan = $this->db
			->select('id')
			->where('type', 'Pejabat')
			->where('aktif', 'Ya')
			->get_compiled_select('jabatan');
		$this->data['arr_pejabat'] = $this->db
			->select('id, nama')
			->where("fid_jabatan IN ($jabatan)", NULL, FALSE)
			->get('pegawai')->result_array();
		$this->load->view('default/riwayat_pangkat_form', $this->data);
	}

	function riwayat_kepangkatan_save(){
		$flag = $this->input->post("flag");
		$pangkat_golongan = $this->input->post("pangkat_golongan");
		if($flag == 0){
			$check = $this->global->find_data('riwayat_pangkat', array('fid_user'=>$this->session->userdata('id'), 'pangkat_golongan'=>$pangkat_golongan));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$data = array(
						'fid_user'=>$this->session->userdata('id'),
						'tmt'=>$this->input->post("tmt"),
						'no_sk'=>$this->input->post("no_sk"),
						'tgl_sk'=>$this->input->post("tgl_sk"),
						'pangkat_golongan'=>$pangkat_golongan,
						'pejabat_sah'=>trim($this->input->post("pejabat_sah")),
						'created_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->save_data('riwayat_pangkat', $data);
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		} else{
			$check = $this->global->find_data('riwayat_pangkat', array('fid_user'=>$this->session->userdata('id'), 'pangkat_golongan'=>$pangkat_golongan, 'id !='=>$flag));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$data = array(
						'tmt'=>$this->input->post("tmt"),
						'no_sk'=>$this->input->post("no_sk"),
						'tgl_sk'=>$this->input->post("tgl_sk"),
						'pangkat_golongan'=>$pangkat_golongan,
						'pejabat_sah'=>trim($this->input->post("pejabat_sah")),
						'updated_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->edit_data('riwayat_pangkat', $data, array('id'=>$flag));
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function riwayat_jabatan(){
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

		$this->layout('default/riwayat_jabatan', $this->data);
	}

	function riwayat_jabatan_json(){
		$query = $this->db
			->select('a.*, b.nama AS pejabat')
			->where('a.fid_user', $this->session->userdata('id'))
			->join('pegawai b', 'a.pejabat_sah=b.id')
			->get('riwayat_jabatan a')->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['jabatan']);
			array_push($baris,$data['unit_kerja']);
			array_push($baris,$data['eselon']);
			array_push($baris,$data['tmt']);
			array_push($baris,$data['no_sk']);
			array_push($baris,$data['tgl_sk']);
			array_push($baris,$data['pejabat']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/riwayat_jabatan_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Riwayat Jabatan", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function riwayat_jabatan_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('riwayat_jabatan', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$jabatan = $this->db
			->select('id')
			->where('type', 'Pejabat')
			->where('aktif', 'Ya')
			->get_compiled_select('jabatan');
		$this->data['arr_pejabat'] = $this->db
			->select('id, nama')
			->where("fid_jabatan IN ($jabatan)", NULL, FALSE)
			->get('pegawai')->result_array();
		$this->load->view('default/riwayat_jabatan_form', $this->data);
	}

	function riwayat_jabatan_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'jabatan'=>trim($this->input->post("jabatan")),
					'unit_kerja'=>trim($this->input->post("unit_kerja")),
					'eselon'=>trim($this->input->post("eselon")),
					'tmt'=>$this->input->post("tmt"),
					'no_sk'=>$this->input->post("no_sk"),
					'tgl_sk'=>$this->input->post("tgl_sk"),
					'pejabat_sah'=>trim($this->input->post("pejabat_sah")),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('riwayat_jabatan', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'jabatan'=>trim($this->input->post("jabatan")),
					'unit_kerja'=>trim($this->input->post("unit_kerja")),
					'eselon'=>trim($this->input->post("eselon")),
					'tmt'=>$this->input->post("tmt"),
					'no_sk'=>$this->input->post("no_sk"),
					'tgl_sk'=>$this->input->post("tgl_sk"),
					'pejabat_sah'=>trim($this->input->post("pejabat_sah")),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('riwayat_jabatan', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function riwayat_pendidikan(){
		$this->data['list_css_plugin'] = array(
				'jquery.gritter/css/jquery.gritter.css',
				'datatables/css/dataTables.bootstrap.css',
				'datatables/css/datatables.responsive.css',
				'fuelux/dist/css/fuelux.min.css',
				'bootstrap-datepicker-vitalets/css/datepicker.css'
			);
		$this->data['list_js_plugin'] = array(
				'datatables/js/jquery.dataTables.min.js',
				'datatables/js/dataTables.bootstrap.js',
				'datatables/js/datatables.responsive.js',
				'fuelux/dist/js/fuelux.min.js',
				'jquery.gritter/js/jquery.gritter.min.js',
				'jquery-validation/dist/jquery.validate.min.js',
				'noty/js/noty/packaged/jquery.noty.packaged.min.js',
				'bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js'
			);

		$this->layout('default/riwayat_pendidikan', $this->data);
	}

	function riwayat_pendidikan_json(){
		$query = $this->global->find_data('riwayat_pendidikan', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,pendidikan($data['pendidikan']));
			array_push($baris,$data['nama_instansi']);
			array_push($baris,$data['pimpinan_instansi']);
			array_push($baris,$data['no_ijazah']);
			array_push($baris,$data['tgl_ijazah']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/riwayat_pendidikan_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Riwayat Pendidikan Umum", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function riwayat_pendidikan_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('riwayat_pendidikan', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/riwayat_pendidikan_form', $this->data);
	}

	function riwayat_pendidikan_save(){
		$flag = $this->input->post("flag");
		$pendidikan = $this->input->post("pendidikan");
		if($flag == 0){
			$check = $this->global->find_data('riwayat_pendidikan', array('fid_user'=>$this->session->userdata('id'), 'pendidikan'=>$pendidikan));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$data = array(
						'fid_user'=>$this->session->userdata('id'),
						'pendidikan'=>$pendidikan,
						'nama_instansi'=>trim($this->input->post("nama_instansi")),
						'pimpinan_instansi'=>trim($this->input->post("pimpinan_instansi")),
						'no_ijazah'=>trim($this->input->post("no_ijazah")),
						'tgl_ijazah'=>trim($this->input->post("tgl_ijazah")),
						'created_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->save_data('riwayat_pendidikan', $data);
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		} else{
			$check = $this->global->find_data('riwayat_pendidikan', array('fid_user'=>$this->session->userdata('id'), 'pendidikan'=>$pendidikan, 'id !='=>$flag));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$data = array(
						'pendidikan'=>$pendidikan,
						'nama_instansi'=>trim($this->input->post("nama_instansi")),
						'pimpinan_instansi'=>trim($this->input->post("pimpinan_instansi")),
						'no_ijazah'=>trim($this->input->post("no_ijazah")),
						'tgl_ijazah'=>trim($this->input->post("tgl_ijazah")),
						'updated_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->edit_data('riwayat_pendidikan', $data, array('id'=>$flag));
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function riwayat_diklat_json(){
		$query = $this->global->find_data('riwayat_pelatihan', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['nama_diklat']);
			array_push($baris,$data['penyelenggara']);
			array_push($baris,$data['tahun']);
			array_push($baris,$data['lama']);
			array_push($baris,$data['no_sttp']);
			array_push($baris,$data['tgl_sttp']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/riwayat_diklat_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Riwayat Pendidikan dan Pelatihan", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function riwayat_diklat_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('riwayat_pelatihan', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/riwayat_pelatihan_form', $this->data);
	}

	function riwayat_diklat_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'kategori_diklat'=>$this->input->post("kategori"),
					'nama_diklat'=>trim($this->input->post("nama_diklat")),
					'penyelenggara'=>trim($this->input->post("penyelenggara")),
					'tahun'=>trim($this->input->post("tahun")),
					'lama'=>trim($this->input->post("lama")),
					'no_sttp'=>trim($this->input->post("no_sttp")),
					'tgl_sttp'=>trim($this->input->post("tgl_sttp")),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('riwayat_pelatihan', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'kategori_diklat'=>$this->input->post("kategori"),
					'nama_diklat'=>trim($this->input->post("nama_diklat")),
					'penyelenggara'=>trim($this->input->post("penyelenggara")),
					'tahun'=>trim($this->input->post("tahun")),
					'lama'=>trim($this->input->post("lama")),
					'no_sttp'=>trim($this->input->post("no_sttp")),
					'tgl_sttp'=>trim($this->input->post("tgl_sttp")),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('riwayat_pelatihan', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function disiplin(){
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

		$this->layout('default/disiplin', $this->data);
	}

	function disiplin_json(){
		$query = $this->global->find_data('disiplin', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['tahun']);
			array_push($baris,$data['tingkat']);
			array_push($baris,$data['jenis']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/disiplin_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Disiplin", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function disiplin_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('disiplin', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/disiplin_form', $this->data);
	}

	function disiplin_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'tahun'=>trim($this->input->post("tahun")),
					'tingkat'=>trim($this->input->post("tingkat")),
					'jenis'=>trim($this->input->post("jenis")),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('disiplin', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'tahun'=>trim($this->input->post("tahun")),
					'tingkat'=>trim($this->input->post("tingkat")),
					'jenis'=>trim($this->input->post("jenis")),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('disiplin', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function penghargaan(){
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

		$this->layout('default/penghargaan', $this->data);
	}

	function penghargaan_json(){
		$query = $this->global->find_data('penghargaan', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['tahun']);
			array_push($baris,$data['tingkat']);
			array_push($baris,$data['nama']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/penghargaan_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Penghargaan", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function penghargaan_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('penghargaan', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/penghargaan_form', $this->data);
	}

	function penghargaan_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'tahun'=>trim($this->input->post("tahun")),
					'tingkat'=>trim($this->input->post("tingkat")),
					'nama'=>trim($this->input->post("nama")),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('penghargaan', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'tahun'=>trim($this->input->post("tahun")),
					'tingkat'=>trim($this->input->post("tingkat")),
					'nama'=>trim($this->input->post("nama")),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('penghargaan', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function riwayat_kesehatan(){
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

		$this->layout('default/riwayat_kesehatan', $this->data);
	}

	function riwayat_kesehatan_json(){
		$query = $this->global->find_data('riwayat_kesehatan', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['tahun']);
			array_push($baris,$data['penyakit']);
			array_push($baris,$data['dokter']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/riwayat_kesehatan_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Riwayat Kesehatan", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function riwayat_kesehatan_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('riwayat_kesehatan', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/riwayat_kesehatan_form', $this->data);
	}

	function riwayat_kesehatan_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'tahun'=>trim($this->input->post("tahun")),
					'penyakit'=>trim($this->input->post("penyakit")),
					'dokter'=>trim($this->input->post("dokter")),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('riwayat_kesehatan', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'tahun'=>trim($this->input->post("tahun")),
					'penyakit'=>trim($this->input->post("penyakit")),
					'dokter'=>trim($this->input->post("dokter")),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('riwayat_kesehatan', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function bahasa_asing(){
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

		$this->layout('default/bahasa_asing', $this->data);
	}

	function bahasa_asing_json(){
		$query = $this->global->find_data('bahasa_asing', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['bahasa']);
			array_push($baris,aktif($data['aktif']));
			array_push($baris,aktif($data['pasif']));
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/bahasa_asing_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Bahasa Asing", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function bahasa_asing_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('bahasa_asing', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/bahasa_asing_form', $this->data);
	}

	function bahasa_asing_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'bahasa'=>trim($this->input->post("bahasa")),
					'aktif'=>trim($this->input->post("aktif")),
					'pasif'=>trim($this->input->post("pasif")),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('bahasa_asing', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'bahasa'=>trim($this->input->post("bahasa")),
					'aktif'=>trim($this->input->post("aktif")),
					'pasif'=>trim($this->input->post("pasif")),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('bahasa_asing', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function prestasi(){
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

		$this->layout('default/prestasi', $this->data);
	}

	function prestasi_json(){
		$query = $this->global->find_data('prestasi', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['tahun']);
			array_push($baris,$data['bidang']);
			array_push($baris,$data['tingkat']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/prestasi_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Prestasi", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function prestasi_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('prestasi', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/prestasi_form', $this->data);
	}

	function prestasi_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'tahun'=>trim($this->input->post("tahun")),
					'tingkat'=>trim($this->input->post("tingkat")),
					'bidang'=>trim($this->input->post("bidang")),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('prestasi', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'tahun'=>trim($this->input->post("tahun")),
					'tingkat'=>trim($this->input->post("tingkat")),
					'bidang'=>trim($this->input->post("bidang")),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('prestasi', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function keluarga(){
		$this->data['list_css_plugin'] = array(
				'jquery.gritter/css/jquery.gritter.css',
				'datatables/css/dataTables.bootstrap.css',
				'datatables/css/datatables.responsive.css',
				'fuelux/dist/css/fuelux.min.css',
				'bootstrap-datepicker-vitalets/css/datepicker.css'
			);
		$this->data['list_js_plugin'] = array(
				'datatables/js/jquery.dataTables.min.js',
				'datatables/js/dataTables.bootstrap.js',
				'datatables/js/datatables.responsive.js',
				'fuelux/dist/js/fuelux.min.js',
				'jquery.gritter/js/jquery.gritter.min.js',
				'jquery-validation/dist/jquery.validate.min.js',
				'noty/js/noty/packaged/jquery.noty.packaged.min.js',
				'bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js'
			);

		$this->layout('default/keluarga', $this->data);
	}

	function keluarga_json(){
		$query = $this->global->find_data('keluarga', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['nama']);
			array_push($baris,$data['tgl_lahir']);
			array_push($baris,$data['akte_lahir']);
			array_push($baris,$data['status']);
			array_push($baris,$data['surat_nikah']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("profil/keluarga_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Keluarga", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function keluarga_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('keluarga', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/keluarga_form', $this->data);
	}

	function keluarga_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'nama'=>strtoupper(trim($this->input->post("nama"))),
					'tgl_lahir'=>trim($this->input->post("tgl_lahir")),
					'akte_lahir'=>trim($this->input->post("akte_lahir")),
					'status'=>trim($this->input->post("status")),
					'surat_nikah'=>trim($this->input->post("surat_nikah")),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('keluarga', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'nama'=>strtoupper(trim($this->input->post("nama"))),
					'tgl_lahir'=>trim($this->input->post("tgl_lahir")),
					'akte_lahir'=>trim($this->input->post("akte_lahir")),
					'status'=>trim($this->input->post("status")),
					'surat_nikah'=>trim($this->input->post("surat_nikah")),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('keluarga', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

}
