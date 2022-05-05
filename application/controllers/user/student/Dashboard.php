<?php
Class Dashboard extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/M_ujian');
        $this->load->model('user/M_student');
    }

    public function index()
    {
        $data['total'] = $this->M_ujian->count_total_ujian()->row_array();
        $stdID = $this->M_student->get_peserta_id_byuser($this->session->userdata('id_user'))->row_array()['id'];

        $data['list'] = $this->M_ujian->get_ujian_berjalan(date('Y-m-d h:i:s'))->result_array();

        foreach($data['list'] as $idx => $l){
            $res = $this->M_ujian->check_hasil_ujian($l['id'], $stdID)->row_array();

            if($res != null){
                $data['list'][$idx]['total_skor'] = $res['total_skor'];
            } else {  
                $data['list'][$idx]['total_skor'] = ''; }
            }
            
        $this->template->load('template_admin','student/dashboard_page', $data);
    }

}