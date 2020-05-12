<?php
class Slide extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('slide_model');
        if ($this->session->userdata('login') && $this->session->userdata('login_info')) {
            $this->data['infomation'] = $this->session->userdata['login_info'];
        }
    }
    public function index()
    {
        $list=$this->slide_model->get_list();
        $this->data['list']=$list;

        $message=$this->session->flashdata('message');
        $this->data['message']=$message;

       
        $this->data['temp']='admin/slide/index';
        $this->load->view('admin/main',$this->data);
    }

    public function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $id=$this->uri->rsegment('3');

        $id=intval($id);
        $info=$this->slide_model->get_info($id);

        if(!$info){
            $this->session->set_flashdata('message','Không tìm thấy slide!');
            redirect(admin_url('slide'));
        }


        if($this->input->post()) {
            $this->form_validation->set_rules('name','Tên slide','required');

            if($this->form_validation->run()) {
                
                $this->load->library('upload_library');
                $upload_path='./upload/slide/';
                $upload_data=$this->upload_library->upload($upload_path,'image_link');
                if($upload_data['file_name'])
                {   
                    $image_link=$upload_data['file_name'];
                }
               $name=$this->input->post('name');
               $image_name=$this->input->post('image_name');
               $link=$this->input->post('link');
               $sort_order=$this->input->post('sort_order');
               
               
               $data_slide=array(
                   'name'=>$name,
                   'image_link'=>$image_link,
                   'image_name'=>$image_name,
                   'link'=>$link,
                   'sort_order'=>$sort_order
               );

               if($this->slide_model->update($id,$data_slide))
               {
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thành công!');
                    
               }
               else{
                $this->session->set_flashdata('message','Cập nhật thất bại ! Thử lại sau');
               }

               redirect(admin_url('slide'));
            }
        }

        $this->data['info']=$info;
        $this->data['temp']='admin/slide/edit';
        $this->load->view('admin/main',$this->data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()) {
            $this->form_validation->set_rules('name','Tên slide','required|callback_check_slide');
        
            if($this->form_validation->run()) {
                //Add to database

                $this->load->library('upload_library');
                $upload_path='./upload/slide/';
                $upload_data=$this->upload_library->upload($upload_path,'image_link');
                if($upload_data['file_name'])
                {   
                    $image_link=$upload_data['file_name'];
                }
               $name=$this->input->post('name');
               $image_name=$this->input->post('image_name');
               $link=$this->input->post('link');
               $sort_order=$this->input->post('sort_order');
               
               
               $data_slide=array(
                   'name'=>$name,
                   'image_link'=>$image_link,
                   'image_name'=>$image_name,
                   'link'=>$link,
                   'sort_order'=>$sort_order
               );

               if($this->slide_model->create($data_slide))
               {
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thành công!');
                    
               }
               else{
                $this->session->set_flashdata('message','Thêm mới thất bại ! Thử lại sau');
               }

               redirect(admin_url('slide'));
            }

            
        }
        

        $this->data['temp']='admin/slide/add';
        $this->load->view('admin/main',$this->data);
    }

     function check_slide()
    {
        $name=$this->input->post('name');

        $where=array('name'=>$name);
        if($this->slide_model->check_exists($where)){
            //tra ve thong bao loi
            $this->form_validation->set_message(__FUNCTION__,'Tên slide đã tồn tại!');
            return false;
        }

        return true;
    }

    function delete()
    {
        $id=$this->uri->rsegment('3');
        $id=intval($id);
        $info=$this->slide_model->get_info($id);

        if(!$info){
            $this->session->set_flashdata('message','Không tìm thấy slide!');
            redirect(admin_url('admin'));
        }
        if (file_exists('./upload/slide/' . $info->image_link)) {
            unlink('./upload/slide/' . $info->image_link);
        }

        $this->admin_model->delete($id);
        $this->session->set_flashdata('message','Xóa thành công!');
        redirect(admin_url('slide'));
    }

    function del_multi(){
        $ids=$this->input->post('ids');
        foreach($ids as $i){
            $this->_del($i);
        }
    }

    private function _del($id){
        $info = $this->slide_model->get_info($id);


        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy slide!');
            redirect(admin_url('slide'));
        }
        $this->slide_model->delete($id);
        
        if (file_exists('./upload/slide/' . $info->image_link)) {
            unlink('./upload/slide/' . $info->image_link);
        }


        
    }
}