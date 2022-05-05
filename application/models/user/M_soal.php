<?php

    class M_soal extends MY_Model
    {
        protected $primary = 'tbl_soal';
        protected $secondary = 'tbl_jawaban_text';
        protected $third = 'tbl_jawaban_images';
        protected $fourth = 'tbl_lampiran_soal';

        public function __construct()
        {
           parent::__construct();
        }
       
        // Universal CRUD
        public function insert($table, $data, $batch = false)
        {
            if($batch != false){
                $this->db->insert_batch($table, $data);} 
            else {$this->db->insert($table, $data);}
            return $this->db->insert_id(); 
        }

        public function update($table, $data, $where, $batch = false)
        {
            if($batch == false){
                $this->db->where($where);
                return $this->db->update($table, $data);
            } else {$this->db->update_batch($table, $data, $where); }
        }
        
        public function delete($table, $where)
        {
            $this->db->where($where);
            return $this->db->delete($table);
        }

        // Get
        public function get_all_soal($filter)
        {
            $this->db->join('tbl_user as us', 'usl.id_user = us.id_user');

            if($filter != ''){
                $this->db->where('usl.jenis_soal', $filter);
            }

            // Added 23 02 2022
            $this->db->where('usl.id_user', $this->session->userdata('id_user'));

            $this->db->order_by('usl.id', 'DESC');
            return $this->db->get($this->primary.' as usl');
        }

        public function get_type_soal($where)
        {
            $this->db->select('sl.*, ji.*, jt.*, ji.id as answer_img_id, jt.id as answer_txt_id, jt.bobot_jawaban as txtBobot, ji.bobot_jawaban as imgBobot');

            $this->db->from($this->primary.' as sl');

            $this->db->join($this->secondary.' as jt', 'sl.id = jt.id_soal', 'LEFT');
            $this->db->join($this->third.' as ji', 'sl.id = ji.id_soal', 'LEFT');

            $this->db->where('sl.id', $where);

            return $this->db->get();
        }

        // Get count
        public function count_jenis_soal($where)
        {
            $this->db->where('jenis_soal', $where);

            // Added 23 02 2022
            $this->db->where('id_user', $this->session->userdata('id_user'));

            return $this->db->get('tbl_soal');
        }

        public function count_total_soal()
        {
            $this->db->select('count(id) as total');

            // Added 23 02 2022
            $this->db->where('id_user', $this->session->userdata('id_user'));

            return $this->db->get($this->primary);
        }

        public function count_soal_by_kolom()
        {
            $this->db->select('count(id) as total_soal, kolom_soal');
            $this->db->where('jenis_soal', 'kcm');

            // Added 23 02 2022
            $this->db->where('id_user', $this->session->userdata('id_user'));
            
            $this->db->group_by('kolom_soal');
            $this->db->order_by('kolom_soal', 'ASC');

            return $this->db->get($this->primary);
        }

        // Get Datas
        public function get_soal_ujian_page($type, $limit, $idUser, $kolom = null, $random = 'N')
        {
            $this->db->where('jenis_soal', $type);
            $this->db->where('id_user', $idUser);

            if($kolom != null){$this->db->where('kolom_soal', $kolom);}

            $this->db->limit($limit);

            if($random != 'N'){
                $this->db->order_by('rand()');
            } else {$this->db->order_by('id', 'DESC');}

            return $this->db->get($this->primary);
        }

        public function get_answer_soal_ujian_page($where, $type)
        {
            $this->db->where('id_soal', $where);

            // $this->db->sort_by('id', 'ASC');
            if($type == 'txt'){
                return $this->db->get($this->secondary); } 
            else if($type == 'img') {
                return $this->db->get($this->third); }
        }

        public function get_kunci_jawaban_bysoal($where, $kolom = null)
        {
            $this->db->select('id, kunci_jawaban');

            $this->db->where('jenis_soal', $where);
            if($kolom != null){$this->db->where('kolom_soal', $kolom);}

            return $this->db->get($this->primary);
        }

        public function get_lampir_soal($where)
        {
            $this->db->where('id_soal', $where);
            return $this->db->get($this->fourth);
        }
    }

?>