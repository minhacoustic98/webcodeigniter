<?php
class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    /**
     *  Register
     * 
     */

    function register()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Họ và tên', 'required|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_mail');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'required');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');


            if ($this->form_validation->run()) {
                //Add to database

                $name = $this->input->post('name');
                $password = $this->input->post('password');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $phone = $this->input->post('phone');

                $data_info = array(
                    'password' => md5($password),
                    'name' => $name,
                    'address' => $address,
                    'email' => $email,
                    'phone' => $phone
                );

                if ($this->user_model->create($data_info)) {
                    $this->session->set_flashdata('message', 'Đăng ký thành viên thành công!');
                } else {
                    $this->session->set_flashdata('message', 'Có lỗi! Vui lòng tử lại sau');
                }

                redirect(site_url());
            }
        }
        //Load view

        $this->data['temp'] = 'site/user/register';
        $this->load->view('site/layout', $this->data);
    }

    function login()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        if($this->input->post())
        {
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('login','Login','callback_check_login');
          
            if($this->form_validation->run())
            {
                $user=$this->get_userinfo();
                $this->session->set_userdata('user_login',$user->id);
                $this->session->set_flashdata('message', 'Đăng nhập thành công');

                redirect();
            }

        }

        $this->data['temp'] = 'site/user/login';
        $this->load->view('site/layout', $this->data);
    }

   
        function logout()
        {
            if($this->session->userdata('user_login')) {
                $this->session->unset_userdata('user_login');
                redirect();
            }
        }
    

    function check_mail()
    {
        $email = $this->input->post('email');

        $where = array('email' => $email);
        if ($this->user_model->check_exists($where)) {
            //tra ve thong bao loi
            $this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại!');
            return false;
        }

        return true;
    }

    function check_login()
    {
       $user=$this->get_userinfo();
        if($user){
            return true;
        }
        else{
            $this->form_validation->set_message(__FUNCTION__,'Đăng nhập thất bại!');
            return false;
        }

    }

    function get_userinfo()
    {
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $password=md5($password);

        
        $where=array(
            'email'=>$email,
            'password'=>$password
        );

        $user=$this->user_model->get_info_rule($where);
        return $user;
    }

    function index()
    {
        if(!$this->session->userdata('user_login'))
        {
            redirect();
        }

        $user_id=$this->session->userdata('user_login');
        $user=$this->user_model->get_info($user_id);
        if(!$user)
        {
            redirect();
        }
        $this->data['user']=$user;
        $this->data['temp']='site/user/index';
        $this->load->view('site/layout',$this->data);

    }

    function edit()
    {
        if(!$this->session->userdata('user_login'))
        {
            redirect(site_url('user/login'));
        }

        $user_id=$this->session->userdata('user_login');
        $user=$this->user_model->get_info($user_id);
        if(!$user)
        {
            redirect();
        }

        $this->load->library('form_validation');
        $this->load->helper('form');
        if ($this->input->post()) {
            $password = $this->input->post('password');
            if($password)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[8]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches|password');
            }
            $this->form_validation->set_rules('name', 'Họ và tên', 'required|min_length[8]');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'required');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');

            
            if ($this->form_validation->run()) {
                //Add to database

                $name = $this->input->post('name');
                $address = $this->input->post('address');
                $phone = $this->input->post('phone');

                $data_info = array(
                    'name' => $name,
                    'address' => $address,
                    'phone' => $phone
                );

                if($password)
                {
                    $data_info['password']=$password;
                }

                if ($this->user_model->update($user_id,$data_info)) {
                    $this->session->set_flashdata('message', 'Cập nhật thành công!');
                } else {
                    $this->session->set_flashdata('message', 'Có lỗi! Vui lòng tử lại sau');
                }

                redirect(site_url('user'));
            }
        }

        $this->data['user']=$user;
        $this->data['temp']='site/user/edit';
        $this->load->view('site/layout',$this->data);
    }
}
