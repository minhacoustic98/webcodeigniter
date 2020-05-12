<?php
class Comment extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        if($this->session->userdata('login')&&$this->session->userdata('login_info')){
            $this->data['infomation']=$this->session->userdata['login_info'];
         }
         $this->load->model('feedback_model');
    }

    function index()
    {

        $message=$this->session->set_flashdata('message');
        $this->data['message']=$message;

        //Total comment
        $total_rows = $this->feedback_model->get_total();
        $this->data['total_rows'] = $total_rows;

        //Paginations
        $this->load->library('pagination');
        $config=array();
        $config['total_rows']=$total_rows;
        $config['base_url']=admin_url('comment/index');
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

        $list=$this->feedback_model->get_list($input);
        $this->data['list']=$list;

        $this->data['temp']='admin/comment/index';
        $this->load->view('admin/main',$this->data);
    }

    function del()
    {
        $id=$this->uri->rsegment(3);
        $id=intval($id);

        $comment=$this->feedback_model->get_info($id);
        if(!$comment)
        {
            $this->session->set_flashdata('message','Comment không tồn tại!');
            redirect(admin_url('comment'));
        }

        $this->feedback_model->delete($id);
        $this->session->set_flashdata('message','Xóa thành công!');
        redirect(admin_url('comment'));
    }

    function del_multi()
    {
        $id=$this->input->post('ids');
        foreach($id as $i)
        {
            $this->_del($i);
        }
    }
    private function _del($id,$redirect=true){
        $info=$this->feedback_model->get_info($id);

        if(!$info){
            $this->session->set_flashdata('message','Không tìm thấy comment!');
            if($redirect)
            {
                redirect(admin_url('comment'));
            }
            else{
                return false;
            }
        }

        
        $this->menu_model->delete($id);
    }
}