<?php

    class M_kolom extends MY_Model
    {
        protected $primary = 'tbl_kolom';
        protected $secondary = 'tbl_soal';

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

        // Check progress 
        public function ujian_progress($id)
        {
            $this->db->from($this->primary);

            $this->db->where('id_user', $this->session->userdata('id_user'));
            $this->db->where('id_ujian', $id);

            return $this->db->get();

        }
    }
?>