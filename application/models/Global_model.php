<?php 
class Global_model extends CI_Model{

	public function find_data($table, $where = null, $order_by = '', $order_type = '') {
		if ($where != null) {
			$this->db->where($where);
		}
		if ($order_by != '') {
			if ($order_type != '') {
				$this->db->order_by($order_by, $order_type);
			} else {
				$this->db->order_by($order_by, 'ASC');
			}
		}
		return $this->db->get($table);
	}

	public function save_data($table, $data){
		$save = $this->db->insert($table,$data);
		if($save)
			return TRUE;
		else
			return FALSE;
	}

	public function edit_data($table, $data, $id){
		$save = $this->db->update($table,$data,$id);
		if($save)
			return TRUE;
		else
			return FALSE;
	}

	public function save_getLastID($table, $data){
		$this->db->trans_start();
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

	public function count_data($table, $where=null){
		$this->db->select('*');
		if ($where != null) {
			$this->db->where($where);
		}
		return $this->db->get($table)->num_rows();
	}

	function generate_menu($parent=0,$hasil,$class='sidebar-menu'){
		$parent = $this->db
			->select('a.fid_menu, b.parent, b.url, b.nama, b.icon')
			->where('a.fid_user_level', $this->session->userdata('user_level'))
			->where('b.parent', $parent)
			->where('b.active', 1)
			->order_by('order', 'ASC')
			->join('menu b', 'a.fid_menu=b.id')
			->get('user_role a');
		if(($parent->num_rows())>0){
			$hasil .= "<ul class='".$class."'>";
		}
		foreach($parent->result() as $h){
			$w_sub = $this->db
				->select('a.fid_menu, b.parent, b.url, b.nama, b.icon')
				->where('a.fid_user_level', $this->session->userdata('user_level'))
				->where('b.parent', $h->fid_menu)
				->where('b.active', 1)
				->order_by('order', 'ASC')
				->join('menu b', 'a.fid_menu=b.id')
				->get('user_role a');
			if(($w_sub->num_rows())>0){
				$hasil .= "<li id='djmainmenu".$h->fid_menu."' class=\"submenu\">
						<a href=\"javascript:void(0);\">
                            <span class=\"icon\"><i class='".$h->icon."'></i></span>
                            <span class=\"text\">".$h->nama."</span>
                            <span class=\"arrow\"></span>
                        </a>";
			} else{
				if($h->parent==0){
					$hasil .= "<li id='djmenu".$h->fid_menu."'><a href=".base_url().$h->url.">
		                            <span class=\"icon\"><i class='".$h->icon."'></i></span>
		                            <span class=\"text\">".$h->nama."</span>
		                        </a>";
				} else{
					$hasil .= "<li id='djmenu".$h->fid_menu."'><a href=".base_url().$h->url.">".$h->nama."</a>";
				}
			}
			$hasil = $this->generate_menu($h->fid_menu,$hasil,$class='');
			$hasil .= "</li>";
		}
		if(($parent->num_rows)>0)
		{
			$hasil .= "</ul>";
		}
		return $hasil;
	}
}
