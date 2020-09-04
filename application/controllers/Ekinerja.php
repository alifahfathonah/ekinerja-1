<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekinerja extends DJ_Admin {

	public function index()
	{	
		$this->data['list_css_plugin'] = array('chosen_v1.2.0/chosen.min.css');
		$this->data['list_js_plugin'] = array('chosen_v1.2.0/chosen.jquery.min.js');

		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$this->layout('default/ekinerja/index', $this->data);
	}

	function hitung_tpp(){
		$fid_pegawai = $this->data['user_active']['id_pegawai'];
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$id_user = $this->session->userdata('id');
		$fid_jabatan = $this->data['user_active']['fid_jabatan'];

		//FIND SKP BULANAN
	    $sql_nilai = $this->global->find_data('ekin_prilaku', array('fid_pegawai'=>$fid_pegawai, 'bulan'=>$bulan, 'tahun'=>$tahun, 'status'=>'Diterima'))->row_array();
	    $nilai_kegiatan = 0;
	  	$nilai_tambahan = 0;
	  	$nilai_kreativ = 0;
	    $sql_kegiatan_tahunan = $this->global->find_data('ekin_keg_tahunan', array('fid_user'=>$id_user, 'tahun'=>$tahun, 'status'=>'Diterima'))->result_array();
	    $sql_tugas_tambahan = $this->global->find_data('ekin_tambahan_kreatifitas', array('fid_user'=>$id_user, 'tahun'=>$tahun, 'bulan'=>$bulan, 'jenis'=>'Tugas Tambahan', 'status'=>'Diterima'))->result_array();
    	$sql_kreativitas = $this->global->find_data('ekin_tambahan_kreatifitas', array('fid_user'=>$id_user, 'tahun'=>$tahun, 'bulan'=>$bulan, 'jenis'=>'Kreatifitas', 'status'=>'Diterima'))->result_array();
    	if(count($sql_tugas_tambahan) > 0){
    		if(count($sql_tugas_tambahan) <= 3){
	    		$nilai_tambahan = 1;
	    	} elseif(count($sql_tugas_tambahan) >= 4 && count($sql_tugas_tambahan) <=6){
	    		$nilai_tambahan = 2;
	    	} else{
				$nilai_tambahan = 3;
	    	}
    	}
    	if(count($sql_kreativitas) > 0){
		    foreach ($sql_kreativitas as $value) {
		    	$nilai_kreativ += $value['nilai'];
		    }
	    }
    	if(count($sql_kegiatan_tahunan) > 0){
	        foreach ($sql_kegiatan_tahunan as $kegTahun) {
	        	$sql_realisasi = $this->db
            	->select('a.nilai')
            	->where('b.fid_keg_tahunan', $kegTahun['id'])
            	->where('b.status', 'Diterima')
            	->where('b.bulan', $bulan)
            	->where('a.fid_user', $id_user)
            	->join('ekin_keg_bulanan b', 'a.fid_keg_bulanan=b.id')
            	->get('ekin_keg_bulanan_realisasi a')->row_array();
            	$nilai = $sql_realisasi['nilai'];
	            $nilai_kegiatan += $nilai;
	        }
	        $total_nilai = ($nilai_kegiatan / count($sql_kegiatan_tahunan)) + $nilai_tambahan + $nilai_kreativ;
			$nilai_skp = round($total_nilai, 2);
	    } else{
	    	$nilai_skp = 0;
	    }
	    //----- END FIND SKP BULANAN
	    $jml_nilai = $sql_nilai['orientasi']+$sql_nilai['integritas']+$sql_nilai['komitmen']+$sql_nilai['disiplin']+$sql_nilai['kerja_sama']+$sql_nilai['kepemimpinan'];
	    $hasil = 0;
	    if($jml_nilai > 0){
	    	$hasil = $jml_nilai;
	    	$rata_rata = round(($jml_nilai / 6), 2);
	    } else{
	    	$hasil = 0;
	    	$rata_rata = 0;
	    }


	    //NILAI JABATAN
	    $nilai_jabatan = show_row('jabatan', array('id'=>$fid_jabatan), 'nilai');
	    //INDEX Besaran Rupiah
	    $idr = show_row('setting', array('id'=>1), 'ekin_idr');

	    $hitung_nilai = $nilai_jabatan * $idr; //number_format($data['biaya'],0,",","."));

	    $valNKT = round(($nilai_skp * 60) / 100, 2);
	    $valNPK = round(($rata_rata * 40) / 100, 2);
	    $nilai_prestasi = round(($valNKT + $valNPK), 2);
	    $string_nilai = "(".string_nilai($nilai_prestasi).")";

	    $hitung1 = number_format($hitung_nilai,0,",",".")." x ".$nilai_prestasi." %";

	    $hasil1 = round(($hitung_nilai * $nilai_prestasi) / 100, 0);
	    $pajak = round(($hasil1 * 15) / 100, 0);
	    $hasilHitung = number_format(($hasil1 - $pajak),0,",",".");

		$this->output->set_output(json_encode(array('output'=>'success', 'hitung1'=>$hitung1, 'hasil1'=>"= ".number_format($hasil1,0,",","."), 'pajak'=>"= ".number_format($pajak,0,",","."), 'hasilHitung'=>"= ".$hasilHitung, 'valNKT'=>$valNKT, 'valNPK'=>$valNPK, 'valPrestasi'=>$nilai_prestasi, 'string_nilai'=>$string_nilai)));
	}

	function keg_tahunan(){
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
		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');

		$this->layout('default/ekinerja/keg_tahunan', $this->data);
	}

	function keg_tahunan_json(){
		$tahun = $this->input->post('tahun');
		$query = $this->global->find_data('ekin_keg_tahunan', array('fid_user'=>$this->session->userdata('id'), 'tahun'=>$tahun))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			$baris=array();
			array_push($baris, $data['kegiatan']);
			array_push($baris, $data['target_kuantitas']);
			array_push($baris,number_format($data['biaya'],0,",","."));
			array_push($baris,$data['angka_kredit']);
			if($data['status'] == 'Draft'){
				array_push($baris, '<button class="BreakDown btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="BreakDown" data-id="'.$data['id'].'"><i class="fa fa-plus-square"></i></button>');
			} else{
				array_push($baris, '-');
			}
			array_push($baris, $data['status']);
			if($data['status'] == 'Draft'){
				array_push($baris, '<span data-toggle="tooltip" data-placement="top" data-original-title="Edit"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("ekinerja/keg_tahunan_form", "contentModal", "id='.$data['id'].'");open_modal("", "Edit Target Kinerja Tahunan", "modal-primary");\'><i class="fa fa-pencil"></i></button></span>
				<a onclick = "return confirm(\'Apakah anda yakin ingin menghapus item ini ?\')" href="'.base_url().'Ekinerja/hapuskinerja/'.$data['id'].'"><span data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><button class="btn btn-danger btn-xs"><i class="fa fa-close"></i></button></span></a>');
			} else{
				array_push($baris, '-');
			}
			
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function hapuskinerja($id) {
		$this->load->model('ekinerja_model');
		if ($id != NULL) {
			$this->ekinerja_model->hapus($id);
		}

		redirect('ekinerja/keg_tahunan');
	}

	function keg_tahunan_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('ekin_keg_tahunan', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
			if($find_data['status'] == 'Draft'){
				$this->data['btn_ajukan'] = '<a class="btn btn-primary ajukan"><i class="fa fa-mail-forward"></i> Ajukan Ke Atasan/Pejabat Penilai</a>';
			} else{
				$this->data['btn_ajukan'] = '';
			}
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = ["kegiatan"=>"","jenis"=>"","target_kuantitas"=>0,
			"satuan"=>"","biaya"=>0,"angka_kredit"=>""];;
			$this->data['btn_ajukan'] = '';
		}
		$this->load->view('default/ekinerja/keg_tahunan_form', $this->data);
	}

	function keg_tahunan_post(){
		$flag = $this->input->post("flag");
		if($flag == 0){
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'tahun'=>trim($this->input->post("tahun")),
					'kegiatan'=>trim($this->input->post("kegiatan")),
					'jenis'=>$this->input->post("jenis"),
					'target_kuantitas'=>trim($this->input->post("target_kuantitas")),
					'satuan'=>trim($this->input->post("satuan")),
					'biaya'=>str_replace(".", "", $this->input->post("biaya")),
					'angka_kredit'=>trim($this->input->post("angka_kredit")),
					'target_penyelesaian'=>$this->input->post("target_penyelesaian"),
					'fid_jabatan'=>$this->data['user_active']['fid_jabatan'],
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan_keg_tahunan = $this->global->save_getLastID('ekin_keg_tahunan', $data);
			$data_tahun = array(
				'fid_kegiatan'=>$simpan_keg_tahunan,
				'fid_user'=>$this->session->userdata('id'),
				'jenis'=>'keg_tahunan',
				'aksi'=>'Tambah',
				'hasil'=>'Draft',
				'created_date'=>date('Y-m-d H:i:s')
			);
			$simpan = $this->global->save_data('ekin_log', $data_tahun);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'kegiatan'=>trim($this->input->post("kegiatan")),
					'jenis'=>$this->input->post("jenis"),
					'target_kuantitas'=>trim($this->input->post("target_kuantitas")),
					'satuan'=>trim($this->input->post("satuan")),
					'biaya'=>str_replace(".", "", $this->input->post("biaya")),
					'angka_kredit'=>trim($this->input->post("angka_kredit")),
					'target_penyelesaian'=>$this->input->post("target_penyelesaian"),
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('ekin_keg_tahunan', $data, array('id'=>$flag));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function keg_tahunan_breakdown(){
		$html = '';
		$id = $this->input->post('idx');
		$count = show_row('ekin_keg_tahunan', array('id'=>$id), 'target_penyelesaian');
		$count_result = (int) $count;
		$html .= '<div class="animated fadeIn"><center>';
		if($count_result == 12){
			for($i=1;$i<$count_result+1;$i++){
				$html .= '<button type="button" class="btn btn-primary btn-stroke btn-dashed" data-toggle="modal" data-target="#modal_data" onclick=\'top.callPages("ekinerja/keg_tahunan_breakdown_form", "contentModal", "id_keg='.$id.'&bulan='.$i.'");top.open_modal("", "BreakDown Target Bulanan", "modal-primary");\'>'.bulan($i).'</button>';
			}
		} else{
			$query_bln = $this->db
				->select('bulan')
				->group_by('bulan')
				->where('fid_keg_tahunan', $id)
				->get('ekin_keg_bulanan');
			$count_bln = $query_bln->num_rows();
			$selisih = $count_result - $count_bln;

			if(($count_bln > 0) && ($count_bln < $count_result)){
				foreach ($query_bln->result_array() as $rsbln) {
					$html .= '<button type="button" class="col-sm-2 btn btn-primary btn-stroke btn-dashed" data-toggle="modal" data-target="#modal_data" onclick=\'top.callPages("ekinerja/keg_tahunan_breakdown_form", "contentModal", "id_keg='.$id.'&bulan='.$rsbln['bulan'].'");top.open_modal("", "BreakDown Target Bulanan", "modal-primary");\'>'.bulan($rsbln['bulan']).'</button>';
				}
			}
			if($selisih == 0){
				foreach ($query_bln->result_array() as $rsbln) {
					$html .= '<button type="button" class="btn btn-primary btn-stroke btn-dashed" data-toggle="modal" data-target="#modal_data" onclick=\'top.callPages("ekinerja/keg_tahunan_breakdown_form", "contentModal", "id_keg='.$id.'&bulan='.$rsbln['bulan'].'");top.open_modal("", "BreakDown Target Bulanan", "modal-primary");\'>'.bulan($rsbln['bulan']).'</button>';
				}
			}
			if($selisih != 0){
				for($i=1;$i<$selisih+1;$i++){
					$html .= '<div class="input-group mb-10 mr-10">
								<select class="form-control" id="bulan_'.$i.'">
									<option value="">Pilih Bulan</option>';
					foreach (bulan() as $key => $value) {
						$html .= '<option value="'.$key.'">'.$value.'</option>';
					}
					$html .= '</select>
				                <span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_data" onclick=\'javascript: var val_bulan=document.getElementById("bulan_'.$i.'").value; if(val_bulan == ""){top.callPages("ekinerja/bulan_null", "contentModal", "");top.open_modal("", "BreakDown Target Bulanan", "modal-primary");} else{top.callPages("ekinerja/keg_tahunan_breakdown_form", "contentModal", "id_keg='.$id.'&bulan="+val_bulan);top.open_modal("", "BreakDown Target Bulanan", "modal-primary");} \'>BreakDown</button></span>
				            </div>';
				}
			}
		}
		$html .='</center></div>';
		$this->output->set_output(json_encode(array('html'=>$html)));
	}

	function bulan_null(){
		echo '<h3 class="text-center text-danger">PILIH BULAN TERLEBIH DULU</h3>';
	}

	function keg_tahunan_breakdown_form(){
		$this->data['id_keg'] = $this->input->post('id_keg');
		$this->data['bulan'] = $this->input->post('bulan');
		$this->data['list_data_bulan'] = '';
		$query = $this->global->find_data('ekin_keg_bulanan', array('fid_keg_tahunan'=>$this->data['id_keg'], 'bulan'=>$this->data['bulan']));
		if($query->num_rows() > 0){
			$no=1;
			foreach ($query->result_array() as $key) {
				$this->data['list_data_bulan'] .= '<tr>
					<td class="text-center border-right">'.$no++.'</td>
					<td>'.$key['kuantitas'].'</td>
					<td>'.$key['satuan'].'</td>
					<td>'.$key['waktu'].'&nbsp;'.$key['periode_waktu'].'</td>
					<td class="text-center">
						<a href="javascript:void(0);" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Delete"><i class="fa fa-times"></i></a>
					</td>
				</tr>';
			}
		} else{
			$this->data['list_data_bulan'] .= '<tr class="text-center"><td colspan="5">data masih kosong.....</td></tr>';
		}
		$this->load->view('default/ekinerja/keg_tahunan_breakdown', $this->data);
	}

	function keg_bulanan_post(){
		$bulan = $this->input->post("bulan");
		$keg_tahunan = trim($this->input->post("idKegiatan"));
		$cek_data = $this->global->find_data('ekin_keg_bulanan', array('fid_keg_tahunan'=>$keg_tahunan,'bulan'=>$bulan));
		if($cek_data->num_rows() > 0){
			$status = 'already';
		} else{
			$data = array(
				'fid_user'=>$this->session->userdata('id'),
				'fid_keg_tahunan'=>trim($this->input->post("idKegiatan")),
				'bulan'=>$this->input->post("bulan"),
				//'kegiatan'=>trim($this->input->post("kegiatan")),
				'kuantitas'=>trim($this->input->post("kuantitas")),
				'satuan'=>trim($this->input->post("satuan")),
				'biaya'=>str_replace(".", "", $this->input->post("biaya")),
				'angka_kredit'=>trim($this->input->post("angka_kredit")),
				'waktu'=>trim($this->input->post("waktu")),
				'periode_waktu'=>trim($this->input->post("periode_waktu")),
				'created_date'=>date('Y-m-d H:i:s')
			);
			$simpan_keg_bulan = $this->global->save_getLastID('ekin_keg_bulanan', $data);
			$data_bulan = array(
				'fid_kegiatan'=>$simpan_keg_bulan,
				'fid_user'=>$this->session->userdata('id'),
				'jenis'=>'keg_bulanan',
				'aksi'=>'Tambah',
				'hasil'=>'Draft',
				'created_date'=>date('Y-m-d H:i:s')
			);
			$simpan = $this->global->save_data('ekin_log', $data_bulan);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}
		
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function keg_bulanan(){
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
		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$this->layout('default/ekinerja/keg_bulanan', $this->data);
	}

	function keg_bulanan_json(){
		$tahun = $this->input->post('tahun');
		header('Content-Type: application/json');
        $this->datatables->select('a.id,a.bulan, b.kegiatan AS keg_thn, a.kuantitas, CONCAT(a.waktu," ", a.periode_waktu) as waktu, a.status, c.nilai, b.status AS status_thn');
        $this->datatables->where('a.fid_user', $this->session->userdata('id'));
        $this->datatables->where('b.tahun', $tahun);
        $this->datatables->from('ekin_keg_bulanan a');
        $this->datatables->join('ekin_keg_tahunan b', 'a.fid_keg_tahunan=b.id');
        $this->datatables->join('ekin_keg_bulanan_realisasi c', 'a.id=c.fid_keg_bulanan', 'LEFT');
        $this->datatables->add_column('view', '<span data-toggle="tooltip" data-placement="top" data-original-title="Detail"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("ekinerja/keg_bulanan_realisasi", "contentModal", "id=$1");open_modal("modal-lg", "Realisasi Kinerja Bulanan", "modal-primary");\'><i class="fa fa-book"></i></button></span>', 'id');
        echo $this->datatables->generate();
	}

	function keg_bulanan_realisasi(){
		$idx = $this->input->post('id');
		$check_row = $this->global->find_data('ekin_keg_bulanan_realisasi', array('fid_keg_bulanan'=>$idx));
		if($check_row->num_rows() > 0){
			$this->data['find_data'] = $check_row->row_array();
			$this->data['undifine'] = 1;
		} else{
			$this->data['find_data'] = FALSE;
			$this->data['undifine'] = 0;
		}
		$this->data['flag'] = $idx;

		$this->data['result'] = $this->global->find_data('ekin_keg_bulanan', array('id'=>$idx))->row_array();
		if($this->data['result']['status'] !== 'Draft'){
			$this->data['readonly'] = 'readonly';
		} else{
			$this->data['readonly'] = '';
		}
		$this->load->view('default/ekinerja/keg_bulanan_realisasi', $this->data);
	}

	function keg_bulanan_realisasi_post(){
		$id_keg = trim($this->input->post('id_keg'));
		$kuantitas = trim($this->input->post('kuantitas'));
		$kualitas = trim($this->input->post('kualitas'));
		$biaya = str_replace(".", "", $this->input->post("biaya"));
		$angka_kredit = trim($this->input->post('angka_kredit'));
		$waktu = trim($this->input->post('waktu'));

		$find = $this->global->find_data('ekin_keg_bulanan', array('id'=>$id_keg))->row_array();
		$tar_kuantitas = $find['kuantitas'];
		$tar_waktu = $find['waktu'];
		$tar_kualitas = 100;
		$tar_biaya = $find['biaya'];

		$hit_kuantitas = 0;
		$hit_kualitas = 0;
		$hit_waktu = 0;
		$hit_biaya = 0;
		$varWaktu = 0;
		$varbiaya = 0;
		$pembagi = 0;

		$hit_kuantitas = ($kuantitas / $tar_kuantitas) * 100;
		$hit_kualitas = ($kualitas / $tar_kualitas) * 100;
		$hit_waktu = 100-(($waktu/$tar_waktu) * 100);
		if($hit_waktu <= 24){
			$varWaktu = (((1.76 * $tar_waktu) - $waktu) / $tar_waktu) * 100;
		} else{
			$varWaktu = 76 - (((((1.76 * $tar_waktu) - $waktu) / $tar_waktu) * 100) - 100);
		}
		if($tar_biaya == 0){
			$pembagi = 3;
			$perhitungan = $hit_kuantitas + $hit_kualitas + $varWaktu;
		} else{
			$hit_biaya = 100-(($biaya/$tar_biaya) * 100);
			if($hit_biaya <= 24){
				$varbiaya = (((1.76 * $tar_biaya) - $biaya) / $tar_biaya) * 100;
			} else{
				$varbiaya = 76 - (((((1.76 * $tar_biaya) - $biaya) / $tar_biaya) * 100) - 100);
			}
			$pembagi = 4;
			$perhitungan = $hit_kuantitas + $hit_kualitas + $varWaktu + $varbiaya;
		}
		$nilai = $perhitungan / $pembagi;

		$cek_data = $this->global->find_data('ekin_keg_bulanan_realisasi', array('fid_keg_bulanan'=>$id_keg));
		if($cek_data->num_rows() > 0){
			$data = array(
					'kuantitas'=>$kuantitas,
					'kualitas'=>$kualitas,
					'biaya'=>$biaya,
					'angka_kredit'=>$angka_kredit,
					'waktu'=>$waktu,
					'perhitungan'=>$perhitungan,
					'nilai'=>$nilai,
					'updated_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->edit_data('ekin_keg_bulanan_realisasi', $data, array('fid_keg_bulanan'=>$id_keg));
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} else{
			$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'fid_keg_bulanan'=>$id_keg,
					'kuantitas'=>$kuantitas,
					'kualitas'=>$kualitas,
					'biaya'=>$biaya,
					'angka_kredit'=>$angka_kredit,
					'waktu'=>$waktu,
					'perhitungan'=>$perhitungan,
					'nilai'=>$nilai,
					'created_date'=>date('Y-m-d H:i:s')
				);
			$simpan = $this->global->save_data('ekin_keg_bulanan_realisasi', $data);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		}

		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function tgs_tambkrea(){
		$this->data['list_css_plugin'] = array(
				'jquery.gritter/css/jquery.gritter.css',
				'datatables/css/dataTables.bootstrap.css',
				'datatables/css/datatables.responsive.css',
				'fuelux/dist/css/fuelux.min.css',
				'jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css'
			);
		$this->data['list_js_plugin'] = array(
				'datatables/js/jquery.dataTables.min.js',
				'datatables/js/dataTables.bootstrap.js',
				'datatables/js/datatables.responsive.js',
				'fuelux/dist/js/fuelux.min.js',
				'jquery.gritter/js/jquery.gritter.min.js',
				'jquery-validation/dist/jquery.validate.min.js',
				'noty/js/noty/packaged/jquery.noty.packaged.min.js',
				'jasny-bootstrap-fileinput/js/jasny-bootstrap.fileinput.min.js'
			);
		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$this->layout('default/ekinerja/tugas_tamkre', $this->data);
	}

	function tgs_tambkrea_json(){
		$tahun = $this->input->post('tahun');
		header('Content-Type: application/json');
        $this->datatables->select('id,tahun,bulan,kegiatan,jenis,status');
        $this->datatables->where('fid_user', $this->session->userdata('id'));
        $this->datatables->where('tahun', $tahun);
        $this->datatables->from('ekin_tambahan_kreatifitas');
        $this->datatables->add_column('view', '<span data-toggle="tooltip" data-placement="top" data-original-title="Detail"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("ekinerja/tgs_tambkrea_form", "contentModal", "id=$1");open_modal("", "Detail Tugas Tambahan & Kreatifitas", "modal-primary");\'><i class="fa fa-book"></i></button></span>', 'id');
        echo $this->datatables->generate();
	}

	function tgs_tambkrea_form(){
		if(isset($_POST['id'])){
			$this->data['flag'] = $_POST['id'];
			$find_data = $this->global->find_data('ekin_tambahan_kreatifitas', array('id'=>$_POST['id']))->row_array();
			$this->data['find_data'] = $find_data;
			if($find_data['status'] == 'Draft'){
				$this->data['btn_ajukan'] = '<a class="btn btn-primary ajukan"><i class="fa fa-mail-forward"></i> Ajukan Ke Atasan/Pejabat Penilai</a>';
				$this->data['readonly'] = '';
			} else{
				$this->data['btn_ajukan'] = '';
				$this->data['readonly'] = 'readonly';
			}
			
		} else{
			$this->data['flag'] = 0;
			$this->data['find_data'] = FALSE;
			$this->data['btn_ajukan'] = '';
			$this->data['readonly'] = '';
		}

		$this->load->view('default/ekinerja/tugas_tamkre_form', $this->data);
	}

	function tgs_tambkrea_post(){
		header('Content-Type: application/json');

		$flag = $this->input->post("flag");
		$tahun = $this->input->post("tahun");
		$bulan = $this->input->post("bulan");
		$jenis = $this->input->post("jenis");
		$kegiatan = trim($this->input->post("kegiatan"));
		$note = trim($this->input->post("note"));
		$pesan = '';
		if (empty($_FILES['userfile']['name'])) {
			if($flag == 0){
				$data = array(
					'fid_user'=>$this->session->userdata('id'),
					'tahun'=>$tahun,
					'bulan'=>$bulan,
					'kegiatan'=>$kegiatan,
					'jenis'=>$jenis,
					'note'=>$note,
					'fid_jabatan'=>$this->data['user_active']['fid_jabatan'],
					'created_date'=>date('Y-m-d H:i:s')
				);
				$simpan_keg = $this->global->save_getLastID('ekin_tambahan_kreatifitas', $data);
				$data_log = array(
					'fid_kegiatan'=>$simpan_keg,
					'fid_user'=>$this->session->userdata('id'),
					'jenis'=>'tamker',
					'aksi'=>'Tambah',
					'hasil'=>'Draft',
					'created_date'=>date('Y-m-d H:i:s')
				);
				$simpan = $this->global->save_data('ekin_log', $data_log);
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			} else{
				$data = array(
					'tahun'=>$tahun,
					'bulan'=>$bulan,
					'kegiatan'=>$kegiatan,
					'jenis'=>$jenis,
					'note'=>$note,
					'updated_date'=>date('Y-m-d H:i:s')
				);
				$simpan = $this->global->edit_data('ekin_tambahan_kreatifitas', $data, array('id'=>$flag));
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		} 
		else{
			buat_direktori('./upload/file/');
			$config['upload_path'] = './upload/file/';
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = 10250;
			$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('userfile')){
				$data_upload = $this->upload->data();
				$nama_file = $data_upload['file_name'];
				if($flag == 0){
					$data = array(
						'fid_user'=>$this->session->userdata('id'),
						'tahun'=>$tahun,
						'bulan'=>$bulan,
						'kegiatan'=>$kegiatan,
						'jenis'=>$jenis,
						'file'=>$nama_file,
						'note'=>$note,
						'fid_jabatan'=>$this->data['user_active']['fid_jabatan'],
						'created_date'=>date('Y-m-d H:i:s')
					);
					$simpan_keg = $this->global->save_getLastID('ekin_tambahan_kreatifitas', $data);
					$data_log = array(
						'fid_kegiatan'=>$simpan_keg,
						'fid_user'=>$this->session->userdata('id'),
						'jenis'=>'tamker',
						'aksi'=>'Tambah',
						'hasil'=>'Draft',
						'created_date'=>date('Y-m-d H:i:s')
					);
					$simpan = $this->global->save_data('ekin_log', $data_log);
					if($simpan == "TRUE"){
						$status = 'success';
					} else{
						@unlink('./upload/file/'.$data_upload['file_name']);
						$status = 'error';
					}
				} else{
					$find_old_file = $this->global->find_data('ekin_tambahan_kreatifitas', array('id'=>$flag))->row_array();
					$data = array(
						'tahun'=>$tahun,
						'bulan'=>$bulan,
						'kegiatan'=>$kegiatan,
						'jenis'=>$jenis,
						'file'=>$nama_file,
						'note'=>$note,
						'updated_date'=>date('Y-m-d H:i:s')
					);
					$simpan = $this->global->edit_data('ekin_tambahan_kreatifitas', $data, array('id'=>$flag));
					if($simpan == "TRUE"){
						@unlink('./upload/file/'.$find_old_file['file']);
						$status = 'success';
					} else{
						@unlink('./upload/file/'.$data_upload['file_name']);
						$status = 'error';
					}
				}
			} else{
				@unlink('./upload/file/'.$data_upload['file_name']);
				$status = 'upload_error';
				$pesan = $this->upload->display_errors();
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status, 'pesan'=>$pesan)));
	}

	// HASIL PENILAIAN
	function hasil_penilaian(){
		$this->data['list_css_plugin'] = array(
			'bootstrap-datepicker-vitalets/css/datepicker.css',
			'bootstrap-daterangepicker/daterangepicker.css'
		);
		$this->data['list_js_plugin'] = array(
			'bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js',
			'moment/min/moment.min.js',
			'bootstrap-daterangepicker/daterangepicker.js'
		);
		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$this->layout('default/ekinerja/hasil_penilaian', $this->data);
	}

	function formulir_sasaran_kerja(){
		$this->load->library('pdf');
		$this->data['tahun'] = $this->input->post('tahun');
	  	$this->data['tanggal_cetak'] = trim($this->input->post('tanggal_cetak'));
	  	$this->data['fid_user'] = $this->session->userdata('id');
	  	$output_QR = 'Formulir Sasaran Kerja Tahun '.$this->data['tahun'].' Tanggal Cetak '.$this->data['tanggal_cetak'];
	  	$this->QrCodeGenerate($output_QR);
		$this->pdf->setPaper('legal', 'landscape'); //portrait/landscape
	    $this->pdf->filename = "formulir_sasaran_kerja_".$this->data['tahun'].".pdf";
	    $this->pdf->load_view('default/ekinerja/formulir_sasaran', $this->data);
	}

	function capaian_sasaran_kerja_tahunan(){
		$this->load->library('pdf');
		$this->data['tahun'] = $this->input->post('tahun');
	  	$tgl = $this->input->post('periode_penilaian');
		$pecah = explode('s/d', $tgl);
		$tglawal = trim($pecah[0]);
		$tglakhir = trim($pecah[1]);
		$this->data['periode_penilaian'] = tgl_indo($tglawal)." s/d ".tgl_indo($tglakhir);
	  	$this->data['tanggal_cetak'] = trim($this->input->post('tanggal_cetak'));
	  	$this->data['fid_user'] = $this->session->userdata('id');
	  	$output_QR = 'Capaian Sasaran Kerja Tahun '.$this->data['tahun'].' Tanggal Cetak '.$this->data['tanggal_cetak'];
	  	$this->QrCodeGenerate($output_QR);
		$this->pdf->setPaper('legal', 'landscape');
	    $this->pdf->filename = "capaian_sasaran_kerja_tahunan_".$this->data['tahun'].".pdf";
	    $this->pdf->load_view('default/ekinerja/capaian_sasaran_kerja_tahunan', $this->data);
	}

	function capaian_sasaran_kerja_bulanan(){
		$this->load->library('pdf');
		$this->data['tahun'] = $this->input->post('tahun');
	  	$this->data['bulan'] = $this->input->post('bulan');
	  	$this->data['tanggal_cetak'] = trim($this->input->post('tanggal_cetak'));
	  	$this->data['fid_user'] = $this->session->userdata('id');
	  	$output_QR = 'Capaian Sasaran Kerja Bulanan '.$this->data['tahun'].' Bulan '.$this->data['bulan'].' Tanggal Cetak '.$this->data['tanggal_cetak'];
	  	$this->QrCodeGenerate($output_QR);
		$this->pdf->setPaper('legal', 'landscape');
	    $this->pdf->filename = "capaian_sasaran_kerja_bulanan_".$this->data['tahun']."_bulan_".$this->data['bulan'].".pdf";
	    $this->pdf->load_view('default/ekinerja/capaian_sasaran_kerja_bulanan', $this->data);
	}

	function nilai_prilaku_tahunan(){
		$this->load->library('pdf');
		$this->data['tahun'] = $this->input->post('tahun');
	  	$tgl = $this->input->post('periode_penilaian');
		$pecah = explode('s/d', $tgl);
		$tglawal = trim($pecah[0]);
		$tglakhir = trim($pecah[1]);
		$this->data['periode_penilaian'] = tgl_indo($tglawal)." s/d ".tgl_indo($tglakhir);
	  	$this->data['fid_user'] = $this->session->userdata('id');
	  	$output_QR = 'Nilai Prilaku Tahun '.$this->data['tahun'].'';
	  	$this->QrCodeGenerate($output_QR);
		$this->pdf->setPaper('A4', 'portrait');
	    $this->pdf->filename = "nilai_prilaku_tahun_".$this->data['tahun'].".pdf";
	    $this->pdf->load_view('default/ekinerja/nilai_prilaku_tahunan', $this->data);
	}

	function nilai_prilaku_bulanan(){
		$this->load->library('pdf');
		$this->data['tahun'] = $this->input->post('tahun');
	  	$this->data['bulan'] = $this->input->post('bulan');
	  	$this->data['fid_user'] = $this->session->userdata('id');
	  	$output_QR = 'Nilai Prilaku Tahun '.$this->data['tahun'].' Bulan '.$this->data['bulan'].'';
	  	$this->QrCodeGenerate($output_QR);
		$this->pdf->setPaper('A4', 'portrait');
	    $this->pdf->filename = "nilai_prilaku_".$this->data['tahun']."_bulan_".$this->data['bulan'].".pdf";
	    $this->pdf->load_view('default/ekinerja/nilai_prilaku_bulanan', $this->data);
	}

	function prestasi_kerja_tahunan(){
		$this->load->library('pdf');
		$this->data['fid_user'] = $this->session->userdata('id');
		$this->data['tahun'] = $this->input->post('tahun');
		$tgl = $this->input->post('periode_penilaian');
		$pecah = explode('s/d', $tgl);
		$tglawal = trim($pecah[0]);
		$tglakhir = trim($pecah[1]);
		$this->data['periode_penilaian'] = tgl_indo($tglawal)." s/d ".tgl_indo($tglakhir);
		$this->pdf->setPaper('A4', 'portrait');
	    $this->pdf->filename = "hasil_prestasi_kerja_tahun_".$this->data['tahun'].".pdf";
	    $this->pdf->load_view('default/ekinerja/prestasi_kerja_tahunan', $this->data);
	}

	function prestasi_kerja_bulanan(){
		$this->load->library('pdf');
		$this->data['fid_user'] = $this->session->userdata('id');
		$this->data['tahun'] = $this->input->post('tahun');
		$this->data['bulan'] = $this->input->post('bulan');
		$this->pdf->setPaper('A4', 'portrait');
	    $this->pdf->filename = "hasil_prestasi_kerja_bulan_".$this->data['bulan']."_tahun_".$this->data['tahun'].".pdf";
	    $this->pdf->load_view('default/ekinerja/prestasi_kerja_bulanan', $this->data);
	}

	private function QrCodeGenerate($data ='test'){
		//SUMBER = https://github.com/dwisetiyadi/CodeIgniter-PHP-QR-Code
		$this->load->library('ciqrcode');
		//header("Content-Type: image/png"); view image live
		$params['level'] = 'H';
		$params['size'] = 4;
		$params['savename'] = FCPATH.'themes/default/assets/qrCode/output.png';
		//$params['savename'] = FCPATH.'output.png';
		$params['data'] = $data;
		$this->ciqrcode->generate($params);
	}

	// PENILAIAN BAWAHAN
	function prilaku_bawahan(){
		$this->data['list_css_plugin'] = array('x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css','chosen_v1.2.0/chosen.min.css');
		$this->data['list_js_plugin'] = array('noty/js/noty/packaged/jquery.noty.packaged.min.js','x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js','chosen_v1.2.0/chosen.jquery.min.js');
		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$bhw_jabatan = show_row('jabatan', array('parent'=>$this->data['user_active']['fid_jabatan'], 'aktif'=>'Ya'), 'id');
		$this->data['pgw_bawahan'] = $this->global->find_data('pegawai', array('fid_jabatan'=>$bhw_jabatan))->result_array();
		$this->layout('default/ekinerja/prilaku_bawahan', $this->data);
	}

	function prilaku_bawahan_filter(){
		$month = date('m');
		$html = '';
		$tahun = $this->input->post('tahun');
		$pegawai = $this->input->post('pegawai');
		if($pegawai == 0){
			$html .= '<div class="alert alert-danger text-center"><strong>Warning !!!</strong> Pilih Pegawai Terlebih Dahulu.</div>';
		} else{
			foreach (bulan() as $key => $value) {
				if((int)$month == $key){
					$warna = 'warning';
				}
				else{
					$warna = 'primary';
				}

				$check_row = $this->global->find_data('ekin_prilaku', array('fid_pegawai'=>$pegawai, 'tahun'=>$tahun, 'bulan'=>$key))->row_array();
				$orientasi = $check_row['orientasi'];
				$integritas = $check_row['integritas'];
				$komitmen = $check_row['komitmen'];
				$disiplin = $check_row['disiplin'];
				$kerja_sama = $check_row['kerja_sama'];
				$kepemimpinan = $check_row['kepemimpinan'];
				if($orientasi != NULL && $integritas != NULL && $komitmen != NULL && $disiplin != NULL && $kerja_sama != NULL && $kepemimpinan != NULL && $check_row['status'] == 'Penilaian'){
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-info" onclick=\'javascript:verify_prilaku("atasan",'.$check_row['id'].', "Verifikasi", "Penilaian", "Verifikasi");\'><i class="fa fa-mail-forward"></i> Ajukan ke Verifikasi</a>
                                </li>';
				} elseif($check_row['status'] == 'Verifikasi'){
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-warning"><i class="fa fa-gavel"></i> Proses Verifikasi</a>
                                </li>';
				} elseif($check_row['status'] == 'Diterima'){
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-success"><i class="fa fa-check-square-o"></i> Diterima</a>
                                </li>';
				} elseif($check_row['status'] == 'Ditolak'){
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-danger">Ditolak</a>
                                </li>';
				} else{
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-danger"><i class="fa fa-book"></i> Draft</a>
                                </li>';
				}

				$html .= '<div class="col-md-3">
	                        <div class="panel panel-'.$warna.'">
	                            <div class="panel-heading text-center">'.strtoupper($value).'</div>
	                            <div class="panel-body no-padding">
	                                <ul class="list-group no-margin">
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);" class="orpel" data-pk="'.$key.'">'.$orientasi.'</a>
	                                        </span>
	                                        Orientasi Pelayanan
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);" class="integ" data-pk="'.$key.'">'.$integritas.'</a>
	                                        </span>
	                                        Integritas
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);" class="komit" data-pk="'.$key.'">'.$komitmen.'</a>
	                                        </span>
	                                        Komitmen
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);" class="disip" data-pk="'.$key.'">'.$disiplin.'</a>
	                                        </span>
	                                        Disiplin
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);" class="kersa" data-pk="'.$key.'">'.$kerja_sama.'</a>
	                                        </span>
	                                        Kerja Sama
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);" class="kepe" data-pk="'.$key.'">'.$kepemimpinan.'</a>
	                                        </span>
	                                        Kepemimpinan
	                                    </li>
	                                    '.$add_row.'
	                                </ul>
	                            </div>
	                        </div>
	                    </div>';
			}
		}

		$this->output->set_output(json_encode(array('html'=>$html)));
	}

	function prilaku_bawahan_save(){
		$field = $this->input->post("name");
		$value = $this->input->post("value");
		$bulan = $this->input->post("pk");
		$tahun = $this->input->post("thn");
		$pegawai = $this->input->post("pgw"); // id_pegawai
		$pejabat = $this->session->userdata('id'); // id_user
		$date_now = date('Y-m-d H:i:s');

		$check_row = $this->global->find_data('ekin_prilaku', array('fid_pegawai'=>$pegawai, 'tahun'=>$tahun, 'bulan'=>$bulan));
		if($check_row->num_rows() > 0){
			$result = $check_row->row_array();
			$getID = $result['id'];
			if($result['status'] == 'Penilaian'){
				$simpan = $this->global->edit_data('ekin_prilaku', array($field=>$value, 'updated_date'=>$date_now), array('id'=>$getID));
			} else{
				$simpan = "FALSE";
			}
		} else{
			$data = array(
				'fid_pegawai'=>$pegawai,
				'fid_penilai'=>$pejabat,
				'bulan'=>$bulan,
				'tahun'=>$tahun,
				$field=>$value,
				'created_date'=>$date_now
			);
			$simpan = $this->global->save_data('ekin_prilaku', $data);
		}

		if($simpan == "TRUE"){
			$status = 1;
		} else{
			$status = 0;
		}
		$this->output->set_output(json_encode($status));
	}

	function target_tahunan_pgw(){
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

		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$bhw_jabatan = show_row('jabatan', array('parent'=>$this->data['user_active']['fid_jabatan'], 'aktif'=>'Ya'), 'id');
		$this->data['pgw_bawahan'] = $this->global->find_data('pegawai', array('fid_jabatan'=>$bhw_jabatan), 'nama', 'ASC')->result_array();
		$this->layout('default/ekinerja/target_tahunan_pgw', $this->data);
	}

	function target_tahunan_pgw_json(){
		$tahun = $this->input->post('tahun');
		$pegawai = $this->input->post('pegawai');
		$query = $this->global->find_data('ekin_keg_tahunan', array('fid_user'=>$pegawai, 'tahun'=>$tahun, 'status <>'=>'Draft'))->result_array();
		$output=array('data'=>array());
		foreach($query as $data){
			if($data['jenis'] == 'Tupoksi'){
				$jenis = '<span class="label label-success">'.$data['jenis'].'</span>';
			}
			else{
				$jenis = '<span class="label label-warning">'.$data['jenis'].'</span>';
			}
			$baris=array();
			array_push($baris, $data['kegiatan'].'&nbsp;'.$jenis);
			array_push($baris, $data['target_kuantitas']);
			array_push($baris,number_format($data['biaya'],0,",","."));
			array_push($baris,$data['angka_kredit']);
			array_push($baris, '<button class="BreakDown btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="BreakDown" data-id="'.$data['id'].'"><i class="fa fa-plus-square"></i></button>');
			if($data['status'] == 'Penilaian'){
				array_push($baris, '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Terima untuk Diverifikasi" onclick=\'javascript:send_virify("keg_tahunan_bwh",'.$data['id'].',"Verifikasi","Penilaian","Verifikasi","ekin_kegTahunanVerify");\'><i class="fa fa-check"></i></button>
				<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Tolak" onclick=\'javascript:send_virify("keg_tahunan_bwh",'.$data['id'].',"Ditolak","Penilaian","Ditolak","ekin_kegTahunanVerify");\'><i class="fa fa-close"></i></button>');
			} elseif($data['status'] == 'Diterima'){
				array_push($baris, '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Diterima"><i class="fa fa-check"></i></button>');
			} elseif($data['status'] == 'Ditolak'){
				array_push($baris, '<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Ditolak"><i class="fa fa-close"></i></button>');
			} else{
				array_push($baris, '<span class="label label-primary">Verifikasi</span>');
			}
			
			array_push($output['data'],$baris);
		}
		$this->output->set_output(json_encode($output));
	}

	function keg_tahunan_breakdown_bwh(){
		$html = '';
		$id = $this->input->post('idx');
		//$count = show_row('ekin_keg_tahunan', array('id'=>$id), 'target_penyelesaian');
		$html .= '<table class="table table-success">
			<thead>
				<tr>
					<th>Bulan</th>
					<th class="text-center">Kuantitas / Satuan</th>
					<th class="text-center">Biaya</th>
					<th class="text-center">AK</th>
					<th class="text-center">Priode Waktu</th>
				</tr>
			</thead>
			<tbody>';
		$query = $this->global->find_data('ekin_keg_bulanan', array('fid_keg_tahunan'=>$id))->result_array();
		$no = 1;
		foreach ($query as $value) {
			$html .='<tr>
				<td>'.bulan($value['bulan']).'</td>
				<td class="text-center">'.$value['kuantitas'].' / '.$value['satuan'].'</td>
				<td class="text-center">'.$value['biaya'].'</td>
				<td class="text-center">'.$value['angka_kredit'].'</td>
				<td class="text-center">'.$value['waktu'].'&nbsp;'.$value['periode_waktu'].'</td>
			</tr>';
		}
		$html .='</tbody></table>';

		$this->output->set_output(json_encode(array('html'=>$html)));
	}

	function realisasi_bulanan_pgw(){
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

		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$bhw_jabatan = show_row('jabatan', array('parent'=>$this->data['user_active']['fid_jabatan'], 'aktif'=>'Ya'), 'id');
		$this->data['pgw_bawahan'] = $this->global->find_data('pegawai', array('fid_jabatan'=>$bhw_jabatan), 'nama', 'ASC')->result_array();
		$this->layout('default/ekinerja/target_bulanan_pgw', $this->data);
	}

	function keg_bulanan_pgw_json(){
		$tahun = $this->input->post('tahun');
		$pegawai = $this->input->post('pegawai');
		header('Content-Type: application/json');
        $this->datatables->select('a.id,a.bulan, b.kegiatan AS keg_thn, a.kuantitas, CONCAT(a.waktu," ", a.periode_waktu) as waktu, a.status, c.nilai, b.status AS status_thn');
        $this->datatables->where('a.fid_user', $pegawai);
        $this->datatables->where('b.tahun', $tahun);
        $this->datatables->where('a.status !=', 'Draft');
        $this->datatables->from('ekin_keg_bulanan a');
        $this->datatables->join('ekin_keg_tahunan b', 'a.fid_keg_tahunan=b.id');
        $this->datatables->join('ekin_keg_bulanan_realisasi c', 'a.id=c.fid_keg_bulanan', 'LEFT');
        $this->datatables->add_column('view', '<span data-toggle="tooltip" data-placement="top" data-original-title="Detail"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("ekinerja/keg_bulanan_detail", "contentModal", "id=$1");open_modal("modal-lg", "Realisasi Kinerja Bulanan", "modal-primary");\'><i class="fa fa-book"></i></button></span>', 'id');
        echo $this->datatables->generate();
	}

	function keg_bulanan_detail(){
		$idx = $this->input->post('id');
		$this->data['find_data'] = $this->global->find_data('ekin_keg_bulanan_realisasi', array('fid_keg_bulanan'=>$idx))->row_array();
		$this->data['result'] = $this->global->find_data('ekin_keg_bulanan', array('id'=>$idx))->row_array();
		$this->load->view('default/ekinerja/keg_bulanan_detail', $this->data);
	}

	function tugas_pgw(){
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

		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$bhw_jabatan = show_row('jabatan', array('parent'=>$this->data['user_active']['fid_jabatan'], 'aktif'=>'Ya'), 'id');
		$this->data['pgw_bawahan'] = $this->global->find_data('pegawai', array('fid_jabatan'=>$bhw_jabatan), 'nama', 'ASC')->result_array();
		$this->layout('default/ekinerja/tugas_tamkre_pgw', $this->data);
	}

	function tugas_pgw_json(){
		$tahun = $this->input->post('tahun');
		$pegawai = $this->input->post('pegawai');
		header('Content-Type: application/json');
        $this->datatables->select('id,tahun,bulan,kegiatan,jenis,status');
        $this->datatables->where('fid_user', $pegawai);
        $this->datatables->where('tahun', $tahun);
        $this->datatables->where('status !=', 'Draft');
        $this->datatables->from('ekin_tambahan_kreatifitas');
        $this->datatables->add_column('view', '<span data-toggle="tooltip" data-placement="top" data-original-title="Detail"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("ekinerja/tugas_pgw_detail", "contentModal", "id=$1&oleh=penilai");open_modal("", "Detail Tugas Tambahan & Kreatifitas", "modal-primary");\'><i class="fa fa-book"></i></button></span>', 'id');
        echo $this->datatables->generate();
	}

	function tugas_pgw_detail(){
		$find_data = $this->global->find_data('ekin_tambahan_kreatifitas', array('id'=>$_POST['id']))->row_array();
		if(file_exists('./upload/file/'.$find_data['file']) && $find_data['file'] != NULL){
			$file = '<a href="'.base_url().'upload/file/'.$find_data['file'].'" target="_blank">'.$find_data['file'].'</a>';
		} else{
			$file = 'Tidak ada';
		}
		$check = $_POST['oleh'];
		$jenis = show_row('ekin_tambahan_kreatifitas', array('id'=>$_POST['id']), 'jenis');
		$role_show = '';
		$role = '<div class="row">
					<h4 class="text-center">Aturan Penilaian</h4>
					<table class="table table-bordered table-striped" width="100%">
			            <tr>
			            	<th class="text-center" width="5%">No</th>
			            	<th class="text-center">Kreativitas</th>
			            	<th class="text-center" width="10%">Nilai</th>
			            </tr>
			            <tr>
			            	<td class="text-center">1</td>
			            	<td>Apabila hasil yang ditemukan merupakan sesuatu yang baru dan bermanfaat bagi unit kerjanya dan dibuktikan dengan surat keterangan yang ditandatangani oleh kepala unit kerja atau pejabat eselon II diberikan nilai.</td>
			            	<td class="text-center">3</td>
			            </tr>
			            <tr>
			            	<td class="text-center">2</td>
			            	<td>Apabila hasil yang ditemukan merupakan sesuatu yang baru dan bermanfaat bagi organisasinya serta dibuktikan dengan surat keterangan yang ditandatangani oleh pejabat eselon I atau pimpinan instansi yang setingkat diberikan nilai.</td>
			            	<td class="text-center">6</td>
			            </tr>
			            <tr>
			            	<td class="text-center">3</td>
			            	<td>Apabila hasil yang ditemukan merupakan sesuatu yang baru dan bermanfaat bagi Negara serta dibuktikan dengan surat keterangan yang ditandatangani oleh pimpinan instansi yang tertinggi diberikan nilai.</td>
			            	<td class="text-center">12</td>
			            </tr>
			        </table>
				</div>';
		if($jenis == 'Kreatifitas'){
			if($check == 'penilai'){
				$role_show = $role;
				if($find_data['status'] == 'Penilaian'){
					$new_row = '<tr>
	                    <td class="text-right">Nilai</td>
	                    <td class="text-danger">
	                    	'.form_dropdown('nilai_kreatifitas', nilai_kreatifitas(), $find_data['nilai'], "class='form-control input-sm' style='width:150px;' onchange=\"javascript:penilaian_kreatifitas(this, ".$_POST['id'].");\" ").'
                        </td>
	                </tr>';
				} else{
					$new_row = '<tr>
	                    <td class="text-right">Nilai</td>
	                    <td class="text-danger">'.$find_data['nilai'].'</td>
	                </tr>';
				}
			} else{
				$role_show = $role;
				$new_row = '<tr>
	                    <td class="text-right">Nilai</td>
	                    <td class="text-danger">'.$find_data['nilai'].'</td>
	                </tr>';
			}
		} else{
			$new_row = '';
		}

		echo '<div class="panel-body animated fadeIn">
			    <div class="row">
			        <table class="table table-bordered table-striped" width="100%">
			            <tbody>
			            	<tr>
			                    <td class="text-right" width="30%">Tahun</td>
			                    <td class="text-danger">'.$find_data['tahun'].'</td>
			                </tr>
			                <tr>
			                    <td class="text-right">Bulan</td>
			                    <td class="text-danger">'.bulan($find_data['bulan']).'</td>
			                </tr>
			                <tr>
			                    <td class="text-right">Jenis</td>
			                    <td class="text-danger">'.$find_data['jenis'].'</td>
			                </tr>
			                <tr>
			                    <td class="text-right">Kegiatan</td>
			                    <td class="text-danger">'.$find_data['kegiatan'].'</td>
			                </tr>
			                <tr>
			                    <td class="text-right">File Bukti</td>
			                    <td class="text-danger">'.$file.'</td>
			                </tr>
			                <tr>
			                    <td class="text-right">Note</td>
			                    <td class="text-danger">'.$find_data['note'].'</td>
			                </tr>
			                '.$new_row.'
			            </tbody>
			        </table>
			    </div>
			    '.$role_show.'
			</div>';
	}

	function penilaian_kreatifitas(){
		$id = $this->input->post("id");
		$nilai = $this->input->post("nilai");
		$update = $this->global->edit_data('ekin_tambahan_kreatifitas', array('nilai'=>$nilai), array('id'=>$id));
		if($update == "TRUE"){
			$status = 'success';
			$pesan = 'Kegiatan berhasil di nilai.';
		} else{
			$status = 'error';
			$pesan = 'Terjadi Masalah.';
		}
		$this->output->set_output(json_encode(array('status'=>$status, 'pesan'=>$pesan)));
	}

	// END PENILAIAN BAWAHAN ---------------------

	// TEAM VERIFIKASI ---------------------
	function target_tahunan_verifikasi(){
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

		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$this->data['unit_kerja'] = $this->global->find_data('unit_kerja')->result_array();
		$this->layout('default/ekinerja/target_tahunan_verifikasi', $this->data);
	}

	function target_tahunan_verifikasi_json(){
		$tahun = $this->input->post('tahun');
		$unit_kerja = $this->input->post('unit_kerja');
		header('Content-Type: application/json');
        $this->datatables->select('a.id, a.kegiatan, a.jenis, a.biaya, CONCAT(a.target_kuantitas," / ",a.satuan) AS target_kuantitas, a.angka_kredit, a.status, b.nama, b.nip');
        $this->datatables->where('a.status !=', 'Draft');
        $this->datatables->where('a.tahun', $tahun);
        $this->datatables->where('b.unit_kerja', $unit_kerja);
        $this->datatables->from('ekin_keg_tahunan a');
        $this->datatables->join('pegawai b', 'a.fid_user=b.fid_user');
        $this->datatables->add_column('breakDown', '<button class="BreakDown btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="BreakDown" data-id="$1"><i class="fa fa-plus-square"></i></button>', 'id');
        echo $this->datatables->generate();
	}

	function target_bulanan_verifikasi(){
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

		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$this->data['unit_kerja'] = $this->global->find_data('unit_kerja')->result_array();
		$this->layout('default/ekinerja/target_bulanan_verifikasi', $this->data);
	}

	function target_bulanan_verifikasi_json(){
		$tahun = $this->input->post('tahun');
		$unit_kerja = $this->input->post('unit_kerja');
		header('Content-Type: application/json');
        $this->datatables->select('a.id,a.bulan, b.kegiatan AS keg_thn, a.kuantitas, CONCAT(a.waktu," ", a.periode_waktu) as waktu, a.status, c.nilai, b.status AS status_thn, d.nama, d.nip');
        $this->datatables->where('d.unit_kerja', $unit_kerja);
        $this->datatables->where('b.tahun', $tahun);
        $this->datatables->where('b.status !=', 'Draft');
        $this->datatables->where('a.status !=', 'Draft');
        $this->datatables->from('ekin_keg_bulanan a');
        $this->datatables->join('ekin_keg_tahunan b', 'a.fid_keg_tahunan=b.id');
        $this->datatables->join('ekin_keg_bulanan_realisasi c', 'a.id=c.fid_keg_bulanan', 'LEFT');
         $this->datatables->join('pegawai d', 'a.fid_user=d.fid_user');
        $this->datatables->add_column('view', '<span data-toggle="tooltip" data-placement="top" data-original-title="Detail"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("ekinerja/keg_bulanan_detail", "contentModal", "id=$1");open_modal("modal-lg", "Realisasi Kinerja Bulanan", "modal-primary");\'><i class="fa fa-book"></i></button></span>', 'id');
        echo $this->datatables->generate();
	}

	function tugas_verifikasi(){
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

		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$this->data['unit_kerja'] = $this->global->find_data('unit_kerja')->result_array();
		$this->layout('default/ekinerja/tugas_tamkre_verifikasi', $this->data);
	}

	function tugas_verifikasi_json(){
		$tahun = $this->input->post('tahun');
		$unit_kerja = $this->input->post('unit_kerja');
		header('Content-Type: application/json');
        $this->datatables->select('a.id,a.tahun,a.bulan,a.kegiatan,a.jenis,a.status, b.nama, b.nip');
        $this->datatables->where('a.tahun', $tahun);
        $this->datatables->where('b.unit_kerja', $unit_kerja);
        $this->datatables->where('a.status !=', 'Draft');
        $this->datatables->from('ekin_tambahan_kreatifitas a');
        $this->datatables->join('pegawai b', 'a.fid_user=b.fid_user');
        $this->datatables->add_column('view', '<span data-toggle="tooltip" data-placement="top" data-original-title="Detail"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal_data" onclick=\'javascript:callPages("ekinerja/tugas_pgw_detail", "contentModal", "id=$1&oleh=verifikasi");open_modal("", "Detail Tugas Tambahan & Kreatifitas", "modal-primary");\'><i class="fa fa-book"></i></button></span>', 'id');
        echo $this->datatables->generate();
	}

	function prilaku_verifikasi(){
		$this->data['list_css_plugin'] = array('x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css','chosen_v1.2.0/chosen.min.css');
		$this->data['list_js_plugin'] = array('noty/js/noty/packaged/jquery.noty.packaged.min.js','x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js','chosen_v1.2.0/chosen.jquery.min.js');
		$this->data['thn_aktif'] = show_row('setting', array('id'=>1), 'tahun_aktif');
		$this->data['unit_kerja'] = $this->global->find_data('unit_kerja')->result_array();
		$this->layout('default/ekinerja/prilaku_verifikasi', $this->data);
	}

	function prilaku_verifikasi_filter(){
		$month = date('m');
		$html = '';
		$tahun = $this->input->post('tahun');
		$unit_kerja = $this->input->post('unit_kerja');
		$pegawai = $this->input->post('pegawai');
		if($unit_kerja == 0 || $pegawai == 0){
			$html .= '<div class="alert alert-danger text-center"><strong>Warning !!!</strong> Pilih Unit Kerja / Pegawai Terlebih Dahulu.</div>';
		} else{
			foreach (bulan() as $key => $value) {
				if((int)$month == $key){
					$warna = 'warning';
				}
				else{
					$warna = 'primary';
				}

				$check_row = $this->global->find_data('ekin_prilaku', array('fid_pegawai'=>$pegawai, 'tahun'=>$tahun, 'bulan'=>$key))->row_array();
				$orientasi = $check_row['orientasi'];
				$integritas = $check_row['integritas'];
				$komitmen = $check_row['komitmen'];
				$disiplin = $check_row['disiplin'];
				$kerja_sama = $check_row['kerja_sama'];
				$kepemimpinan = $check_row['kepemimpinan'];
				if($orientasi != NULL && $integritas != NULL && $komitmen != NULL && $disiplin != NULL && $kerja_sama != NULL && $kepemimpinan != NULL && $check_row['status'] == 'Verifikasi'){
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-success" onclick=\'javascript:verify_prilaku("verifikasi",'.$check_row['id'].', "Diterima", "Verifikasi", "Diterima");\'><i class="fa fa-check"></i> Terima</a>
                                    <a class="btn btn-xs btn-danger" onclick=\'javascript:verify_prilaku("verifikasi",'.$check_row['id'].', "Ditolak", "Verifikasi", "Ditolak");\'><i class="fa fa-close"></i> Tolak</a>
                                </li>';
				} elseif($check_row['status'] == 'Penilaian'){
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-warning"><i class="fa fa-gavel"></i> Penilaian</a>
                                </li>';
				} elseif($check_row['status'] == 'Diterima'){
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-success"><i class="fa fa-check"></i> Diterima</a>
                                </li>';
				} elseif($check_row['status'] == 'Ditolak'){
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-danger"><i class="fa fa-close"></i> Ditolak</a>
                                </li>';
				} else{
					$add_row = '<li class="list-group-item text-center">
                                    <a class="btn btn-xs btn-danger"><i class="fa fa-book"></i> Draft</a>
                                </li>';
				}

				$html .= '<div class="col-md-3">
	                        <div class="panel panel-'.$warna.'">
	                            <div class="panel-heading text-center">'.strtoupper($value).'</div>
	                            <div class="panel-body no-padding">
	                                <ul class="list-group no-margin">
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);">'.$orientasi.'</a>
	                                        </span>
	                                        Orientasi Pelayanan
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);">'.$integritas.'</a>
	                                        </span>
	                                        Integritas
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);">'.$komitmen.'</a>
	                                        </span>
	                                        Komitmen
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);">'.$disiplin.'</a>
	                                        </span>
	                                        Disiplin
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);">'.$kerja_sama.'</a>
	                                        </span>
	                                        Kerja Sama
	                                    </li>
	                                    <li class="list-group-item">
	                                        <span class="badge text-inverse" style="background-color:white;">
	                                            <a href="javascript:void(0);">'.$kepemimpinan.'</a>
	                                        </span>
	                                        Kepemimpinan
	                                    </li>
	                                    '.$add_row.'
	                                </ul>
	                            </div>
	                        </div>
	                    </div>';
			}
		}
		$this->output->set_output(json_encode(array('html'=>$html)));
	}

	function find_pegawai(){
		$unit_kerja = $this->input->post('unit_kerja');
		$row_pegawai = $this->global->find_data('pegawai', array('unit_kerja'=>$unit_kerja), 'nama', 'ASC')->result_array();
		$html = '<option value="0">Pilih Pegawai</option>';
		foreach ($row_pegawai as $value) {
			$html .= '<option value="'.$value['id'].'">'.$value['nama'].' ('.$value['nip'].')</option>';
		}
		$this->output->set_output(json_encode(array('html'=>$html)));
	}
	// END TEAM VERIFIKASI  ---------------------

	function post_status_kegiatan(){
		$pesan = '';
		$type = $this->input->post('type');
		$id_keg = $this->input->post('id_kegiatan');
		$status = $this->input->post('status');
		$aksi = $this->input->post('aksi');
		$hasil = $this->input->post('hasil');

		if($type == 'keg_tahunan'){
			$jml_bulan = show_row('ekin_keg_tahunan', array('id'=>$id_keg), 'target_penyelesaian');
			$check = $this->global->find_data('ekin_keg_bulanan', array('fid_keg_tahunan'=>$id_keg));
			if($jml_bulan > $check->num_rows()){
				$status = 'kurang';
			} else{
				$this->global->edit_data('ekin_keg_tahunan', array('status'=>$status), array('id'=>$id_keg));
				$data_tahun = array(
					'fid_kegiatan'=>$id_keg,
					'fid_user'=>$this->session->userdata('id'),
					'jenis'=>'keg_tahunan',
					'aksi'=>$aksi,
					'hasil'=>$hasil,
					'created_date'=>date('Y-m-d H:i:s')
				);
				$simpan = $this->global->save_data('ekin_log', $data_tahun);
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		} elseif($type == 'keg_bulanan'){
			$id_tahunan = show_row('ekin_keg_bulanan', array('id'=>$id_keg), 'fid_keg_tahunan');
			$check = show_row('ekin_keg_tahunan', array('id'=>$id_tahunan), 'status');
			if($check !== 'Diterima'){
				$status = 'no_verify';
			} else{
				$this->global->edit_data('ekin_keg_bulanan', array('status'=>$status), array('id'=>$id_keg));
				$data_bulan = array(
					'fid_kegiatan'=>$id_keg,
					'fid_user'=>$this->session->userdata('id'),
					'jenis'=>'keg_bulanan',
					'aksi'=>$aksi,
					'hasil'=>$hasil,
					'created_date'=>date('Y-m-d H:i:s')
				);
				$simpan = $this->global->save_data('ekin_log', $data_bulan);
				if($simpan == "TRUE"){
					$status = 'success';
				} else{
					$status = 'error';
				}
			}
		} elseif($type == 'tamker'){
			$this->global->edit_data('ekin_tambahan_kreatifitas', array('status'=>$status), array('id'=>$id_keg));
			$data_tamker = array(
				'fid_kegiatan'=>$id_keg,
				'fid_user'=>$this->session->userdata('id'),
				'jenis'=>'tamker',
				'aksi'=>$aksi,
				'hasil'=>$hasil,
				'created_date'=>date('Y-m-d H:i:s')
			);
			$simpan = $this->global->save_data('ekin_log', $data_tamker);
			if($simpan == "TRUE"){
				$status = 'success';
			} else{
				$status = 'error';
			}
		} elseif($type == 'keg_tahunan_bwh'){
			$this->global->edit_data('ekin_keg_tahunan', array('status'=>$status), array('id'=>$id_keg));
			$data_tahun = array(
				'fid_kegiatan'=>$id_keg,
				'fid_user'=>$this->session->userdata('id'),
				'jenis'=>'keg_tahunan',
				'aksi'=>$aksi,
				'hasil'=>$hasil,
				'created_date'=>date('Y-m-d H:i:s')
			);
			$simpan = $this->global->save_data('ekin_log', $data_tahun);
			if($simpan == "TRUE"){
				$status = 'success';
				if($hasil == 'Verifikasi'){
					$pesan = 'Kegiatan telah diajukan ke tim verifikasi.';
				} else{
					$pesan = 'Kegiatan telah ditolak.';
				}
			} else{
				$status = 'error';
			}
		} elseif($type == 'keg_tahunan_verify'){
			$this->global->edit_data('ekin_keg_tahunan', array('status'=>$status), array('id'=>$id_keg));
			$data_tahun = array(
				'fid_kegiatan'=>$id_keg,
				'fid_user'=>$this->session->userdata('id'),
				'jenis'=>'keg_tahunan',
				'aksi'=>$aksi,
				'hasil'=>$hasil,
				'created_date'=>date('Y-m-d H:i:s')
			);
			$simpan = $this->global->save_data('ekin_log', $data_tahun);
			if($simpan == "TRUE"){
				$status = 'success';
				if($hasil == 'Diterima'){
					$pesan = 'Kegiatan telah diterima';
				} else{
					$pesan = 'Kegiatan telah ditolak.';
				}
			} else{
				$status = 'error';
			}
		} elseif($type == 'keg_bulanan_bwh'){
			$this->global->edit_data('ekin_keg_bulanan', array('status'=>$status), array('id'=>$id_keg));
			$data_bulan = array(
				'fid_kegiatan'=>$id_keg,
				'fid_user'=>$this->session->userdata('id'),
				'jenis'=>'keg_bulanan',
				'aksi'=>$aksi,
				'hasil'=>$hasil,
				'created_date'=>date('Y-m-d H:i:s')
			);
			$simpan = $this->global->save_data('ekin_log', $data_bulan);
			if($simpan == "TRUE"){
				$status = 'success';
				if($hasil == 'Verifikasi'){
					$pesan = 'Kegiatan telah diajukan ke tim verifikasi.';
				} else{
					$pesan = 'Kegiatan telah ditolak.';
				}
			} else{
				$status = 'error';
			}
		} elseif($type == 'keg_bulanan_verify'){
			$this->global->edit_data('ekin_keg_bulanan', array('status'=>$status), array('id'=>$id_keg));
			$data_bulan = array(
				'fid_kegiatan'=>$id_keg,
				'fid_user'=>$this->session->userdata('id'),
				'jenis'=>'keg_bulanan',
				'aksi'=>$aksi,
				'hasil'=>$hasil,
				'created_date'=>date('Y-m-d H:i:s')
			);
			$simpan = $this->global->save_data('ekin_log', $data_bulan);
			if($simpan == "TRUE"){
				$status = 'success';
				if($hasil == 'Diterima'){
					$pesan = 'Kegiatan telah diterima';
				} else{
					$pesan = 'Kegiatan telah ditolak.';
				}
			} else{
				$status = 'error';
			}
		} elseif($type == 'tamker_bwh'){
			$check_nilai = show_row('ekin_tambahan_kreatifitas', array('id'=>$id_keg), 'nilai');
			if($check_nilai == 0 && $hasil != 'Ditolak'){
				$status = 'success';
				$pesan = 'Silahkan Input Nilai Kegiatan Terlebih Dahulu.';
			} else{
				$this->global->edit_data('ekin_tambahan_kreatifitas', array('status'=>$status), array('id'=>$id_keg));
				$data_tamker = array(
					'fid_kegiatan'=>$id_keg,
					'fid_user'=>$this->session->userdata('id'),
					'jenis'=>'tamker',
					'aksi'=>$aksi,
					'hasil'=>$hasil,
					'created_date'=>date('Y-m-d H:i:s')
				);
				$simpan = $this->global->save_data('ekin_log', $data_tamker);
				if($simpan == "TRUE"){
					$status = 'success';
					if($hasil == 'Verifikasi'){
						$pesan = 'Tugas tambahan & kreatifitas telah diajukan ke tim verifikasi.';
					} else{
						$pesan = 'Tugas tambahan & kreatifitas telah ditolak.';
					}
				} else{
					$status = 'error';
				}
			}
		} elseif($type == 'tamker_verify'){
			$this->global->edit_data('ekin_tambahan_kreatifitas', array('status'=>$status), array('id'=>$id_keg));
			$data_tamker = array(
				'fid_kegiatan'=>$id_keg,
				'fid_user'=>$this->session->userdata('id'),
				'jenis'=>'tamker',
				'aksi'=>$aksi,
				'hasil'=>$hasil,
				'created_date'=>date('Y-m-d H:i:s')
			);
			$simpan = $this->global->save_data('ekin_log', $data_tamker);
			if($simpan == "TRUE"){
				$status = 'success';
				if($hasil == 'Diterima'){
					$pesan = 'Tugas tambahan & kreatifitas telah diterima.';
				} else{
					$pesan = 'Tugas tambahan & kreatifitas telah ditolak.';
				}
			} else{
				$status = 'error';
			}
		}
		$this->output->set_output(json_encode(array('status'=>$status, 'pesan'=>$pesan)));
	}

	function post_status_prilaku(){
		$pesan = '';
		$id_pri = $this->input->post('id_prilaku');
		$status = $this->input->post('status');
		$aksi = $this->input->post('aksi');
		$hasil = $this->input->post('hasil');
		$this->global->edit_data('ekin_prilaku', array('status'=>$status), array('id'=>$id_pri));
		$data = array(
			'fid_prilaku'=>$id_pri,
			'fid_user'=>$this->session->userdata('id'),
			'aksi'=>$aksi,
			'hasil'=>$hasil,
			'created_date'=>date('Y-m-d H:i:s')
		);
		$simpan = $this->global->save_data('ekin_log_prilaku', $data);
		if($simpan == "TRUE"){
			$status = 'success';
			if($hasil == 'Verifikasi'){
				$pesan = 'Prilaku bawahan telah diajukan ke tim verifikasi.';
			} elseif($hasil == 'Diterima'){
				$pesan = 'Prilaku pegawai telah diterima.';
			} else{
				$pesan = 'Prilaku pegawai telah ditolak.';
			}
		} else{
			$status = 'error';
		}
		$this->output->set_output(json_encode(array('status'=>$status, 'pesan'=>$pesan)));
	}

}
