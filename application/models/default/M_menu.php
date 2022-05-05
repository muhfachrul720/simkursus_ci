<?php

    class M_menu extends MY_Model
    {
        protected $primary = 'tbl_menu';
        protected $secondary = 'tbl_hak_akses';
        protected $third = 'tbl_user_level';

        public function __construct()
        {
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
        public function get_all_table_menu($opt = 'all')
        {
            // Minimaze data 
            $this->db->select('
                mn.*
            ');

            if($opt == 'sub'){
                $this->db->where('mn.is_main_menu !=', 0);
            } else if ($opt == 'menu'){$this->db->where('mn.is_main_menu', 0);}

            return $this->db->get($this->primary.' as mn');
        }
        
        public function get_all_table_access()
        {
            // Minimaze data 
            $this->db->select('
                mn.title, mn.id_menu,
                lv.nama, 
                ac.*
            ');

            $this->join_access();
            return $this->db->get($this->secondary.' as ac');
        }

        public function get_access_byid($id)
        {
            // Minimaze data 
            $this->db->select('
                mn.title, mn.id_menu,
                lv.nama, lv.id,
                ac.*
            ');

            $this->join_access();
            $this->db->where('lv.id', $id);
            return $this->db->get($this->secondary.' as ac');
        }

        public function get_menu_id_only($id)
        {
            // Minimaze data 
            $this->db->select('
                mn.*
            ');

            $this->db->where('id_menu', $id);
            return $this->db->get($this->primary.' as mn');
        }

        public function get_submenu_from_parent_id($id)
        {
            // Minimaze data 
            $this->db->select('
                mn.title
            ');

            $this->db->where('is_main_menu', $id);
            return $this->db->get($this->primary.' as mn');
        }

        private function join_access()
        {
            $this->db->join($this->primary.' as mn', 'mn.id_menu = ac.id_menu');
            $this->db->join($this->third.' as lv', 'lv.id = ac.id_user_level', 'RIGHT');
        }
    }

?>