<?php

    class m_auth extends MY_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function validate($email)
        {

            // var_dump($password);

            $this->db->select('
                id_user, 
                username, 
                nama_pengguna,
                password,
                user_level,
                picture_profile,
            ');

            $this->db->where('username', $email);

            $this->db->limit(1);
            return $this->db->get('tbl_user')->row_array();
        }
    }
    




?>