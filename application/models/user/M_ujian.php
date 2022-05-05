<?php
    class M_ujian extends MY_Model
    {
        protected $primary = 'tbl_ujian';
        protected $secondary = 'tbl_hasil_ujian';
        
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

        // Get Count
        public function count_total_ujian()
        {
            $this->db->select('count(id) as total');

            $this->db->where('id_user', $this->session->userdata('id_user'));

            return $this->db->get($this->primary);
        }

        // Get Ujian
        public function get_all_ujian($filter)
        {
            if($filter != ''){
                $this->db->where('type_ujian', $filter);
            } 

            $this->db->where('id_user', $this->session->userdata('id_user'));
            $this->db->order_by('time_start', 'DESC');
            return $this->db->get($this->primary);
        }

        public function get_ujian_berjalan($date)
        {
            $this->db->where('time_start <', $date);
            $this->db->where('time_end >', $date);

            return $this->db->get($this->primary);
        }

        public function check_hasil_ujian($idUj, $idStd)
        {
            $this->db->select(
                'total_skor'
            );
            $this->db->where('id_ujian', $idUj);
            $this->db->where('id_student', $idStd);

            return $this->db->get($this->secondary);
        }

        public function count_jenis_ujian($where)
        {
            $this->db->where('type_ujian', $where);

            $this->db->where('id_user', $this->session->userdata('id_user'));

            return $this->db->get($this->primary);
        }

        public function get_ujian_byid($where, $type = false)
        {
            $this->db->where('id', $where);
            return $this->db->get($this->primary);
        }

        public function get_ujian_page($where)
        {
            $this->db->from('tbl_ujian as uj');

            $this->db->where('id', $where);

            return $this->db->get();
        }

        public function get_detail_ujian($where)
        {
            $this->db->select(
                'std.nama_lengkap, std.id as stdID, 
                 hj.id as hjID, hj.total_skor, hj.sisa_durasi'
            );

            $this->db->where('id_ujian', $where);
            $this->db->order_by('total_skor', 'DESC');

            $this->db->join('tbl_student as std', 'hj.id_student = std.id');

            return $this->db->get($this->secondary.' as hj');
        }
    }

?>