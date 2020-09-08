<?php
class Upload_model extends CI_Model{
 
    function save($data){
        if ($data['file_name'] != NULL && $data['id_user'] != NULL && $data['file_lokasi'] != NULL && $data['type'] != NULL) {
            $save = $this->db->insert('upload',$data);
            if($save)
                return TRUE;
            else
                return FALSE;
        } else {
            return FALSE;
        }
    }

    public function hapus($id,$lokasi) {
		if ($id != null) {
            if (file_exists($lokasi)) {
                unlink($lokasi);
            }
            $this->db->where('id_upload',$id);
            $this->db->delete('upload');
            return 1;
		} else {
            return 0;
        }
    }
     
}