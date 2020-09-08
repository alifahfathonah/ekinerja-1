<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal_profil extends DJ_Admin {

	function profil(){
		$data = '';
		$target = $this->input->get("target");
		$idx_user = $this->input->get("id_user");
		switch ($target) {
			case 'personal':
				return $this->personal($idx_user);
				break;
			case 'riKepangkatan':
				return $this->riKepangkatan($idx_user);
				break;
			case 'riJabatan':
				return $this->riJabatan($idx_user);
				break;
			case 'riPendidikan':
				return $this->riPendidikan($idx_user);
				break;
			case 'duk':
				return $this->duk($idx_user);
				break;
			case 'penilaian':
				return $this->penilaian($idx_user);
				break;
			case 'disiplin':
				return $this->disiplin($idx_user);
				break;
			case 'penghargaan':
				return $this->penghargaan($idx_user);
				break;
			case 'riKesehatan':
				return $this->riKesehatan($idx_user);
				break;
			case 'bhsAsing':
				return $this->bhsAsing($idx_user);
				break;
			case 'prestasi':
				return $this->prestasi($idx_user);
				break;
			case 'keluarga':
				return $this->keluarga($idx_user);
				break;
			default:
				echo 'terjadi masalah';
				break;
		}
	}

	private function personal($idx_user){
		
		$find_data = $this->global->find_data('pegawai', array('fid_user'=>$idx_user))->row_array();
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

	private function riKepangkatan($idx_user){
		$no = 1;
		$query = $this->db
			->select('a.*, a.id as idForm, b.nama AS pejabat')
			->where('a.fid_user', $idx_user)
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
	                            <th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
						<tbody>';
                       	foreach ($query as $value) {
							$noFile = 1;
							$htmlFile = "";
							$queryFile = $this->db
								->where('id_user', $idx_user)
								->where('type', 1)
								->where('id_form', $value['idForm'])
								->get('upload')->result();
							
							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}

                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.pangkat_golongan($value['pangkat_golongan']).'</td>
                       				<td>'.$value['tmt'].'</td>
                       				<td>'.$value['no_sk'].'</td>
                       				<td>'.$value['tgl_sk'].'</td>
									<td>'.$value['pejabat'].'</td>
									<td>'.$htmlFile.'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function riJabatan($idx_user){
		$no = 1;
		$query = $this->db
			->select('a.*,a.id as idForm, b.nama AS pejabat')
			->where('a.fid_user', $idx_user)
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
								<th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
							$noFile = 1;
							$htmlFile = "";

							$queryFile = $this->db
							->where('id_user', $idx_user)
							->where('type', 2)
							->where('id_form', $value['idForm'])
							->get('upload')->result();

							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}
							
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['jabatan'].'</td>
                       				<td>'.$value['unit_kerja'].'</td>
                       				<td>'.$value['eselon'].'</td>
                       				<td>'.$value['tmt'].'</td>
                       				<td>'.$value['no_sk'].'</td>
                       				<td>'.$value['tgl_sk'].'</td>
									   <td>'.$value['pejabat'].'</td>
									   <td>'.$htmlFile.'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function riPendidikan($idx_user){
		$no = 1;
		$no2 = 1;
		$query = $this->global->find_data('riwayat_pendidikan', array('fid_user'=>$idx_user))->result_array();
		$query2 = $this->global->find_data('riwayat_pelatihan', array('fid_user'=>$idx_user))->result_array();
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
								<th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
						<tbody>';
						
                       	foreach ($query as $value) {
							$noFile = 1;
							$htmlFile = "";
							$queryFile = $this->db
								->where('id_user', $idx_user)
								->where('type', 3)
								->where('id_form', $value['id'])
								->get('upload')->result();
							
							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}

                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.pendidikan($value['pendidikan']).'</td>
                       				<td>'.$value['nama_instansi'].'</td>
                       				<td>'.$value['pimpinan_instansi'].'</td>
                       				<td>'.$value['no_ijazah'].'</td>
									   <td>'.$value['tgl_ijazah'].'</td>
									   <td>'.$htmlFile.'</td>
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
								<th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query2 as $value) {
							$noFile = 1;
							$htmlFile = "";
							$queryFile = $this->db
								->where('id_user', $idx_user)
								->where('type', 4)
								->where('id_form', $value['id'])
								->get('upload')->result();
							
							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}

                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no2++.'</td>
                       				<td>'.$value['nama_diklat'].'</td>
                       				<td>'.$value['penyelenggara'].'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['lama'].'</td>
                       				<td>'.$value['no_sttp'].'</td>
									   <td>'.$value['tgl_sttp'].'</td>
									   <td>'.$htmlFile.'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function duk($idx_user){
		$no = 1;
		$pegawai = $this->global->find_data('pegawai', array('fid_user'=>$idx_user))->row_array();
		$query = $this->db
			->select('a.*,a.id as idForm, b.jabatan')
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

	private function penilaian($idx_user){
		$html = '';
		$no = 1;
		$no2 = 1;

		$pegawai = $this->global->find_data('pegawai', array('fid_user'=>$idx_user))->row_array();

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

	private function disiplin($idx_user){
		$no = 1;
		$query = $this->global->find_data('disiplin', array('fid_user'=>$idx_user))->result_array();
		$html = '<h4>Disiplin</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Tingkat Hukum</th>
								<th>Jenis Hukuman</th>
								<th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
							$noFile = 1;
							$htmlFile = "";
							$queryFile = $this->db
								->where('id_user', $idx_user)
								->where('type', 6)
								->where('id_form', $value['id'])
								->get('upload')->result();
							
							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}
                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['tingkat'].'</td>
									   <td>'.$value['jenis'].'</td>
									   <td>'.$htmlFile.'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function penghargaan($idx_user){
		$no = 1;
		$query = $this->global->find_data('penghargaan', array('fid_user'=>$idx_user))->result_array();
		$html = '<h4>Penghargaan</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Tingkat</th>
								<th>Nama</th>
								<th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
							$noFile = 1;
							$htmlFile = "";
							$queryFile = $this->db
								->where('id_user', $idx_user)
								->where('type', 7)
								->where('id_form', $value['id'])
								->get('upload')->result();
							
							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}

                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['tingkat'].'</td>
									   <td>'.$value['nama'].'</td>
									   <td>'.$htmlFile.'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function riKesehatan($idx_user){
		$no = 1;
		$query = $this->global->find_data('riwayat_kesehatan', array('fid_user'=>$idx_user))->result_array();
		$html = '<h4>Riwayat Kesehatan</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Penyakit Yang Pernah Diderita</th>
								<th>Dokter Yang Menangani</th>
								<th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
							$noFile = 1;
							$htmlFile = "";
							$queryFile = $this->db
								->where('id_user', $idx_user)
								->where('type', 8)
								->where('id_form', $value['id'])
								->get('upload')->result();
							
							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}

                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['penyakit'].'</td>
									   <td>'.$value['dokter'].'</td>
									   <td>'.$htmlFile.'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function bhsAsing($idx_user){
		$no = 1;
		$query = $this->global->find_data('bahasa_asing', array('fid_user'=>$idx_user))->result_array();
		$html = '<h4>Bahasa Asing</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Bahasa Asing</th>
	                            <th>Aktif</th>
								<th>Pasif</th>
								<th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
							$noFile = 1;
							$htmlFile = "";
							$queryFile = $this->db
								->where('id_user', $idx_user)
								->where('type', 9)
								->where('id_form', $value['id'])
								->get('upload')->result();
							
							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}

                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['bahasa'].'</td>
                       				<td>'.aktif($value['aktif']).'</td>
									   <td>'.aktif($value['pasif']).'</td>
									   <td>'.$htmlFile.'</td>
                       			</tr>';
                       	}
        
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function prestasi($idx_user){
		$no = 1;
		$query = $this->global->find_data('prestasi', array('fid_user'=>$idx_user))->result_array();
		$html = '<h4>Prestasi</h4>
				<div class="table-responsive" style="margin-top: -1px;">
                    <table class="table table-striped table-primary">
                        <thead>
	                        <tr>
	                            <th class="text-center border-right" style="width: 1%;">No.</th>
	                            <th>Tahun</th>
	                            <th>Bidang Prestasi</th>
								<th>Tingkat Kejuaraan</th>
								<th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
							$noFile = 1;
							$htmlFile = "";
							$queryFile = $this->db
								->where('id_user', $idx_user)
								->where('type', 10)
								->where('id_form', $value['id'])
								->get('upload')->result();
							
							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}

                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['tahun'].'</td>
                       				<td>'.$value['bidang'].'</td>
									   <td>'.$value['tingkat'].'</td>
									   <td>'.$htmlFile.'</td>
                       			</tr>';
                       	}
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

	private function keluarga($idx_user){
		$no = 1;
		$query = $this->global->find_data('keluarga', array('fid_user'=>$idx_user))->result_array();
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
								<th style="text-align:center">Dokumen</th>
	                        </tr>
                        </thead>
                        <tbody>';
                       	foreach ($query as $value) {
							$noFile = 1;
							$htmlFile = "";
							$queryFile = $this->db
								->where('id_user', $idx_user)
								->where('type', 11)
								->where('id_form', $value['id'])
								->get('upload')->result();
							
							foreach ($queryFile as $file) { 
								$htmlFile .= '<div class="row" style="padding-left:28%;margin-top:5px">
								<a target="_blank" href="'.base_url().$file->file_lokasi.'">
									<span>'.$noFile.'. '.$file->file_name.'</span> 
								</a>
								</div>';
								$noFile++;
							}

                       		$html .= '<tr>
                       				<td class="text-center border-right">'.$no++.'</td>
                       				<td>'.$value['nama'].'</td>
                       				<td>'.$value['tgl_lahir'].'</td>
                       				<td>'.$value['akte_lahir'].'</td>
                       				<td>'.$value['status'].'</td>
									   <td>'.$value['surat_nikah'].'</td>
									   <td>'.$htmlFile.'</td>
                       			</tr>';
                       	}
        $html .=        '</tbody>
                    </table>
                </div>';
		echo $html;
	}

}
