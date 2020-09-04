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
        <title>Print Penilaian DP3</title>
    </head>
    <body>
      <?php
        $skp_rata = 0;
        $query_skp = $this->db
          ->select('IFNULL(AVG(b.nilai), 0) AS rata_skp')
          ->where('a.fid_pegawai', $find_data['id'])
          ->where('a.tahun', $dp3['tahun'])
          ->join('skp_detil b', 'a.id=b.fid_skp')
          ->get('skp a');
        if($query_skp->num_rows() > 0){
          $skp_ = $query_skp->row_array();
          $skp_rata = $skp_['rata_skp'];
        }
      ?>
      <page size="F4">
        <div class="content">
          <div class="garuda">
            <img src="<?=base_url();?>themes/default/assets/img/garuda.png" width="80">
          </div>
          <h2 align="center">RAHASIA</h2>
          <h4 align="center">DAFTAR PENILAIAN PELAKSANAAN PEKERJAAN <br> PEGAWAI NEGERI SIPIL, TAHUN <?=$dp3['tahun'];?></h4>
          <div class="sub">
            <span class="text1">PEMERINTAH KOTA MAKASSAR</span>
            <span class="right text1">JANGKA WAKTU PENILAIAN <br> TANGGAL, </span>
          </div>
          <table border="1" style="padding-top: 20px" width="100%">
            <tr>
              <td rowspan="6">1</td>
              <td colspan="5"><strong>YANG DINILAI</strong></td>
            </tr>
            <tr>
              <td>a. Nama</td>
              <td colspan="4"><strong><?=$find_data['nama'];?></strong></td>
            </tr>
            <tr>
              <td>b. NIP</td>
              <td colspan="4"><?=$find_data['nip'];?></td>
            </tr>
            <tr>
              <td>c. Pangkat, Golongan ruang</td>
              <td colspan="4"><?=pangkat_golongan($find_data['pangkat_golongan']);?></td>
            </tr>
            <tr>
              <td>d. Jabatan/Pekerjaan</td>
              <td colspan="4"><?=show_row('jabatan',array('id'=>$find_data['fid_jabatan']),'nama');?></td>
            </tr>
            <tr>
              <td>e. Unit Organisasi</td>
              <td colspan="4">BAPPEDA KOTA MAKASSAR</td>
            </tr>

            <tr>
              <td rowspan="6">2</td>
              <td colspan="5"><strong>PEJABAT PENILAI</strong></td>
            </tr>
            <tr>
              <td>a. Nama</td>
              <td colspan="4"><strong><?=show_row('pegawai',array('id'=>$dp3['pejabat']),'nama');?></strong></td>
            </tr>
            <tr>
              <td>b. NIP</td>
              <td colspan="4"><?=show_row('pegawai',array('id'=>$dp3['pejabat']),'nip');?></td>
            </tr>
            <tr>
              <td>c. Pangkat, Golongan ruang</td>
              <td colspan="4"><?=pangkat_golongan($pejabat['pangkat_golongan']);?></td>
            </tr>
            <tr>
              <td>d. Jabatan/Pekerjaan</td>
              <td colspan="4"><?=show_row('jabatan',array('id'=>$pejabat['fid_jabatan']),'nama');?></td>
            </tr>
            <tr>
              <td>e. Unit Organisasi</td>
              <td colspan="4">BAPPEDA KOTA MAKASSAR</td>
            </tr>

            <tr>
              <td rowspan="6">3</td>
              <td colspan="5"><strong>ATASAN PEJABAT PENILAI</strong></td>
            </tr>
            <tr>
              <td>a. Nama</td>
              <td colspan="4"><strong><?=show_row('pegawai',array('id'=>$dp3['atasan_pejabat']),'nama');?></strong></td>
            </tr>
            <tr>
              <td>b. NIP</td>
              <td colspan="4"><?=show_row('pegawai',array('id'=>$dp3['atasan_pejabat']),'nip');?></td>
            </tr>
            <tr>
              <td>c. Pangkat, Golongan ruang</td>
              <td colspan="4"><?=pangkat_golongan($atasan_pejabat['pangkat_golongan']);?></td>
            </tr>
            <tr>
              <td>d. Jabatan/Pekerjaan</td>
              <td colspan="4"><?=show_row('jabatan',array('id'=>$atasan_pejabat['fid_jabatan']),'nama');?></td>
            </tr>
            <tr>
              <td>e. Unit Organisasi</td>
              <td colspan="4">BAPPEDA KOTA MAKASSAR</td>
            </tr>

            <tr>
              <td rowspan="13">4</td>
              <td colspan="5"><strong>UNSUS YANG DINILAI</strong> <span class="right" style="margin-right: 15px;">JUMLAH</span></td>
            </tr>
            <tr>
              <td colspan="5">a. Sasar Kinerja Pegawai (SKP) <?=round($skp_rata, 2);?> x 60% <span class="right" style="margin-right: 25px;"><?= (round($skp_rata, 2) * 60) / 100;?></span></td>
            </tr>
            <tr>
              <td rowspan="9">b. Perilaku Kerja</td>
              <td>1. Orientasi Pelayanan</td>
              <td width="8%" align="center">
              <?php 
              if($dp3['nilai_orientasi'] == 0.00)
                echo '';
              else
                echo round($dp3['nilai_orientasi'], 2); 
              ?>
              </td>
              <td width="13%" align="center"><?=string_nilai($dp3['nilai_orientasi']);?></td>
              <td width="8%"></td>
            </tr>
            <tr>
              <td>2. Integritas</td>
              <td width="8%" align="center">
              <?php 
              if($dp3['nilai_integritas'] == 0.00)
                echo '';
              else
                echo round($dp3['nilai_integritas'], 2); 
              ?>
              </td>
              <td width="13%" align="center"><?=string_nilai($dp3['nilai_integritas']);?></td>
              <td width="8%"></td>
            </tr>
            <tr>
              <td>3. Komitmen</td>
              <td width="8%" align="center">
              <?php 
              if($dp3['nilai_komitmen'] == 0.00)
                echo '';
              else
                echo round($dp3['nilai_komitmen'], 2); 
              ?>
              </td>
              <td width="13%" align="center"><?=string_nilai($dp3['nilai_komitmen']);?></td>
              <td width="8%"></td>
            </tr>
            <tr>
              <td>4. Disiplin</td>
              <td width="8%" align="center">
              <?php 
              if($dp3['nilai_disiplin'] == 0.00)
                echo '';
              else
                echo round($dp3['nilai_disiplin'], 2);
              ?>
              </td>
              <td width="13%" align="center"><?=string_nilai($dp3['nilai_disiplin']);?></td>
              <td width="8%"></td>
            </tr>
            <tr>
              <td>5. Kerjasama</td>
              <td width="8%" align="center">
              <?php 
              if($dp3['nilai_kerjasama'] == 0.00)
                echo '';
              else
                echo round($dp3['nilai_kerjasama'], 2);
              ?>
              </td>
              <td width="13%" align="center"><?=string_nilai($dp3['nilai_kerjasama']);?></td>
              <td width="8%"></td>
            </tr>
            <tr>
              <td>6. Kepemimpinan</td>
              <td width="8%" align="center">
              <?php 
              if($dp3['nilai_kepemimpinan'] == 0.00)
                echo '';
              else
                echo round($dp3['nilai_kepemimpinan'], 2);
              ?>
              </td>
              <td width="13%" align="center"><?=string_nilai($dp3['nilai_kepemimpinan']);?></td>
              <td width="8%"></td>
            </tr>
            <tr>
              <td>7. Jumlah</td>
              <td width="8%" align="center"><?php echo ($dp3['nilai_orientasi'] + $dp3['nilai_integritas'] + $dp3['nilai_komitmen'] + $dp3['nilai_disiplin'] + $dp3['nilai_kerjasama'] + $dp3['nilai_kepemimpinan']);?></td>
              <td width="13%" align="center"></td>
              <td width="8%"></td>
            </tr>
            <tr>
              <td>8. Nilai rata-rata</td>
              <td width="8%" align="center">
              <?php 
              if($dp3['nilai_avg'] == 0.00)
                echo '';
              else
                echo round($dp3['nilai_avg'], 2);
              ?>
              </td>
              <td width="13%" align="center"><?=string_nilai($dp3['nilai_avg']);?></td>
              <td width="8%"></td>
            </tr>
            <tr>
              <td colspan="3">9. Nilai Perilaku Kerja <span class="right"><?=round($dp3['nilai_avg'], 2);?> x 40%</span></td>
              <td width="8%" align="center"><?php echo ((round($dp3['nilai_avg'], 2) * 40) / 100);?></td>
            </tr>
            <tr>
              <td rowspan="2" colspan="4" align="center">NILAI PRESTASI KERJA</td>
              <td width="13%" align="center"><?= ((round($skp_rata, 2) * 60) / 100) + ((round($dp3['nilai_avg'], 2) * 40) / 100) ;?></td>
            </tr>
            <tr>
              <td width="13%" align="center"><?=string_nilai(((round($skp_rata, 2) * 60) / 100) + ((round($dp3['nilai_avg'], 2) * 40) / 100));?></td>
            </tr>
          </table>
        </div>
      </page>

      <page size="F4">
        <div class="content">
          <div class="border-box">
            <div style="padding: 10px;">5. KEBERATAN DARI PEGAWAI NEGERI SIPIL, YANG DINILAI (APABILA ADA)</div>
            <div class="tgl-box">Tanggal, &nbsp;. . . . . . . . . . . . .</div>
          </div>
          <div class="border-box">
            <div style="padding: 10px;">6. TANGGAPAN PEJABAT PENILAI ATAS KEBERATAN</div>
            <div class="tgl-box">Tanggal, &nbsp;. . . . . . . . . . . . .</div>
          </div>
          <div class="border-box">
            <div style="padding: 10px;">7. KEPUTUSAN ATASAN PEJABAT PENILAI ATAS KEBERATAN</div>
            <div class="tgl-box">Tanggal, &nbsp;. . . . . . . . . . . . .</div>
          </div>
          <div class="border-box">
            <div style="padding: 10px;">8. LAIN - LAIN</div>
            <div class="tgl-box">Tanggal, &nbsp;. . . . . . . . . . . . .</div>
          </div>
        </div>
      </page>

      <page size="F4">
        <div class="content">
          <table style="border: 2px solid #000" width="100%">
            <tr>
              <td rowspan="2">10. DITERIMA TANGGAL, . . . . . . . . . . . . . . . . .<br>
                <div align="center">
                  PEGAWAI NEGERI SIPIL YANG <br>DINILAI <br><br><br><br><br><br>
                  <u><strong><?=$find_data['nama'];?></strong></u> <br>
                  <?=$find_data['nip'];?> <br><br>
                </div>
              </td>
              <td width="50%">9. DIBUAT TANGGAL, . . . . . . . . . . . . . . . . . . . .<br>
                <div align="center">
                  PEJABAT PENILAI <br><br><br><br><br><br>
                  <u><strong><?=show_row('pegawai',array('id'=>$dp3['pejabat']),'nama');?></strong></u> <br>
                  <?=show_row('pegawai',array('id'=>$dp3['pejabat']),'nip');?> <br><br>
                </div>
              </td>
            </tr>
            <tr>
              <td>11. DITERIMA TANGGAL, . . . . . . . . . . . . . . . . .<br>
                <div align="center">
                  ATASAN PEJABAT PENILAI <br><br><br><br><br><br>
                  <u><strong><?=show_row('pegawai',array('id'=>$dp3['atasan_pejabat']),'nama');?></strong></u> <br>
                  <?=show_row('pegawai',array('id'=>$dp3['atasan_pejabat']),'nip');?> <br><br>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </page>
    </body>
</html>