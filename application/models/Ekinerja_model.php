<?php 
class Ekinerja_model extends CI_Model{

	public function hapus($id) {
		if ($id != null) {
            $this->db->where('id',$id);
            $this->db->delete('ekin_keg_tahunan');
            return 1;
		} else {
            return 0;
        }
	
		 
    }
}