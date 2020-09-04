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
    $sql_kegiatan_tahunan = $this->global->find_data('ekin_keg_tahunan', array('fid_user'=>$fid_user, 'tahun'=>$tahun))->result_array();
    ?>
    <div class="header">
        FORMULIR SASARAN KERJA<br>PEGAWAI NEGERI SIPIL<br>TAHUN <?=$tahun;?>
    </div>
    <div class="topright">
        <img src="<?php echo $_SERVER['DOCUMENT_ROOT'];?>/SIMPEG_BAP/themes/default/assets/qrCode/output.png" width="80" alt="no img">
    </div>
    <table width="100%">
        <tr>
            <th width="5%" class="text-center">NO</th>
            <th class="text-left" width="45%" colspan="2">I. PEJABAT PENILAI</th>
            <th width="5%" class="text-center">NO</th>
            <th class="text-left" width="45%" colspan="2">II. PEGAWAI NEGERI SIPIL YANG DINILAI</th>
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
    </table>

    <table width="100%" style="margin-top: -1px;">
        <tr>
            <th width="5%" rowspan="2" class="text-center">NO</th>
            <th class="text-left" width="45%" rowspan="2">III. KEGIATAN TUGAS JABATAN</th>
            <th width="5%" rowspan="2" class="text-center">AK</th>
            <th width="45%" colspan="4" class="text-center">TARGET</th>
        </tr>
        <tr>
            <th class="text-center">KUANT/OUTPUT</th>
            <th class="text-center">KUAL/MUTU</th>
            <th class="text-center">WAKTU</th>
            <th class="text-center">BIAYA</th>
        </tr>
        <!-- LIST KEGIATAN TAHUNAN -->
        <?php
        $no = 1;
        foreach ($sql_kegiatan_tahunan as $value) {
            if($value['biaya'] == 0)
                $biaya = '&nbsp;';
            else
                $biaya = number_format($value['biaya'],0,",",".");

            if((int)$value['angka_kredit'] == 0)
                $ak = '&nbsp;';
            else
                $ak = (int)$value['angka_kredit'];
            echo '<tr>
                <td class="text-center">'.$no++.'</td>
                <td>'.$value['kegiatan'].'</td>
                <td class="text-center">'.$ak.'</td>
                <td class="text-center">'.$value['satuan'].'</td>
                <td class="text-center">100</td>
                <td class="text-center">'.$value['target_penyelesaian'].' Bulan</td>
                <td class="text-center">'.$biaya.'</td>
            </tr>';
        }
        ?>
    </table>

    <div class="text-right" style="padding-top: 10px; padding-bottom: 10px;">
        <?=show_row('setting', array('id'=>1),'pengguna').", ".tgl_indo($tanggal_cetak);?>
    </div>

    <table width="100%" border="0">
        <tr>
            <td width="50%" class="text-center font17">Pejabat Penilai<br></td>
            <td width="50%" class="text-center font17">Pegawai Negeri Sipil Yang Dinilai</td>
        </tr>
        <tr>
            <td class="text-center" style="height: 160px; vertical-align: bottom;">
                <u class="font-ttd"><?=$sql_atasan['nama'];?></u><br><?=$sql_atasan['nip'];?>
            </td>
            <td class="text-center" style="height: 160px; vertical-align: bottom;">
                <u class="font-ttd"><?=$sql_pegawai['nama'];?></u><br><?=$sql_pegawai['nip'];?>
            </td>
        </tr>
    </table>
</body>
</html>