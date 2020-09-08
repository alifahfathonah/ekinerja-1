<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends DJ_Admin {

	public function index()
	{	
		$this->data['list_js_page'] = array('blankon.dashboard.js');
		$this->data['list_js_plugin'] = array(
				'waypoints/lib/jquery.waypoints.min.js',
				'counter-up/jquery.counterup.min.js'
			);
		$find_data = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')));
		$this->data['find_data'] = $find_data->row_array();

		$sql_ultah = "SELECT COUNT(TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())) AS jml FROM pegawai WHERE DAY(tgl_lahir) = DAY(CURDATE()) AND MONTH(tgl_lahir) = MONTH(CURDATE())";
		$jml_ultah = $this->db->query($sql_ultah)->row_array();
		$this->data['count_ultah'] = $jml_ultah['jml'];

		if($this->data['user_active']['fid_user_level'] == 1){
			$where = '';
		} else{
			$where = 'AND fid_pegawai='.$this->data['user_active']['id_pegawai'].'';
		}
		$sql_kgb = "SELECT id FROM kgb WHERE tanggal BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 MONTH) $where";
		$jml_kgb = $this->db->query($sql_kgb)->num_rows();

		$this->data['count_kgb'] = $jml_kgb;
		$this->layout('default/dashboard', $this->data);
	}

	function profil(){
		$data = '';
		$target = $this->input->get("target");
		switch ($target) {
			case 'personal':
				return $this->personal();
				break;
			case 'riKepangkatan':
				return $this->riKepangkatan();
				break;
			case 'riJabatan':
				return $this->riJabatan();
				break;
			case 'riPendidikan':
				return $this->riPendidikan();
				break;
			case 'duk':
				return $this->duk();
				break;
			case 'penilaian':
				return $this->penilaian();
				break;
			case 'disiplin':
				return $this->disiplin();
				break;
			case 'penghargaan':
				return $this->penghargaan();
				break;
			case 'riKesehatan':
				return $this->riKesehatan();
				break;
			case 'bhsAsing':
				return $this->bhsAsing();
				break;
			case 'prestasi':
				return $this->prestasi();
				break;
			case 'keluarga':
				return $this->keluarga();
				break;
			default:
				echo 'terjadi masalah';
				break;
		}
	}

	private function personal(){
		
		$find_data = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')))->row_array();
		if($find_data['tunjangan'] == NULL || $find_data['tunjangan'] == '')
			$tunjangan = 'Tidak Menanggung';
		else
			$tunjangan = $find_data['tunjangan'];
		$html = '<h4>Personal</h4>
				<table class="table table-bordered table-striped" style="clear: both">
				    <tbody>
				    <tr>
				        <td width="20%" class="text-right">NIP</td>
				        <td width="80%">'.$find_data['nip'].'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Nama Panggilan</td>
				        <td>'.$find_data['nama_panggilan'].'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Nama Lengkap</td>
				        <td>'.$find_data['nama'].'</td>
				    </tr>
				    <tr>
				        <td class="text-right">TTL</td>
				        <td>'.$find_data['tmp_lahir'].', '.$find_data['tgl_lahir'].'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Agama</td>
				        <td>'.agama($find_data['agama']).'</td>
				    </tr>

				    <tr>
				        <td class="text-right">Jenis Pegawai</td>
				        <td>'.jenis_pegawai($find_data['jenis_pegawai']).'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Gender</td>
				        <td>'.$find_data['gender'].'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Alamat</td>
				        <td>'.$find_data['alamat'].'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Pangkat & Golongan</td>
				        <td>'.pangkat_golongan($find_data['pangkat_golongan']).'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Jabatan</td>
				        <td>'.show_row('jabatan',array('id'=>$find_data['fid_jabatan']),'nama').'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Instansi Kerja</td>
				        <td>'.$find_data['instansi_kerja'].'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Unit Kerja</td>
				        <td>'.show_row('unit_kerja',array('id'=>$find_data['unit_kerja']),'nama').'</td>
				    </tr>
				    <tr>
				        <td class="text-right">No. HP</td>
				        <td>'.$find_data['no_hp'].'</td>
				    </tr>
				    <tr>
				        <td class="text-right">No. NPWP</td>
				        <td>'.$find_data['npwp'].'</td>
				    </tr>
				    <tr>
				        <td class="text-right">Tunjangan</td>
				        <td>'.$tunjangan.'</td>
				    </tr>
				    </tbody>
				</table>';
		echo $html;
	}

	private function riKepangkatan(){
		$no = 1;
		$query = $this->db
			->select('a.*, b.nama AS pejabat')
			->where('a.fid_user', $this->session->userdata('id'))
			->join('pegawai b', 'a.pejabat_sah=b.id')
			->get('riwayat_pangkat a')->result_array();
		$html = '<h4>Riwayat Kepangkatan</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Pangkat / Golongan Ruang</th>
	                            <th>TMT</th>
	                            <th>Nomor SK</th>
	                            <th>Tanggal SK</th>
	                            <th>Pejabat Yang Menetapkan</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.pangkat_golongan($value['pangkat_golongan']).'</td>
                       				<td>'.$value['tmt'].'</td>
                       				<td>'.$value['no_sk'].'</td>
                       				<td>'.$value['tgl_sk'].'</td>
                       				<td>'.$value['pejabat'].'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function riJabatan(){
		$no = 1;
		$query = $this->db
			->select('a.*, b.nama AS pejabat')
			->where('a.fid_user', $this->session->userdata('id'))
			->join('pegawai b', 'a.pejabat_sah=b.id')
			->get('riwayat_jabatan a')->result_array();
		$html = '<h4>Riwayat Jabatan</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Nama Jabatan</th>
	                            <th>Unit Kerja</th>
	                            <th>Eselon Jabatan</th>
	                            <th>TMT</th>
	                            <th>Nomor SK</th>
	                            <th>Tanggal SK</th>
	                            <th>Pejabat Yang Menetapkan</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['jabatan'].'</td>
                       				<td>'.$value['unit_kerja'].'</td>
                       				<td>'.$value['eselon'].'</td>
                       				<td>'.$value['tmt'].'</td>
                       				<td>'.$value['no_sk'].'</td>
                       				<td>'.$value['tgl_sk'].'</td>
                       				<td>'.$value['pejabat'].'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function riPendidikan(){
		$no = 1;
		$no2 = 1;
		$query = $this->global->find_data('riwayat_pendidikan', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$query2 = $this->global->find_data('riwayat_pelatihan', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$html = '<h4>Pendidikan Umum</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Jenjang</th>
	                            <th>Instansi</th>
	                            <th>Kepala Instansi</th>
	                            <th>Nomor Ijazah</th>
	                            <th>Tanggal Ijazah</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.pendidikan($value['pendidikan']).'</td>
                       				<td>'.$value['nama_instansi'].'</td>
                       				<td>'.$value['pimpinan_instansi'].'</td>
                       				<td>'.$value['no_ijazah'].'</td>
                       				<td>'.$value['tgl_ijazah'].'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div><br>';

        $html .= '<h4>Pendidikan dan Pelatihan</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Nama Diklat</th>
	                            <th>Penyelenggara</th>
	                            <th>Tahun/Angkatan</th>
	                            <th>Lama Pendidikan</th>
	                            <th>No. STPP</th>
	                            <th>Tanggal STPP</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query2 as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no2++.'</td>
                       				<td>'.$value['nama_diklat'].'</td>
                       				<td>'.$value['penyelenggara'].'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['lama'].'</td>
                       				<td>'.$value['no_sttp'].'</td>
                       				<td>'.$value['tgl_sttp'].'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function duk(){
		$no = 1;
		$pegawai = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')))->row_array();
		$query = $this->db
			->select('a.*, b.jabatan')
			->where('a.fid_pegawai', $pegawai['id'])
			->join('riwayat_jabatan b', 'a.fid_jabatan_akhir=b.id', 'LEFT')
			->get('duk a')->result_array();
		$html = '<h4>Urut Kepangkatan</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th rowspan="2" class="text-center border-right" style="width: 1%;">No.</th>
	                            <th rowspan="2" class="text-center">Tahun</th>
	                            <th rowspan="2" class="text-center">Nomor Urut</th>
	                            <th rowspan="2">Pangkat</th>
	                            <th rowspan="2">Jabatan</th>
	                            <th colspan="2" class="text-center">Masa Kerja</th>
	                        </tr>
	                        <tr>
	                        	<th class="text-center">Tahun/Masa Kerja, Angkatan</th>
	                        	<th class="text-center">Bulan/Masa Kerja, Angkatan</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td class="text-center">'.$value['tahun_duk'].'</td>
                       				<td class="text-center">'.$value['urutan_duk'].'</td>
                       				<td>'.pangkat_golongan($value['fid_pangkat_akhir']).'</td>
                       				<td>'.$value['jabatan'].'</td>
                       				<td class="text-center">'.$value['thn_masakerja'].'</td>
                       				<td class="text-center">'.$value['bln_masakerja'].'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function penilaian(){
		$html = '';
		$no = 1;
		$no2 = 1;

		$pegawai = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')))->row_array();

		$query = $this->db
			->select('a.*, b.nama AS pejabats, c.nama AS atasan_pejabats')
			->where('a.fid_pegawai', $pegawai['id'])
			->join('pegawai b', 'a.pejabat=b.id', 'LEFT')
			->join('pegawai c', 'a.atasan_pejabat=c.id', 'LEFT')
			->get('dp3 a')->result_array();

		$query2 = $this->db
			->select('a.*, b.nama AS pejabats, c.nama AS atasan_pejabats')
			->where('a.fid_pegawai', $pegawai['id'])
			->join('pegawai b', 'a.pejabat=b.id', 'LEFT')
			->join('pegawai c', 'a.atasan_pejabat=c.id', 'LEFT')
			->get('skp a')->result_array();

		$html .= '<h4>Nilai DP-3</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Nilai Rata-Rata</th>
	                            <th>Pejabat Penilai</th>
	                            <th>Atasan Pejabat Penilai</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['nilai_avg'].'</td>
                       				<td>'.$value['pejabats'].'</td>
                       				<td>'.$value['atasan_pejabats'].' <a href="'.base_url().'dashboard/cetak_dp3/'.$value['id'].'" target="_blank" class="btn btn-theme btn-sm btn-expand pull-right"><i class="fa fa-print"></i> Print Nilai </a></td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div><br>';
        $html .= '<h4>Nilai SKP</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Pejabat Penilai</th>
	                            <th>Atasan Pejabat Penilai</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query2 as $value2) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no2++.'</td>
                       				<td>'.$value2['tahun'].'</td>
                       				<td>'.$value2['pejabats'].'</td>
                       				<td>'.$value2['atasan_pejabats'].' <a href="'.base_url().'dashboard/cetak_skp/'.$value2['id'].'" target="_blank" class="btn btn-theme btn-sm btn-expand pull-right"><i class="fa fa-print"></i> Print Nilai </a></td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div><br>';
		echo $html;
	}

	private function disiplin(){
		$no = 1;
		$query = $this->global->find_data('disiplin', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$html = '<h4>Disiplin</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Tingkat Hukum</th>
	                            <th>Jenis Hukuman</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['tingkat'].'</td>
                       				<td>'.$value['jenis'].'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function penghargaan(){
		$no = 1;
		$query = $this->global->find_data('penghargaan', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$html = '<h4>Penghargaan</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Tingkat</th>
	                            <th>Nama</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['tingkat'].'</td>
                       				<td>'.$value['nama'].'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function riKesehatan(){
		$no = 1;
		$query = $this->global->find_data('riwayat_kesehatan', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$html = '<h4>Riwayat Kesehatan</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Penyakit Yang Pernah Diderita</th>
	                            <th>Dokter Yang Menangani</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['penyakit'].'</td>
                       				<td>'.$value['dokter'].'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function bhsAsing(){
		$no = 1;
		$query = $this->global->find_data('bahasa_asing', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$html = '<h4>Bahasa Asing</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Bahasa Asing</th>
	                            <th>Aktif</th>
	                            <th>Pasif</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['bahasa'].'</td>
                       				<td>'.aktif($value['aktif']).'</td>
                       				<td>'.aktif($value['pasif']).'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function prestasi(){
		$no = 1;
		$query = $this->global->find_data('prestasi', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$html = '<h4>Prestasi</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Bidang Prestasi</th>
	                            <th>Tingkat Kejuaraan</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['bidang'].'</td>
                       				<td>'.$value['tingkat'].'</td>
                       			</tr>';
                       	}
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function keluarga(){
		$no = 1;
		$query = $this->global->find_data('keluarga', array('fid_user'=>$this->session->userdata('id')))->result_array();
		$html = '<h4>Susunan Keluarga</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Nama</th>
	                            <th>Tanggal Lahir</th>
	                            <th>No. Akte Kelahiran</th>
	                            <th>Status</th>
	                            <th>No. Surat Nikah (Istri/Suami)</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['nama'].'</td>
                       				<td>'.$value['tgl_lahir'].'</td>
                       				<td>'.$value['akte_lahir'].'</td>
                       				<td>'.$value['status'].'</td>
                       				<td>'.$value['surat_nikah'].'</td>
                       			</tr>';
                       	}
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	function cetak_pupns(){
		ob_start();    
		//$data['siswa'] = $this->siswa_model->view_row();
		$this->data['fid_user'] = $this->session->userdata('id'); 
		$find_data = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')));
		$this->data['find_data'] = $find_data->row_array(); 
		$this->load->view('default/print_pupns', $this->data);    
		$html = ob_get_contents();        
		ob_end_clean();                
		require_once('./themes/default/assets/html2pdf/html2pdf.class.php');
		try {
		    $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', array(0, 0, 0, 0));    
			$pdf->WriteHTML($html, isset($_GET['vuehtml']));    
			$pdf->Output('Data PUPNS.pdf', 'D');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}    
	}

	function cetak_dp3($id){
		$this->data['fid_user'] = $this->session->userdata('id');
		$find_data = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')));
		$this->data['find_data'] = $find_data->row_array();
		$dp3 = $this->global->find_data('dp3', array('fid_pegawai'=>$this->data['find_data']['id'], 'id'=>$id));
		$this->data['dp3'] = $dp3->row_array();
		$this->data['pejabat'] =  $this->global->find_data('pegawai', array('id'=>$this->data['dp3']['pejabat']))->row_array();
		$this->data['atasan_pejabat'] =  $this->global->find_data('pegawai', array('id'=>$this->data['dp3']['atasan_pejabat']))->row_array();
		$this->load->view('default/print_penilaian', $this->data);
	}

	function cetak_skp($id){
		$this->data['fid_user'] = $this->session->userdata('id');
		$find_data = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')));
		$this->data['find_data'] = $find_data->row_array();
		$dp3 = $this->global->find_data('skp', array('fid_pegawai'=>$this->data['find_data']['id'], 'id'=>$id));
		$this->data['skp'] = $dp3->row_array();
		$this->data['pejabat'] =  $this->global->find_data('pegawai', array('id'=>$this->data['skp']['pejabat']))->row_array();
		$this->load->view('default/print_penilaian_skp', $this->data);
	}

	function find_pegawai(){
		$sql = $this->global->find_data('pegawai');
		$data = array();
		if($sql->num_rows() > 0){
			$row = $sql->result_array();
			foreach ($row as $key) {
				$data[] = array(
					'id'=>$key['id'],
					'nip'=>$key['nip'],
					'nama'=>$key['nama']
				);
			}
		} 
		$this->output->set_output(json_encode($data));
	}

	function get_listUltah(){
        $sql_ultah = "SELECT a.nama, b.nama AS jabatan, TIMESTAMPDIFF(YEAR, a.tgl_lahir, CURDATE()) AS umur  FROM pegawai a JOIN jabatan b ON a.fid_jabatan=b.id WHERE DAY(a.tgl_lahir) = DAY(CURDATE()) AND MONTH(a.tgl_lahir) = MONTH(CURDATE())";
		$ultah = $this->db->query($sql_ultah);
		echo '<ul class="list-group no-margin">';
		if($ultah->num_rows() > 0){
			foreach ($ultah->result_array() as $value) {
				echo '<li class="list-group-item">
	                    <span class="badge">ke - '.$value['umur'].' thn</span>
	                    '.$value['nama'].' <br>
	                    Jabatan : '.$value['jabatan'].'
	                </li>';
			}
		} else{
			echo '<li class="list-group-item">Tidak ada pegawai yang berulang tahun.</li>';
		}
		echo '</ul>';
	}

	function get_listKGB(){
		if($this->data['user_active']['fid_user_level'] == 1){
			$where = '';
		} else{
			$where = 'AND a.fid_pegawai='.$this->data['user_active']['id_pegawai'].'';
		}
		$sql_kgb = "SELECT a.gaji_lama, a.gaji_baru, a.tanggal, b.nama AS nama_peg, c.nama AS jabatan FROM kgb a JOIN pegawai b ON a.fid_pegawai=b.id JOIN jabatan c ON b.fid_jabatan=c.id WHERE tanggal BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 MONTH) $where ORDER BY a.tanggal, b.nama ASC";
		$kgb = $this->db->query($sql_kgb);
		echo '<ul class="list-group no-margin">';
		if($kgb->num_rows() > 0){
			foreach ($kgb->result_array() as $value) {
				echo '<li class="list-group-item">
	                    <p style="font-size: 10pt; text-align: center;">
	                    	<b>'.$value['nama_peg'].'</b> <br />
	                    	'.$value['jabatan'].'
	                    </p>
	                    <p style="text-align: center;">
	                    	Gaji Lama : <span class="badge">Rp. '.number_format($value['gaji_lama'], 0 , '' , '.' ).'</span> &nbsp; &nbsp;
	                    	Gaji Baru : <span class="badge badge-success">Rp. '.number_format($value['gaji_baru'], 0 , '' , '.' ).'</span>
	                    </p>
	                    <p style="text-align: center;">
	                    	Pada Tanggal : '.$value['tanggal'].'
	                    </p>
	                </li>';
			}
		} else{
			echo '<li class="list-group-item">Tidak ada pegawai KGB hari ini.</li>';
		}
		echo '</ul>';
	}

	function generate_kgb(){
		$tahun = $this->input->post("tahun");
		$val_tahun = $tahun - 2;
		$sql_awal = "SELECT a.*, DATE_ADD(a.tanggal, INTERVAL 2 YEAR) AS new_date  FROM kgb a JOIN pegawai b ON a.fid_pegawai=b.id WHERE b.unit_kerja=".$this->data['user_active']['unit_kerja']." AND YEAR(a.tanggal) = ".$val_tahun."";
		$find_data = $this->db->query($sql_awal);
		if($find_data->num_rows() > 0){
			foreach ($find_data->result() AS $value) {
				$sql_now = $this->global->find_data('kgb', array('YEAR(tanggal)'=>$tahun, 'fid_pegawai'=>$value->fid_pegawai));
				if($sql_now->num_rows() == 0){
					$this->global->save_data('kgb', array('fid_pegawai'=>$value->fid_pegawai, 'gaji_lama'=>$value->gaji_baru, 'gaji_baru'=>0, 'tanggal'=>$value->new_date));
				}
			}
			$flag = 1;
		} else{
			$flag = 0;
		}
		$this->output->set_output(json_encode(array('status'=>$flag)));
	}

	function hapus_data(){
		$table = $this->input->post('table');
		$id = $this->input->post('id');
		$hapus = $this->db->delete($table, array('id' => $id));
		if($hapus)
			$status = 'success';
		else
			$status = 'error';
		$this->output->set_output(json_encode(array('status'=>$status)));
	}

	function logout(){
		if ($this->auth->is_logged_in()) {
	        $this->auth->logout();
	    }
	    redirect(base_url());
	}
}
