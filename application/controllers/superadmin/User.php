<?php
Class User extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('default/M_user');
    }

    public function index()
    {
        // Taking Data From DB
        $data['liuser'] = $this->M_user->get_all_table()->result_array();

        $this->template->load('template_admin','default/user/user_manage', $data);
    }

    public function user_add()
    {
        // An Empty Array
        $data['inuser'] = array(
            'id_user' => 0,
            'username' => '',
            'nama_pengguna' => '',
            'id' => '',
            'picture_profile' => ''
        );

        $data['action'] = 'superadmin/user/user_insert';
        $this->template->load('template_admin','default/user/user_form', $data);
    }

    public function user_insert()
    {
        $post = $this->input->post();

        $this->form_rules_required($post);
        if($this->form_validation->run() != False){
            
            $dataInsert = array(
                'username' => $post['userName'],
                'nama_pengguna' => $post['namaPengguna'],
                'password' => password_hash($post['password'],PASSWORD_DEFAULT),
                'user_level' => $post['lvUser'],
            ); 

            if($_FILES['fotoProfile']['name'] != ''){
                $path = 'upload/foto_profil';
                $file = $this->file_upload($path, 'fotoProfile');

                $dataInsert['picture_profile'] = $file['file_name'];
            }

            $this->M_user->insert('tbl_user', $dataInsert);
            $this->session->set_flashdata('msg', 'Berhasil Menambahkan pengguna baru|success'); redirect('superadmin/user');

        } else {$this->session->set_flashdata('msg', 'Silahkan Mengisi Inputan File Secara Keseluruhan|danger'); redirect($_SERVER['HTTP_REFERER']);}
    }

    public function user_edit($id)
    {
        // Taking Data From DB
        $data['inuser'] = $this->M_user->get_user_info($id)->row_array();

        // Form Target 
        $data['action'] = 'superadmin/user/user_update';
        $this->template->load('template_admin','default/user/user_form', $data);
    }
    
    public function user_update()
    {
        $post = $this->input->post();
        /* Delete Password */ $pass = $post['password']; unset($post['password']);

        $this->form_rules_required($post);
        if($this->form_validation->run() != False){

            $dataUpdate = array(
                'username' => $post['userName'],
                'nama_pengguna' => $post['namaPengguna'],
                'user_level' => $post['lvUser'],
            );

            if($pass != ''){
                $dataUpdate['password'] = password_hash($pass, PASSWORD_DEFAULT); }

            if($_FILES['fotoProfile']['name'] != ''){
                $path = 'upload/foto_profil';
                $file = $this->file_upload($path, 'fotoProfile');

                $dataUpdate['picture_profile'] = $file['file_name'];
            }

            $this->M_user->update('tbl_user', $dataUpdate, array('id_user' => $post['iduser']));
            $this->session->set_flashdata('msg', 'Data Pengguna Berhasil Di Sunting|success'); redirect('superadmin/user');

        } else {$this->session->set_flashdata('msg', 'Silahkan Mengisi Inputan File Secara Keseluruhan|danger'); redirect($_SERVER['HTTP_REFERER']);}
    }

    public function user_delete()
    {
        $id = $this->input->post('idUser');
        if($this->M_user->delete('tbl_user', array('id_user' => $id))) {
            $this->session->set_flashdata('msg', 'Berhasil Menghapus Pengguna|success'); redirect($_SERVER['HTTP_REFERER']);
        } else {$this->debug($id);};
    }

    public function user_level()
    {
        // Taking Data From DB
        $data['list'] = $this->M_user->get_all_table_level()->result_array();

        $this->template->load('template_admin','default/user_level/user_level_manage', $data);
    }

    public function user_level_add()
    {
        // An Empty Array
        $data['inuser'] = array(
            'id' => 0,
            'nama' => '',
        );

        $data['action'] = 'superadmin/user/user_level_insert';
        $this->template->load('template_admin','default/user_level/user_level_form', $data);
    }

    public function user_level_insert()
    {
        $post = $this->input->post();

        $this->form_rules_required($post);
        if($this->form_validation->run() != False){
            
            $dataInsert = array(
                'nama' => $post['levelName']
            ); 

            $this->M_user->insert('tbl_user_level', $dataInsert);
            $this->session->set_flashdata('msg', 'Berhasil Menambahkan pengguna baru|success'); redirect('superadmin/user/user_level');

        } else {$this->session->set_flashdata('msg', 'Silahkan Mengisi Inputan File Secara Keseluruhan|danger'); redirect($_SERVER['HTTP_REFERER']);}
    }

    public function user_level_edit($id)
    {
          // Taking Data From DB
        $data['inuser'] = $this->M_user->get_level_id_only($id)->row_array();

        // Form Target 
        $data['action'] = 'superadmin/user/user_level_update';
        $this->template->load('template_admin','default/user_level/user_level_form', $data);
    }

    public function user_level_update()
    {
        $post = $this->input->post();

        $this->form_rules_required($post);
        if($this->form_validation->run() != False){
            
            $dataUpdate = array(
                'nama' => $post['levelName']
            ); 

            // $this->M_user->update('tbl_user_level', $dataInsert);
            $this->M_user->update('tbl_user_level', $dataUpdate, array('id' => $post['iduser']));
            
            $this->session->set_flashdata('msg', 'Berhasil Menambahkan pengguna baru|success'); redirect('superadmin/user/user_level');

        } else {$this->session->set_flashdata('msg', 'Silahkan Mengisi Inputan File Secara Keseluruhan|danger'); redirect($_SERVER['HTTP_REFERER']);}
    }

    public function user_level_delete()
    {
        $id = $this->input->post('idUser');
        if($this->M_user->delete('tbl_user_level', array('id' => $id))) {
            $this->session->set_flashdata('msg', 'Berhasil Menghapus Level Pengguna|success'); redirect($_SERVER['HTTP_REFERER']);
        } else {$this->debug($id);};
    }

    // // Utility tools Function
    // private function crypt_pass($pass)
    // {
        
    // }
}