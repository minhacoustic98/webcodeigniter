<?php 

Class Home extends MY_Controller{
    function index() {

        $this->load->model('slide_model');
        $this->load->model('product_model');
        $this->data['temp']='site/home/index';
        $this->data['slide_list']=$this->slide_model->get_list();
        $input=array();
        $input['limit']=array(3,0);
           $product_newest=$this->product_model->get_list($input);
        $this->data['product_newest']=$product_newest;
        $input['order']=array('buyed','DESC');
     
        $product_buyed=$this->product_model->get_list($input);
        $this->data['product_buyed']=$product_buyed;
       
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;

        $this->load->view('site/layout',$this->data);
    }
}