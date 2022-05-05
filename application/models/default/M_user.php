<?php

    class M_user extends MY_Model
    {
        protected $primary = 'tbl_user';
        protected $secondary = 'tbl_user_level';

        public function __construct()
        {
            parent::__construct();
        }

        // Universal CRUD
        public function insert($table, $data)
        {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }

        public function update($table, $data, $where)
        {
            $this->db->where($where);
            return $this->db->update($table, $data);
        }
        
        public function delete($table, $where)
        {
            $this->db->where($where);
            return $this->db->delete($table);
        }

        // Get
        public function get_all_table()
        {
            // Minimaze data 
            $this->db->select('
                us.username, us.nama_pengguna, us.id_user, us.date_registration,
                lv.nama
            ');

            $this->db->join($this->secondary.' as lv', 'lv.id = us.user_level');
            return $this->db->get($this->primary.' as us');
        }

        public function get_user_info($id)
        {
            $this->db->where('us.id_user', $id);

            $this->db->join($this->secondary.' as lv', 'us.user_level = lv.id');

            return $this->db->get($this->primary.' as us');
        }

        public function get_all_table_level()
        {
            // Minimaze data 
            $this->db->select('
                lv.id, lv.nama, lv.date_created, count(us.id_user) as total_user
            ');

            $this->db->join($this->primary.' as us', 'lv.id = us.user_level', 'LEFT');
            $this->db->group_by('lv.id');
            $this->db->order_by('lv.id', 'ASC');

            return $this->db->get($this->secondary.' as lv');
        }

        public function get_level_id_only($id = null)
        {
            $this->db->select('
               id, nama
            ');

            if($id != null){ $this->db->where('id', $id);}
            return $this->db->get($this->secondary);
        }
    }
    




?>