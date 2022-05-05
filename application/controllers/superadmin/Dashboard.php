<?php
Class Dashboard extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // redirect('auth');
        // $this->load->view('maintenance/still_working.php');
        $this->template->load('template_admin','default/dashboard_page');
    }

}