<?php
class Chatbot extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        if ($this->session->userdata('login') && $this->session->userdata('login_info')) {
            $this->data['infomation'] = $this->session->userdata['login_info'];
        }
        
        $this->load->model('chatbot_model');
    }

    function index()
    {
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;

        $total_rows=$this->chatbot_model->get_count_chatbot();
        $this->data['total_rows']=$total_rows;

          //Paginations
          $this->load->library('pagination');
          $config=array();
          $config['total_rows']=$total_rows;
          $config['base_url']=admin_url('chatbot/index');
          $config['per_page']=5;
          $config['uri_segment']='4';
          $config['next_link']='Kế tiếp';
          $config['prev_link']='Trang trước';
  
          $this->pagination->initialize($config);
          $segment=$this->uri->segment(4);
          $segment=intval($segment);
  
        
  
          $list=$this->chatbot_model->get_limit_chatbot($config['per_page'], $segment);
          $this->data['list']=$list;
   

        $this->data['temp']='admin/chat/index';
        $this->load->view('admin/main',$this->data);
    }

    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post())
        {
            $this->form_validation->set_rules('question','Câu hỏi','required');
            $this->form_validation->set_rules('answer','Câu trả lời','required');
            if($this->form_validation->run())
            {
                $data_add=array(
                    'question'=>$this->input->post('question'),
                    'answer'=>$this->input->post('answer'),
                    'created'=>now(),
                    'updated'=>0
                );

                if($this->chatbot_model->add_chatbot($data_add))
                {
                    $this->session->set_flashdata('message','Thêm dữ liệu thành công!');
                }   
                else
                {
                    $this->session->set_flashdata('message','Thêm dữ liệu thất bại!');

                }
                redirect(admin_url('chatbot'));

            }
        }

        $this->data['temp']='admin/chat/add';
        $this->load->view('admin/main',$this->data);
    }

    function delete()
    {
        $id=$this->uri->rsegment(3);
        $id=intval($id);
        $info=$this->chatbot_model->get_chatbot($id);
        if(!$info)
        {
            $this->session->set_flashdata('message','Có lỗi, vui lòng thử lại!');
           
        }
        else{
            $this->chatbot_model->delete_chatbot($id);
            $this->session->set_flashdata('message','Xóa thành công!');

        }

        redirect(admin_url('chatbot'));
    }



    function edit()
    {
        $id=$this->uri->rsegment(3);
        $id=intval($id);

        $info=$this->chatbot_model->get_chatbot($id);
        if(!$info)
        {
            $this->session->set_flashdata('message','Có lỗi, vui lòng thử lại!');
            redirect(admin_url('chatbot'));
        }

        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post())
        {
            $this->form_validation->set_rules('question','Câu hỏi','required');
            $this->form_validation->set_rules('answer','Câu trả lời','required');
            if($this->form_validation->run())
            {
                $data_update=array(
                    'question'=>$this->input->post('question'),
                    'answer'=>$this->input->post('answer'),
                    'updated'=>now()
                );

                if($this->chatbot_model->update_chatbot($id,$data_update))
                {
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thành công!');
                }   
                else
                {
                    $this->session->set_flashdata('message','cập nhật dữ liệu thất bại!');

                }
                redirect(admin_url('chatbot'));

            }
    }

    $this->data['info']=$info;
    $this->data['temp']='admin/chat/edit';
    $this->load->view('admin/main',$this->data);
}
}