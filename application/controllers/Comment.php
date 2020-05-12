<?php 

class Comment extends MY_Controller
{
     /*
   * Ham khi khoi tao
   */
   public function __construct()
   {
       parent::__construct();
       //load các file để validation form
       $this->load->helper('form');
       $this->load->model('comment_model');
       //load file model
   	  
   	  
   }
   
   /*
    * Trang comment
    */
   public function save()
   { 
        
   }
   
}