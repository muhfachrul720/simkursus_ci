<?php

    class MY_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function form_rules_required($data, $required = 'required|trim')
        {
            foreach($data as $key => $value){
                $this->form_validation->set_rules($key, strtoupper($key), $required);
            }
        }

        public function form_rules_required_multiple($data, $rules = 'required|trim')
        {
            $this->form_validation->set_error_delimiters('<small style="color:red">', '</small>');
            foreach($data as $key => $value){
                if(is_array($data[$key]) == true){
                    foreach($data[$key] as $keyTwo => $val){
                        $this->form_validation->set_rules($key.'['.$keyTwo.']', 'Form Harus Diisi Dan Tidak Boleh Kosong', $rules);
                    }
                } else { $this->form_validation->set_rules($key, strtoupper($key), $rules); }
            }
        } 

        
        public function file_upload_multiple($path, $name, $type = 'png|jpg')
        {
            $config = $this->setUploadConfig($path, $type);
            $this->load->library('upload', $config);
            
            $count = count($_FILES[$name]['name']); $data = array();

            for($i=0; $i < $count; $i++){
                if(!empty($_FILES[$name]['name'][$i])){
                    $_FILES['file']['name']     = $_FILES[$name]['name'][$i];
                    $_FILES['file']['type']     = $_FILES[$name]['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES[$name]['error'][$i];
                    $_FILES['file']['size']     = $_FILES[$name]['size'][$i];

                    if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();
                        $data['files'][$i] = $uploadData;
                    } else { echo $this->upload->display_errors(); 
                    die;}
                }
            }

            return $data['files'];
        }

        public function file_upload($path, $name, $type = 'gif|jpg|jpeg|png|docx')
        {
            $config['upload_path']          = $path;
            $config['allowed_types']        = $type;
            $config['overwrite']			= true;
            $config['encrypt_name']         = TRUE;
    
            $this->load->library('upload', $config);
    
            if($bool = $this->upload->do_upload($name)){
                return $this->upload->data();
            }else {
                echo $this->upload->display_errors();
                die;
            }
        }

        function debug($params)
        {
            if(is_array($params) == true){
                echo '<pre>';
                    print_r($params);
                echo '</pre>';
            } else {
                var_dump($params);
            }
        }

        function setUploadConfig($path, $type){
            $config['upload_path']          = $path;
            $config['allowed_types']        = $type;
            $config['overwrite']			= true;
            $config['encrypt_name']         = TRUE;

            return $config;
        }

        function generateRandomString($length = 5) {
            return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        }   
    }
    

?>