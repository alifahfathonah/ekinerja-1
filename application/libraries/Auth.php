<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

	/**
	 * The CodeIgniter super object
	 *
	 * @var object
	 * @access public
	 */
	public $CI;

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->CI = &get_instance();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function login($username, $password) {
		$where = "username='$username' AND active='YES' ";
		$result = $this->CI->db->where($where)->limit(1)->get('user');
		if ($result->num_rows() == 0) {
			return FALSE;
		} else {
			$data = $result->row();
			if ($password == $data->password) {
				$session_data = array();
				$session_data['id'] = $data->id;
				$session_data['username'] = $data->username;
				$session_data['email'] = $data->email;
				$session_data['user_level'] = $data->fid_user_level;
				$session_data['is_logged_in'] = true;
				$this->CI->session->set_userdata($session_data);
				$this->last_logged_in();
				return TRUE;
			}
			return FALSE;
		}
	}

	private function last_logged_in() {
		$data = array(
				'last_logged_in' => date('Y-m-d H:i:s'),
				'ip_address' => $_SERVER['REMOTE_ADDR'],
			);
		$this->CI->db
			->where('username', $this->CI->session->userdata('username'))
			->update('user', $data);
	}

	/**
	 * is_logged_in()
	 * Fungsi untuk mengecek apakah data session user id kosong / tidak
	 * @access   public
	 * @return   bool
	 */
	public function is_logged_in() {
		return $this->CI->session->userdata('is_logged_in');
	}

	/**
	 * restrict()
	 * Fungsi untuk memvalidasi status login
	 * @access   public
	 * @return   bool
	 */
	public function restrict() {
		if (!$this->is_logged_in()) {
			redirect(base_url());
		}
	}
	/**
	 * logout()
	 * Fungsi untuk menghapus data session user
	 * @return   void
	 */
	public function logout() {
		$this->CI->session->sess_destroy();
	}
}