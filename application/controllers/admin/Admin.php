<?php
Class Admin extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        if($this->session->userdata('login')&&$this->session->userdata('login_info')){
            $this->data['infomation']=$this->session->userdata['login_info'];
         }
    }
    
    function index(){
        $input=array();
        
        $list_admin_info=$this->admin_model->get_list($input);
        $this->data['list']=$list_admin_info;
        $this->data['total']=$this->admin_model->get_total($input);
        $this->data['temp']='admin/admin/index';
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        $this->load->view('admin/main',$this->data);
    } 

    function addNewAdmin(){
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post()) {
            $this->form_validation->set_rules('name','Họ và tên','required|min_length[8]');
            $this->form_validation->set_rules('username','Username','required|callback_check_username');
            $this->form_validation->set_rules('password','Password','required|min_length[6]');
            $this->form_validation->set_rules('repass','Nhập lại mật khẩu','matches[password]');

            if($this->form_validation->run()) {
                //Add to database

               $name=$this->input->post('name');
               $username=$this->input->post('username');
               $password=$this->input->post('password');
                
               $data_info=array(
                   'name'=>$name,
                   'username'=>$username,
                   'password'=>md5($password)
               );

               if($this->admin_model->create($data_info))
               {
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thành công!');
                    
               }
               else{
                $this->session->set_flashdata('message','Thêm mới thất bại ! Thử lại sau');
               }

               redirect(admin_url('admin'));
            }

            
        }
        $this->data['temp']='admin/admin/addNewAdmin';
        $this->load->view('admin/main',$this->data);
    }

  

    function check_username(){
        $username=$this->input->post('username');

        $where=array('username'=>$username);
        if($this->admin_model->check_exists($where)){
            //tra ve thong bao loi
            $this->form_validation->set_message(__FUNCTION__,'Username đã tồn tại!');
            return false;
        }

        return true;
    }

    function edit() {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $id=$this->uri->rsegment('3');

        $id=intval($id);
        $info=$this->admin_model->get_info($id);

        if(!$info){
            $this->session->set_flashdata('message','Không tìm thấy tài khoản!');
            redirect(admin_url('admin'));
        }


        if($this->input->post()) {
            $this->form_validation->set_rules('name','Họ và tên','required|min_length[8]');
            $this->form_validation->set_rules('username','Username','required');

            $password=$this->input->post('password');

            if($password) {
                $this->form_validation->set_rules('password','Password','required|min_length[6]');
                $this->form_validation->set_rules('repass','Nhập lại mật khẩu','matches[password]');
            }

            if($this->form_validation->run()) {

                    $name=$this->input->post('name');
                    $username=$this->input->post('username');

                    $data_update=array(
                        'name'=>$name,
                        'username'=>$username
                    );

                    if($password){
                        $password=md5($password);
                        $data_update['password']=$password;
                    }

                    if($this->admin_model->update($id,$data_update)){
                        $this->session->set_flashdata('message','Cập nhật thành công!');
                    }
                    else{
                        $this->session->set_flashdata('message','Cập nhật thất bại!');
                    }
                    redirect(admin_url('admin'));
            }
        }

        $this->data['info']=$info;
        $this->data['temp']='admin/admin/edit';
        $this->load->view('admin/main',$this->data);

    }


    function delete(){
        $id=$this->uri->rsegment('3');
        $id=intval($id);
        $info=$this->admin_model->get_info($id);

        if(!$info){
            $this->session->set_flashdata('message','Không tìm thấy tài khoản!');
            redirect(admin_url('admin'));
        }
      
        $this->admin_model->delete($id);
        $this->session->set_flashdata('message','Xóa thành công!');
        redirect(admin_url('admin'));
    }

    function logout()
    {
        if($this->session->userdata('login')) {
            $this->session->unset_userdata('login');
            redirect(admin_url('login'));
        }
    }

}