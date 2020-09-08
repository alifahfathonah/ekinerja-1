<page backtop="10mm" backbottom="20mm" backleft="10mm" backright="10mm">
    <style>
        .header {border-bottom:solid 3px #EF4135; height:85px; width:90%; margin:auto; margin-bottom:5px;}
        .header img {float:right; margin-right:10px;}
        .header h3{font-family:Times, serif;font-size:16px; line-height:30px; text-align:center; margin-top:0px; font-weight:bold; text-transform:uppercase;}
        .header p {text-align:center; font-weight:bold; margin:auto;padding:1px!important;}
        .header span {padding-top:10px;}
        .table {border: solid 0.5px #000000; margin-right:10px;}
        .table th {font-size:10px; border:0.5px #000000; background:#ADADAD; padding:10px;text-align:center;vertical-align: middle;text-transform:uppercase}
        .table td {border:solid 0.5px #000000; padding:2px;word-wrap:break-word; font-family:Arial, Helvetica, sans-serif;font-size:11px;}
        #p {height:85px; width:90%; margin-left: 40px; margin-bottom:5px;}
        ul.a {list-style-type: lower-alpha;}
        .footer {width:90%; position: absolute; bottom: 25px; border-top:solid 1px #000000; margin-left: 40px;text-align:right; font-size: 12px;}
        .ttd {width: 90%; margin-top: 10px;}
        .text-right {
            text-align: right !important;
        }
    </style>
    <page_header></page_header>
    <page_footer>
        <i style="text-align: left; font-size: 10px;margin-bottom:20px">Sumber: SIMPEG</i>
        <div class="footer">
            <?php date_default_timezone_set("Asia/Makassar"); echo date('d/m/Y - H:i:s'); ?> / Hal.[[page_cu]] ke [[page_nb]]
        </div>
    </page_footer>
    <div id="p">
        <div class="header">
            <?php
                if(file_exists('./upload/images/profil/'.$user_active['foto']) && $user_active['foto'] != NULL){
            ?>
                    <img src="upload/images/profil/<?=$user_active['foto'];?>" style="height: 80px" alt="foto">
            <?php
                } else{
            ?>
                    <img src="themes/default/assets/img/no-image.jpg" style="height: 80px" alt="foto">
            <?php
                }
            ?>
            <span>
                <h3>
                    BIODATA LENGKAP<br>
                    PEGAWAI NEGERI SIPIL (PNS)<br>
                    TAHUN <?= date('Y');?>
                </h3>
            </span>
        </div>
        <br>
        <br>
        <p>
            <b>A. Identitas Pegawai</b>
            <table style="margin-left: 15px;" scellpadding="2" cellspacing="2" width="100%">
                <small>
                    <tr>
                        <td width="30%" align="right">NIP :</td>
                        <td width="70%"><?=$find_data['nip'];?></td>
                    </tr>
                    <tr>
                        <td align="right">Nama Panggilan :</td>
                        <td><?=$find_data['nama_panggilan'];?></td>
                    </tr>
                    <tr>
                        <td align="right">Nama Lengkap :</td>
                        <td><?=$find_data['nama'];?></td>
                    </tr>
                    <tr>
                        <td align="right">TTL :</td>
                        <td><?=$find_data['tmp_lahir'].', '.$find_data['tgl_lahir'];?></td>
                    </tr>
                    <tr>
                        <td align="right">Agama :</td>
                        <td><?php echo agama($find_data['agama']);?></td>
                    </tr>
                    <tr>
                        <td align="right">Jenis Pegawai :</td>
                        <td><?php echo jenis_pegawai($find_data['jenis_pegawai']);?></td>
                    </tr>
                    <tr>
                        <td align="right">Gender :</td>
                        <td><?=$find_data['gender'];?></td>
                    </tr>
                    <tr>
                        <td align="right">Alamat :</td>
                        <td><?=$find_data['alamat'];?></td>
                    </tr>
                    <tr>
                        <td align="right">Pangkat & Golongan :</td>
                        <td><?=pangkat_golongan($find_data['pangkat_golongan']);?></td>
                    </tr>
                    <tr>
                        <td align="right">Jabatan :</td>
                        <td><?=show_row('jabatan',array('id'=>$find_data['fid_jabatan']),'nama');?></td>
                    </tr>
                    <tr>
                        <td align="right">Instansi Kerja :</td>
                        <td><?=$find_data['instansi_kerja'];?></td>
                    </tr>
                    <tr>
                        <td align="right">Unit Kerja :</td>
                        <td><?=show_row('unit_kerja',array('id'=>$find_data['unit_kerja']),'nama');?></td>
                    </tr>
                    <tr>
                        <td align="right">No. HP :</td>
                        <td><?=$find_data['no_hp'];?></td>
                    </tr>

                    <tr>
                        <td align="right">No. NPWP :</td>
                        <td><?=$find_data['npwp'];?></td>
                    </tr>
                </small>
            </table>
        </p> <br>

        <p>
            <b>B. Riwayat Kepangkatan</b>
            <br><br>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 5px">No</th>
                        <th rowspan="2" style="width: 90px">Pangkat / Golongan Ruang</th>
                        <th rowspan="2" class="center">TMT</th>
                        <th colspan="2">Surat Keputusan</th>
                        <th rowspan="2" class="center">Pejabat yang menetapkan</th>
                    </tr>
                    <tr>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $query = $this->db
                        ->select('a.*, b.nama AS pejabat')
                        ->where('a.fid_user', $fid_user)
                        ->join('pegawai b', 'a.pejabat_sah=b.id')
                        ->get('riwayat_pangkat a')->result_array();
                    //$query = $this->global->find_data('riwayat_pangkat', array('fid_user'=>$fid_user))->result_array();
                    foreach ($query as $value) {
                        echo '<tr>
                            <td align="center">'.$no++.'</td>
                            <td>'.pangkat_golongan($value['pangkat_golongan']).'</td>
                            <td>'.$value['tmt'].'</td>
                            <td align="center">'.$value['no_sk'].'</td>
                            <td align="center">'.$value['tgl_sk'].'</td>
                            <td>'.$value['pejabat'].'</td>
                        </tr>';
                    }
                ?>
                </tbody>
            </table>
        </p> <br>

        <p>
            <b>C. Riwayat Jabatan</b>
            <br><br>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Jabatan</th>
                        <th rowspan="2">Eselon</th>
                        <th rowspan="2">TMT Jabatan</th>
                        <th colspan="2">Surat Keputusan</th>
                        <th rowspan="2">Pejabat yang menetapkan</th>
                    </tr>
                    <tr>
                        <th class="center">Nomor</th>
                        <th class="center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $query = $this->db
                        ->select('a.*, b.nama AS pejabat')
                        ->where('a.fid_user', $fid_user)
                        ->join('pegawai b', 'a.pejabat_sah=b.id')
                        ->get('riwayat_jabatan a')->result_array();
                    //$query = $this->global->find_data('riwayat_jabatan', array('fid_user'=>$fid_user))->result_array();
                    foreach ($query as $value) {
                        echo '<tr>
                            <td align="center">'.$no++.'</td>
                            <td>'.$value['jabatan'].'</td>
                            <td>'.$value['eselon'].'</td>
                            <td align="center">'.$value['tmt'].'</td>
                            <td align="center">'.$value['no_sk'].'</td>
                            <td align="center">'.$value['tgl_sk'].'</td>
                            <td>'.$value['pejabat'].'</td>
                        </tr>';
                    }
                ?>
                </tbody>
            </table>
        </p> <br>

        <p><b>D. Riwayat Pendidikan</b></p>
        <p style="margin-left: 15px">1. Pendidikan Umum</p>
        <p>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th style="width: 50px" rowspan="2">Jenjang Pendidikan</th>
                        <th style="width: 100px" rowspan="2">Nama Instansi</th>
                        <th style="width: 100px" rowspan="2">Kepala Instansi</th>
                        <th colspan="2">STTB/IJAZAH</th>
                    </tr>
                    <tr>
                        <th class="center">Nomor</th>
                        <th class="center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $query = $this->global->find_data('riwayat_pendidikan', array('fid_user'=>$fid_user))->result_array();
                    foreach ($query as $value) {
                        echo '<tr>
                            <td align="center">'.$no++.'</td>
                            <td>'.pendidikan($value['pendidikan']).'</td>
                            <td>'.$value['nama_instansi'].'</td>
                            <td>'.$value['pimpinan_instansi'].'</td>
                            <td align="center">'.$value['no_ijazah'].'</td>
                            <td align="center">'.$value['tgl_ijazah'].'</td>
                        </tr>';
                    }
                ?>
                </tbody>
            </table> <br><br><br>
        </p>
        <p style="margin-left: 15px">2. Pendidikan dan Pelatihan</p>
        <span style="margin-left: 25px">1.) Pendidikan dan Pelatihan Kepemimpinan</span>
        <p style="margin-left: 25px">
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Nama DIKLAT</th>
                        <th rowspan="2">Penyelenggara Pendidikan</th>
                        <th style="width: 40px" rowspan="2">Angkatan / Tahun</th>
                        <th style="width: 50px" rowspan="2">Lama Pendidikan</th>
                        <th colspan="2">STPP</th>
                    </tr>
                    <tr>
                        <th style="width: 50px">Nomor</th>
                        <th style="width: 50px">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $query = $this->global->find_data('riwayat_pelatihan', array('fid_user'=>$fid_user, 'kategori_diklat'=>1))->result_array();
                    foreach ($query as $value) {
                        echo '<tr>
                            <td align="center">'.$no++.'</td>
                            <td>'.$value['nama_diklat'].'</td>
                            <td>'.$value['penyelenggara'].'</td>
                            <td>'.$value['tahun'].'</td>
                            <td>'.$value['lama'].'</td>
                            <td align="center">'.$value['no_sttp'].'</td>
                            <td align="center">'.$value['tgl_sttp'].'</td>
                        </tr>';
                    }
                ?>
                </tbody>
            </table><br><br>
        </p>
        <p style="margin-left: 25px">2.) Pendidikan dan Pelatihan Fungsional</p>
        <p style="margin-left: 25px">
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Nama DIKLAT</th>
                        <th rowspan="2">Penyelenggara Pendidikan</th>
                        <th style="width: 40px" rowspan="2">Angkatan / Tahun</th>
                        <th style="width: 50px" rowspan="2">Lama Pendidikan</th>
                        <th colspan="2">STPP</th>
                    </tr>
                    <tr>
                        <th style="width: 50px">Nomor</th>
                        <th style="width: 50px">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $query = $this->global->find_data('riwayat_pelatihan', array('fid_user'=>$fid_user, 'kategori_diklat'=>2))->result_array();
                    foreach ($query as $value) {
                        echo '<tr>
                            <td align="center">'.$no++.'</td>
                            <td>'.$value['nama_diklat'].'</td>
                            <td>'.$value['penyelenggara'].'</td>
                            <td>'.$value['tahun'].'</td>
                            <td>'.$value['lama'].'</td>
                            <td align="center">'.$value['no_sttp'].'</td>
                            <td align="center">'.$value['tgl_sttp'].'</td>
                        </tr>';
                    }
                ?>
                </tbody>
            </table>
        </p> <br><br>
        <p style="margin-left: 25px">3.) Pendidikan dan Pelatihan Teknis</p>
        <p style="margin-left: 25px">
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Nama DIKLAT</th>
                        <th rowspan="2">Penyelenggara Pendidikan</th>
                        <th style="width: 40px" rowspan="2">Angkatan / Tahun</th>
                        <th style="width: 50px" rowspan="2">Lama Pendidikan</th>
                        <th colspan="2">STPP</th>
                    </tr>
                    <tr>
                        <th style="width: 50px">Nomor</th>
                        <th style="width: 50px">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $query = $this->global->find_data('riwayat_pelatihan', array('fid_user'=>$fid_user, 'kategori_diklat'=>3))->result_array();
                    foreach ($query as $value) {
                        echo '<tr>
                            <td align="center">'.$no++.'</td>
                            <td>'.$value['nama_diklat'].'</td>
                            <td>'.$value['penyelenggara'].'</td>
                            <td>'.$value['tahun'].'</td>
                            <td>'.$value['lama'].'</td>
                            <td align="center">'.$value['no_sttp'].'</td>
                            <td align="center">'.$value['tgl_sttp'].'</td>
                        </tr>';
                    }
                ?>
                </tbody>
            </table> <br>
        </p>

        <p>
            <b>E. Daftar Urut Kepangkatan</b>
            <br><br>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tahun</th>
                        <th>Urutan/Peringkat dalam DUK</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $pegawai = $this->global->find_data('pegawai', array('fid_user'=>$fid_user))->row_array();
                $query = $this->db
                    ->select('a.*, b.jabatan')
                    ->where('a.fid_pegawai', $pegawai['id'])
                    ->join('riwayat_jabatan b', 'a.fid_jabatan_akhir=b.id', 'LEFT')
                    ->get('duk a')->result_array();
                foreach ($query as $value) {
                    echo '<tr>
                        <td align="center">'.$no++.'</td>
                        <td align="center">'.$value['tahun_duk'].'</td>
                        <td align="center">'.$value['urutan_duk'].'</td>
                    </tr>';
                }
                ?>
                </tbody>
            </table> <br>
        </p>

        <p>
            <b>F. Daftar Penilaian Pelaksanaan Pekerjaan (DP-3)</b>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tahun</th>
                        <th>Pejabat Penilai</th>
                        <th>Atasan Pejabat Penilai</th>
                        <th>Nilai Rata-Rata</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $pegawai = $this->global->find_data('pegawai', array('fid_user'=>$fid_user))->row_array();
                $query = $this->db
                    ->select('a.*, b.nama AS pejabats, c.nama AS atasan_pejabats')
                    ->where('a.fid_pegawai', $pegawai['id'])
                    ->join('pegawai b', 'a.pejabat=b.id', 'LEFT')
                    ->join('pegawai c', 'a.atasan_pejabat=c.id', 'LEFT')
                    ->get('dp3 a')->result_array();
                foreach ($query as $value) {
                    echo '<tr>
                        <td align="center">'.$no++.'</td>
                        <td align="center">'.$value['tahun'].'</td>
                        <td>'.$value['pejabats'].'</td>
                        <td>'.$value['atasan_pejabats'].'</td>
                        <td align="center">'.$value['nilai_avg'].'</td>
                    </tr>';
                }
                ?>
                </tbody>
            </table> <br>
        </p>

        <p>
            <b>G. Disiplin</b> <br><br>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tahun</th>
                        <th>Tingkat Hukum Disiplin</th>
                        <th>Jenis Hukuman Disiplin</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = $this->global->find_data('disiplin', array('fid_user'=>$fid_user))->result_array();
                foreach ($query as $value) {
                    echo '<tr>
                        <td align="center">'.$no++.'</td>
                        <td align="center">'.$value['tahun'].'</td>
                        <td>'.$value['tingkat'].'</td>
                        <td>'.$value['jenis'].'</td>
                    </tr>';
                }
                ?>
                </tbody>
            </table> <br>
        </p>

        <p>
            <b>H. Penghargaan</b> <br><br>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Penghargaan</th>
                        <th>Tingkat</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = $this->global->find_data('penghargaan', array('fid_user'=>$fid_user))->result_array();
                foreach ($query as $value) {
                    echo '<tr>
                        <td align="center">'.$no++.'</td>
                        <td>'.$value['nama'].'</td>
                        <td>'.$value['tingkat'].'</td>
                        <td align="center">'.$value['tahun'].'</td>
                    </tr>';
                }
                ?>
                </tbody>
            </table> <br>
        </p>

        <p>
            <b>I. Riwayat Kesehatan</b> <br><br>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tahun</th>
                        <th>Penyakit Yang Pernah Diderita</th>
                        <th>Dokter Yang Menangani</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = $this->global->find_data('riwayat_kesehatan', array('fid_user'=>$fid_user))->result_array();
                foreach ($query as $value) {
                    echo '<tr>
                        <td align="center">'.$no++.'</td>
                        <td align="center">'.$value['tahun'].'</td>
                        <td>'.$value['penyakit'].'</td>
                        <td>'.$value['dokter'].'</td>
                    </tr>';
                }
                ?>
                </tbody>
            </table> <br>
        </p>

        <p>
            <b>J. Bahasa Asing Yang Dikuasai</b> <br><br>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th style="width: 95px">Bahasa</th>
                        <th>Aktif</th>
                        <th>Pasif</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = $this->global->find_data('bahasa_asing', array('fid_user'=>$fid_user))->result_array();
                foreach ($query as $value) {
                    echo '<tr>
                        <td align="center">'.$no++.'</td>
                        <td>'.$value['bahasa'].'</td>
                        <td align="center">'.aktif($value['aktif']).'</td>
                        <td align="center">'.aktif($value['pasif']).'</td>
                    </tr>';
                }
                ?>
                </tbody>
            </table> <br>
        </p>

        <p>
            <b>K. Prestasi Yang Pernah Diraih (Sains/Olahraga/Seni/dll)</b> <br><br>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th style="width: 95px">Bidang</th>
                        <th>Kejuaraan Tingkat</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = $this->global->find_data('prestasi', array('fid_user'=>$fid_user))->result_array();
                foreach ($query as $value) {
                    echo '<tr>
                        <td align="center">'.$no++.'</td>
                        <td>'.$value['bidang'].'</td>
                        <td>'.$value['tingkat'].'</td>
                        <td align="center">'.$value['tahun'].'</td>
                    </tr>';
                }
                ?>
                </tbody>
            </table> <br>
        </p>

        <p>
            <b>L. Susunan Keluarga</b> <br><br>
            <table width="271" cellpadding="0" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th style="width: 95px">Nama</th>
                        <th align="center">Tanggal Lahir</th>
                        <th align="center">No. Surat Nikah</th>
                        <th align="center">No. Akte Kelahiran</th>
                        <th align="center">Status Keluarga</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = $this->global->find_data('keluarga', array('fid_user'=>$fid_user))->result_array();
                foreach ($query as $value) {
                    echo '<tr>
                        <td align="center">'.$no++.'</td>
                        <td>'.$value['nama'].'</td>
                        <td align="center">'.$value['tgl_lahir'].'</td>
                        <td align="center">'.$value['surat_nikah'].'</td>
                        <td align="center">'.$value['akte_lahir'].'</td>
                        <td align="center">'.$value['status'].'</td>
                    </tr>';
                }
                ?>
                </tbody>
            </table> <br><br><br>
        </p>

        <p style="margin-left: 5px">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width: 200px; text-align:center">Mengetahui, <br> 
                        <?php
                            $jabatan = $this->global->find_data('jabatan', array('id'=>$find_data['fid_jabatan']));
                            if($jabatan->num_rows() > 0){
                                $jabatan_row = $jabatan->row_array();
                                if($jabatan_row['parent'] == 0){
                                    echo $jabatan_row['nama'];
                                    echo '<br><br><br><br><br><br>WALIKOTA';
                                } else{
                                    $jabatan2 = $this->global->find_data('jabatan', array('id'=>$jabatan_row['parent']))->row_array();
                                    echo $jabatan2['nama'];
                                    $pegawai_penilai = $this->global->find_data('pegawai', array('fid_jabatan'=>$jabatan2['id']))->row_array();
                                    echo '<br><br><br><br><br><br>'.$pegawai_penilai['nama'].'<br>NIP. '.$pegawai_penilai['nip'];
                                }
                            } else{
                                echo 'Anda belum menentukan Jabatan.';
                            }
                        ?>
                    </td>
                    <td style="width: 150px"></td>
                    <td style="width: 300px; text-align: center">Makassar, <?php echo date('d/F/Y'); ?><br>Yang Bersangkutan,
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <b><?=$find_data['nama'];?></b><br>
                        NIP. <?=$find_data['nip'];?>
                    </td>

                </tr>
            </table>
        </p>

    </div>
</page>