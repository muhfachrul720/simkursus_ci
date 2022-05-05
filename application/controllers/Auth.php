<?php
Class Auth extends MY_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_auth');
    }

    public function index()
    {   
        $this->load->view('auth/default_login_page.php');
    }

    public function authentication()
    {
        if($post = $this->input->post()){
            $this->form_rules_required($post);

            $password = $this->input->post('pass',TRUE);
            $hashPass = password_hash($password,PASSWORD_DEFAULT);
            $test     = password_verify($password, $hashPass);

            if($this->form_validation->run() == TRUE){

                // var_dump($hashPass);
                if($sess_data = $this->m_auth->validate($post['username'])){
                  if(password_verify($password, $sess_data['password'])){
                        $this->session->set_userdata($sess_data);
                        if($sess_data['user_level'] == 1){
                            redirect('superadmin/dashboard');
                        } else if($sess_data['user_level'] == 5) {
                            redirect('user/admin/dashboard');
                        } else if($sess_data['user_level'] == 6) {
                            redirect('user/student/dashboard');
                        }
                  } else {
                    $this->session->set_flashdata('mark', 'fail');
                    redirect('auth');
                  }
                }
                else {
                    $this->session->set_flashdata('mark', 'fail');
                    redirect('auth');
                }
            }
        } 
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }

    // public function fill_session($data)
    // {
    //     $sess = array(
    //         'id' => $data['user_id'],
    //         'id' => $data['email'],
    //         'id' => $data['picture'],
    //         'id' => $data['picture'],
    //     );
    //     $this->session->set_userdata();
    // }



}