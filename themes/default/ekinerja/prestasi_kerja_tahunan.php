<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,maximum-scale=1.0">
    <style type="text/css" media="screen"></style>
    <style type="text/css" media="print"></style>
	<style type="text/css">
	    div.border-full {
	    	width: 100%;
	    	height: 99%;
	    	font-family: Times New Roman;
		    border: 1px solid black;
	    }
	    .new-page { page-break-after: always;}
	    .content{
	    	padding: 20px;
	    	font-family: Times New Roman;
	    }
	    .text-center {
	    	text-align: center;
	    }
	    .text-left {
	    	text-align: left;
	    }
	    .text-right {
	    	text-align: right;
	    }
	    .topright {
          position: absolute;
          top: 0px;
          right: 20px;
        }
        .row_awal {
			width:100%;
			height: 20px;
		}
		.row_kiri {
			text-align:left;
			float:left;
		}
		.row_kanan {
			text-align:left;
			float:right;
		}
		.border_tbl{
			border: 1px solid black;
			padding: 10px 5px;
		}
	</style>
</head>
<body>
	<?php
	    $sql_pegawai = $this->global->find_data('pegawai', array('fid_user'=>$fid_user))->row_array();
	    $sql_parent_jabatan = show_row('jabatan', array('id'=>$sql_pegawai['fid_jabatan']), 'parent');
	    $sql_atasan = $this->global->find_data('pegawai', array('fid_jabatan'=>$sql_parent_jabatan))->row_array();
	    $sql_parent_jabatan2 = show_row('jabatan', array('id'=>$sql_atasan['fid_jabatan']), 'parent');
	    $sql_atasan2 = $this->global->find_data('pegawai', array('fid_jabatan'=>$sql_parent_jabatan2))->row_array();

	    //PRILAKU
	    $sql_nilai = $this->global->find_data('ekin_prilaku', array('fid_pegawai'=>$sql_pegawai['id'], 'tahun'=>$tahun))->result_array();
	    $nilai_orientasi=0;
	    $nilai_integritas=0;
	    $nilai_komitmen=0;
	    $nilai_disiplin=0;
	    $nilai_kerjasama=0;
	    $nilai_kepemimpinan=0;
	    foreach ($sql_nilai as $nilais) {
	    	$nilai_orientasi += $nilais['orientasi'];
	    	$nilai_integritas += $nilais['integritas'];
	    	$nilai_komitmen += $nilais['komitmen'];
	    	$nilai_disiplin += $nilais['disiplin'];
	    	$nilai_kerjasama += $nilais['kerja_sama'];
	    	$nilai_kepemimpinan += $nilais['kepemimpinan'];
	    }
	    $tot_nilai = ($nilai_orientasi + $nilai_integritas + $nilai_komitmen + $nilai_disiplin + $nilai_kerjasama + $nilai_kepemimpinan) / 12;
	    $total_nilai2 = round($tot_nilai, 2);

	    //FIND SKP BULANAN
	    $nilai_kegiatan = 0;
	  	$nilai_tambahan = 0;
	  	$nilai_kreativ = 0;
	    $sql_kegiatan_tahunan = $this->global->find_data('ekin_keg_tahunan', array('fid_user'=>$fid_user, 'tahun'=>$tahun, 'status'=>'Diterima'))->result_array();
	    $sql_tugas_tambahan = $this->global->find_data('ekin_tambahan_kreatifitas', array('fid_user'=>$fid_user, 'tahun'=>$tahun, 'jenis'=>'Tugas Tambahan', 'status'=>'Diterima'), 'kegiatan', 'ASC')->result_array();
    	$sql_kreativitas = $this->global->find_data('ekin_tambahan_kreatifitas', array('fid_user'=>$fid_user, 'tahun'=>$tahun, 'jenis'=>'Kreatifitas', 'status'=>'Diterima'), 'kegiatan', 'ASC')->result_array();
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
	            	->select('SUM(a.nilai) AS nilai')
	            	->where('b.fid_keg_tahunan', $kegTahun['id'])
	            	->where('b.status', 'Diterima')
	            	->where('a.fid_user', $fid_user)
	            	->join('ekin_keg_bulanan b', 'a.fid_keg_bulanan=b.id')
	            	->get('ekin_keg_bulanan_realisasi a')->row_array();
	            $nilai = round(($sql_realisasi['nilai'] / $kegTahun['target_penyelesaian']), 2);
	            $nilai_kegiatan += $nilai;
	        }
	        $total_nilai = ($nilai_kegiatan / count($sql_kegiatan_tahunan)) + $nilai_tambahan + $nilai_kreativ;
	    	$nilai_skp = round($total_nilai, 2);
	    } else{
	    	$nilai_skp = 0;
	    }

	    $val_orientasi = round(($nilai_orientasi / 12),2);
	    $val_integritas = round(($nilai_integritas / 12),2);
	    $val_komitmen = round(($nilai_komitmen / 12),2);
	    $val_disiplin = round(($nilai_disiplin / 12),2);
	    $val_kerjasama = round(($nilai_kerjasama / 12),2);
	    $val_kepemimpinan = round(($nilai_kepemimpinan / 12),2);

	    $nilai_rata = round(($total_nilai2 / 6), 2);
	    $hitung_skp = ($nilai_skp * 60) / 100;
	    $hitung_prilaku = ($nilai_rata * 40) / 100;

	    $nilai_prestasi = round(($hitung_skp + $hitung_prilaku), 2);
	?>
	<div class="content">
		<div style="border: 1px solid black;">
			<div class="text-center" style="margin-top: 55px;">
				<img src="<?php echo $_SERVER['DOCUMENT_ROOT'];?>/SIMPEG_BAP/themes/default/assets/img/garuda.png" width="80" alt="no img">
			</div>
			<h4 class="text-center">PENILAIAN PRESTASI KERJA <br> PEGAWAI NEGERI SIPIL</h4>
			<div class="text-center" style="margin-top: 135px; font-weight: bold;">
				Jangka Waktu Penilaian <br> <?=$periode_penilaian;?>
			</div>
			<table style="margin-top: 150px;" border="0" width="100%">
				<tr>
					<td class="text-right" width="45%">Nama</td>
					<td class="text-center" width="2%">:</td>
					<td><?=$sql_pegawai['nama'];?></td>
				</tr>
				<tr>
					<td class="text-right">NIP</td>
					<td class="text-center">:</td>
					<td><?=$sql_pegawai['nip'];?></td>
				</tr>
				<tr>
					<td class="text-right">Pangkat, Gol/Ruang</td>
					<td class="text-center">:</td>
					<td><?=pangkat_golongan($sql_pegawai['pangkat_golongan']);?></td>
				</tr>
				<tr>
					<td class="text-right">Jabatan</td>
					<td class="text-center">:</td>
					<td><?=show_row('jabatan',array('id'=>$sql_pegawai['fid_jabatan']),'nama');?></td>
				</tr>
			</table>
			<h2 class="text-center" style="margin-top: 240px; margin-bottom: 55px;">BADAN KEPEGAWAIAN DAERAH <br> TAHUN 2018</h2>
		</div>

		<div class="new-page"></div>
		
		<div class="text-center">
			<img src="<?php echo $_SERVER['DOCUMENT_ROOT'];?>/SIMPEG_BAP/themes/default/assets/img/garuda.png" width="80" alt="no img">
		</div>
		<h4 class="text-center">PENILAIAN PRESTASI KERJA <br> PEGAWAI NEGERI SIPIL</h4>
		<div class="topright">
	        <img src="<?php echo $_SERVER['DOCUMENT_ROOT'];?>/SIMPEG_BAP/themes/default/assets/qrCode/output.png" width="80" alt="no img">
	    </div>
	    <div class="row_awal">
	    	<div class="row_kiri" style="width: 50%;">
	    		BADAN KEPEGAWAIAN DAERAH
	    	</div>
	    	<div class="row_kanan" style="width: 50%;">
	    		JANGKA WAKTU PERNILAIAN <br>
	    		<?=$periode_penilaian;?>
	    	</div>
	    </div>
	    <br>
	    <table class="border_tbl" width="100%" style="border-collapse: collapse;">
	        <tr>
	            <td width="5%" rowspan="6" class="text-center border_tbl" style="vertical-align: top;">1</td>
	            <td colspan="2" class="border_tbl">YANG DINILAI</td>
	        </tr>
	        <tr>
	            <td width="35%" class="border_tbl">a. Nama</td>
	            <td class="border_tbl"><?=$sql_pegawai['nama'];?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">b. NIP</td>
	            <td class="border_tbl"><?=$sql_pegawai['nip'];?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">c. Pangkat, Golongan/Ruang</td>
	            <td class="border_tbl"><?=pangkat_golongan($sql_pegawai['pangkat_golongan']);?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">d. Jabatan / Pekerjaan</td>
	            <td class="border_tbl"><?=show_row('jabatan',array('id'=>$sql_pegawai['fid_jabatan']),'nama');?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">e. Unit Organisasi</td>
	            <td class="border_tbl"><?=show_row('unit_kerja',array('id'=>$sql_pegawai['unit_kerja']),'nama');?></td>
	        </tr>
	        <tr>
	            <td rowspan="6" class="text-center border_tbl" style="vertical-align: top;">2</td>
	            <td colspan="2" class="border_tbl">PEJABAT PENILAI</td>
	        </tr>
	        <tr>
	            <td class="border_tbl">a. Nama</td>
	            <td class="border_tbl"><?=$sql_atasan['nama'];?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">b. NIP</td>
	            <td class="border_tbl"><?=$sql_atasan['nip'];?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">c. Pangkat, Golongan/Ruang</td>
	            <td class="border_tbl"><?=pangkat_golongan($sql_atasan['pangkat_golongan']);?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">d. Jabatan / Pekerjaan</td>
	            <td class="border_tbl"><?=show_row('jabatan',array('id'=>$sql_atasan['fid_jabatan']),'nama');?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">e. Unit Organisasi</td>
	            <td class="border_tbl"><?=show_row('unit_kerja',array('id'=>$sql_atasan['unit_kerja']),'nama');?></td>
	        </tr>
	        <tr>
	            <td rowspan="6" class="text-center border_tbl" style="vertical-align: top;">3</td>
	            <td colspan="2" class="border_tbl">ATASAN PEJABAT PENILAI</td>
	        </tr>
	        <tr>
	            <td class="border_tbl">a. Nama</td>
	            <td class="border_tbl"><?=$sql_atasan2['nama'];?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">b. NIP</td>
	            <td class="border_tbl"><?=$sql_atasan2['nip'];?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">c. Pangkat, Golongan/Ruang</td>
	            <td class="border_tbl"><?=pangkat_golongan($sql_atasan2['pangkat_golongan']);?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">d. Jabatan / Pekerjaan</td>
	            <td class="border_tbl"><?=show_row('jabatan',array('id'=>$sql_atasan2['fid_jabatan']),'nama');?></td>
	        </tr>
	        <tr>
	            <td class="border_tbl">e. Unit Organisasi</td>
	            <td class="border_tbl"><?=show_row('unit_kerja',array('id'=>$sql_atasan2['unit_kerja']),'nama');?></td>
	        </tr>
	    </table>
	
		<div class="new-page"></div>
		
		<table width="100%" style="border-collapse: collapse;">
	        <tr>
	            <td width="5%" rowspan="11" class="text-center border_tbl" style="vertical-align: top;">4</td>
	            <td colspan="4" class="border_tbl">UNSUR YANG DINILAI</td>
	            <td width="10%" class="border_tbl">JUMLAH</td>
	        </tr>
	        <tr>
	        	<td colspan="2" class="border_tbl">a. Sasaran Kerja Pegawai (SKP)</td>
	        	<td colspan="2" class="text-center"><?=$nilai_skp;?> x 60%</td>
	        	<td class="text-center border_tbl"><?=round($hitung_skp,2);?></td>
	        </tr>
	        <tr>
	        	<td rowspan="9" class="border_tbl">b. Perilaku Kerja</td>
	        	<td class="border_tbl">1) Orientasi Pelayanan</td>
	        	<td class="border_tbl text-center" width="12%"><?=$val_orientasi;?></td>
	        	<td class="border_tbl text-center" width="12%"><?=string_nilai($val_orientasi);?></td>
	        	<td class="border_tbl"></td>
	        </tr>
	        <tr>
	        	<td class="border_tbl">2) Integritas</td>
	        	<td class="border_tbl text-center"><?=$val_integritas;?></td>
	        	<td class="border_tbl text-center"><?=string_nilai($val_integritas);?></td>
	        	<td class="border_tbl"></td>
	        </tr>
	        <tr>
	        	<td class="border_tbl">3) Komitmen</td>
	        	<td class="border_tbl text-center"><?=$val_komitmen;?></td>
	        	<td class="border_tbl text-center"><?=string_nilai($val_komitmen);?></td>
	        	<td class="border_tbl"></td>
	        </tr>
	        <tr>
	        	<td class="border_tbl">4) Disiplin</td>
	        	<td class="border_tbl text-center"><?=$val_disiplin;?></td>
	        	<td class="border_tbl text-center"><?=string_nilai($val_disiplin);?></td>
	        	<td class="border_tbl"></td>
	        </tr>
	        <tr>
	        	<td class="border_tbl">5) Kerjasama</td>
	        	<td class="border_tbl text-center"><?=$val_kerjasama;?></td>
	        	<td class="border_tbl text-center"><?=string_nilai($val_kerjasama);?></td>
	        	<td class="border_tbl"></td>
	        </tr>
	        <tr>
	        	<td class="border_tbl">6) Kepemimpinan</td>
	        	<td class="border_tbl text-center"><?=$val_kepemimpinan;?></td>
	        	<td class="border_tbl text-center"><?=string_nilai($val_kepemimpinan);?></td>
	        	<td class="border_tbl"></td>
	        </tr>
	        <tr>
	        	<td class="border_tbl">Jumlah</td>
	        	<td class="border_tbl text-center"><?=$total_nilai2;?></td>
	        	<td class="border_tbl"></td>
	        	<td class="border_tbl"></td>
	        </tr>
	        <tr>
	        	<td class="border_tbl">Nilai Rata-Rata</td>
	        	<td class="border_tbl text-center"><?=$nilai_rata;?></td>
	        	<td class="border_tbl text-center"><?=string_nilai($nilai_rata);?></td>
	        	<td class="border_tbl"></td>
	        </tr>
	        <tr>
	        	<td class="border_tbl">Nilai Perilaku Kerja</td>
	        	<td class="text-center" colspan="2"><?=$nilai_rata;?> x 40%</td>
	        	<td class="border_tbl text-center"><?=round($hitung_prilaku,2);?></td>
	        </tr>
	        <tr>
	        	<td colspan="5" class="border_tbl text-center" style="height: 30px;">Nilai Prestasi Kerja</td>
	        	<td class="border_tbl text-center"><?=$nilai_prestasi;?> <br> (<?=string_nilai($nilai_prestasi);?>)</td>
	        </tr>
	    </table>

	    <div class="new-page"></div>

	    <table width="100%" class="border_tbl" style="border-collapse: collapse;">
	    	<tr>
	    		<td width="5%" class="text-center" style="height: 470px;vertical-align:top;">5.</td>
	    		<td style="vertical-align:top;">KEBERATAN DARI PEGAWAI NEGERI SIPIL YANG DINILAI (APABILA ADA)</td>
	    		<td width="30%" style="padding-bottom:30px; vertical-align:bottom;">Tanggal ...............................</td>
	    	</tr>
	    </table>
	    <table width="100%" class="border_tbl" style="border-collapse:collapse; margin-top: -22px;">
	    	<tr>
	    		<td width="5%" class="text-center" style="height: 470px;vertical-align:top;">6.</td>
	    		<td style="vertical-align:top;">TANGGAPAN PEJABAT PENILAI ATAS KEBERATAN</td>
	    		<td width="30%" style="padding-bottom:30px; vertical-align:bottom;">Tanggal ...............................</td>
	    	</tr>
	    </table>

	    <div class="new-page"></div>

	    <table width="100%" class="border_tbl" style="border-collapse: collapse;">
	    	<tr>
	    		<td width="5%" class="text-center" style="height: 470px;vertical-align:top;">7.</td>
	    		<td style="vertical-align:top;">KEPUTUSAN ATASAN PEJABAT PENILAI ATAS KEBERATAN</td>
	    		<td width="30%" style="padding-bottom:30px; vertical-align:bottom;">Tanggal ...............................</td>
	    	</tr>
	    </table>
	    <table width="100%" class="border_tbl" style="border-collapse:collapse; margin-top: -22px;">
	    	<tr>
	    		<td width="5%" class="text-center" style="height: 470px;vertical-align:top;">8.</td>
	    		<td style="vertical-align:top;">REKOMENDASI</td>
	    		<td width="30%" style="padding-bottom:30px; vertical-align:bottom;">Tanggal ...............................</td>
	    	</tr>
	    </table>

	    <div class="new-page"></div>

	    <table width="100%" class="border_tbl" style="border-collapse: collapse;">
	    	<tr>
	    		<td width="50%"></td>
	    		<td width="50%">9. DIBUAT TANGGAL,</td>
	    	</tr>
	    	<tr>
	    		<td width="50%"></td>
	    		<td width="50%" class="text-center">
	    			<div style="height: 100px;">PEJABAT PENILAI</div>
	    			<div>
	    				<strong><u><?=$sql_atasan['nama'];?></u></strong><br><?=$sql_atasan['nip'];?>
	    			</div>
	    		</td>
	    	</tr>

	    	<tr>
	    		<td width="50%">10. DITERIMA TANGGAL,</td>
	    		<td width="50%"></td>
	    	</tr>
	    	<tr>
	    		<td width="50%" class="text-center">
	    			<div style="height: 100px; padding-left: 15px;">PEGAWAI NEGERI SIPIL YANG DINILAI</div>
	    			<div style="padding-left: 15px;">
	    				<strong style="padding-left: 15px;"><u><?=$sql_pegawai['nama'];?></u></strong><br><?=$sql_pegawai['nip'];?>
	    			</div>
	    		</td>
	    		<td width="50%"></td>
	    	</tr>

	    	<tr>
	    		<td width="50%"></td>
	    		<td width="50%">11. DITERIMA TANGGAL,</td>
	    	</tr>
	    	<tr>
	    		<td width="50%"></td>
	    		<td width="50%" class="text-center">
	    			<div style="height: 100px;">ATASAN PEJABAT YANG MENILAI</div>
	    			<div>
	    				<strong><u><?=$sql_atasan2['nama'];?></u></strong><br><?=$sql_atasan2['nip'];?>
	    			</div>
	    		</td>
	    	</tr>
	    </table>
    </div>
</body>
</html>