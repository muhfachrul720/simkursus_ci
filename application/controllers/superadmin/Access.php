<?php
Class Access extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('default/M_menu');
        $this->load->model('default/M_user');
    }

    public function index()
    {
        // Taking from DB
        $data['list'] = $this->M_user->get_level_id_only()->result_array();
        $lvresult = $this->M_menu->get_all_table_access()->result_array();
        foreach($data['list'] as $k => $d){
            $tempListMn = ''; $tempIdMn = '';
            foreach($lvresult as $ky => $l) {
                if($d['id'] == $l['id_user_level']){
                    $tempIdMn .= $l['id_hak_akses'].', '; $tempListMn .= $l['title'].', ';
                    unset($lvresult[$ky]);   
                }
            } 

            $data['list'][$k]['list_menu'] = $tempListMn;
            $data['list'][$k]['id_menu'] = $tempIdMn;
        }

        $this->template->load('template_admin','default/access/access_manage', $data);
    }

    public function access_edit($id)
    {
        // Taking From DB
        $data['info'] = $this->M_menu->get_access_byid($id)->result_array();

        // $this->debug($data);
        // die;

        $this->template->load('template_admin','default/access/access_form', $data);
    }

    public function access_insert()
    {
        $post = $this->input->post();

        $dataInsert = array('id_user_level' => $post['idLevel'], 'id_menu' => $post['idMenu']);
        $this->M_menu->insert('tbl_hak_akses', $dataInsert);

        $this->session->set_flashdata('msg', 'Berhasil Menambahkan Akses Baru|success'); redirect($_SERVER['HTTP_REFERER']);
    }

    public function access_delete()
    {
        $post = $this->input->post();
        if($this->M_user->delete('tbl_hak_akses', array(
            $post['type'] == 'all' ? 'id_user_level' : 'id_hak_akses' => $post['id'])
        )) {
            $this->session->set_flashdata('msg', 'Berhasil Menghapus Hak Akses|success'); redirect($_SERVER['HTTP_REFERER']);
        } else {$this->debug($post['id']);};

    }

}