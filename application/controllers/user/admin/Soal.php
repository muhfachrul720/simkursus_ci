<?php
Class Soal extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/M_soal');
    }

    public function index()
    {
        $this->template->load('template_admin','admin/dashboard_page');
    }

    // Add Soal
    public function list_soal()
    {
        $filter = count($this->input->post()) > 0 ? $this->input->post('filter') : '';

        // count Tiap Soal
        $data['tkd'] = $this->M_soal->count_jenis_soal('tkd')->num_rows();

        $data['kcm'] = $this->M_soal->count_jenis_soal('kcm')->num_rows();
        $data['kolom_kcm'] = $this->M_soal->count_soal_by_kolom()->result_array();

        $data['kpb'] = $this->M_soal->count_jenis_soal('kpb')->num_rows();

        $data['list'] = $this->M_soal->get_all_soal($filter)->result_array();

        $this->template->load('template_admin','admin/soal/list', $data);
    }

    public function add_soal()
    {
        $data['setting'] = array(
            'page' => 'Penambahan',
            'detail' => 'menambahkan soal',
            'action' => 'user/admin/soal/insert_soal'
        );

        $data['form'] = array(
            'id' => '',
        );

        $this->template->load('template_admin','admin/soal/form', $data);
    }

    public function insert_soal()
    {
        $post = $this->input->post();;

        if(!empty($post)){

            // For Question 
            $dataSoal = array(
                'kode_soal' => ucwords($post['typeQuestion']).'_'.$this->generateRandomString().'_'.date('mY'),
                'jenis_soal' => $post['typeQuestion'],
                'bobot_soal' => isset($post['bobotTKDKC']) ? $post['bobotTKDKC'] : '-',
                'jml_jawaban' => $post['totalAnswer'],
                'kunci_jawaban' => isset($post['trueAnswerTKDKC']) ? $post['trueAnswerTKDKC'] : null,
                'type_jawaban' => $post['typeAnswer'],
                'isi_soal' => $post['theQuestion'],
                'kolom_soal' => isset($post['columnKC']) ? $post['columnKC'] : null,
                'id_user' => $this->session->userdata('id_user'),
                'tanggal_input' => date('Y-m-d'),
            );  $id = $this->M_soal->insert('tbl_soal', $dataSoal);

            if($_FILES['soalImg']['name'][0] != ''){
                $path = 'upload/user_images/answer_images';
                $file = $this->file_upload_multiple($path, 'soalImg', 'png|jpeg|jpg');

                $lampirSoalArray = [];
                foreach($file as $f){
                    array_push($lampirSoalArray, [
                        'nama_file' => $f['file_name'],
                        'id_soal' => $id
                    ]);
                } $this->M_soal->insert('tbl_lampiran_soal', $lampirSoalArray, true);
            } 

            if(isset($post['answerTxt'])){

                $dataAnswer = array();
                foreach($post['answerTxt'] as $char => $value){
                    array_push($dataAnswer, array(
                        'opsi_karakter' => $char,
                        'isi_jawaban' => $value,
                        'bobot_jawaban' => isset($post['answerBobot']) ? $post['answerBobot'][$char] : null,
                        'id_soal' => $id 
                    ));
                } $this->M_soal->insert('tbl_jawaban_text', $dataAnswer, true);
                
            } else if(isset($_FILES['answerImg'])){

                $path = 'upload/user_images/answer_images';
                $file = $this->file_upload_multiple($path, 'answerImg', 'png|jpeg|jpg');

                $dataAnswer = array();
                foreach($post['answerBobot'] as $char => $value){
                    array_push($dataAnswer, array(
                        'opsi_karakter' => $char,
                        'nama_gambar' => $file[$char]['file_name'],
                        'bobot_jawaban' => $value,
                        'id_soal' => $id 
                    ));
                } $this->M_soal->insert('tbl_jawaban_images', $dataAnswer, true);
            }

            $this->session->set_flashdata('notif', 'success|Berhasil Menambahkan Soal');
            redirect('user/admin/soal/list_soal');

        } else {
            $this->session->set_flashdata('notif', 'danger|Gagal Menambahkan Soal, Penyebab ');
            redirect('user/admin/soal/list_soal');
        };

        // $this->debug($_FILES);
       
    }

    public function edit_soal($id)
    {
        // Setting page
        $data['setting'] = array(
            'page' => 'Penyuntingan',
            'detail' => 'melakukan penyuntingan soal',
            'action' => 'user/admin/soal/update_soal'
        );

        $data['form'] = array(
            'id' => $id,
        );

        // Lampiran gambar soal 
        $data['lampiran'] = $this->M_soal->get_lampir_soal($id)->result_array();

        // Detail Page
        $arrayAlphabet = ['A', 'B', 'C', 'D', 'E', 'F'];
        $data['detail'] = $this->M_soal->get_type_soal($id)->result_array();

        // Question Form
        $data['question'] = '';
        if($data['detail'][0]['jenis_soal'] == 'tkd'){

            $data['question'] = '
                <div class="form-group row">
                    <label for="" class="col-1">Pertanyaan </label>
                    <div class="col-11">
                        <textarea name="theQuestion" class="form-control form-control-sm" id="" rows="5" required>'.$data['detail'][0]['isi_soal'].'</textarea>
                        <small>Masukkan Pertanyaan Disini</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-1">Bobot</label>
                    <div class="col-5">
                        <input type="text" name="bobotTKDKC" id="" class="form-control form-control-sm" value="'.$data['detail'][0]['bobot_soal'].'" placeholder="Contoh : 2" required>
                        <small>Masukkan bobot pertanyaan</small>
                    </div>

                    <label for="" class="col-1">Jawaban </label>
                    <div class="col-5">
                        <select name="trueAnswerTKDKC" id="trueAnswer" class="form-control form-control-sm" required> 
                           '; for($i=0; $i < $data['detail'][0]['jml_jawaban']; $i++){

                                if($arrayAlphabet[$i] == $data['detail'][0]['kunci_jawaban']){
                                    $data['question'] .= '<option value="'.$arrayAlphabet[$i].'" selected> '.$arrayAlphabet[$i].' </option>'; 
                                } else { $data['question'] .= '<option value="'.$arrayAlphabet[$i].'"> '.$arrayAlphabet[$i].' </option>'; }

                           }; $data['question'] .= '
                        </select>
                        <small>Pilih Jawaban yang benar pada Pertanyaan tersebut</small>
                    </div>
                </div>
            ';

        } else if($data['detail'][0]['jenis_soal'] == 'kcm') {

            $data['question'] .= '
                <div class="form-group row">
                    <label for="" class="col-1">Kolom Soal </label>
                    <div class="col-11">
                        <select name="columnKC" id="" class="form-control form-control-sm">
                            <option value="'.$data['detail'][0]['kolom_soal'].'">Kolom '.$data['detail'][0]['kolom_soal'].'</option>

                            <option value="1">Kolom 1</option>
                            <option value="2">Kolom 2</option>
                            <option value="3">Kolom 3</option>
                            <option value="4">Kolom 4</option>
                            <option value="5">Kolom 5</option>
                            <option value="6">Kolom 6</option>
                            <option value="7">Kolom 7</option>
                            <option value="8">Kolom 8</option>
                            <option value="9">Kolom 9</option>
                            <option value="10">Kolom 10</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-1">Pertanyaan </label>
                    <div class="col-11">
                        <textarea name="theQuestion" class="form-control form-control-sm" id="" rows="5" required>'.$data['detail'][0]['isi_soal'].'</textarea>
                        <small>Masukkan Pertanyaan Disini</small>
                    </div>
                </div>

                <div class="form-group row">
                <label for="" class="col-1">Bobot</label>
                <div class="col-5">
                    <input type="text" name="bobotTKDKC" id="" class="form-control form-control-sm" placeholder="Contoh : 2" value="'.$data['detail'][0]['bobot_soal'].'" required>
                    <small>Masukkan bobot pertanyaan</small>
                </div>

                <label for="" class="col-1">Jawaban </label>
                <div class="col-5">
                    <select name="trueAnswerTKDKC" id="trueAnswer" class="form-control form-control-sm" required> 
                        <option value="1"> 2 </option>
                    </select>
                    <small>Pilih Jawaban yang benar pada Pertanyaan tersebut</small>
                </div>
            </div>
            ';
        }else if($data['detail'][0]['jenis_soal'] == 'kpb') {
            $data['question'] = '
                <div class="form-group row">
                    <label for="" class="col-1">Pertanyaan </label>
                    <div class="col-11">
                        <textarea name="theQuestion" class="form-control form-control-sm" id="" rows="5" required>'.$data['detail'][0]['isi_soal'].'</textarea>
                        <small>Masukkan Pertanyaan Disini</small>
                    </div>
                </div>
            ';
        }

        // Answer Form
        $data['answer'] = '';
        if($data['detail'][0]['type_jawaban'] == 'txt'){
            for($i = 0; $i < $data['detail'][0]['jml_jawaban']; $i++){
                $data['answer'] .= '
                <div class="form-group row">
                    <label for="" class="col-2">Pilihan '.$arrayAlphabet[$i].' </label> 
                    <div class="col-7">
                        <input type="text" name="answerTxt['.$data['detail'][$i]['answer_txt_id'].']" id="" class="form-control form-control-sm" value="'.$data['detail'][$i]['isi_jawaban'].'" required>
                        <small>Masukkan isi Jawaban pada pilihan '.$arrayAlphabet[$i].' </small>
                    </div>

                    <label for="" class="col-1 text-center">Bobot </label>
                    <div class="col-2">
                        <input type="text" name="answerBobot['.$data['detail'][$i]['answer_txt_id'].']" id="" class="form-control form-control-sm" value="'.$data['detail'][$i]['txtBobot'].'" required>
                        <small>Masukkan Bobot Dari Jawaban</small>
                    </div>
                </div>
            ';
            }
        } else if ($data['detail'][0]['type_jawaban'] == 'img'){
            for($i = 0; $i < $data['detail'][0]['jml_jawaban']; $i++){
                $data['answer'] .= '
                <div class="form-group row">
                    
                    <input type="hidden" value="'.$data['detail'][$i]['nama_gambar'].'" name="answerImgOld[]">

                    <label for="" class="col-2">Pilihan '.$arrayAlphabet[$i].' </label>
                    <div class="col-7">
                        <div class="mb-0 pb-0">
                            <label for="imgAns_'.$arrayAlphabet[$i].'" class="btn btn-unique mb-0 w-50 mr-2">Upload File Disini</label>
                            <input type="file" name="answerImg[]" id="imgAns_'.$arrayAlphabet[$i].'" class="dp-none file-input" accept="">
                            <small>Nama File : '.$data['detail'][$i]['nama_gambar'].'</small>
                        </div>
                        <small>Masukkan isi Jawaban pada pilihan '.$arrayAlphabet[$i].' </small>
                    </div>

                    <label for="" class="col-1">Bobot </label>
                    <div class="col-2">
                        <input type="text" name="answerBobot[]" id="" class="form-control form-control-sm" value="'.$data['detail'][$i]['imgBobot'].'" required>
                        <small>Masukkan Bobot Dari Jawaban</small>
                    </div>
                </div> 
            ';
            }
        }

        $this->template->load('template_admin','admin/soal/edit_form', $data);
    }

    public function update_soal()
    {
        $post = $this->input->post();

        if(!empty($post)){

            $id = $post['id'];

            // For Question 
            $dataSoal = array(
                'bobot_soal' => isset($post['bobotTKDKC']) ? $post['bobotTKDKC'] : '-',
                'kunci_jawaban' => isset($post['trueAnswerTKDKC']) ? $post['trueAnswerTKDKC'] : null,
                'isi_soal' => $post['theQuestion'],
                'kolom_soal' => isset($post['columnKC']) ? $post['columnKC'] : null,
            );  $this->M_soal->update('tbl_soal', $dataSoal, array('id' => $id));


            if($_FILES['soalImg']['name'][0] != ''){
                $path = 'upload/user_images/answer_images';
                $file = $this->file_upload_multiple($path, 'soalImg', 'png|jpeg|jpg');

                // Delete first
                $this->M_soal->delete('tbl_lampiran_soal', array('id_soal' => $id));

                // Then Add
                $lampirSoalArray = [];
                foreach($file as $f){
                    array_push($lampirSoalArray, [
                        'nama_file' => $f['file_name'],
                        'id_soal' => $id
                    ]);
                } $this->M_soal->insert('tbl_lampiran_soal', $lampirSoalArray, true);
            } 

            if(isset($post['answerTxt'])){

                $dataAnswer = array();
                foreach($post['answerTxt'] as $char => $value){
                    array_push($dataAnswer, array(
                        'id' => $char,

                        'isi_jawaban' => $value,
                        'bobot_jawaban' => isset($post['answerBobot']) ? $post['answerBobot'][$char] : null,
                    ));
                } $this->M_soal->update('tbl_jawaban_text', $dataAnswer, 'id', true);
                
            } else if(isset($_FILES['answerImg'])){

                $path = 'upload/user_images/answer_images';
                $file = $this->file_upload_multiple($path, 'answerImg', 'png|jpeg|jpg');

                $dataAnswer = array();
                foreach($post['answerBobot'] as $char => $value){
                    array_push($dataAnswer, array(
                        'opsi_karakter' => $char,
                        'nama_gambar' => isset($file[$char]['file_name']) ? $file[$char]['file_name'] : $post['answerImgOld'][$char],
                        'bobot_jawaban' => $value,
                        'id_soal' => $id 
                    ));
                } 

                $this->M_soal->delete('tbl_jawaban_images', array('id_soal' => $id));

                $this->M_soal->insert('tbl_jawaban_images', $dataAnswer, true);
            }

            $this->session->set_flashdata('notif', 'success|Berhasil Menambahkan Soal');
            redirect('user/admin/soal/list_soal');

        } else {
            $this->session->set_flashdata('notif', 'danger|Gagal Menambahkan Soal, Penyebab ');
            redirect('user/admin/soal/list_soal');
        };  
    }

    public function delete_soal()
    {
        $post = $this->input->post();

        $this->M_soal->delete('tbl_soal', array('id' => $post['id']));
        $this->M_soal->delete('tbl_jawaban_text', array('id_soal' => $post['id']));
        $this->M_soal->delete('tbl_jawaban_images', array('id_soal' => $post['id']));

        $this->session->set_flashdata('notif', 'success|Berhasil Menghapus Soal');
        redirect('user/admin/soal/list_soal');
    }

    function generateRandomString($length = 5) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }    

}