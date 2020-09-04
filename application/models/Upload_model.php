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
     
}