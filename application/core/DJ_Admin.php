<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DJ_Admin extends CI_Controller {

    protected $data = array();
    public $setting = array();

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
        if ($this->auth->is_logged_in() != TRUE) {
            redirect(base_url());
        }
        $this->data['user_active'] = $this->db
            ->select('a.*, b.nama AS akses, c.nama_panggilan, c.nama, c.id AS id_pegawai, c.unit_kerja, c.fid_jabatan')
            ->where('a.id', $this->session->userdata('id'))
            ->join('user_level b', 'a.fid_user_level=b.id')
            ->join('pegawai c', 'a.id=c.fid_user')
            ->get('user a')->row_array();
        $this->data['generate_menu'] = $this->global->generate_menu('0',$h='','sidebar-menu');

        // SET ACTIVE MENU --------
        if($this->uri->segment(2) != ''){
            $url_aktif = $this->uri->segment(1)."/".$this->uri->segment(2);
        } else{
            $url_aktif = $this->uri->segment(1);
        }
        $slqMenu = $this->global->find_data('menu', array('url'=>$url_aktif))->row_array();
        if ($slqMenu != 0) {
            $idParent = $slqMenu['parent'];
            if($idParent == 0){
                $this->data['main_menu_active'] = '';
                $this->data['menu_active'] = $slqMenu['id'];
            } else{
                $this->data['main_menu_active'] = $idParent;
                $this->data['menu_active'] = $slqMenu['id'];
            }
        }
        // END SET ACTIVE MENU --------

        //EKINERJA TUGAS TAMBAHAN DAN KREATIFITAS
        $this->data['hidden_file'] = '';
        $this->data['btn_submit'] = '';
    }

    protected function layout($layout, $array){
        $this->load->view('default/header', $array);
        $this->load->view($layout);
        $this->load->view('default/footer');
    }
}