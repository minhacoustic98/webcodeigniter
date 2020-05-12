<?php
class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login')&&$this->session->userdata('login_info')){
            $this->data['infomation']=$this->session->userdata['login_info'];
         }
         $this->load->model('user_model');
    }

    function index()
    {
         //Total comment
         $total_rows = $this->user_model->get_total();
         $this->data['total_rows'] = $total_rows;
 
         //Paginations
         $this->load->library('pagination');
         $config=array();
         $config['total_rows']=$total_rows;
         $config['base_url']=admin_url('user/index');
         $config['per_page']=5;
         $config['uri_segment']='4';
         $config['next_link']='Kế tiếp';
         $config['prev_link']='Trang trước';
 
         $this->pagination->initialize($config);
         $segment=$this->uri->segment(4);
         $segment=intval($segment);
 
         $input=array();
         $input['limit']=array(
             $config['per_page'],
             $segment
         );

         $list=$this->user_model->get_list($input);
         $this->data['list']=$list;
 

        $this->data['temp']='admin/user/index';
        $this->load->view('admin/main',$this->data);
    }
}