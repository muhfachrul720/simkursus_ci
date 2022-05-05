<?php

Class Student extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/M_student');
    }

    public function index()
    {
        $data['list'] = $this->M_student->get_all_peserta()->result_array();

        // $this->debug($data);
        // die;

        $this->template->load('template_admin','admin/student/list', $data);
    }

    public function add_student()
    {
        $data['setting'] = array(
            'page' => 'Penambahan',
            'detail' => 'mendaftarkan peserta baru',
            'action' => 'user/admin/student/insert_student'
        );

        $data['form'] = array(
            'id' => '',
        );

        $this->template->load('template_admin','admin/student/form', $data);
    }

    public function edit_student($id)
    {
        $data['setting'] = array(
            'page' => 'Penyuntingan',
            'detail' => 'menyunting peserta ',
            'action' => 'user/admin/student/update_student'
        );

        $data['form'] = $this->M_student->get_peserta_info_byid($id)->row_array();

        $this->template->load('template_admin','admin/student/edit_form', $data);
    }

    public function insert_student()
    {
        $post = $this->input->post();
        $validate = $post;

        // Unset Pass and Id 
        unset($validate['id']); unset($validate['passwordPeserta']);

        $this->form_rules_required($validate);
        if($this->form_validation->run() != False){
            
            $pass = $this->changePassword($post['passwordPeserta']);

            $pastId = $this->M_student->latest_student_id()->row_array()['id']; 
            if($pastId == null){
                $pastId = 0;
            }

            // Make NIP Peserta
            $nip = 'PSRT0'.($pastId + 1).'SIMKURSUS';

            $dataUser = array(
                'username' => $post['usernamePeserta'],
                'nama_pengguna' => $post['namaLengkapPeserta'], 
                'password' => $pass != null ? $pass : $this->changePassword($nip), 
                'user_level' => 6,
                'date_registration' => date('Y-m-d h:i:s'), 
                'picture_profile' => 'default.png',
            );  
            
            // $this->debug($dataUser);
            $idUser = $this->M_student->insert('tbl_user', $dataUser);

            $dataStudent = array(
                'nomor_induk' => $nip,
                'nama_lengkap' => $post['namaLengkapPeserta'],
                'jenis_kelamin' => $post['jenisKelamin'],
                'no_hp' => $post['noHPPeserta'],
                'visible_pass' =>  $pass != null ? $post['passwordPeserta'] : $nip,
                'id_user' => $idUser,
            );

            // $this->debug($dataStudent);
            $this->M_student->insert('tbl_student', $dataStudent);

            $this->session->set_flashdata('notif', 'success|Berhasil Menambahkan Peserta');
            redirect('user/admin/student');

        } else { $this->session->set_flashdata('notif', 'danger|Silahkan mengisi dengan lengkap');
        redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function update_student()
    {
        $post = $this->input->post();
        $validate = $post;

        // Unset Pass and Id 
        unset($validate['id']); unset($validate['passwordPeserta']);

        $this->form_rules_required($validate);
        if($this->form_validation->run() != False){
            
            $pass = $this->changePassword($post['passwordPeserta']);

            $dataUser = array(
                'username' => $post['usernamePeserta'],
                'nama_pengguna' => $post['namaLengkapPeserta'], 
                'password' => $pass != null ? $pass : $this->changePassword($post['nomorInduKPeserta']), 
            );  
            
            // $this->debug($dataUser);
            $this->M_student->update('tbl_user', $dataUser, array('id_user' => $post['usid']));

            $dataStudent = array(
                'nama_lengkap' => $post['namaLengkapPeserta'],
                'jenis_kelamin' => $post['jenisKelamin'],
                'no_hp' => $post['noHPPeserta'],
                'visible_pass' =>  $pass != null ? $post['passwordPeserta'] : $post['nomorIndukPeserta'],
            );

            // $this->debug($dataStudent);
            $this->M_student->update('tbl_student', $dataStudent, array('id' => $post['id']));

            $this->session->set_flashdata('notif', 'success|Berhasil Menyunting Peserta');
            redirect('user/admin/student');

        } else { $this->session->set_flashdata('notif', 'danger|Silahkan mengisi dengan lengkap');
        redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function delete_student()
    {
        $post = $this->input->post();

        $idUser = $this->M_student->get_peserta_info_byid($post['id'])->row_array()['id_user'];

        // Delete
        $this->M_student->delete('tbl_user', array('id_user' => $idUser));
        $this->M_student->delete('tbl_ujian', array('id' => $post['id']));

        $this->session->set_flashdata('notif', 'success|Berhasil Menghapus Peserta');
        redirect('user/admin/student');
    }

    function changePassword($rawPassword)
    {
        if($rawPassword != ''){
            return password_hash($rawPassword, PASSWORD_DEFAULT);;
        } else {return null; }
    }
}

?>
