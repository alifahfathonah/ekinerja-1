<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends DJ_Admin {
	public function index()
	{	
		$this->data['list_js_plugin'] = array(
				'highcharts/highcharts.js',
				'highcharts/modules/exporting.js'
			);
		$this->layout('default/grafik', $this->data);
	}

	function prosentase_pegawai(){
		$sql = "SELECT CASE 
				WHEN jenis_pegawai = 1 THEN 'Pegawai Negeri Sipil Daerah (PNSD)'
				ELSE 'Calon Pegawai Negeri Sipil Daerah (CPNSD)' 
				END AS jns_pegawai, COUNT(jenis_pegawai) AS jml FROM pegawai GROUP BY jenis_pegawai";
		$query = $this->db->query($sql)->result_array();
		$rows['type'] = 'pie';
        $rows['name'] = 'Pelawat';
        foreach ($query as $value) {
        	$rows['data'][] = array('Jumlah '.$value['jns_pegawai'].'', $value['jml']);
        }
        $result = array();
        array_push($result,$rows);
        print json_encode($result, JSON_NUMERIC_CHECK);
	}

	function duk(){
        $pegawai = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')))->row_array();
		$query = $this->db
			->select('id, tahun_duk, urutan_duk')
			->group_by('tahun_duk')
			->where('fid_pegawai', $pegawai['id'])
			->get('duk')->result_array();

        $bulan = array();
        $bulan['name'] = 'Tahun';
        $rows['name'] = 'Urutan Kepangkatan PerTahun';
        foreach ($query as $value) {
        	$bulan['data'][] = $value['tahun_duk'];
            $rows['data'][] = $value['urutan_duk'];
        }
        $result = array();
        array_push($result, $bulan);
        array_push($result, $rows);
        print json_encode($result, JSON_NUMERIC_CHECK);
	}

	function kgb(){
        $pegawai = $this->global->find_data('pegawai', array('fid_user'=>$this->session->userdata('id')))->row_array();
		$query = $this->db
			->select('id, YEAR(tanggal) AS tahun, gaji_lama, gaji_baru')
			->group_by('YEAR(tanggal)')
			->where('fid_pegawai', $pegawai['id'])
			->get('kgb')->result_array();

        $bulan = array();
        $bulan['name'] = 'Tahun';
        $rows['name'] = 'Gaji Pokok Lama';
        $rows2['name'] = 'Gaji Pokok Baru';
        foreach ($query as $value) {
        	$bulan['data'][] = $value['tahun'];
            $rows['data'][] = $value['gaji_lama'];
            $rows2['data'][] = $value['gaji_baru'];
        }
        $result = array();
        array_push($result, $bulan);
        array_push($result, $rows);
        array_push($result, $rows2);
        print json_encode($result, JSON_NUMERIC_CHECK);
	}
}
