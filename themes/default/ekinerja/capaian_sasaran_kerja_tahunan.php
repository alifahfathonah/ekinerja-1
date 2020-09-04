<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN</title>
	<style type="text/css">
	    @page{margin: 0.2in 0.5in 0.2in 0.5in;}
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
	    .text-center{
	        text-align: center;
	    }
	    .text-left{
	        text-align: left;
	    } 
	    .text-right{
	        text-align: right;
	    }
	    .header{
	        padding-bottom: 20px; 
	        font-weight: bold;
	        font-size: 18px;
	        text-align: center;
	    }
	    .barcode{
	        position: absolute;
	        right: 0;
	    }
	    .font16{
	        font-size: 16px;
	    }
	    .font17{
	        font-size: 17px;
	    }
	    .font18{
	        font-size: 18px;
	    }
	    .font-ttd{
	        font-size: 20px;
	        font-weight: bold;
	    }
	    .topright {
		  position: absolute;
		  top: 0px;
		  right: 0px;
		}
	</style>
</head>
<body>
	<?php
    $sql_pegawai = $this->global->find_data('pegawai', array('fid_user'=>$fid_user))->row_array();
    $sql_parent_jabatan = $this->global->find_data('jabatan', array('id'=>$sql_pegawai['fid_jabatan']))->row_array();
    $sql_atasan = $this->global->find_data('pegawai', array('fid_jabatan'=>$sql_parent_jabatan['parent']))->row_array();
    $sql_kegiatan_tahunan = $this->global->find_data('ekin_keg_tahunan', array('fid_user'=>$fid_user, 'tahun'=>$tahun, 'status'=>'Diterima'))->result_array();
    $sql_tugas_tambahan = $this->global->find_data('ekin_tambahan_kreatifitas', array('fid_user'=>$fid_user, 'tahun'=>$tahun, 'jenis'=>'Tugas Tambahan', 'status'=>'Diterima'), 'kegiatan', 'ASC')->result_array();
    $sql_kreativitas = $this->global->find_data('ekin_tambahan_kreatifitas', array('fid_user'=>$fid_user, 'tahun'=>$tahun, 'jenis'=>'Kreatifitas', 'status'=>'Diterima'), 'kegiatan', 'ASC')->result_array();
    $jml_keg_tahunan = count($sql_kegiatan_tahunan);
	?>
	<div class="header">
		PENILAIAN CAPAIAN SASARAN KERJA<br>PEGAWAI NEGERI SIPIL<br>TAHUN <?=$tahun;?>
	</div>
	<div class="topright">
	    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'];?>/SIMPEG_BAP/themes/default/assets/qrCode/output.png" width="80" alt="no img">
	</div>

	<table width="100%">
	    <tr>
	        <th width="3%" class="text-center">NO</th>
	        <th class="text-left" width="47%" colspan="2">I. PEJABAT PENILAI</th>
	        <th width="3%" class="text-center">NO</th>
	        <th class="text-left" width="47%" colspan="2">II. PEGAWAI NEGERI SIPIL YANG DINILAI</th>
	    </tr>
	    <tr>
	        <td class="text-center">1</td>
	        <td>Nama</td>
	        <td><?=$sql_atasan['nama'];?></td>
	        <td class="text-center">1</td>
	        <td>Nama</td>
	        <td><?=$sql_pegawai['nama'];?></td>
	    </tr>
	    <tr>
	        <td class="text-center">2</td>
	        <td>NIP</td>
	        <td><?=$sql_atasan['nip'];?></td>
	        <td class="text-center">3</td>
	        <td>NIP</td>
	        <td><?=$sql_pegawai['nip'];?></td>
	    </tr>
	    <tr>
	        <td class="text-center">3</td>
	        <td>Pangkat/Gol.Ruang</td>
	        <td><?=pangkat_golongan($sql_atasan['pangkat_golongan']);?></td>
	        <td class="text-center">3</td>
	        <td>Pangkat/Gol.Ruang</td>
	        <td><?=pangkat_golongan($sql_pegawai['pangkat_golongan']);?></td>
	    </tr>
	    <tr>
	        <td class="text-center">4</td>
	        <td>Jabatan</td>
	        <td><?=show_row('jabatan',array('id'=>$sql_atasan['fid_jabatan']),'nama');?></td>
	        <td class="text-center">4</td>
	        <td>Jabatan</td>
	        <td><?=show_row('jabatan',array('id'=>$sql_pegawai['fid_jabatan']),'nama');?></td>
	    </tr>
	    <tr>
	        <td class="text-center">5</td>
	        <td>Unit Kerja</td>
	        <td><?=show_row('unit_kerja',array('id'=>$sql_atasan['unit_kerja']),'nama');?></td>
	        <td class="text-center">5</td>
	        <td>Unit Kerja</td>
	        <td><?=show_row('unit_kerja',array('id'=>$sql_pegawai['unit_kerja']),'nama');?></td>
	    </tr>
	    <tr><td colspan="6" class="text-center"><strong>Jangka Waktu Penilaian <?=$periode_penilaian;?></strong></td></tr>
	</table>

	<table width="100%" style="margin-top: -1px;">
	    <tr>
	        <th width="3%" rowspan="2" class="text-center">NO</th>
	        <th width="25%" class="text-left"rowspan="2">III. KEGIATAN TUGAS JABATAN</th>
	        <th width="5%" rowspan="2" class="text-center">AK</th>
	        <th colspan="4" class="text-center">TARGET</th>
	        <th width="5%" rowspan="2" class="text-center">AK</th>
	        <th colspan="4" class="text-center">REALISASAI</th>
	        <th rowspan="2" class="text-center">PERHITUNGAN</th>
	        <th rowspan="2" class="text-center">NILAI</th>
	    </tr>
	    <tr>
	        <th class="text-center">KUANT/<br>OUTPUT</th>
	        <th class="text-center">KUAL/<br>MUTU</th>
	        <th class="text-center">WAKTU</th>
	        <th class="text-center">BIAYA</th>
	        <th class="text-center">KUANT/<br>OUTPUT</th>
	        <th class="text-center">KUAL/<br>MUTU</th>
	        <th class="text-center">WAKTU</th>
	        <th class="text-center">BIAYA</th>
	    </tr>
	    <!-- LIST KEGIATAN -->
	  	<?php
	  	$nilai_kegiatan = 0;
	  	$nilai_kreativ = 0;
	  	if(count($sql_kegiatan_tahunan) > 0){
	  		$no1 = 1;
	        foreach ($sql_kegiatan_tahunan as $value) {
	        	$sql_realisasi = $this->db
	            	->select('SUM(a.kuantitas) as kuantitas, SUM(a.kualitas) AS kualitas, COUNT(*) as waktu, SUM(a.biaya) AS biaya, SUM(a.perhitungan) AS perhitungan, SUM(a.nilai) AS nilai, SUM(a.angka_kredit) as angka_kredit')
	            	->where('b.fid_keg_tahunan', $value['id'])
	            	->where('b.status', 'Diterima')
	            	->where('a.fid_user', $fid_user)
	            	->join('ekin_keg_bulanan b', 'a.fid_keg_bulanan=b.id')
	            	->get('ekin_keg_bulanan_realisasi a')->row_array();
	            if($value['biaya'] == 0)
	                $biaya = '&nbsp;';
	            else
	                $biaya = number_format($value['biaya'],0,",",".");

	            if((int)$value['angka_kredit'] == 0)
	                $ak = '&nbsp;';
	            else
	                $ak = round($value['angka_kredit'], 1);

	            if($sql_realisasi['biaya'] == 0)
	            	$biaya_realisasi = '&nbsp;';
	            else
	            	$biaya_realisasi = number_format(round(($sql_realisasi['biaya'] / $value['target_penyelesaian']), 2), 0,",",".");

	            if((int)$sql_realisasi['angka_kredit'] == 0)
	                $ak_realisasi = '&nbsp;';
	            else
	                $ak_realisasi = round($sql_realisasi['angka_kredit'], 1);

	            $nilai = round(($sql_realisasi['nilai'] / $value['target_penyelesaian']), 2);
	            $nilai_kegiatan += $nilai;
	            echo '<tr>
	                <td class="text-center">'.$no1++.'</td>
	                <td>'.$value['kegiatan'].'</td>
	                <td class="text-center">'.$ak.'</td>
	                <td class="text-center">'.(int)$value['target_kuantitas'].' '.$value['satuan'].'</td>
	                <td class="text-center">100</td>
	                <td class="text-center">'.$value['target_penyelesaian'].' Bulan</td>
	                <td class="text-center">'.$biaya.'</td>
	                <td class="text-center">'.$ak_realisasi.'</td>
	                <td class="text-center">'.(int)$sql_realisasi['kuantitas'].' '.$value['satuan'].'</td>
	                <td class="text-center">'.round(($sql_realisasi['kualitas'] / $value['target_penyelesaian']), 2).'</td>
	                <td class="text-center">'.$sql_realisasi['waktu'].' Bulan</td>
	                <td class="text-center">'.$biaya_realisasi.'</td>
	                <td class="text-center">'.round(($sql_realisasi['perhitungan'] / $value['target_penyelesaian']), 2).'</td>
	                <td class="text-center">'.$nilai.'</td>
	            </tr>';

	        }
	  	} else{
	  		echo '<tr>
		    		<td class="text-center" colspan="14">Tugas Jabatan Belum Diisi / Belum Terverifikasi</td>
		    	</tr>';
	  	}
        ?>
	    <tr>
	    	<th width="3%" class="text-center">NO</th>
	    	<th colspan="13" class="text-left">IV. TUGAS TAMBAHAN DAN KREATIVITAS</th>
	    </tr>
	    <tr>
	    	<td width="3%" class="text-center" rowspan="<?=count($sql_tugas_tambahan)+1;?>">1</td>
	    	<th colspan="13" class="text-left">TUGAS TAMBAHAN</th>
	    </tr>
	    <?php
	    $dum_nilai1 = 0;
	    if(count($sql_tugas_tambahan) > 0){
	    	if(count($sql_tugas_tambahan) <= 3){
	    		$dum_nilai1 = 1;
	    	} elseif(count($sql_tugas_tambahan) >= 4 && count($sql_tugas_tambahan) <=6){
	    		$dum_nilai1 = 2;
	    	} else{
				$dum_nilai1 = 3;
	    	}
	    	$row_chek=1;
		    foreach ($sql_tugas_tambahan as $value) {
		    	if($row_chek == 1){
		    		echo '<tr>
		    				<td colspan="12" class="text-left">- '.$value['kegiatan'].'</td>
		    				<td class="text-center" rowspan="'.count($sql_tugas_tambahan).'">'.$dum_nilai1.'</td>
		    			</tr>';
		    	} else{
		    		echo '<tr>
		    				<td colspan="12" class="text-left">- '.$value['kegiatan'].'</td>
		    			</tr>';
		    	}
		    	$row_chek ++;
		    }
	    } else{
	    	echo '<tr>
		    		<td class="text-center" colspan="14">Tidak Ada Tugas Tambahan</td>
		    	</tr>';
	    }
	    ?>
	    <tr>
	    	<td width="3%" class="text-center" rowspan="<?=count($sql_kreativitas)+1;?>">2</td>
	    	<th colspan="13" class="text-left">KREATIVITAS</th>
	    </tr>
	    <?php
	    if(count($sql_kreativitas) > 0){
		    foreach ($sql_kreativitas as $value) {
		    	$nilai_kreativ += $value['nilai'];
	    		echo '<tr>
	    				<td colspan="12" class="text-left">- '.$value['kegiatan'].'</td>
	    				<td class="text-center">'.$value['nilai'].'</td>
	    			</tr>';
		    }
	    } else{
	    	echo '<tr>
		    		<td class="text-center" colspan="14">Tidak Ada Kegiatan Kreativitas</td>
		    	</tr>';
	    }
	    ?>
	    <tr>
	    	<th colspan="13" rowspan="2" class="text-center">NILAI CAPAIAN SKP</th>
	    	<th class="text-center">
	    		<?php 
	    			$total_nilai = ($nilai_kegiatan / $jml_keg_tahunan) + $dum_nilai1 + $nilai_kreativ;
	    			$print_nilai = round($total_nilai, 2);
	    			echo $print_nilai;
	    		?>
	    	</th>
	    </tr>
	    <tr>
	    	<th class="text-center">(<?=string_nilai($print_nilai);?>)</th>
	    </tr>
	</table>

	<div class="text-right" style="padding-top: 10px; padding-bottom: 10px;">
	    <?=show_row('setting', array('id'=>1),'pengguna').", ".tgl_indo($tanggal_cetak);?>
	</div>

	<table width="100%" style="border-collapse: collapse;">
	    <tr>
	        <td class="text-center font17">Pejabat Penilai<br></td>
	    </tr>
	    <tr>
	        <td class="text-center" style="height: 160px; vertical-align: bottom;">
	            <u class="font-ttd"><?=$sql_atasan['nama'];?></u><br><?=$sql_atasan['nip'];?>
	        </td>
	    </tr>
	</table>
</body>
</html>