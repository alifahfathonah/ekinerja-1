<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends DJ_Admin {
	public function index()
	{	
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

		switch ($this->data['user_active']['fid_user_level']) {
			case 1:
				$this->layout('default/pegawai_admin', $this->data);
				break;
			case 5:
				$this->layout('default/pegawai_admin_dinas', $this->data);
				break;
			default:
				$this->layout('default/pegawai_non_admin', $this->data);
				break;
		}
	}

	function deleteFile($id) {
		$id = base64_decode($id);
		$explod = explode("|",$id);
		$this->load->model('upload_model');

		$this->upload_model->hapus($explod[0],$explod[1]);

		if (isset($_SERVER['HTTP_REFERER']))
        {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
	}
	

	function pegawai_json(){
		$query = $this->db
			->select('a.*, b.nama AS jabatan, c.email, c.foto, c.active')
			->join('user c', 'a.fid_user=c.id', 'LEFT')
			->join('jabatan b', 'a.fid_jabatan=b.id', 'LEFT')
			->get('pegawai a')->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			if(file_exists('./upload/images/profil/'.$data['foto']) && $data['foto'] != NULL){
				$foto = '<img src="'.base_url().'upload/images/profil/'.$data['foto'].'" class="img-circle img-bordered-theme" alt="foto" width="50px">';
			} else{
				$foto = '<img src="'.base_url().'themes/default/assets/img/no-image.jpg" class="img-circle img-bordered-theme" alt="foto" width="50px">';
			}
			$baris=array();
			array_push($baris,$foto.'<span>'.$data['nip'].'</span>');
			array_push($baris,$data['nama']);
			array_push($baris,$data['jabatan']);
			array_push($baris,$data['email']);
			array_push($baris,$data['active']);
			array_push($baris, '<div class="btn-group">
				<span data-toggle="tooltip" data-placement="top" data-original-title="Detail Pegawai"><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/pegawai_detil", "contentModal", "id='.$data['id'].'");open_modal("modal-lg", "Detail Pegawai", "modal-danger");\'><i class="fa fa-eye"></i></button></span>
				<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/pegawai_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Pegawai", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>
				</div>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function pegawai_dinas_json(){
		$query = $this->db
			->select('a.*, b.nama AS jabatan, c.email, c.foto, c.active')
			->where('a.unit_kerja', $this->data['user_active']['unit_kerja'])
			->join('user c', 'a.fid_user=c.id', 'LEFT')
			->join('jabatan b', 'a.fid_jabatan=b.id', 'LEFT')
			->get('pegawai a')->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			if(file_exists('./upload/images/profil/'.$data['foto']) && $data['foto'] != NULL){
				$foto = '<img src="'.base_url().'upload/images/profil/'.$data['foto'].'" class="img-circle img-bordered-theme" alt="foto" width="50px">';
			} else{
				$foto = '<img src="'.base_url().'themes/default/assets/img/no-image.jpg" class="img-circle img-bordered-theme" alt="foto" width="50px">';
			}
			$baris=array();
			array_push($baris,$foto.'<span>'.$data['nip'].'</span>');
			array_push($baris,$data['nama']);
			array_push($baris,$data['jabatan']);
			array_push($baris,$data['email']);
			array_push($baris,$data['active']);
			array_push($baris, '<div class="btn-group">
				<span data-toggle="tooltip" data-placement="top" data-original-title="Detail Pegawai"><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/pegawai_detil", "contentModal", "id='.$data['id'].'");open_modal("modal-lg", "Detail Pegawai", "modal-danger");\'><i class="fa fa-eye"></i></button></span>
				<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/pegawai_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Pegawai", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>
				</div>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function pegawai_non_json(){
		$query = $this->db
			->select('a.*, b.nama AS jabatan, c.email, c.foto, c.active')
			->where('a.unit_kerja', $this->data['user_active']['unit_kerja'])
			->join('user c', 'a.fid_user=c.id', 'LEFT')
			->join('jabatan b', 'a.fid_jabatan=b.id', 'LEFT')
			->get('pegawai a')->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			if(file_exists('./upload/images/profil/'.$data['foto']) && $data['foto'] != NULL){
				$foto = '<img src="'.base_url().'upload/images/profil/'.$data['foto'].'" class="img-circle img-bordered-theme" alt="foto" width="50px">';
			} else{
				$foto = '<img src="'.base_url().'themes/default/assets/img/no-image.jpg" class="img-circle img-bordered-theme" alt="foto" width="50px">';
			}
			$baris=array();
			array_push($baris,$foto.'<span>'.$data['nip'].'</span>');
			array_push($baris,$data['nama']);
			array_push($baris,$data['jabatan']);
			array_push($baris,$data['email']);
			array_push($baris,$data['active']);
			array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Detail Pegawai"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/pegawai_detil", "contentModal", "id='.$data['id'].'");open_modal("", "Detail Pegawai", "modal-danger");\'><i class="fa fa-eye"></i></button></span>');
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function pegawai_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('pegawai', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = ["nip"=>"","nama_panggilan"=>"","nama"=>"","fid_user"=>0,
			"fid_jabatan"=>"","unit_kerja"=>""];
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
		
		$this->load->view('default/pegawai_form', $this->data);
	}

	function pegawai_save(){
		$flag = $this->input->post("flag");
		$username = trim($this->input->post("username"));
		if($flag == 0){
			$check = $this->global->find_data('user', array('username'=>$username));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$nip = "'".$this->input->post("nip")."'";
				$checkNip = $this->global->count_data('pegawai', 'nip='.$nip);

				if ($checkNip > 0) {
					$status = 'error';
					return $this->output->set_output(json_encode(array('status'=>$status)));
				}

				$data_user = array(
						'fid_user_level'=>$this->input->post("role"),
						'username'=>$username,
						'password'=>md5($this->input->post("password").$this->config->item('keyRandom')),
						'email'=>trim($this->input->post("email")),
						'active'=>$this->input->post("aktif")
					);
				$simpan_user = $this->global->save_getLastID('user', $data_user);
				$data = array(
						'fid_user'=>$simpan_user,
						'nip'=>trim($this->input->post("nip")),
						'nama_panggilan'=>trim($this->input->post("nama_panggilan")),
						'nama'=>trim($this->input->post("nama")),
						'fid_jabatan'=>$this->input->post("fid_jabatan"),
						'unit_kerja'=>$this->input->post("unit_kerja"),
						'created_by'=>$this->session->userdata('id'),
						'created_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->save_data('pegawai', $data);
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		} else{
			$new_flag = $this->global->find_data('pegawai', array('id'=>$flag))->row_array();
			$check = $this->global->find_data('user', array('username'=>$username, 'id !='=>$new_flag['fid_user']));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				// $nip = "'".$this->input->post("nip")."'";
				// $checkNip = $this->global->count_data('pegawai', 'nip='.$nip);
				
				// if ($checkNip > 0) {
				// 	$status = 'error';
				// 	return $this->output->set_output(json_encode(array('status'=>$status)));
				// }

				$dataUser = array(
						'fid_user_level'=>$this->input->post("role"),
						'username'=>$username,
						'password'=>md5($this->input->post("password").$this->config->item('keyRandom')),
						'email'=>trim($this->input->post("email")),
						'active'=>$this->input->post("aktif")
					);
				$this->global->edit_data('user', $dataUser, array('id'=>$new_flag['fid_user']));
				$pegawai = array(
						'nip'=>trim($this->input->post("nip")),
						'nama_panggilan'=>trim($this->input->post("nama_panggilan")),
						'nama'=>trim($this->input->post("nama")),
						'fid_jabatan'=>$this->input->post("fid_jabatan"),
						'unit_kerja'=>$this->input->post("unit_kerja"),
						'updated_by'=>$this->session->userdata('id'),
						'updated_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->edit_data('pegawai', $pegawai, array('id'=>$flag));
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function duk(){
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
		$this->layout('default/duk', $this->data);
	}

	function duk_json(){
		if($this->data['user_active']['fid_user_level'] == 5){
			$button = '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/duk_form", "contentModal", "id=$1");open_modal("", "Edit Data DUK", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>';
		} else{
			$button = '-';
		}
		header('Content-Type: application/json');
        $this->datatables->select("a.id, a.thn_masakerja, a.bln_masakerja, CONCAT(b.nama, ' / ',b.nip) AS pegawai, a.urutan_duk, a.fid_pangkat_akhir, d.jabatan, a.tahun_duk");
        $this->datatables->where('b.unit_kerja', $this->data['user_active']['unit_kerja']);
        $this->datatables->from('duk a');
        $this->datatables->join('pegawai b', 'a.fid_pegawai=b.id', 'LEFT');
        $this->datatables->join('riwayat_pangkat c', 'a.fid_pangkat_akhir=c.id', 'LEFT');
        $this->datatables->join('riwayat_jabatan d', 'a.fid_jabatan_akhir=d.id', 'LEFT');
        $this->datatables->add_column('view', $button, 'id');
        echo $this->datatables->generate();
	}

	function duk_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('duk', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/duk_form', $this->data);
	}

	function duk_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_pegawai'=>$this->input->post("fid_pegawai"),
					'fid_pangkat_akhir'=>$this->input->post("fid_pangkat_akhir"),
					'fid_jabatan_akhir'=>$this->input->post("fid_jabatan_akhir"),
					'thn_masakerja'=>trim($this->input->post("thn_masakerja")),
					'bln_masakerja'=>trim($this->input->post("bln_masakerja")),
					'tahun_duk'=>trim($this->input->post("tahun_duk")),
					'urutan_duk'=>trim($this->input->post("urutan_duk")),
					'created_by'=>$this->session->userdata('id'),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('duk', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'fid_pegawai'=>$this->input->post("fid_pegawai"),
					'fid_pangkat_akhir'=>$this->input->post("fid_pangkat_akhir"),
					'fid_jabatan_akhir'=>$this->input->post("fid_jabatan_akhir"),
					'thn_masakerja'=>trim($this->input->post("thn_masakerja")),
					'bln_masakerja'=>trim($this->input->post("bln_masakerja")),
					'tahun_duk'=>trim($this->input->post("tahun_duk")),
					'urutan_duk'=>trim($this->input->post("urutan_duk")),
					'updated_by'=>$this->session->userdata('id'),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('duk', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function cari_pangkat_jabatan(){
		$option_pangkat = '<option value="">-- Pilih--</option>';
		$option_jabatan = '<option value="">-- Pilih--</option>';
		$id_pegawai = $this->input->post("id_pegawai");
		$pegawai = $this->global->find_data('pegawai', array('id'=>$id_pegawai))->row_array();
		$pangkat = $this->global->find_data('riwayat_pangkat', array('fid_user'=>$pegawai['fid_user']), 'tgl_sk', 'DESC')->result_array();
		$jabatan = $this->global->find_data('riwayat_jabatan', array('fid_user'=>$pegawai['fid_user']), 'tgl_sk', 'DESC')->result_array();
		foreach ($pangkat as $value) {
			$option_pangkat .= '<option value="'.$value['id'].'">'.pangkat_golongan($value['pangkat_golongan']).' - '.$value['tgl_sk'].'</option>';
		}
		foreach ($jabatan as $value) {
			$option_jabatan .= '<option value="'.$value['id'].'">'.$value['jabatan'].' - '.$value['tgl_sk'].'</option>';
		}
		$this->output->set_output(json_encode(array('pangkat'=>$option_pangkat, 'jabatan'=>$option_jabatan)));
	}

	function kgb(){
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

		$this->layout('default/kgb', $this->data);
	}

	function kgb_json(){
		$query = $this->db
			->select('a.*, b.nama AS pegawai, b.nip')
			->where('b.unit_kerja', $this->data['user_active']['unit_kerja'])
			->join('pegawai b', 'a.fid_pegawai=b.id', 'LEFT')
			->get('kgb a')->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['pegawai'].'<br> NIP: '.$data['nip']);
			array_push($baris,number_format($data['gaji_lama'],0,",","."));
			array_push($baris,number_format($data['gaji_baru'],0,",","."));
			array_push($baris,$data['tanggal']);
			if($this->data['user_active']['fid_user_level'] == 5){
				$button = '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/kgb_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Data KGB", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>';
			} else{
				$button = '-';
			}
			array_push($baris, $button);
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function kgb_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('kgb', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/kgb_form', $this->data);
	}

	function kgb_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_pegawai'=>trim($this->input->post("fid_pegawai")),
					'gaji_lama'=>str_replace(".", "", $this->input->post("gaji_lama")),
					'gaji_baru'=>str_replace(".", "", $this->input->post("gaji_baru")),
					'tanggal'=>trim($this->input->post("tanggal")),
					'created_by'=>$this->session->userdata('id'),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('kgb', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'fid_pegawai'=>trim($this->input->post("fid_pegawai")),
					'gaji_lama'=>str_replace(".", "", $this->input->post("gaji_lama")),
					'gaji_baru'=>str_replace(".", "", $this->input->post("gaji_baru")),
					'tanggal'=>trim($this->input->post("tanggal")),
					'updated_by'=>$this->session->userdata('id'),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('kgb', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function naik_pangkat(){
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
		$this->layout('default/kenaikan_pangkat', $this->data);
	}

	function naik_pangkat_json(){
        $query = $this->db
			->select('a.*, b.nama AS pegawai, b.nip')
			->where('b.unit_kerja', $this->data['user_active']['unit_kerja'])
			->join('pegawai b', 'a.fid_pegawai=b.id', 'LEFT')
			->get('kenaikan_pangkat a')->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['pegawai'].'<br> NIP: '.$data['nip']);
			array_push($baris,pangkat_golongan($data['fid_pangkat_lama']));
			array_push($baris,pangkat_golongan($data['fid_pangkat_baru']));
			array_push($baris,$data['tgl_pertek']);
			array_push($baris,$data['tgl_sk']);
			array_push($baris,$data['no_sk']);
			if($this->data['user_active']['fid_user_level'] == 5){
				$button = '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/naik_pangkat_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Data Kenaikan Pangkat", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>';
			} else{
				$button = '-';
			}
			array_push($baris, $button);
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function naik_pangkat_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('kenaikan_pangkat', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/kenaikan_pangkat_form', $this->data);
	}

	function naik_pangkat_save(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_pegawai'=>$this->input->post("fid_pegawai"),
					'fid_pangkat_lama'=>$this->input->post("fid_pangkat_lama"),
					'fid_pangkat_baru'=>$this->input->post("fid_pangkat_baru"),
					'tgl_sk'=>trim($this->input->post("tgl_sk")),
					'no_sk'=>trim($this->input->post("no_sk")),
					'tgl_pertek'=>trim($this->input->post("tgl_pertek")),
					'created_by'=>$this->session->userdata('id'),
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('kenaikan_pangkat', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'fid_pegawai'=>$this->input->post("fid_pegawai"),
					'fid_pangkat_lama'=>$this->input->post("fid_pangkat_lama"),
					'fid_pangkat_baru'=>$this->input->post("fid_pangkat_baru"),
					'tgl_sk'=>trim($this->input->post("tgl_sk")),
					'no_sk'=>trim($this->input->post("no_sk")),
					'tgl_pertek'=>trim($this->input->post("tgl_pertek")),
					'updated_by'=>$this->session->userdata('id'),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('kenaikan_pangkat', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function dp3(){
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
		$this->layout('default/dp3', $this->data);
	}

	function dp3_json(){
        if($this->data['user_active']['fid_user_level'] == 1){
			$button = '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/dp3_form", "contentModal", "id=$1");open_modal("", "Edit Data Nilai DP-3", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>';
		} else{
			$button = '-';
		}
		header('Content-Type: application/json');
        $this->datatables->select("a.id, a.tahun, c.nama AS pejabat, d.nama AS atasan_pejabat, a.nilai_avg, CONCAT(b.nama, ' / ',b.nip) AS pegawai");
        $this->datatables->from('dp3 a');
        $this->datatables->join('pegawai b', 'a.fid_pegawai=b.id', 'LEFT');
        $this->datatables->join('pegawai c', 'a.pejabat=c.id', 'LEFT');
        $this->datatables->join('pegawai d', 'a.atasan_pejabat=d.id', 'LEFT');
        $this->datatables->add_column('view', $button, 'id');
        echo $this->datatables->generate();
	}

	function dp3_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('dp3', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/dp3_form', $this->data);
	}

	function dp3_save(){
		$flag = $this->input->post("flag");
		$nilai1 = trim($this->input->post("nilai_orientasi"));
		$nilai2 = trim($this->input->post("nilai_integritas"));
		$nilai3 = trim($this->input->post("nilai_komitmen"));
		$nilai4 = trim($this->input->post("nilai_disiplin"));
		$nilai5 = trim($this->input->post("nilai_kerjasama"));
		$nilai6 = trim($this->input->post("nilai_kepemimpinan"));
		$total = $nilai1+$nilai2+$nilai3+$nilai4+$nilai4+$nilai6;
		$avg = ($total / 6);

		$tahun = trim($this->input->post("tahun"));
		if($flag == 0){
			$check = $this->global->find_data('dp3', array('fid_pegawai'=>$this->input->post("fid_pegawai"),'tahun'=>$tahun));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$data = array(
						'fid_pegawai'=>$this->input->post("fid_pegawai"),
						'tahun'=>$tahun,
						'pejabat'=>trim($this->input->post("pejabat")),
						'atasan_pejabat'=>trim($this->input->post("atasan_pejabat")),
						'nilai_orientasi'=>$nilai1,
						'nilai_integritas'=>$nilai2,
						'nilai_komitmen'=>$nilai3,
						'nilai_disiplin'=>$nilai4,
						'nilai_kerjasama'=>$nilai5,
						'nilai_kepemimpinan'=>$nilai6,
						'nilai_avg'=>$avg,
						'created_by'=>$this->session->userdata('id'),
						'created_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->save_data('dp3', $data);
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		} else{
			$check = $this->global->find_data('dp3', array('fid_pegawai'=>$this->input->post("fid_pegawai"), 'tahun'=>$tahun, 'id !='=>$flag));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$data = array(
						'fid_pegawai'=>$this->input->post("fid_pegawai"),
						'tahun'=>$tahun,
						'pejabat'=>trim($this->input->post("pejabat")),
						'atasan_pejabat'=>trim($this->input->post("atasan_pejabat")),
						'nilai_orientasi'=>$nilai1,
						'nilai_integritas'=>$nilai2,
						'nilai_komitmen'=>$nilai3,
						'nilai_disiplin'=>$nilai4,
						'nilai_kerjasama'=>$nilai5,
						'nilai_kepemimpinan'=>$nilai6,
						'nilai_avg'=>$avg,
						'updated_by'=>$this->session->userdata('id'),
						'updated_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->edit_data('dp3', $data, array('id'=>$flag));
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function cari_pejabat(){
		$option_pejabat = '<option value="">-- Pilih--</option>';
		$option_atasan_pejabat = '<option value="">-- Pilih--</option>';
		$id_pegawai = $this->input->post("id_pegawai");
		$pegawai = $this->global->find_data('pegawai', array('id'=>$id_pegawai))->row_array();

		$jabatan = $this->global->find_data('jabatan', array('id'=>$pegawai['fid_jabatan']))->row_array();
		$fid_jabPejabat = $jabatan['parent'];
		if($fid_jabPejabat == 0){
			$option_pejabat .= '<option value="'.$pegawai['id'].'">'.$pegawai['nama'].' - '.$pegawai['nip'].'</option>';
		} else{
			$pegawai_penilai = $this->global->find_data('pegawai', array('fid_jabatan'=>$fid_jabPejabat))->result_array();
			foreach ($pegawai_penilai as $value) {
				$option_pejabat .= '<option value="'.$value['id'].'">'.$value['nama'].' - '.$value['nip'].'</option>';
			}
		}
		$this->output->set_output(json_encode(array('pejabat'=>$option_pejabat)));
	}

	function cari_atasan_pejabat(){
		$option_pejabat = '<option value="">-- Pilih--</option>';
		$option_atasan_pejabat = '<option value="">-- Pilih--</option>';
		$id_pegawai = $this->input->post("id_pegawai");
		$pegawai = $this->global->find_data('pegawai', array('id'=>$id_pegawai))->row_array();

		$jabatan = $this->global->find_data('jabatan', array('id'=>$pegawai['fid_jabatan']))->row_array();
		$fid_jabPejabat = $jabatan['parent'];
		if($fid_jabPejabat == 0){
			$option_pejabat .= '<option value="'.$pegawai['id'].'">'.$pegawai['nama'].' - '.$pegawai['nip'].'</option>';
		} else{
			$pegawai_penilai = $this->global->find_data('pegawai', array('fid_jabatan'=>$fid_jabPejabat))->result_array();
			foreach ($pegawai_penilai as $value) {
				$option_pejabat .= '<option value="'.$value['id'].'">'.$value['nama'].' - '.$value['nip'].'</option>';
			}
		}
		$this->output->set_output(json_encode(array('pejabat'=>$option_pejabat)));
	}

	function skp(){
		$this->data['list_css_plugin'] = array(
				'jquery.gritter/css/jquery.gritter.css',
				'datatables/css/dataTables.bootstrap.css',
				'datatables/css/datatables.responsive.css',
				'fuelux/dist/css/fuelux.min.css',
				'chosen_v1.2.0/chosen.min.css',
				'x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css'
			);
		$this->data['list_js_plugin'] = array(
				'datatables/js/jquery.dataTables.min.js',
				'datatables/js/dataTables.bootstrap.js',
				'datatables/js/datatables.responsive.js',
				'fuelux/dist/js/fuelux.min.js',
				'jquery.gritter/js/jquery.gritter.min.js',
				'jquery-validation/dist/jquery.validate.min.js',
				'noty/js/noty/packaged/jquery.noty.packaged.min.js',
				'chosen_v1.2.0/chosen.jquery.min.js',
				'jquery-mockjax/jquery.mockjax.js',
				'moment/min/moment.min.js',
				'x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js'
			);
		$this->layout('default/skp', $this->data);
	}

	function skp_json(){
        if($this->data['user_active']['fid_user_level'] == 1){
			$button = '<div class="btn-group">
				<span data-toggle="tooltip" data-placement="top" data-original-title="Input Nilai"><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/skp_detil", "contentModal", "id=$1");open_modal("modal-lg", "Input Nilai SKP", "modal-warning");\'><i class="fa fa-edit"></i> Input Nilai</button></span>
				<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("pegawai/skp_form", "contentModal", "id=$1");open_modal("", "Edit Data SKP", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>
				</div>';
		} else{
			$button = '-';
		}
		header('Content-Type: application/json');
        $this->datatables->select("a.id, a.tahun, c.nama AS pejabat, d.nama AS atasan_pejabat, CONCAT(b.nama, ' / ',b.nip) AS pegawai");
        $this->datatables->from('skp a');
        $this->datatables->join('pegawai b', 'a.fid_pegawai=b.id', 'LEFT');
        $this->datatables->join('pegawai c', 'a.pejabat=c.id', 'LEFT');
        $this->datatables->join('pegawai d', 'a.atasan_pejabat=d.id', 'LEFT');
        $this->datatables->add_column('view', $button, 'id');
        echo $this->datatables->generate();
	}

	function skp_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('skp', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
		}
		$this->load->view('default/skp_form', $this->data);
	}

	function skp_save(){
		$flag = $this->input->post("flag");
		$tahun = trim($this->input->post("tahun"));
		if($flag == 0){
			$check = $this->global->find_data('skp', array('fid_pegawai'=>$this->input->post("fid_pegawai"),'tahun'=>$tahun));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$data = array(
						'fid_pegawai'=>$this->input->post("fid_pegawai"),
						'tahun'=>$tahun,
						'pejabat'=>trim($this->input->post("pejabat")),
						'atasan_pejabat'=>trim($this->input->post("atasan_pejabat")),
						'created_by'=>$this->session->userdata('id'),
						'created_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->save_data('skp', $data);
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		} else{
			$check = $this->global->find_data('skp', array('fid_pegawai'=>$this->input->post("fid_pegawai"),'tahun'=>$tahun, 'id !='=>$flag));
			if($check->num_rows() > 0){
				$status = 'already';
			} else{
				$data = array(
						'fid_pegawai'=>$this->input->post("fid_pegawai"),
						'tahun'=>$tahun,
						'pejabat'=>trim($this->input->post("pejabat")),
						'atasan_pejabat'=>trim($this->input->post("atasan_pejabat")),
						'updated_by'=>$this->session->userdata('id'),
						'updated_date'=>date('Y-m-d H:i:s')
					);
				$simpan = $this->global->edit_data('skp', $data, array('id'=>$flag));
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function skp_detil(){
		$id_skp = $_POST['id'];
		$sql = $this->db
			->select('a.id, a.tahun, b.nama, b.nip')
			->where('a.id', $id_skp)
			->join('pegawai b', 'a.fid_pegawai=b.id', 'LEFT')
			->get('skp a')->row_array();
		$this->data['skp_pegawai'] = $sql;
		$this->load->view('default/skp_detil', $this->data);
	}

	function skp_detil_json($id_skp){
		$query = $this->global->find_data('skp_detil', array('fid_skp'=>$id_skp))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris,$data['tugas']);
			array_push($baris,'<a href="javascript:void(0);" class="ak1" data-pk="'.$data['id'].'">'.$data['ak1'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="tar_kuant" data-pk="'.$data['id'].'">'.$data['tar_kuant'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="tar_kual" data-pk="'.$data['id'].'">'.$data['tar_kual'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="tar_bln" data-pk="'.$data['id'].'">'.$data['tar_bln'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="tar_biaya" data-pk="'.$data['id'].'">'.$data['tar_biaya'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="ak2" data-pk="'.$data['id'].'">'.$data['ak2'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="rea_kuant" data-pk="'.$data['id'].'">'.$data['rea_kuant'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="rea_kual" data-pk="'.$data['id'].'">'.$data['rea_kual'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="rea_bln" data-pk="'.$data['id'].'">'.$data['rea_bln'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="rea_biaya" data-pk="'.$data['id'].'">'.$data['rea_biaya'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="perhitungan" data-pk="'.$data['id'].'">'.$data['perhitungan'].'</a>');
			array_push($baris,'<a href="javascript:void(0);" class="nilai" data-pk="'.$data['id'].'">'.$data['nilai'].'</a>');
			array_push($baris,$data['jenis_tugas']);
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function skp_detil_insert(){
		$data = array(
				'fid_skp'=>$this->input->post("fid_skp"),
				'jenis_tugas'=>$this->input->post("jenis_tugas"),
				'tugas'=>trim($this->input->post("tugas"))
			);
		$simpan = $this->global->save_data('skp_detil', $data);
		if($simpan == "TRUE"){
			$status = 'success';
		} else{
			$status = 'error';
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function skp_detil_save(){
		$field = $this->input->post("name");
		$value = $this->input->post("value");
		$pk = $this->input->post("pk");
		$simpan = $this->global->edit_data('skp_detil', array($field=>$value), array('id'=>$pk));
		if($simpan == "TRUE")
			$status = 1;
		else
			$status = 0;
		$this->output->set_output(json_encode($status));
	}

	function pegawai_detil(){
		$_id = $_POST['id'];
		$this->data['find_data'] = $this->global->find_data('pegawai', array('id'=>$_id))->row_array();
		$this->load->view('default/pegawai_detil', $this->data);
	}
}
