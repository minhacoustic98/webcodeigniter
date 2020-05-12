<?php 
class Upload extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login')&&$this->session->userdata('login_info')){
            $this->data['infomation']=$this->session->userdata['login_info'];
         }
    }

    function index(){
      
        if($this->input->post('submit'))
      {
        $this->load->library('upload_library');
        $upload_path='./upload/user';
        $data=$this->upload_library->upload($upload_path,'image');
        printData($data);
      }
        $this->data['temp']='admin/upload/index';
        $this->load->view('admin/main',$this->data);

    }

    function upload_files(){
        if($this->input->post('submit'))
        {
           
            $this->load->library('upload_library');
            $upload_path='./upload/user';
            $data=$this->upload_library->upload_multi($upload_path,'image_list');
            
            printData($data);
           
            
        }
        $this->data['temp']='admin/upload/upload_files';
        $this->load->view('admin/main',$this->data);
    }
}