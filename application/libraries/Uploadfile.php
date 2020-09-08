<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Uploadfile {
    public $CI;

    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->model('upload_model');
    } 
 
    public function upload_image($files,$type,$idform){
        $checkFile = $this->CI->global->count_data('upload',  'type='.$type.' AND id_form='.$idform.' AND id_user='.$this->CI->session->userdata('id'));

        if ($checkFile > 2) {
            $status = 'error';
            return $this->CI->output->set_output(json_encode(array('status'=>$status)));
        }

        $config['upload_path'] = './public/file/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = FALSE;
        $config['overwrite']= TRUE;
        $config['max_size'] = 1024; // 1MB
        
        $this->CI->load->library('upload',$config);
        if(!empty($files['file']['name'])){
            $jumlah_berkas = count($files['file']['name']);
            for($i = 0; $i < $jumlah_berkas;$i++) {
                $_FILES['file[]']['name']= $files['file']['name'][$i];
                $_FILES['file[]']['type']= $files['file']['type'][$i];
                $_FILES['file[]']['tmp_name']= $files['file']['tmp_name'][$i];
                $_FILES['file[]']['error']= $files['file']['error'][$i];
                $_FILES['file[]']['size']= $files['file']['size'][$i];

                $filename = $this->CI->fungsi->generateString(12).'-'.$files['file']['name'][$i];
            
                $file[] = $filename;
                $config['file_name'] = $filename;

                $this->CI->upload->initialize($config);
                if ($this->CI->upload->do_upload('file[]')){
                    $gbr = $this->CI->upload->data();
                    $filename = $gbr['file_name'];
                    $configResize = [];
                    //Compress Image
                    $configResize['image_library']='gd2';
                    $configResize['source_image']='./public/file/'.$filename;
                    $configResize['create_thumb']= FALSE;
                    $configResize['quality']= '88%';

                    list($width, $height) = getimagesize('./public/file/'.$filename);
                    if ($width < $height) {
                        $configResize['master_dim'] = 'width';
                        $configResize['x_axis'] = 0;
                        $configResize['y_axis'] = 105 * (intval($height) / intval($width) - 1);
                    } else if ($width == $height) {
                        $configResize['x_axis'] = 105 * (intval($width) / intval($height) - 1);
                        $configResize['y_axis'] = 105 * (intval($height) / intval($width) - 1);
                    }
                    else {
                        // $configResize['master_dim'] = 'height';
                        // $configResize['x_axis'] = 105 * (intval($width) / intval($height) - 1);
                        // $configResize['y_axis'] = 0;
                    }

                    $configResize['width']= 720;

                    $this->CI->load->library('image_lib', $configResize);
                    $configResize['new_image']= './public/file/'.$filename;

                    $this->CI->image_lib->clear();
                    $this->CI->image_lib->initialize($configResize);

                    if ( !$this->CI->image_lib->resize())
                    {
                            echo $this->CI->image_lib->display_errors();
                    }

                    $configResize['maintain_ratio']= FALSE;
                    $configResize['new_image']= './public/file/'.$filename;

                    if (!$this->CI->image_lib->crop()){
                        echo $this->CI->image_lib->display_errors();
                    }


                    $data['file_name']= $filename;
                    $data['file_lokasi']='public/file/'.$filename;
                    $data['type']= $type;
                    $data['id_form'] = $idform;
                    $data['id_user']= $this->CI->session->userdata('id');
                    
                    $checkFile = $this->CI->global->count_data('upload', 'type='.$type.' AND id_form='.$idform.' AND id_user='.$this->CI->session->userdata('id'));

                    if ($checkFile > 2) {
                        if (file_exists('./public/file/'.$filename)) {
                            unlink('./public/file/'.$filename);
                        }
                        $status = 'error';
                        return $this->CI->output->set_output(json_encode(array('status'=>$status)));
                    } else {
                        $this->CI->upload_model->save($data);
                    }
                } else {
                    print_r($this->CI->upload->display_errors());
                }
            }

            return TRUE;
        }else{
            return FALSE;
        }
                 
    }
 
} 