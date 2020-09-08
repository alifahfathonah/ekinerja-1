<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,maximum-scale=1.0">
        <style type="text/css" media="screen"></style>
        <style type="text/css" media="print"></style>
        <style type="text/css">
          body {
            background: rgb(204,204,204); 
          }
          table {
            font-size: 12px;
          }
          .content{
            padding: 40px;
          }
          .garuda {
            text-align: center;
          }
          .sub {
            margin-top: 40px;
          }
          .right {
            float: right;
          }
          .text1 {
            font-size:14px;
          }
          .border-box {
            margin-bottom: 10px;
            width:100%;
            height:250px;
            border: 2px solid #000;
          }
          .tgl-box {
            position:relative;top:70%;text-align:right;padding-right: 10px;
          }
          page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
          }
          page[size="F4"] {  
            width: 21.0cm;
            height: 33.0cm; 
          }
          page[size="F4"][layout="portrait"] {
            width: 33.0cm;
            height: 21.0cm;  
          }
          page[size="A4"] {  
            width: 21cm;
            height: 29.7cm; 
          }
          page[size="A4"][layout="portrait"] {
            width: 29.7cm;
            height: 21cm;  
          }
          page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
          }
          page[size="A3"][layout="portrait"] {
            width: 42cm;
            height: 29.7cm;  
          }
          page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
          }
          page[size="A5"][layout="portrait"] {
            width: 21cm;
            height: 14.8cm;  
          }
          @media print {
            body, page {
              margin: 0;
              box-shadow: 0;
            }
          }
        </style>
        <title>Print Penilaian SKP</title>
    </head>
    <body>
      <page size="F4" layout="portrait">
        <div class="content">
          <h3 align="center">PEGAWAI NEGERI SIPIL, TAHUN <?=$skp['tahun'];?></h3>
          <table border="1" style="padding-top: 5px" width="100%">
            <tr>
              <td align="center" width="4%"><strong>NO</strong></td>
              <td colspan="2" width="55%"><strong>I. PEJABAT PENILAI</strong></td>
              <td align="center" width="4%"><strong>NO</strong></td>
              <td colspan="4"><strong>II. PEGAWAI NEGERI SIPIL YANG DINILAI</strong></td>
            </tr>
            <tr>
              <td align="center">1</td>
              <td width="10%">Nama</td>
              <td><?=show_row('pegawai',array('id'=>$skp['pejabat']),'nama');?></td>
              <td align="center">1</td>
              <td width="10%">Nama</td>
              <td colspan="3"><?=$find_data['nama'];?></td>
            </tr>
            <tr>
              <td align="center">2</td>
              <td>NIP</td>
              <td><?=show_row('pegawai',array('id'=>$skp['pejabat']),'nip');?></td>
              <td align="center">2</td>
              <td>NIP</td>
              <td colspan="3"><?=$find_data['nip'];?></td>
            </tr>
            <tr>
              <td align="center">3</td>
              <td>Pangkat/Gol Ruang</td>
              <td><?=pangkat_golongan($pejabat['pangkat_golongan']);?></td>
              <td align="center">3</td>
              <td>Pangkat/Gol Ruang</td>
              <td colspan="3"><?=pangkat_golongan($find_data['pangkat_golongan']);?></td>
            </tr>
            <tr>
              <td align="center">4</td>
              <td>Jabatan</td>
              <td><?=show_row('pejabat',array('id'=>$skp['pejabat']),'posisi');?></td>
              <td align="center">4</td>
              <td>Jabatan</td>
              <td colspan="3"><?=show_row('jabatan',array('id'=>$find_data['fid_jabatan']),'nama');?></td>
            </tr>
            <tr>
              <td align="center">5</td>
              <td>Unit Kerja</td>
              <td>BAPPEDA KOTA MAKASSAR</td>
              <td align="center">5</td>
              <td>Unit Kerja</td>
              <td colspan="3">BAPPEDA KOTA MAKASSAR</td>
            </tr>
            
            <tr>
              <td rowspan="2" align="center"><strong>NO</strong></td>
              <td rowspan="2" colspan="2" align="center"><strong>III. KEGIATAN TUGAS JABATAN</strong></td>
              <td rowspan="2" align="center"><strong>AK</strong></td>
              <td colspan="4" align="center"><strong>TARGET</strong></td>
            </tr>
            <tr>
              <td align="center"><strong>Kuant/ Output</strong></td>
              <td align="center"><strong>Kual/ Mutu</strong></td>
              <td align="center"><strong>Waktu (Bln)</strong></td>
              <td align="center" width="10%"><strong>Biaya</strong></td>
            </tr>
            <tr>
            <?php
              $no = 1;
              $sql = $this->db
                ->select('*')
                ->where('fid_skp', $skp['id'])
                ->get('skp_detil')->result();
              if(!empty($sql)){
                foreach ($sql as $value) {
                  echo '<tr>
                    <td align="center">'.$no++.'</td>
                    <td colspan="2">'.$value->tugas.'</td>
                    <td align="center">'.$value->ak1.'</td>
                    <td align="center">'.$value->tar_kuant.'</td>
                    <td align="center">'.$value->tar_kual.'</td>
                    <td align="center">'.$value->tar_bln.'</td>
                    <td align="center">'.$value->tar_biaya.'</td>
                  </tr>';
                }
              } else{
                echo '<tr><td colspan="8" align="center">Detail Nilai Belum Diinput.</td></tr>';
              }
            ?>
            </tr>
          </table>
          <table style="padding-top: 5px" width="100%">
            <tr>
              <td width="50%">
                PEJABAT PENILAI, <br><br><br>
                <strong><?=show_row('pegawai',array('id'=>$skp['pejabat']),'nama');?></strong><br>
                <?=show_row('pegawai',array('id'=>$skp['pejabat']),'nip');?>
              </td>
              <td width="50%" align="right">
                Pegawai Negeri Sipil Yang Dinilai, <br><br><br>
                <strong><?=$find_data['nama'];?></strong><br>
                <?=$find_data['nip'];?>
              </td>
            </tr>
          </table>
        </div>
      </page>

      <page size="F4" layout="portrait">
        <div class="content">
          <h3 align="center">PENILAIAN CAPAIAN SASARAN KERJA <br> PEGAWAI NEGERI SIPIL</h3>
          <table border="1" style="padding-top: 5px" width="100%">
            <tr>
              <td rowspan="2" align="center"><strong>NO</strong></td>
              <td rowspan="2" align="center" width="40%"><strong>I. TUGAS</strong></td>
              <td rowspan="2" align="center"><strong>AK</strong></td>
              <td colspan="4" align="center"><strong>TARGET</strong></td>
              <td rowspan="2" align="center"><strong>AK</strong></td>
              <td colspan="4" align="center"><strong>REALISASI</strong></td>
              <td rowspan="2" align="center"><strong>PERHITUNGAN</strong></td>
              <td rowspan="2" align="center"><strong>NILAI</strong></td>
            </tr>
            <tr>
              <td align="center"><strong>Kuant/ Output</strong></td>
              <td align="center"><strong>Kual/ Mutu</strong></td>
              <td align="center"><strong>Waktu (Bln)</strong></td>
              <td align="center"><strong>Biaya</strong></td>
              <td align="center"><strong>Kuant/ Output</strong></td>
              <td align="center"><strong>Kual/ Mutu</strong></td>
              <td align="center"><strong>Waktu (Bln)</strong></td>
              <td align="center"><strong>Biaya</strong></td>
            </tr>
            <?php
              $no1 = 1;
              $sql1 = $this->db
                ->select('*')
                ->where('fid_skp', $skp['id'])
                ->where('jenis_tugas', 1)
                ->get('skp_detil')->result();
              if(!empty($sql1)){
                echo '<tr><td colspan="14"><strong>Jenis : Tugas Pokok Jabatan</strong></td></tr>';
                foreach ($sql1 as $value) {
                  echo '<tr>
                    <td align="center">'.$no1++.'</td>
                    <td>'.$value->tugas.'</td>
                    <td align="center">'.$value->ak1.'</td>
                    <td align="center">'.$value->tar_kuant.'</td>
                    <td align="center">'.$value->tar_kual.'</td>
                    <td align="center">'.$value->tar_bln.'</td>
                    <td align="center">'.$value->tar_biaya.'</td>
                    <td align="center">'.$value->ak2.'</td>
                    <td align="center">'.$value->rea_kuant.'</td>
                    <td align="center">'.$value->rea_kual.'</td>
                    <td align="center">'.$value->rea_bln.'</td>
                    <td align="center">'.$value->rea_biaya.'</td>
                    <td align="center">'.$value->perhitungan.'</td>
                    <td align="center">'.round($value->nilai, 2).'</td>
                  </tr>';
                }
              } else{
                echo '<tr><td colspan="14" align="center">Detail Nilai Belum Diinput.</td></tr>';
              }

              $no2 = 1;
              $sql2 = $this->db
                ->select('*')
                ->where('fid_skp', $skp['id'])
                ->where('jenis_tugas', 2)
                ->get('skp_detil')->result();
              if(!empty($sql2)){
                echo '<tr><td colspan="14"><strong>Jenis : Tugas Tambahan dan Kreativitas</strong></td></tr>';
                foreach ($sql2 as $value) {
                  echo '<tr>
                    <td align="center">'.$no2++.'</td>
                    <td>'.$value->tugas.'</td>
                    <td align="center">'.$value->ak1.'</td>
                    <td align="center">'.$value->tar_kuant.'</td>
                    <td align="center">'.$value->tar_kual.'</td>
                    <td align="center">'.$value->tar_bln.'</td>
                    <td align="center">'.$value->tar_biaya.'</td>
                    <td align="center">'.$value->ak2.'</td>
                    <td align="center">'.$value->rea_kuant.'</td>
                    <td align="center">'.$value->rea_kual.'</td>
                    <td align="center">'.$value->rea_bln.'</td>
                    <td align="center">'.$value->rea_biaya.'</td>
                    <td align="center">'.$value->perhitungan.'</td>
                    <td align="center">'.round($value->nilai, 2).'</td>
                  </tr>';
                }
              } else{
                echo '<tr><td colspan="14" align="center">Detail Nilai Belum Diinput.</td></tr>';
              }
            ?>
            <tr>
            <?php
              $sql_avg= $this->db
                ->select('IFNULL(AVG(nilai), 0) AS rata')
                ->where('fid_skp', $skp['id'])
                ->get('skp_detil')->row_array();
            ?>
              <td rowspan="2" colspan="13" align="center">NILAI CAPAIAN SKP</td>
              <td align="center">
              <?php
                if($sql_avg['rata'] == 0)
                  echo '-';
                else
                  echo round($sql_avg['rata'], 2);
              ?>
              </td>
            </tr>
            <tr>
              <td align="center">
              <?php
                if($sql_avg['rata'] == 0)
                  echo '-';
                else
                  echo string_nilai($sql_avg['rata']);
              ?>
              </td>
            </tr>
          </table>
          <table style="padding-top: 5px" width="100%">
            <tr>
              <td align="right">
                PEJABAT PENILAI, <br><br><br>
                <strong><u><?=show_row('pegawai',array('id'=>$skp['pejabat']),'nama');?></u></strong><br>
                <?=show_row('pegawai',array('id'=>$skp['pejabat']),'nip');?>
              </td>
            </tr>
          </table>
        </div>
      </page>
    </body>
</html>