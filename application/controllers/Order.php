<?php
class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }


    function checkout()
    {
        //Get cart info
        $cart=$this->cart->contents();
        $total_items=$this->cart->total_items();
        if($total_items<=0)
        {
            redirect();
        }

        //Check user info
        
        $total_amount=0;
        foreach($cart as $row)
        {
            $total_amount+=$row['subtotal'];
        }
        
        $this->data['total_amount']=$total_amount;
        
        $user_id=0;
        $user='';
        if($this->session->userdata('user_login'))
        {
           $user_id=$this->session->userdata('user_login');
           $user=$this->user_model->get_info($user_id);

        }

        $this->load->library('form_validation');
        $this->load->helper('form');
        if ($this->input->post()) {
          
            
            $this->form_validation->set_rules('name', 'Họ và tên', 'required|min_length[8]');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('payment', 'Thanh toán', 'required');
            
            if ($this->form_validation->run()) {
                //Add to database

                $username = $this->input->post('name');
                $userphone = $this->input->post('phone');
                $useremail = $this->input->post('email');
                $message=$this->input->post('message');
                $payment=$this->input->post('payment');
                $data_info = array(
                    'type'=>0,
                    'status'=>0, //not purchased
                    'user_id'=>$user_id, //id of user
                    'username' => $username,
                    'useremail' => $useremail,
                    'userphone' => $userphone,
                    'amount'=>$total_amount,
                    'payment'=>$payment,
                    'message'=>$message,
                    'created'=>now()
                   
                );

                
               $this->load->model('transaction_model');

               $this->transaction_model->create($data_info);
               $trans_id=$this->db->insert_id();

               $this->load->model('order_model');
               
               foreach($cart as $row)
               {
                   $data=array(
                       'transaction_id'=>$trans_id,
                       'product_id'=>$row['id'],
                       'quantity'=>$row['qty'],
                       'amount'=>$row['subtotal'],
                       'status'=>0
                   );

                   $this->order_model->create($data);

               }
               
               $this->cart->destroy();
               $this->session->set_flashdata('message','Đặt hàng thành công!!');
               
               redirect(site_url(''));
            }
        }


        $this->data['user']=$user;
        $this->data['temp']='site/order/checkout';
        $this->load->view('site/layout',$this->data);
    }
}