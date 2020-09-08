<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('buat_direktori')) {
   function buat_direktori($dir) {
      if (!is_dir($dir)) {
         if (!mkdir($dir, 0777, true)) {
            die('Failed to create directory : ' . $dir);
         }
      }
   }
}

if (!function_exists('string_nilai')) {
   function string_nilai($nilai) {
      if($nilai == 0.00){
         $str = '';
      }elseif($nilai >= 90.00){
         $str = 'Sangat Baik';
      } elseif($nilai >= 80.00){
         $str = 'Baik';
      } elseif($nilai >= 70.00){
         $str = 'Cukup';
      } elseif($nilai >= 60.00){
         $str = 'Kurang';
      } else {
         $str = 'Buruk';
      }
      return $str;
   }
}

if (!function_exists('show_row')) {
   function show_row($table, $where=null, $field) {
      $ci = & get_instance();
      $ci->db->select($field);
      $ci->db->limit(1);
      if($where !=null){
         $ci->db->where($where);
      }
      $getData = $ci->db->get($table);
      
      $checkRow = $getData->num_rows();
      if ($checkRow == 0) {
         return 0;
      } else {
         $sql = $getData->row_array();
         return $sql[$field];
      }
   }
}

if (!function_exists('jenis_tugas')) {
   function jenis_tugas($key = '') {
      $arr = [
         ''=>'-- Pilih --',
         '1'=>'Tugas Pokok Jabatan',
         '2'=>'Tugas Tambahan dan Kreativitas'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('kategori_diklat')) {
   function kategori_diklat($key = '') {
      $arr = [
         ''=>'-- Pilih --',
         '1'=>'Pendidikan dan Pelatihan Kepemimpinan',
         '2'=>'Pendidikan dan Pelatihan Fungsional',
         '3'=>'Pendidikan dan Pelatihan Teknis'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('jenis_pegawai')) {
   function jenis_pegawai($key = '') {
      $arr = [
         '1'=>'Pegawai Negeri Sipil Daerah (PNSD)',
         '2'=>'Calon Pegawai Negeri Sipil Daerah (CPNSD)'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('aktif')) {
   function aktif($str = '') {
      $arr = [
         ''=>'-- Pilih --',
         'Ya'=>'Ya',
         'Tidak'=>'Tidak'
      ];
      return $str == '' ? $arr : $arr[$str];
   }
}

if (!function_exists('type_jabatan')) {
   function type_jabatan($str = '') {
      $arr = [
         ''=>'-- Pilih --',
         'Staf'=>'Staf',
         'Pejabat'=>'Pejabat'
      ];
      return $str == '' ? $arr : $arr[$str];
   }
}

if (!function_exists('status_keluarga')) {
   function status_keluarga($str = '') {
      $arr = [
         ''=>'-- Pilih --',
         'Istri'=>'Istri',
         'Suami'=>'Suami',
         'Anak'=>'Anak'
      ];
      return $str == '' ? $arr : $arr[$str];
   }
}


if (!function_exists('select_dinamis')) {
   function select_dinamis($name, $table, $field, $pk, $where=null, $selected=null, $extra=null) {
      $ci = & get_instance();
      if($where != null) {
         $ci->db->where($where);
      }
      $data = $ci->db->get($table)->result();
      $select = "<select name='$name' class='form-control input-sm' $extra>";
      if(!empty($data)){
         foreach ($data as $row) {
            $select .="<option value='" . $row->$pk . "'";
            $select .= $selected == $row->$pk ? 'selected' : '';
            $select .=">" . $row->$field . "</option>";
         }
      }
      $select .= "</select>";
      return $select;
   }
}

if (!function_exists('select_dinamis_choosen')) {
   function select_dinamis_choosen($name, $table, $field, $pk, $where=null, $selected=null, $extra=null) {
      $ci = & get_instance();
      if($where != null) {
         $ci->db->where($where);
      }
      $data = $ci->db->get($table)->result();
      $select = "<select data-placeholder='Choose' name='$name' class='form-control chosen-select mb-15' tabindex='2' $extra>";
      $select .="<option value=''>-- Pilih --</option>";
      if(!empty($data)){
         foreach ($data as $row) {
            $select .="<option value='" . $row->$pk . "'";
            $select .= $selected == $row->$pk ? 'selected' : '';
            $select .=">" . $row->$field . "</option>";
         }
      }
      $select .= "</select>";
      return $select;
   }
}

if (!function_exists('select_filter')) {
   function select_filter($name, $table, $field, $pk, $where=null, $selected=null, $extra=null) {
      $ci = & get_instance();
      if($where != null) {
         $ci->db->where($where);
      }
      $data = $ci->db->get($table)->result();
      $select = "<select name='$name' class='form-control input-sm' $extra>";
      $select .= "<option value='all'>All</option>";
      if(!empty($data)){
         foreach ($data as $row) {
            $select .="<option value='" . $row->$pk . "'";
            $select .= $selected == $row->$pk ? 'selected' : '';
            $select .=">" . $row->$field . "</option>";
         }
      }
      $select .= "</select>";
      return $select;
   }
}

if (!function_exists('agama')) {
   function agama($str = '') {
      $arr = [
         'Islam' => 'Islam',
         'Kristen' => 'Kristen',
         'Katholik' => 'Katholik',
         'Hindu' => 'Hindu',
         'Budha' => 'Budha',
      ];
      return $str == '' ? $arr : $arr[$str];
   }
}

if (!function_exists('status_anak')) {
   function status_anak($str = '') {
      $arr = [
         'Anak Kandung' => 'Anak Kandung',
         'Anak Angkat' => 'Anak Angkat'
      ];
      return $str == '' ? $arr : $arr[$str];
   }
}

if (!function_exists('pangkat_golongan')) {
   function pangkat_golongan($key = '') {
      $arr = [
         '0' => 'Default',
         '1' => 'Juru Muda (I/a)',
         '2' => 'Juru Muda Tk.I (I/b)',
         '3' => 'Juru (I/c)',
         '4' => 'Juru Tk.I (I/d)',
         '5' => 'Pengatur Muda (II/a)',
         '6' => 'Pengatur Muda Tk.I (II/b)',
         '7' => 'Pengatur (II/c)',
         '8' => 'Pengatur Tk.I (II/d)',
         '9' => 'Penata Muda (III/a)',
         '10' => 'Penata Muda Tk. I (III/b)',
         '11' => 'Penata (III/c)',
         '12' => 'Penata Tk. I (III/d)',
         '13' => 'Pembina (IV/a)',
         '14' => 'Pembina Tk.I (IV/b)',
         '15' => 'Pembina Utama Muda (IV/c)',
         '16' => 'Pembina Utama Madya (IV/d)',
         '17' => 'Pembina Utama (IV/e)',
         '18' => 'TENAGA SUKARELA',
         '19' => 'TENAGA KONTRAK'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (! function_exists('pendidikan')) {
   function pendidikan($str = '') {
      $arr = [
         '1' => 'SD / sederajat', //1
         '2' => 'SMP / sederajat', //2
         '3' => 'SMA / sederajat', //3
         '4' => 'Paket A', 
         '5' => 'Paket B',
         '6' => 'Paket C',
         '7' => 'D1',
         '8' => 'D2',
         '9' => 'D3', //4
         '10' => 'D4',
         '11' => 'Profesi',
         '12' => 'S1', //5
         '13' => 'Sp-1',
         '14' => 'S2', //6
         '15' => 'Sp-2',
         '16' => 'S3' //15
      ];
      return $str == '' ? $arr : $arr[$str];
   }
}

if (! function_exists('pekerjaan')) {
   function pekerjaan($key = '') {
      $arr = [
         '0' => 'Tidak Bekerja',
         '1' => 'Arsitek',
         '2' => 'Apoteker',
         '3' => 'Akuntan',
         '4' => 'Aktor',
         '5' => 'Atlet',
         '6' => 'Bidan',
         '7' => 'Dokter',
         '8' => 'Dosen',
         '9' => 'Direktur',
         '10' => 'Desainer',
         '11' => 'Guru',
         '12' => 'Hakim',
         '13' => 'Jaksa',
         '14' => 'Kasir',
         '15' => 'Kondektur',
         '16' => 'Koki',
         '17' => 'Karyawan',
         '18' => 'Masinis',
         '19' => 'Model',
         '20' => 'Nelayan',
         '21' => 'Novelis',
         '22' => 'Nakhoda',
         '23' => 'Penyanyi',
         '24' => 'Pengacara',
         '25' => 'Programmer',
         '26' => 'Polisi',
         '27' => 'Pramugari',
         '28' => 'Perawat',
         '29' => 'Penerjemah',
         '30' => 'Pilot',
         '31' => 'Pramusaji',
         '32' => 'Presiden',
         '33' => 'Penari',
         '34' => 'Pemadam Kebakaran',
         '35' => 'Pelayan',
         '36' => 'Petani/Pekebun',
         '37' => 'Resepsionis',
         '38' => 'Satpam',
         '39' => 'Seniman',
         '40' => 'Sopir',
         '41' => 'Sekretaris',
         '42' => 'Tentara',
         '43' => 'Video-editor',
         '44' => 'Wartawan'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('status_kepegawaian')) {
   function status_kepegawaian($key = '') {
      $arr = [
         '1' => 'PNS', 
         '2' => 'PNS Diperbantukan', 
         '3' => 'PNS DEPAG', 
         '4' => 'GTY/PTY', 
         '5' => 'GTT/PTT Provinsi', 
         '6' => 'GTT/PTT Kabupaten/Kota',
         '7' => 'Guru Bantu Pusat',
         '8' => 'Guru Honor Sekolah', 
         '9' => 'Tenaga Honor Sekolah', 
         '10' => 'CPNS', 
         '11' => 'Lainnya',
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('jenis_ptk')) {
   function jenis_ptk($key = '') {
      $arr = [
         '1' => 'Guru Kelas',
         '2' => 'Guru Mata Pelajaran',
         '3' => 'Guru BK',
         '4' => 'Guru Inklusi',
         '5' => 'Tenaga Administrasi Sekolah',
         '6' => 'Gurtu Pendamping',
         '7' => 'Guru Magang',
         '8' => 'Guru TIK',
         '9' => 'Laboran',
         '10' => 'Pustakawan',
         '11' => 'Lainnya'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('bulan')) {
   function bulan($key = '') {
      $arr = [
         '1' => 'Januari',
         '2' => 'Februari',
         '3' => 'Maret',
         '4' => 'April',
         '5' => 'Mei',
         '6' => 'Juni',
         '7' => 'Juli',
         '8' => 'Agustus',
         '9' => 'September',
         '10' => 'Oktober',
         '11' => 'November',
         '12' => 'Desember'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('tgl_indo')) {
   function tgl_indo($tanggal) {
      //format default $tanggal = 1989-04-15
      $pisah = explode('-', $tanggal);
      return (int)$pisah[2]." ".bulan((int)$pisah[1])." ".$pisah[0];
   }
}

if (!function_exists('ekin_jenkeg')) {
   function ekin_jenkeg($key = '') {
      $arr = [
         'Tupoksi' => 'Tupoksi',
         'Non-Tupoksi' => 'Non-Tupoksi'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('ekin_periode_waktu')) {
   function ekin_periode_waktu($key = '') {
      $arr = [
         'Hari' => 'Hari',
         'Minggu' => 'Minggu',
         'Bulan' => 'Bulan'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('ekin_status')) {
   function ekin_status($key = '') {
      $arr = [
         'Draft' => 'Draft',
         'Diajukan' => 'Diajukan',
         'Verifikasi' => 'Verifikasi',
         'Diterima' => 'Diterima'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('ekin_tambkrea')) {
   function ekin_tambkrea($key = '') {
      $arr = [
         'Tugas Tambahan' => 'Tugas Tambahan',
         'Kreatifitas' => 'Kreatifitas'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}

if (!function_exists('nilai_kreatifitas')) {
   function nilai_kreatifitas($key = '') {
      $arr = [
         '0' => 'Pilih Nilai',
         '3' => '3',
         '6' => '6',
         '12' => '12'
      ];
      return $key == '' ? $arr : $arr[$key];
   }
}
