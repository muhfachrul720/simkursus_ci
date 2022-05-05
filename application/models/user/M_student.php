<?php

    class M_student extends MY_Model
    {
        protected $primary = 'tbl_student';
        protected $secondary = 'tbl_user';

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
        public function count_total_student()
        {
            $this->db->select('count(id) as total');
            return $this->db->get($this->primary);
        }

        // Get
        public function latest_student_id()
        {
            $this->db->limit(1);
            $this->db->order_by('id', 'DESC');

            return $this->db->get($this->primary);
        }

        public function get_all_peserta()
        {
            // Minimize Data 
            $this->db->select(
                'std.id as stdID, std.nomor_induk, std.nama_lengkap, std.visible_pass,
                us.username, us.id_user as usID'
            );

            $this->db->join($this->secondary.' as us', 'us.id_user = std.id_user');

            $this->db->where('us.user_level', 6);
            return $this->db->get($this->primary.' as std');
        }

        public function get_peserta_info_byid($where)
        {
            $this->db->join($this->secondary.' as us', 'us.id_user = std.id_user');

            $this->db->where('std.id', $where);
            return $this->db->get($this->primary.' as std');
        }

        public function get_peserta_id_byuser($where)
        {
            $this->db->select('id');

            $this->db->where('id_user', $where);
            return $this->db->get($this->primary);
        }
    }

?>