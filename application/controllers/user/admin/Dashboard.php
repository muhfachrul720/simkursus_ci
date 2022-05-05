<?php
Class Dashboard extends MY_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user/M_ujian');
        $this->load->model('user/M_student');
        $this->load->model('user/M_soal');
    }

    public function index()
    {
        // List Ujian yang sedang berjalan
        $data['list'] = $this->M_ujian->get_ujian_berjalan(date('Y-m-d h:i:s'))->result_array();

        // Count Data 
        $data['c_ujian'] = $this->M_ujian->count_total_ujian()->row_array();
        $data['c_soal'] = $this->M_soal->count_total_soal()->row_array();
        $data['c_peserta'] = $this->M_student->count_total_student()->row_array();

        $this->template->load('template_admin','admin/dashboard_page', $data);
    }

}