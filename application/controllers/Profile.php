<?php
Class Profile extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('default/M_user');
    }

    public function index($id)
    {
        // echo $id;

        $data['p'] = $this->M_user->get_user_info($this->session->userdata('id_user'))->row_array();

        // $this->debug($data);
        // die;

        $this->template->load('template_admin','default/profile', $data);

        // redirect('auth');
        // $this->load->view('maintenance/still_working.php');
    }

    public function update_profile()
    {
        $post = $this->input->post();
        
        $this->form_validation->set_rules('nameUser', 'Nama Pengguna', 'required');
        if($this->form_validation->run() != FALSE){
            $arrayUpdated = array(
                'nama_pengguna' => $post['nameUser']
            );

            if($_FILES['imageUser']['name'] != ''){

                $path = 'upload/foto_profil';
                $files = $this->file_upload($path, 'imageUser');

                $arrayUpdated['picture_profile'] = $files['file_name'];
                
            }

            if($post['newPass'] != ''){
                if($post['newPass'] === $post['matchingPass']){
                    $arrayUpdated['password'] = $this->hashPassword($post['newPass']);
                } else {
                    $this->session->set_flashdata('alert', 'danger|Password Saling Tidak Cocok');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }

            $ck = $this->M_user->update('tbl_user', $arrayUpdated, array('id_user' => $post['idUser']));
            if($ck){ 
                    $this->session->set_flashdata('alert', 'success|Berhasil memperbaharui Profil');
                    redirect($_SERVER['HTTP_REFERER']);} 
            else {$this->debug($post); $this->debug($arrayUpdated); }
        } else {
            $this->session->set_flashdata('alert', 'danger|Nama Pengguna Tidak Boleh Kosong');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    private function hashPassword($pass)
    {
        $option = array('cost' => 4);
        $hashPassword = password_hash($pass, PASSWORD_BCRYPT, $option);

        return $hashPassword;
    }

}