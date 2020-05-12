<?php
Class MY_Controller extends CI_Controller{

    public $data=array();
    
    public function __construct()
    {
        //Extends from CI_Controller
        parent::__construct();

        $admin=$this->uri->segment(1);

        switch($admin){
            case 'admin':
                {
                    //Process data in admin
                     $this->load->helper('admin');
                     $this->checkLogin();
                     break;
                }
      
            default:
            {
                //Process data outside admin
                $this->load->model('menu_model');
                $input=array();
                $input['where']=array('parent_id'=>0);
                $catalog_list=$this->menu_model->get_list($input);
                
                foreach($catalog_list as $catalogs){
                    $input['where']=array('parent_id'=>$catalogs->id);
                    $subs=$this->menu_model->get_list($input);
                    $catalogs->sub=$subs;
                }
                $this->data['catalog_list']=$catalog_list;

                $this->load->model('news_model');
                $input['limit']=array(5,0);
                $this->data['news']=$this->news_model->get_list($input['limit']);

                $user_login=$this->session->userdata('user_login');
                $this->data['user_login']=$user_login;
                if($user_login)
                {
                    $this->load->model('user_model');
                    $user_info=$this->user_model->get_info($user_login);
                    $this->data['user_info']=$user_info;
                }
                $this->load->library('cart');
                $this->data['total_items']=$this->cart->total_items();
                break;
            }

        }
        
    }

    private function checkLogin(){
        $controller=$this->uri->rsegment('1');
        $controller=strtolower($controller);
        $login=$this->session->userdata('login');
        if(!$login && $controller!='login'){
            redirect(admin_url('login'));
        }
        if($login && $controller=='login'){
            redirect(admin_url('home'));
        }
    }
}