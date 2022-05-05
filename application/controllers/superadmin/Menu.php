<?php
Class Menu extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('default/M_menu');
    }

    public function index()
    {
        // Taking from DB
        $data['list'] = $this->M_menu->get_all_table_menu('menu')->result_array(); 
        $data['listsub'] = $this->M_menu->get_all_table_menu('sub')->result_array(); 
        foreach($data['list'] as $km => $r){
            $no = 1;
            foreach($data['listsub'] as $k => $v){
                if($v['is_main_menu'] == $r['id_menu']){
                    $data['list'][$km]['total_sub'] = $no++;
                } 
            } 
        }
        $this->template->load('template_admin','default/menu/menu_manage', $data);
    }

    public function menu_add()
    {
         // Taking from DB
        $data['inmenu'] = array(
            'id_menu' => 0,
            'title' => '',
            'url' => '',
            'icon' => '',
            'is_main_menu' => 0,
            'is_aktif' => 'n',
        );

        $data['action'] = 'superadmin/menu/menu_insert';
        $this->template->load('template_admin','default/menu/menu_form', $data);
    }

    public function menu_insert()
    {
        $post = $this->input->post();

        // $this->debug($post);
        // die;

        $this->form_rules_required($post);
        if($this->form_validation->run() != False){

            $dataInsert = array(
                'title' => $post['titleMenu'],
                'url' => $post['urlMenu'],
                'icon' => $post['iconMenu'],
                'is_main_menu' => isset($post['subMenu']) ? $post['subMenu'] : 0,
                'is_aktif' => $post['isAktif'],
            );

            $this->M_menu->insert('tbl_menu', $dataInsert);
            $this->session->set_flashdata('msg', 'Berhasil Menambahkan pengguna baru|success'); redirect('superadmin/menu');

        } else {$this->session->set_flashdata('msg', 'Silahkan Mengisi Inputan File Secara Keseluruhan|danger'); redirect($_SERVER['HTTP_REFERER']);}
    }

    public function menu_edit($id)
    {
        // Taking From DB
        $data['inmenu'] = $this->M_menu->get_menu_id_only($id)->row_array();
        $data['insubmenu'] = $this->M_menu->get_submenu_from_parent_id($id)->result_array();

        // $this->debug($data);
        // die;

        $data['action'] = 'superadmin/menu/menu_update';
        $this->template->load('template_admin','default/menu/menu_form', $data);
    }
    
    public function menu_update()
    {
        $post = $this->input->post();

        // $this->debug($post);
        // die;

        $this->form_rules_required($post);
        if($this->form_validation->run() != False){

            $dataInsert = array(
                'title' => $post['titleMenu'],
                'url' => $post['urlMenu'],
                'icon' => $post['iconMenu'],
                'is_main_menu' => isset($post['subMenu']) ? $post['subMenu'] : 0,
                'is_aktif' => $post['isAktif'],
            );

            $this->M_menu->update('tbl_menu', $dataInsert, array('id_menu' => $post['idMenu']));
            $this->session->set_flashdata('msg', 'Berhasil Menambahkan menu Baru|success'); redirect('superadmin/menu');

        } else {$this->session->set_flashdata('msg', 'Silahkan Mengisi Inputan File Secara Keseluruhan|danger'); redirect($_SERVER['HTTP_REFERER']);}
    }


    public function menu_delete()
    {
        $id = $this->input->post('id');
        if($this->M_menu->delete('tbl_menu', array('id_menu' => $id))) {
            $this->session->set_flashdata('msg', 'Berhasil Menghapus Menu Tersebut|success'); redirect($_SERVER['HTTP_REFERER']);
        } else {$this->debug($id);};
    }

}