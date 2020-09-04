<?php 
class Uploadfile extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('upload_model');
    } 
 
    function upload_image($files,$type){
        $checkFile = $this->global->count_data('upload', 'type='.$type.' AND id_user='.$this->session->userdata('id'));

        if ($checkFile > 3) {
            $status = 'error';
            return $this->output->set_output(json_encode(array('status'=>$status)));
        }
                
        $config['upload_path'] = './public/file/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = FALSE;
        $config['overwrite']= TRUE;
 
        $this->upload->initialize($config);
        if(!empty($files['name'])){
            $jumlah_berkas = count($files['name']);

            for($i = 0; $i < $jumlah_berkas;$i++) {
                if ($this->upload->do_upload('file[]')){
                    
                    $filename = $this->fungsi->generateString().'-'.$files['name'][$i];
                    //Compress Image
                    $config['image_library']='gd2';
                    $config['source_image']='./public/file/'.$filename;
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= TRUE;
                    $config['quality']= '90%';
                    $config['width']= 800;
                    $config['new_image']= './public/file/'.$filename;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $data['file_name']= $filename;
                    $data['file_lokasi']='./public/file/'.$filename;
                    $data['type']= $type;
                    $data['id_user']= $this->session->userdata('id');
                    
                    $checkFile = $this->global->count_data('upload', 'type='.$type.' AND id_user='.$this->session->userdata('id'));

                    if ($checkFile > 3) {
                        $status = 'error';
                        return $this->output->set_output(json_encode(array('status'=>$status)));
                    } else {
                        $this->upload_model->save($data);
                    }
                    return TRUE;
                } 
            }
        }else{
            return FALSE;
        }
                 
    }
 
} 