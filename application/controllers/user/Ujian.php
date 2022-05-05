<?php
Class Ujian extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/M_soal');
        $this->load->model('user/M_ujian');
        $this->load->model('user/M_student');
        $this->load->model('user/M_kolom');
    }

    public function index()
    {
        $this->template->load('template_admin','admin/dashboard_page');
    }

    // Admin
    // Add Ujian
    public function list_ujian()
    {
        $filter = count($this->input->post()) > 0 ? $this->input->post('filter') : '';

        // count Tiap Soal
        $data['tkd'] = $this->M_ujian->count_jenis_ujian('tkd')->num_rows();
        $data['kcm'] = $this->M_ujian->count_jenis_ujian('kcm')->num_rows();
        $data['kpb'] = $this->M_ujian->count_jenis_ujian('kpb')->num_rows();

        $data['list'] = $this->M_ujian->get_all_ujian($filter)->result_array();

        $this->template->load('template_admin','admin/ujian/list', $data);
    }

    public function add_ujian()
    {
        $data['setting'] = array(
            'page' => 'Penjadwalan',
            'detail' => 'menambahkan ujian',
            'action' => 'user/ujian/insert_ujian'
        );

        $data['form'] = array(
            'id' => '',
        );

        $this->template->load('template_admin','admin/ujian/form', $data);
    }

    public function insert_ujian()
    {
        $post = $this->input->post();
        unset($post['id']);

        $this->form_rules_required($post);
        if($this->form_validation->run() != False){

            $countQuestion = $this->M_soal->count_jenis_soal($post['typeUjian'])->num_rows();
            if($countQuestion >= $post['totalQuestion']){

                $dataUjian = array( 
                    'title_ujian' => $post['titleUjian'] ,
                    'type_ujian' => $post['typeUjian'] ,
                    'code_ujian' => strtoupper($post['typeUjian']).substr($post['titleUjian'], 0, 5).date('Ym') ,
                    'total_question' => $post['totalQuestion'] ,
                    'user_question' => $post['userQuestion'] ,
                    'time_start' => $post['timeStart'] ,
                    'time_end' => $post['timeEnd'] ,
                    'time_duration' => $post['timeDuration'] ,
                    'acak' =>  isset($post['acakUjian']) ? $post['acakUjian'] : 'N' ,
                    'token' => strtoupper($this->generateRandomString(4)) ,
                    'id_user' => $this->session->userdata('id_user'),
                    'date_created' => date('Y-m-d') ,
                );

                $this->M_soal->insert('tbl_ujian', $dataUjian);
                
                $this->session->set_flashdata('notif', 'success|Berhasil Menjadwalkan Ujian');
                redirect('user/ujian/list_ujian');

            } else { $this->session->set_flashdata('notif', 'danger|Jumlah Soal Lebih Banyak Daripada Bank Soal');
            redirect('user/ujian/add_ujian'); }
        } else {$this->session->set_flashdata('notif', 'danger|Silahkan mengisi dengan lengkap');
            redirect('user/ujian/add_ujian');
        }
    }

    // Edit
    public function edit_ujian($id)
    {
        $data['form'] = $this->M_ujian->get_ujian_byid($id)->row_array();

        $data['setting'] = array(
            'page' => 'Penjadwalan',
            'detail' => 'menambahkan ujian',
            'action' => 'user/ujian/update_ujian'
        );

        $this->template->load('template_admin','admin/ujian/edit_form', $data);
    }

    public function update_ujian()
    {
        $post = $this->input->post();

        $this->form_rules_required($post);
        if($this->form_validation->run() != False){

            $dataUjian = array(
                'title_ujian' => $post['titleUjian'] ,
                'time_start' => $post['timeStart'] ,
                'time_end' => $post['timeEnd'] ,
            );

            $this->M_soal->update('tbl_ujian', $dataUjian, array('id' => $post['id']));
            
            $this->session->set_flashdata('notif', 'success|Berhasil Menyunting Ujian');
            redirect('user/ujian/list_ujian');

        } else {$this->session->set_flashdata('notif', 'danger|Silahkan mengisi dengan lengkap');
            redirect('user/ujian/edit_ujian/'.$post['id']);
        }
    }

    // Detail
    public function detail_ujian($id)
    {
        $data['list'] = $this->M_ujian->get_detail_ujian($id)->result_array();
        $data['ujian'] = $this->M_ujian->get_ujian_byid($id)->row_array();

        $this->template->load('template_admin','admin/ujian/detail', $data);
    }

    // Delete
    public function delete_ujian()
    {
        $post = $this->input->post();

        $time = $this->M_ujian->get_ujian_byid($post['id'])->row_array();

        $timeStart = strtotime($time['time_start']);
        $timeNow = strtotime(date('Y-m-d h:i:s'));
        $timeEnd = strtotime($time['time_end']);

        if($timeNow > $timeStart && $timeNow < $timeEnd){
            $this->session->set_flashdata('notif', 'danger|Tidak dapat menghapus ujian yang sedang berjalan');
            redirect('user/ujian/list_ujian');
        } else { $this->M_soal->delete('tbl_ujian', array('id' => $post['id'])); }
       

        $this->session->set_flashdata('notif', 'success|Berhasil Menghapus Ujian');
        redirect('user/ujian/list_ujian');
    }

    // Student
    // List
    public function list_student_ujian()
    {
        $filter = count($this->input->post()) > 0 ? $this->input->post('filterList') : '';

        $stdID = $this->M_student->get_peserta_id_byuser($this->session->userdata('id_user'))->row_array()['id'];
       
        $data['list'] = $this->M_ujian->get_all_ujian($filter)->result_array();
        $data['totalJalan'] = $this->M_ujian->get_ujian_berjalan(date('Y-m-d h:i:s'))->num_rows();
        
        foreach($data['list'] as $idx => $l){
            $res = $this->M_ujian->check_hasil_ujian($l['id'], $stdID)->row_array();

            if($res != null){
                $data['list'][$idx]['total_skor'] = $res['total_skor'];
            } else {  $data['list'][$idx]['total_skor'] = ''; }
        }
        // $this->debug($data['list']);

        $this->template->load('template_admin','student/ujian/list', $data);
    }

    public function ikut_ujian()
    {
        $post = $this->input->post();

        $data['ujian'] = $this->M_ujian->get_ujian_page($post['id'])->row_array();

         if($data['ujian']['token'] == $post['tokenExam']){

            // To Ujian KCM
            if($data['ujian']['type_ujian'] == 'kcm'){
                $this->ikut_ujian_kcm($data['ujian'], $post);
            }

            $data['soal'] = $this->M_soal->get_soal_ujian_page($data['ujian']['type_ujian'], $data['ujian']['total_question'], $data['ujian']['user_question'], null, $data['ujian']['acak'])->result_array();

            foreach($data['soal'] as $index => $soal){
                $data['soal'][$index]['images'] = $this->M_soal->get_lampir_soal($soal['id'])->result_array();
                $data['soal'][$index]['answer'] = $this->M_soal->get_answer_soal_ujian_page($soal['id'], $soal['type_jawaban'])->result_array();
            };

            switch ($data['ujian']['type_ujian']){
                case 'tkd' :
                    $this->template->load('student/template/template_soal','student/ujian/event_tkd', $data);
                    break;
                // case 'kcm' : 
                //     $this->template->load('student/template/template_soal','student/ujian/event_kcm', $data);
                //     break;
                case 'kpb' : 
                    $this->template->load('student/template/template_soal','student/ujian/event_kpb', $data);
                    break;
            } 

        } else {
            $this->session->set_flashdata('notif', 'danger|Token ujian tidak cocok sama sekali');
            redirect('user/ujian/list_student_ujian');
        }

    }

    protected function ikut_ujian_kcm($data, $post)
    {
        $checkColumn = $this->M_kolom->ujian_progress($post['id'])->row_array();
        if($checkColumn == null){
            $data['soal'] = $this->M_soal->get_soal_ujian_page($data['type_ujian'], $data['total_question'], $data['user_question'], 1)->result_array();
            $data['kolom'] = 1;
        } else {
            for($i = 1; $i <= 10; $i++){
                if($checkColumn['kolom_'.$i] == null){
                    $data['soal'] = $this->M_soal->get_soal_ujian_page($data['type_ujian'], $data['total_question'], $data['user_question'], $i)->result_array();
                    $data['kolom'] = $i;
                    $i = 11;
                }
            }
            $data['idKolom'] = $checkColumn['id'];
        }

        foreach($data['soal'] as $index => $soal){
            $data['soal'][$index]['images'] = $this->M_soal->get_lampir_soal($soal['id'])->result_array();
            $data['soal'][$index]['answer'] = $this->M_soal->get_answer_soal_ujian_page($soal['id'], $soal['type_jawaban'])->result_array();
        };
        
        $data['ujian'] = $data;
        
        $this->template->load('student/template/template_soal','student/ujian/event_kcm', $data);

    }

    public function review_ujian()
    {
        $post = $this->input->post();

        if(isset($post['id'])){

            // Get Student ID 
            $stdID = $this->M_student->get_peserta_id_byuser($this->session->userdata('id_user'))->row_array()['id'];

            // Get Ujian Data 
            $type = $this->M_ujian->get_ujian_page($post['id'])->row_array();
            
            switch ($type['type_ujian']){
                case 'tkd' : 

                    $kunci_jawaban = $this->convert_kunci($this->M_soal->get_kunci_jawaban_bysoal($type['type_ujian'])->result_array());
                    $jawaban = $this->separate_bobot($post['ques']);

                    $arrayHasil = $this->calculate_ujian_bySoal($jawaban['option'], $kunci_jawaban);

                    $dataHasilUjian = array(
                        'id_ujian' => $post['id'],
                        'id_student' => $stdID,
                        'total_skor' => $arrayHasil['skor'], 
                        'jumlah_benar' => $arrayHasil['trueMark'],
                        'jumlah_salah' => $arrayHasil['falseMark'],
                        'jumlah_tidak_dijawab' => $type['total_question'] - ($arrayHasil['trueMark'] + $arrayHasil['falseMark']),
                        'id_soal' => $this->array_to_string(',', array_keys($jawaban['option'])),
                        'jawaban_siswa' => $this->array_to_string(',', $jawaban['option']),
                        'sisa_durasi' => $post['timeLeft'],
                        'tanggal_pengerjaan' => date('Y-m-d h:i:s'),
                        'status' => 1,
                    );

                    $this->M_ujian->insert('tbl_hasil_ujian', $dataHasilUjian);
                
                    $this->session->set_flashdata('notif', 'success|Seleasi Mengikuti Ujian');
                    // redirect('user/ujian/list_student_ujian');

                    $this->hasil_skor($dataHasilUjian);
                    
                    break; 

                case 'kcm' : 

                    $kunci_jawaban = $this->convert_kunci($this->M_soal->get_kunci_jawaban_bysoal($type['type_ujian'], $post['kolom'])->result_array());

                    $arrayHasil['skor'] = 0;
                    if(isset($post['ques'])){
                        $jawaban = $this->separate_bobot($post['ques']);

                        $arrayHasil = $this->calculate_ujian_bySoal($jawaban['option'], $kunci_jawaban);
                    }

                    $dataProgressKolom['kolom_'.$post['kolom']] = $arrayHasil['skor'];

                    if(isset($post['idKolom'])){

                        $this->M_kolom->update('tbl_kolom', $dataProgressKolom, array('id' => $post['idKolom']));

                    } else {

                        $dataProgressKolom['id_ujian'] = $post['id'];
                        $dataProgressKolom['id_user'] = $this->session->userdata('id_user');

                        $this->M_kolom->insert('tbl_kolom', $dataProgressKolom)
                    ;}

                    if($post['kolom'] == 10){

                        $progress = $this->M_kolom->ujian_progress($post['id'])->row_array();

                        $arrayHasil['skor'] = $this->sumAllColumn($progress);

                        $dataHasilUjian = array(
                            'id_ujian' => $post['id'],
                            'id_student' => $stdID,
                            'total_skor' => $arrayHasil['skor'], 
                            'jumlah_benar' => '-',
                            'jumlah_salah' => '-',
                            'jumlah_tidak_dijawab' => '-',
                            'id_soal' => '-',
                            'jawaban_siswa' => '-',
                            'sisa_durasi' => '-',
                            'tanggal_pengerjaan' => date('Y-m-d h:i:s'),
                            'status' => 1,
                        );

                        $this->M_ujian->insert('tbl_hasil_ujian', $dataHasilUjian);

                        $this->hasil_skor($dataHasilUjian);

                        break;

                    } else { 
                        $data['ujian'] = $this->M_ujian->get_ujian_page($post['id'])->row_array();
                        $this->ikut_ujian_kcm($data['ujian'], $post);
                    }

                    break;

                case 'kpb' :
                    
                    $jawaban = $this->separate_bobot($post['ques']);
                    $arrayHasil = $this->calculate_ujian_byBobot($jawaban['bobot']);
                    
                    $dataHasilUjian = array(
                        'id_ujian' => $post['id'],
                        'id_student' => $stdID,
                        'total_skor' => $arrayHasil['skor'], 
                        'jumlah_benar' => $arrayHasil['answered'],
                        'jumlah_salah' => 0,
                        'jumlah_tidak_dijawab' => $type['total_question'] - $arrayHasil['answered'],
                        'id_soal' => $this->array_to_string(',', array_keys($jawaban['option'])),
                        'jawaban_siswa' => $this->array_to_string(',', $jawaban['option']),
                        'sisa_durasi' => $post['timeLeft'],
                        'tanggal_pengerjaan' => date('Y-m-d h:i:s'),
                        'status' => 1,
                    );
                    
                    $this->M_ujian->insert('tbl_hasil_ujian', $dataHasilUjian);
                
                    $this->session->set_flashdata('notif', 'success|Seleasi Mengikuti Ujian');
                    // redirect('user/ujian/list_student_ujian');

                    $this->hasil_skor($dataHasilUjian);
                    
                    break;
            }

        } else {
            $this->session->set_flashdata('notif', 'danger|Belum Mengikuti Ujian sama sekali');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function hasil_skor($data)
    {
        $this->template->load('student/template/template_soal','student/ujian/hasil_skor', $data);
    }

    // Function
    function array_to_string($delimiter, $array){
        $returnString = '';
        foreach($array as $ar){
            $returnString .= $ar.$delimiter;
        }

        return $returnString;

    }

    function convert_kunci($arrayKunci){
        $newArray = array();
        foreach($arrayKunci as $a){
            $newArray[$a['id']] = $a['kunci_jawaban'];
        }

        return $newArray;
    }

    function separate_bobot($array){
        $newArray = array();
        foreach($array as $index => $val){
            $newArray['option'][$index] = explode('|', $val)[0];
            $newArray['bobot'][$index] = explode('|', $val)[1];
        }

        return $newArray;
    }

    function calculate_ujian_byBobot($array){
        $arraySkor = ['skor' => 0, 'answered' => count($array)];
        foreach($array as $a){
            $arraySkor['skor'] = $arraySkor['skor'] + $a;
        }

        return $arraySkor;
    }

    function calculate_ujian_bySoal($array, $kunci){
        $arraySkor = ['skor' => 0, 'trueMark' => 0, 'falseMark' => 0];
        foreach($array as $index => $ans){
            if($ans == $kunci[$index]){
                $arraySkor['skor']++; $arraySkor['trueMark']++;
            } else { $arraySkor['falseMark']++; }
        }

        return $arraySkor;
    }

    function sumAllColumn($array)
    {
        $total = 0;
        for($i = 1; $i <= 10; $i++){
            $total = $total + $array['kolom_'.$i]; 
        }

        return $total;
    }


}