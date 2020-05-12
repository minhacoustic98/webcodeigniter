<?php
Class Menu extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        if($this->session->userdata('login')&&$this->session->userdata('login_info')){
            $this->data['infomation']=$this->session->userdata['login_info'];
         }
    }

    function index() {
        $list=$this->menu_model->get_list();
        $this->data['list']=$list;

        $message=$this->session->flashdata('message');
        $this->data['message']=$message;

        $this->data['temp']='admin/menu/index';
        $this->load->view('admin/main',$this->data);
    }

    function add(){
        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()) {
            $this->form_validation->set_rules('name','Tên danh mục','required');

            if($this->form_validation->run()) {
                //Add to database

               $name=$this->input->post('name');
               $level=$this->input->post('level');
               $sort_order=$this->input->post('sort_order');
               $parent_id=$this->input->post('parent_id');
               $data_menu=array(
                   'name'=>$name,
                   'level'=>$level,
                   'sort_order'=>$sort_order,
                   'parent_id'=>$parent_id
               );

               if($this->menu_model->create($data_menu))
               {
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thành công!');
                    
               }
               else{
                $this->session->set_flashdata('message','Thêm mới thất bại ! Thử lại sau');
               }

               redirect(admin_url('menu'));
            }

            
        }
        

        //Get menu list parent
        $input['where']=array(
            'parent_id'=>0
        );

        $list=$this->menu_model->get_list($input);
        $this->data['list']=$list;

        $this->data['temp']='admin/menu/add';
        $this->load->view('admin/main',$this->data);
    }

    function edit(){
        $this->load->library('form_validation');
        $this->load->helper('form');

        $id=$this->uri->rsegment('3');

        $id=intval($id);
        $info=$this->menu_model->get_info($id);
        
        if(!$info){
            $this->session->set_flashdata('message','Không tìm thấy danh mục!');
            redirect(admin_url('menu'));
        }
        
        if($this->input->post()) {
            $this->form_validation->set_rules('name','Tên danh mục','required');

            if($this->form_validation->run()) {
                //Add to database

               $name=$this->input->post('name');
               $level=$this->input->post('level');
               $sort_order=$this->input->post('sort_order');
               $parent_id=$this->input->post('parent_id');
               $data_menu=array(
                   'name'=>$name,
                   'level'=>$level,
                   'sort_order'=>$sort_order,
                   'parent_id'=>$parent_id
               );

               if($this->menu_model->update($id,$data_menu))
               {
                    $this->session->set_flashdata('message','Cập nhật  dữ liệu thành công!');
                    
               }
               else{
                $this->session->set_flashdata('message','Cập nhật thất bại ! Thử lại sau');
               }

               redirect(admin_url('menu'));
            }

            
        }
        

        //Get menu list parent
        $input['where']=array(
            'parent_id'=>0
        );

        $list=$this->menu_model->get_list($input);
        $this->data['list']=$list;
        $this->data['info']=$info;

        $this->data['temp']='admin/menu/edit';
        $this->load->view('admin/main',$this->data);
    }

    function delete(){
        $id=$this->uri->rsegment('3');
        $id=intval($id);
        $info=$this->menu_model->get_info($id);

        if(!$info){
            $this->session->set_flashdata('message','Không tìm thấy danh mục!');
            redirect(admin_url('menu'));
        }

          //Check menu has product associated
          $this->load->model('product_model');
          $product=$this->product_model->get_info_rule(array('menu_id'=>$id),'id');
          if($product)
          {
              $this->session->set_flashdata('message','Danh mục chứa sản phẩm,xóa sản phẩm trước khi xóa danh mục!');
              redirect(admin_url('product'));
  
          }
        
        $this->menu_model->delete($id);
        $this->session->set_flashdata('message','Xóa thành công!');
        redirect(admin_url('menu'));
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
        $info=$this->menu_model->get_info($id);

        if(!$info){
            $this->session->set_flashdata('message','Không tìm thấy danh mục!');
            if($redirect)
            {
                redirect(admin_url('menu'));
            }
            else{
                return false;
            }
        }

          //Check menu has product associated
          $this->load->model('product_model');
          $product=$this->product_model->get_info_rule(array('menu_id'=>$id),'id');
          if($product)
          {
              $this->session->set_flashdata('message','Danh mục '.$info->name.' chứa sản phẩm,xóa sản phẩm trước khi xóa danh mục!');
              if($redirect)
              {
                  redirect(admin_url('menu'));
              }
              else{
                  return false;
              }
          }
        
        $this->menu_model->delete($id);
    }

   
}


