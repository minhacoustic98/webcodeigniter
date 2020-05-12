<?php
Class Login extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }
    public function index(){
        //Check login
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post()){
            $this->form_validation->set_rules('login','login','callback_check_login');
            if($this->form_validation->run()){
                
                

                $input=array();
                $username=$this->input->post('username');
                $password=$this->input->post('password');
                
                $input['where']=array('username'=>$username,'password'=>md5($password));
                $info_admin=$this->admin_model->get_row($input);
          
                $arrSession=array(
                    'login'=>true,
                    'login_info'=>$info_admin
                );

                $this->session->set_userdata($arrSession);

                redirect(admin_url('home'));
            }

        }
        $this->load->view('admin/login/index');
    }

    public function check_login(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $password=md5($password);

        $where=array(
            'username'=>$username,
            'password'=>$password
        );

        if($this->admin_model->check_exists($where)){
            return true;
        }
        else{
            $this->form_validation->set_message(__FUNCTION__,'Đăng nhập thất bại!');
            return false;
        }

    }
}