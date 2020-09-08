<?php 
class Skpd_model extends CI_Model{

	public function hapus($id) {
		if ($id != null) {
            $this->db->where('id',$id);
            $this->db->delete('unit_kerja');
            return 1;
		} else {
            return 0;
        }
    }

    public function getAll() {
        $this->db->order_by('nama', 'ASC');
		return $this->db->get('unit_kerja')->result();
    }
}