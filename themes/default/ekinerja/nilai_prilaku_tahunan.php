<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,maximum-scale=1.0">
    <style type="text/css" media="screen"></style>
    <style type="text/css" media="print"></style>
	<style type="text/css">
	    .new-page { page-break-after: always;}
	    .content{
	    	padding: 20px;
	    	font-family: Times New Roman;
	    }
	    .header{
            padding-bottom: 20px; 
            font-weight: bold;
            font-size: 18px;
            text-align: center;
        }
        .topright {
          position: absolute;
          top: 0px;
          right: 20px;
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
	    table {
          border-collapse: collapse;
        }
        table, th, td {
          border: 1px solid black;
          font-size: 15px;
        }
        th, td {
          padding: 5px;
        }

        .row_awal {
			width:100%;
			height: 30px;
		}
		.row_kiri {
			width:15%;
			text-align:left;
			float:left;
		}
		.row_kanan {
			width:85%;
			text-align:left;
			float:right;
		}


	</style>
</head>
<body>
	<?php
	    $sql_pegawai = $this->global->find_data('pegawai', array('fid_user'=>$fid_user))->row_array();
	    $sql_parent_jabatan = $this->global->find_data('jabatan', array('id'=>$sql_pegawai['fid_jabatan']))->row_array();
	    $sql_atasan = $this->global->find_data('pegawai', array('fid_jabatan'=>$sql_parent_jabatan['parent']))->row_array();

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
    ?>
	<div class="content">
		<div class="header">
	        PENILAIAN PRILAKU PNS<br>TAHUN <?=$tahun;?>
	    </div>
	    <div class="topright">
	        <img src="<?php echo $_SERVER['DOCUMENT_ROOT'];?>/SIMPEG_BAP/themes/default/assets/qrCode/output.png" width="80" alt="no img">
	    </div>
	    <div class="row_awal">
	    	<div class="row_kiri">Nama <br> NIP</div>
	    	<div class="row_kanan">: <?=$sql_pegawai['nama'];?> <br> : <?=$sql_pegawai['nip'];?></div>
	    </div>
	    <br>
	    <table class="table" width="100%" style="margin-bottom: 50px;">
	        <tr>
	            <th width="5%" class="text-center">No</th>
	            <th width="15%" class="text-center">Tanggal</th>
	            <th class="text-center">Uraian</th>
	            <th width="30%" class="text-center">Paraf Pejabat Penilai</th>
	        </tr>
	        <tr>
	        	<td class="text-center">1</td>
	        	<td class="text-center">2</td>
	        	<td class="text-center">3</td>
	        	<td class="text-center">4</td>
	        </tr>
	        <tr>
	        	<td class="text-center" style="vertical-align: top;">1</td>
	        	<td class="text-left" style="vertical-align: top;">
	        		<?=$periode_penilaian;?>
	        	</td>
	        	<td class="text-left" style="vertical-align: top;">
	        		Penilaian SKP sampai dengan akhir Desember <?=$tahun;?> = <?=$nilai_skp;?> sedangkan penilaian prilaku kerjanya adalah sebagai berikut:
	        		<div style="width: 100%; height: 110px; margin-top: 10px;">
	        			<div style="width: 80%; text-align: left;float: left;">
	        				Orientasi Pelayanan <br>
	        				Integritas <br>
	        				Komitmen <br>
	        				Disiplin <br>
	        				Kerja Sama <br>
	        				Kepemimpinan
	        			</div>
	        			<div style="width: 20%; text-align: left;float: right;">
	        				= <?=round(($nilai_orientasi / 12),2);?> <br>
	        				= <?=round(($nilai_integritas / 12),2);?> <br>
	        				= <?=round(($nilai_komitmen / 12),2);?> <br>
	        				= <?=round(($nilai_disiplin / 12),2);?> <br>
	        				= <?=round(($nilai_kerjasama / 12),2);?> <br>
	        				= <?=round(($nilai_kepemimpinan / 12),2);?>
	        			</div>
	        		</div><hr>
	        		<div style="width: 100%; height: 50px;">
	        			<div style="width: 80%; text-align: left;float: left;">
	        				Jumlah <br>
	        				Nilai Rata-Rata
	        			</div>
	        			<div style="width: 20%; text-align: left;float: right;">
	        				= <?=round($tot_nilai,2);?> <br>
	        				= <?=round(($tot_nilai / 6),2);?>
	        			</div>
	        		</div>
	        	</td>
	        	<td class="text-center" style="vertical-align: top;">
	        		<?=show_row('jabatan',array('id'=>$sql_atasan['fid_jabatan']),'nama');?>
	        		<div style="margin-top: 165px;">
	        			<u><strong><?=$sql_atasan['nama'];?></strong></u><br>
	        			<?=$sql_atasan['nip'];?>
	        		</div>
	        	</td>
	        </tr>
	    </table>
    </div>
</body>
</html>